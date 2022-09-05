<template>
    <div class="flex flex-column container">
        <the-modal v-if="showAddModal" :title="title">
            <template v-slot:addbody>
                <div class="mb-3">
                    <label for="firstName" class="form-lable">First Name:</label>
                    <input type="text" name="" id="firstName" class="form-control">
                </div>
            </template>
        </the-modal>
        <div class="flex">
           <div class="row mt-3">
                <div class="col-md-8">
                    <button class="btn btn-primary" @click="showAddModalTrigger">Add Clients</button>
                </div>
                <div class="col-md-4 px-4">
                    <input type="text" class="form-control bg-white" placeholder="Search Clients...">
                </div>
           </div>
        </div>
        <div v-if="!userStore.users">
            <div class="container text-center mt-3">
                <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
        <div v-else class="mt-3">
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
                        <td>{{ user.barangay }} {{ user.city }} {{ user.province }}</td>
                        <td><button class="btn btn-warning btn-sm">View Details</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

import TheModal from '../modal/TheModal.vue';
import {computed, onMounted, ref} from 'vue';
import useUsersStore from '../../js/Store/UsersStore';
export default {
    components: {
        'the-modal': TheModal,
    },
    setup() {
        let users = ref([]);
        let title = ref('Add Client');
        let showAddModal = ref(false);
        const userStore = useUsersStore();
        let loadUsers = () =>{
            userStore.loadUsers();
        }

        let showAddModalTrigger = ()=>{
            showAddModal.value = !showAddModal.value
        }

        onMounted(()=>{
            loadUsers();  
        })
        
        return {
            users, loadUsers, userStore, showAddModal, title, showAddModalTrigger
        }
    },
}
</script>