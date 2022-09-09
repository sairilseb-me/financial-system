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
                            <h4 class="card-title">Special title treatment</h4>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
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
import router from '../../js/router.js';

import { onMounted } from 'vue';
export default {
    setup() {
        let userStore = useUserStore();

        let loadUserData = () =>{
            axios.get(`http://127.0.0.1:8000/api/clients/view/${router.params.id}`)
        }

        return {
            userStore,
        }
    },
}
</script>