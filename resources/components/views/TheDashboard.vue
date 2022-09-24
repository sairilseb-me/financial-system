<template>
    <div class="container mt-5 flex">
        <div class="row p-2 justify-content-around">
            <div class="col-md-5">
                <data-cards>
                    <template v-slot:title>
                        <p><font-awesome-icon icon="fa-hand-holding-hand"></font-awesome-icon> Total Client Assistance Request:</p>
                    </template>
                    <template v-slot:body>
                        96
                    </template>
                </data-cards>
            </div>
            <div class="col-md-5">
                <data-cards>
                    <template v-slot:title>
                        <p><font-awesome-icon icon="fa-hand-holding-medical"></font-awesome-icon>  Client Assistance Request:</p>
                    </template>
                    <template v-slot:body>
                        96
                    </template>
                </data-cards>
            </div>
        </div>
        <div class="row mt-4 justify-content-end">
            <div class="col-md-6 d-flex justify-content-end">
                <input type="date" name="" id="" class="me-2 form-control">
                <label for="" style="padding-top: 5px;">To</label>
                <input type="date" name="" id="" class="ms-2 form-control">
            </div>
        </div>
        <div class="flex">
            <div class="row mt-5 justify-content-around">
                <div class="col-md-4">
                    <bar-chart
                        :chartData = "clientRequestedData"
                        :chartOptions = "chartOptions"
                    ></bar-chart>
                </div>
                <div class="col-md-4">
                    <bar-chart
                        :chartData = "clientApprovedData"
                        :chartOptions = "chartOptions"
                    ></bar-chart>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import {useAssistanceStore} from '../../js/Store/AssistanceStore';
import {useUsersStore} from '../../js/Store/UsersStore';
import { onMounted } from 'vue';
import DataCards from '../UI/DataCards.vue';
import Charts from '../UI/Charts.vue';
import {ref} from 'vue';

export default {
    components: {
        'data-cards': DataCards,
        'bar-chart': Charts,
    },
    setup(){
        const assistStore = useAssistanceStore();
        const userStore = useUsersStore();
        const clientRequestedData = ref({});
        const clientApprovedData = ref({});

        const chartOptions = {responsive: true}

        clientRequestedData.value = {
            labels: [ 'January', 'February', 'March'],
            datasets: [
                {
                    label: 'Clients who requested for Assistance',
                    backgroundColor: '#0B6FFD',
                    data: [40, 20, 12]
                }
            ]
        }

        clientApprovedData.value = {
            labels: [ 'January', 'February', 'March'],
            datasets: [
                {
                    label: 'Clients assistance approved',
                    backgroundColor: '#f80759',
                    data: [40, 20, 12]
                }
            ]
        }

        

        return{
            assistStore,
            userStore,
            clientRequestedData,
            chartOptions,
            clientApprovedData,
        }
    }
    
}
</script>

<style scoped>
    input[type="date"]{
        width: 20rem;
        text-align: center;
    }
</style>
