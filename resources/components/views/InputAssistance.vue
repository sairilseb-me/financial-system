<template>
    <div class="container">
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
                <div class="col-md-12">
                    <form class="border bg-white p-3 rounded flex">
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
                                    <label for="relationPatient" class="form-lab">Relation of Client to Patient:</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount:</label>
                                    <input type="number" name="" id="amount" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="hospital" class="form-label">Hospital</label>
                                    <input type="text" name="" id="hospital" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="hospitalAddress" class="form-label">Hospital Address</label>
                                    <textarea name="" id="hospitalAddress" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="mb-3">
                                    <label for="doctorsName" class="form-label">Doctor's Name:</label>
                                    <input type="text" name="" id="doctorsName" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="diagnosis" class="form-label">Diagnosis:</label>
                                    <input type="text" name="" id="diagnosis" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="dateRequested" class="form-label">Date Requested:</label>
                                    <input type="date" name="" id="dateRequested" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks:</label>
                                    <textarea name="" id="remarks" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 justify-content-end">
                                    <button class="btn btn-secondary me-2" @click="goBackToHome">Close</button>
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAssistanceStore } from '../../js/Store/AssistanceStore';
import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useRouter } from 'vue-router';
export default {
    setup() {
        
        let assistStore = useAssistanceStore();
        let { patient, client } = storeToRefs(assistStore);
        const assistanceSelected = ref('null');
        const categorySelected = ref('null');
        const router = useRouter();
        const selectedAssistance = () => {
            
        }

        const selectedCategory = () => {
            console.log(categorySelected.value.value);
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
            'ERPAT',
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
            assistanceType,
            assistanceSelected,
            categoryType,
            categorySelected,
            selectedAssistance,
            selectedCategory,
            goBackToHome,
        }
    },

}
</script>