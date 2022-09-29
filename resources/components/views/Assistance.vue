<template>
    <div class="container mt-3">
        <div>
            <h3>Assistance Data</h3>
        </div>
        <div class="flex">
            <div class="row">
                <div class="col-md-8">
                    <button class="btn btn-primary"><font-awesome-icon icon="fa-file-csv"></font-awesome-icon> Generate Report</button>
                </div>
                <div class="col-md-4 px-4">
                    <input type="text" class="form-control bg-white" placeholder="Enter Patient Lastname...">
                </div>
            </div>
            <div v-if="assistStore.assistances" class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Assistance Category</th>
                                <th>Date Requested</th>
                                <th>Client Name</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="assistance in assistStore.assistances" :key="assistance.id">
                               <td>{{ assistance.patient.first_name }} {{ assistance.patient.middle_name }} {{ assistance.patient.last_name }}</td>
                               <td>{{ assistance.assistance }}</td>
                               <td>{{ changeTimeFormat(assistance.date_time_requested) }}</td>
                               <td>{{ assistance.client.first_name }} {{ assistance.client.middle_name }} {{ assistance.client.last_name }}</td>
                               <td><button class="btn btn-secondary">View</button> <button class="btn btn-danger">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { useAssistanceStore } from '../../js/Store/AssistanceStore';
import { onMounted, computed } from 'vue';
import { storeToRefs } from 'pinia';
import moment from 'moment';
export default {
    setup() {
        
        let assistStore = useAssistanceStore();

        const loadAssistance = () =>{
            assistStore.loadAssistance();
        }

        onMounted(()=>{
            loadAssistance();;
        })

        let changeTimeFormat = (value) => {
            return moment(value).format('MMM Do YYYY');
        };

        return{
            assistStore,
            loadAssistance,
            changeTimeFormat,
        }
    },

}
</script>