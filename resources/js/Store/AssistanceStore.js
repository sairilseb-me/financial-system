import axios from 'axios';
import {defineStore} from 'pinia';

export const useAssistanceStore = defineStore('assistance', {
    id: 'assistance',
    state: () => {
        return {
            patients: [],
            patient: {},
            client: {},
            assistanceData: {},
        }
    },
    actions: {
        searchPatients(patientLastname){
            if(patientLastname === ''){
                this.patients = [];
            }else{  
                axios.get(`http://127.0.0.1:8000/api/clients/search/${patientLastname}`)
                .then(({data})=>{
                    this.patients = data.data;
                })
            }
        },
        searchClient(id){
            axios.get(`http://127.0.0.1:8000/api/clients/view/${id}`)
            .then(({data})=>{
                this.client = data.client;
            })
        },
        searchPatient(id){
            axios.get(`http://127.0.0.1:8000/api/clients/view/${id}`)
            .then(({data})=>{
                this.patient = data.client;
            })
        }

        // SET_PATIENT_CLIENT_DATA(client_id, patient_id){
        //     this.patient.client_id = client_id;
        //     this.patient.patient_id = patient_id;
        // }
    }
});