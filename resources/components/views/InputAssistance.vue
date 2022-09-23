<template>
    <div class="container">
        <the-modal v-if="isSuccess">
            <template v-slot:header>
                Success!
            </template>
            <template v-slot:body>
                Successfully created an Assistance
            </template>
            <template v-slot:footer>
                <button class="btn btn-secondary" @click="triggerIsSuccess">Close</button>
            </template>
        </the-modal>
        <div class="flex">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Client Data:
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ client.first_name }} {{ client.middle_name }} {{ client.last_name }}</h5>
                            <p class="card-text">{{ client.date_of_birth }}</p>
                            <p class="card-text">{{ client.Gender }}</p>
                            <p class="card-text">{{ client.barangay }} {{ client.municipality }} {{ client.province }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Patient Data:
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ patient.first_name }} {{ patient.middle_name }} {{ patient.last_name }}</h5>
                            <p class="card-text">{{ patient.date_of_birth }}</p>
                            <p class="card-text">{{ patient.Gender }}</p>
                            <p class="card-text">{{ patient.barangay }} {{ patient.municipality }} {{ patient.province }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-if="hasError" class="alert alert-danger" role="alert">
                    Error!! Please check the data first.
                </div>
                <div class="col-md-12">
                    <div class="border bg-white p-3 rounded flex">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="mb-3">
                                    <label for="assistanceType" class="form-label">Assistance Type:</label>
                                    <select name="" id="assistanceType" class="form-select"  @click="selectedAssistance" ref="assistanceSelected">
                                        <option value="" disabled selected>Select Assistance Type</option>
                                        <option v-for="assistance in assistanceType" :key="assistance + '1'" :value="assistance">{{ assistance }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category:</label>
                                    <select name="" id="category" class="form-select" ref="categorySelected" @click="selectedCategory">
                                        <option value="" selected disabled>Select a Category</option>
                                        <option v-for="category, index in categoryType" :key="index" :value="category">{{ category }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="relationPatient" class="form-label">Relation of Client to Patient:</label>
                                    <input type="text" class="form-control" v-model="assistance.relation_patient">
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount:</label>
                                    <input type="number" name="" id="amount" class="form-control" @focusout="convertDataToDecimal" v-model="assistance.amount">
                                </div>
                                <div class="mb-3">
                                    <label for="hospital" class="form-label">Hospital</label>
                                    <input type="text" name="" id="hospital" class="form-control" v-model="assistance.hospital">
                                </div>
                                <div class="mb-3">
                                    <label for="hospitalAddress" class="form-label">Hospital Address</label>
                                    <textarea name="" id="hospitalAddress" class="form-control" cols="30" rows="3" v-model="assistance.hospital_address"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="mb-3">
                                    <label for="doctorsName" class="form-label">Doctor's Name:</label>
                                    <input type="text" name="" id="doctorsName" class="form-control" v-model="assistance.doctor_name">
                                </div>
                                <div class="mb-3">
                                    <label for="diagnosis" class="form-label">Diagnosis:</label>
                                    <input type="text" name="" id="diagnosis" class="form-control" v-model="assistance.diagnosis">
                                </div>
                                <div class="mb-3">
                                    <label for="dateRequested" class="form-label">Date Requested:</label>
                                    <input type="date" name="" id="dateRequested" class="form-control" v-model="assistance.date_time_requested">
                                </div>
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks:</label>
                                    <textarea name="" id="remarks" cols="30" rows="3" class="form-control" v-model="assistance.remarks"></textarea>
                                </div>
                                <div class="col-md-6 justify-content-end">
                                    <button class="btn btn-secondary me-2" @click="goBackToHome">Close</button>
                                    <button class="btn btn-primary" @click="submitAssistance">Submit</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAssistanceStore } from '../../js/Store/AssistanceStore';
import { onMounted, reactive, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useRouter } from 'vue-router';
import TheModal  from '../modal/TheModal.vue';
export default {
    components: {
        'the-modal': TheModal,
    },
    setup() {
        
        let assistStore = useAssistanceStore();
        let { patient, client, isSuccess, assistanceData } = storeToRefs(assistStore);
        const assistanceSelected = ref('null');
        const categorySelected = ref('null');
        const router = useRouter();
        const assistanceInputData = ref({});
        const hasError = ref(false);

        const assistance = reactive({
            client_id: assistStore.assistanceData.client_id,
            patient_id: assistStore.assistanceData.patient_id,
            assistance: '',
            category: '',
            relation_patient: '',
            amount: 0,
            hospital: '',
            hospital_address: '',
            doctor_name: '',
            diagnosis: '',
            date_time_requested: '',
            remarks: '',
        })

        let triggerIsSuccess = () => {
            isSuccess.value = false;
            router.push('/assistance');
        }

        let triggerIsError = () => {
            hasError.value = true;
            setTimeout(()=>{
                hasError.value = false
            }, 5000);
        }

        let convertDataToDecimal = () => {
            assistance.amount = Number.parseFloat(assistance.amount).toFixed(2);
        }
        
        let submitAssistance = () => {
            assistance.assistance = assistanceSelected.value.value;
            assistance.category = categorySelected.value.value;
            assistance.client_id = assistanceData.client_id;
            assistance.patient_id = assistanceData.patient_id;
            assistStore.addAssistance(assistance)
        }

        const selectedAssistance = () => {
            assistanceInputData.value.assistance = assistanceSelected.value.value;
        }

        const selectedCategory = () => {
            assistanceInputData.value.category = categorySelected.value.value;
        }

        let assistanceType = [
            'Hospital Bill',
            'Medical Bill',
            'Diagnostic & Examination',
            'Burial',
            'Transportation',
            'Natural Disaster & Indirect Hazard',
            'Food Assistance',
            'Assistive Device',
            'Chemotheraphy & Dialysis Treatment',
            'Others'
        ];

        let categoryType = [
            'Women',
            'MEN',
            'Children',
            'Youth',
            'PWD',
            'Senior Citizen',
            'Pantawid',
            'Indigenous People',
            'Disaster Victim',
            'Solo Parent',
            'ERPAT',
            'OFW',
            'CAR',
            'CICL',
            'PLHIV',
            'Abused Women',
            'Abused Men',
            'Suicide Case',
            'Drug Surrenderees',
            'Rebel Surrenderees',
            'Detainees',
            'Single Mother',

        ];

        let goBackToHome = () => {
            assistStore.$reset();
            router.push('/');
        }

        return{
            assistStore,
            patient,
            client,
            isSuccess,
            assistanceType,
            assistanceSelected,
            categoryType,
            categorySelected,
            assistance,
            selectedAssistance,
            isSuccess,
            selectedCategory,
            goBackToHome,
            convertDataToDecimal,
            submitAssistance,
            triggerIsSuccess,
            triggerIsError,
            hasError,
        }
    },

}
</script>