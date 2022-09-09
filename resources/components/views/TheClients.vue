<template>
    <div class="flex flex-column container">
            
        <the-modal v-if="showAddModal">
            <!-- start of modal -->
            <template v-if="inputError" v-slot:error>
                <div class="mt-3">
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            There was an error in your input data. Please check the data.
                        </div>
                    </div>
                </div>
            </template>
            <template v-slot:header>{{ title }}</template>
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
                    <select name="" class="form-select" id="selectedGender" ref="gender">
                        <option selected disabled>Select a Gender</option>
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
                <button type="button" class="btn btn-secondary" @click="showAddModalTrigger">Close</button>
                <button type="button" class="btn btn-primary" @click="addClientTrigger">Save changes</button>
            </template>
            
        </the-modal>
        <!-- end of modal -->
        <div class="flex">
           <div class="row mt-3">
                <div class="col-md-8">
                    <button class="btn btn-primary" @click="showAddModalTrigger">Add Clients</button>
                    <button class="btn btn-secondary mx-2" @click="loadUsers">Refresh</button>
                </div>
                <div class="col-md-4 px-4">
                    <input type="text" class="form-control bg-white" placeholder="Search Clients..." v-model="searchLastname" @keyup="userSearch">
                </div>
           </div>
        </div>
        <!-- <div v-if="!userStore.users">
            <div class="container text-center mt-3">
                <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div> -->
        
        <div class="mt-3">
            <div v-if="success" class="alert alert-success" role="alert">
                    A Client was successfully created.
            </div>
            <table class="table table-striped"> 
                <thead class="text-uppercase fw-bold">
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Option</th>
                    </tr>   
                </thead>
                <tbody>
                    <tr v-for="user in userStore.users" :key="user.id">
                        <td>{{ user.first_name }} {{ user.middle_name }} {{ user.last_name }}</td>
                        <td>{{ user.date_of_birth }}</td>
                        <td>{{ user.gender }}</td>
                        <td>{{ user.barangay }} {{ user.municipality }} {{ user.province }}</td>
                        <td><router-link class="btn btn-warning btn-sm" :to="{ name: 'specific-client', params: {id: user.id} }">View Details</router-link></td>
                    </tr>
                </tbody>
            </table>
                <pagination v-if="showPagination">
                    <template v-slot:links>
                        <li v-for="link, index in pagData" :key="index" class="page-item"><button class="page-link" :disabled="disableButton(link.url)" @click="paginatedClick(link.url)">{{ cleanNextPrevious(link.label) }}</button></li>
                    </template>
                </pagination>
        </div>
    </div>
</template>

<script>

import TheModal from '../modal/TheModal.vue';
import ThePagination from '../UI/ThePagination.vue';
import {computed, onBeforeMount , ref, watch} from 'vue';
import useUsersStore from '../../js/Store/UsersStore';
export default {
    components: {
        'the-modal': TheModal,
        'pagination': ThePagination,
    },
    setup() {
        let users = ref([]);
        let user = ref({
            first_name: '',
            middle_name: '',
            last_name: '',
            date_of_birth: null,
            gender: '',
            barangay: '',
            municipality: '',
            province: '',
        });
        let success = ref(false);
        let inputError = ref(false);
        let selectedGender = '';
        let title = ref('Add Client');
        let showAddModal = ref(false);
        const userStore = useUsersStore();
        let searchLastname = ref('');
        let pagData = ref([]);

        let loadUsers = () => {
            userStore.loadUsers();
        }

        let showAddModalTrigger = () => showAddModal.value = !showAddModal.value;

        let addClientTrigger = ()=>{
            user.value.gender = document.getElementById('selectedGender').value;
            saveInputData();
        }

        let saveInputData = () => {
            axios.post('/api/clients/add', user.value)
            .then((response) =>{
                if(response.data.status == 'success'){
                    showAddModalTrigger();
                    message(success)
                    loadUsers();
                }else {
                    message(inputError)
                }
            }).catch((err)=>{
                console.log(err.response);
                message(inputError)
            });
        }

        let message = (varName) => {
            varName.value = true
            setTimeout(()=>{
                varName.value = false
            }, 5000)
        }

        let userSearch = () => {
            if(!userStore.isLoading){
                userStore.searchUser(searchLastname.value);
                pagData.value = paginationData();
            }
        }

        onBeforeMount(()=>{
            loadUsers();
            showPagination();
            pagData.value = paginationData();
           
        });

        let cleanNextPrevious = ((txt)=>{
            if(txt.includes('&laquo;') || txt.includes('&raquo;')) {
                return txt.replace('&laquo;', '').replace('&raquo;', '');
            }
            return txt;
        });

        let paginatedClick = ((url)=>{
            axios.get(url)
            .then((response)=>{
                userStore.users = response.data.data.data;
                userStore.pagination = response.data.data;
            })
        });

        let disableButton = ((url)=>{
            if(url === null){
                return true
            }
        });

        let showPagination = () =>{
            if(userStore.pagination !==  undefined){
               if(userStore.users.length > 4){
                return true
               }
            }
            return false
        }

        let paginationData = () => {
            if(userStore.pagination){
                return userStore.pagination.links
            }
        }
        
        return {
            users, 
            userStore, 
            showAddModal, 
            title,
            user,
            selectedGender,
            success,
            inputError,
            searchLastname,
            pagData,
            userSearch, 
            loadUsers, 
            showAddModalTrigger, 
            addClientTrigger,
            message,
            cleanNextPrevious,
            paginatedClick,
            disableButton,
            showPagination,
            paginationData,
        }
    },


}
</script>