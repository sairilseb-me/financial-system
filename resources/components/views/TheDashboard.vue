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
            <div class="col-md-6 d-flex me-2 justify-content-end">
                <input type="date" name="" id="" class="me-2 form-control" v-model="fromDate" @change="loadAssistanceData">
                <label for="" style="padding-top: 5px;">To</label>
                <input type="date" name="" id="" class="ms-2 form-control" v-model="toDate" @change="loadAssistanceData">
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
import Modal from '../modal/TheModal.vue';

export default {
    components: {
        'data-cards': DataCards,
        'bar-chart': Charts,
        'modal': Modal,
    },
    setup(){
        const assistStore = useAssistanceStore();
        const userStore = useUsersStore();
        const clientRequestedData = ref({});
        const clientApprovedData = ref({});
        const fromDate = ref(null);
        const toDate = ref(null);
        const hasError = ref(false);
        const errorMessage = ref('');
        const totalClientRequested = ref(0);

        const chartOptions = {responsive: true}

        clientRequestedData.value = {
            labels: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Clients who requested for Assistance',
                    backgroundColor: '#0B6FFD',
                    data: [40, 20, 12, 25, 15, 11, 28, 35, 10, 20, 16, 40]
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

        const triggerErrorModal = () => {
            hasError.value = !hasError.value;
        }

        const loadAssistanceData = () =>{
            if(fromDate.value && toDate.value){
                axios.get(`http://127.0.0.1:8000/api/assistance/get-charts-data/${fromDate.value}/${toDate.value}`)
                .then((response)=>{
                    let mapData = response.data.assistanceDates.map((item)=>{
                        return item.number_of_assistance;
                    })


                    let mapLabels = response.data.assistanceDates.map((item)=>{
                        return item.Month_Name;
                    })

                    let totalRequest = response.data.assistanceDates.map((item)=>{
                        return item.number_of_assistance.map((i)=> {
                            return i;
                        })
                    });
                    clientRequestedData.value.datasets[0].data = mapData;
                    clientRequestedData.value.labels = mapLabels;
                })
            }
        }
        

        return{
            assistStore,
            userStore,
            clientRequestedData,
            chartOptions,
            clientApprovedData,
            fromDate,
            toDate,
            errorMessage,
            hasError,
            totalClientRequested,
            loadAssistanceData,
            triggerErrorModal,
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
