<template>
    <div class="container flex mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="!hasSelectPatient">
                        <h3>Select a Patient</h3> 
                        <div class="flex">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="patient-addon"><font-awesome-icon icon="fa-user-injured"></font-awesome-icon></span>
                                        <input type="text" class="form-control" placeholder="Select a Patient..." aria-describedby="patient-addon" v-model="inputClient" @keyup="searchPatients">    
                                    </div>
                                </div>
                            </div>
                            <div v-if="selectClientError" class="col-md-12 justify-content-center">
                                <div class="row justify-content-center">
                                    <div class="alert alert-danger col-md-8 text-center" role="alert">
                                        Please select a Patient.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Birth Date</th>
                                            <th>Address</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        <tr v-for="patient in patients" :key="patient.id">
                                            <td>{{ patient.first_name }} {{ patient.middle_name }} {{ patient.last_name }}</td>
                                            <td>{{ patient.date_of_birth }}</td>
                                            <td>{{ patient.barangay }} {{ patient.municipality }} {{ patient.province }}</td>
                                            <td><router-link class="btn btn-secondary" :to="`/add-assistance/${patient.id}`" @click="checkSelectPatient(patient.id)">Select</router-link></td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div v-else>
                    <div class="mb-3 flex">
                        <div class="row">
                            <div>
                                <label for="userName"></label>
                            </div>
                        </div>
                    </div>
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
    
</template>
<script>
import { useAssistanceStore } from  '../../js/Store/AssistanceStore';
import {ref, onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { storeToRefs } from 'pinia';
export default {
    setup() {
       let hasSelectPatient = ref(false);
       let client_id = ref('');
       let selectClientError = ref(false);
       let inputClient = ref('');
       let patients = ref([]);
       const route = useRoute(); 
       const assistStore = useAssistanceStore();

       const { assistanceData } = storeToRefs(assistStore);

       let checkSelectPatient = (id) => {
            if(id === ''){
                selectClientError.value = true;
                setTimeout(()=>{
                    selectClientError.value = false;
                }, 5000)
            }else{
                assistanceData.client_id = route.params.id;
                assistanceData.patient_id = id;
                searchPatient(id);
                hasSelectPatient.value = true;   
            }
       }

       let searchPatient = (id) => {
            assistStore.searchPatient(id)
       }

       let searchClient = () => {
            assistStore.searchClient(route.params.id);
       }

       onMounted(()=>{
            searchClient();
       })

       let searchPatients = ()=>{    
            assistStore.searchPatients(inputClient.value); 
            patients.value = assistStore.patients; 
       }

       return {
            hasSelectPatient,
            selectClientError,
            client_id,
            assistStore,
            inputClient,
            patients,
            checkSelectPatient,
            searchPatients,
            searchClient,
       }
    },
}
</script>