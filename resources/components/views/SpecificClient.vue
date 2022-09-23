<template>
    <div class="container flex mt-3">
        <div>
            <modal v-if="isEditUser">
                <template v-slot:header>
                    <h4>Edit Client</h4>
                </template>
                <template v-slot:body>
                    <div class="mb-3">
                    <label for="firstName" class="form-lable">First Name:</label>
                    <input type="text" name="" id="firstName" class="form-control" v-model="user.first_name">
                    </div>
                    <div class="mb-3">
                        <label for="middleName" class="form-lable">Middle Name:</label>
                        <input type="text" name="" id="middleName" class="form-control" v-model="user.middle_name">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-lable">Last Name:</label>
                        <input type="text" name="" id="lastName" class="form-control" v-model="user.last_name">
                    </div>
                    <div class="mb-3">
                        <label for="dateOfBirth" class="form-lable">Date of Birth:</label>
                        <input type="date" name="" id="dateOfBirth" class="form-control" v-model="user.date_of_birth">
                    </div>
                    <div class="mb-3">
                        <select name="" class="form-select" id="selectedGender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="barangay" class="form-lable">Barangay:</label>
                        <input type="text" name="" id="barangay" class="form-control" v-model="user.barangay">
                    </div>
                    <div class="mb-3">
                        <label for="municipality" class="form-lable">Municipality:</label>
                        <input type="text" name="" id="municipality" class="form-control" v-model="user.municipality">
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-lable">Province:</label>
                        <input type="text" name="" id="dateOfBirth" class="form-control" v-model="user.province">
                    </div>
                </template>
                
                <template v-slot:footer>
                    <button type="button" class="btn btn-secondary" @click="triggerEditModal">Close</button>
                <button type="button" class="btn btn-primary" @click="updateClient">Save changes</button>
                </template>
                <div v-if="hasError" class="alert alert-danger" role="alert">
                    There was an error. Please check data.
                </div>
            </modal>
            <div v-if="!userStore.user">
                <div class="flex justify-content-center">
                    <p>No data for now.</p>
                </div>
            </div>
            <div v-else class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ userStore.user.first_name }} {{ userStore.user.middle_name }} {{ userStore.user.last_name }}</h4>
                            <p>{{ userStore.user.gender }}</p>
                            <p>{{ userStore.user.date_of_birth }}</p>
                            <p>{{ userStore.user.barangay }} {{ userStore.user.municipality }} {{ userStore.user.province }}</p>
                            <div class="flex">
                                <div class="row mt-1 justify-content-center">
                                    <router-link class="btn btn-primary col-10" :to="{name: 'add-assistance', params: {id: user.id}}">Add Assistance</router-link>
                                </div>
                                <div class="row mt-1 justify-content-center">
                                    <a href="#" class="btn btn-warning col-10" @click="triggerEditModal">Edit Client Data</a>
                                </div>
                                <div class="row mt-1 justify-content-center">
                                    <a href="#" class="btn btn-danger col-10">Delete Client Data</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h1>Assistance Data</h1>
                    <table class="table table-striped">
                    <thead>
                            <tr>
                                <th>
                                    Assistance Type
                                </th>
                                <th>Patient Name</th>
                                <th>Date Requested</th>
                                <th>Assistance Details</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr v-for="assistance in userStore.user.assistances" :key="assistance.id">
                            <td>{{ assistance.assistance }}</td>
                            <td>{{ assistance.patient.first_name }} {{ assistance.patient.middle_name }} {{ assistance.patient.last_name }}</td>
                            <td>{{ convertTime(assistance.date_time_requested) }}</td>
                            <td><button class="btn btn-secondary">View Details</button></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useUsersStore} from '../../js/Store/UsersStore';

import {useRouter, useRoute } from 'vue-router';
import { onMounted, onBeforeMount, onUpdated, ref } from 'vue';
import Modal from '../modal/TheModal.vue';
import moment from 'moment';
import { storeToRefs } from 'pinia';
export default {
    components: {
        'modal': Modal,
    },  
    setup() {
        let userStore = useUsersStore();
        const router = useRouter();
        const route = useRoute();
        const isEditUser = ref(false);
        const user = ref({});
        let client_id = route.params.id;
        const {hasError} = storeToRefs(useRoute);

        let loadUserData = () =>{
            axios.get(`http://127.0.0.1:8000/api/clients/view/${route.params.id}`)
            .then((response)=>{
                if(response.data.status === 'success'){
                    userStore.user = response.data.client;
                    user.value = userStore.user;
                }
            })
        }

        let updateClient = () => {
            userStore.updateClient(client_id, user.value);
            if(!hasError){
                triggerEditModal();
            }
            loadUserData();
        }

        let triggerEditModal = () =>{
            isEditUser.value = !isEditUser.value;
        }

        let convertTime = (value) => {
            return moment(value).format('MMM Do YYYY');
        }

        onBeforeMount(()=>{
            loadUserData();
        })
        return {
            userStore, 
            isEditUser,
            user,
            hasError,
            loadUserData,
            triggerEditModal,
            convertTime,
            updateClient,
        }
    },
    
}
</script>