<template>
    <div class="container flex mt-3">
        <div>
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
                            <a href="#" class="btn btn-primary">Go somewhere</a>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useUserStore from '../../js/Store/UsersStore';

import {useRouter, useRoute } from 'vue-router';
import { onMounted, onBeforeMount, onUpdated } from 'vue';
export default {
    setup() {
        let userStore = useUserStore();
        const router = useRouter();
        const route = useRoute();

        let loadUserData = () =>{
            console.log(route.params.id);
            axios.get(`http://127.0.0.1:8000/api/clients/view/${route.params.id}`)
            .then((response)=>{
                if(response.data.status === 'success'){
                    userStore.user = response.data.client;
                }
            })
        }
        return {
            userStore, loadUserData
        }
    },

    beforeRouteEnter(to, from, next){
        console.log('Before route enter');
        next();
    },

    
}
</script>