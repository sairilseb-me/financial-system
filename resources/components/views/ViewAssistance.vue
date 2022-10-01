<template>
    <div class="container mt-5">
        <div class="row accordion mx-2" id="accordionAssistance">
            <!--First Accordion-->
            <div class="accordion-item">
                <h2 class="accordion-header" id="clientAccordion">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Client Data
                    </button>
                </h2>
                <div v-if="!assistanceData.id">No Data yet</div>
                <div v-else id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#clientAccordion">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for=""><strong>Client Name:</strong></label>
                            <p>{{ assistanceData.client.first_name }} {{ assistanceData.client.middle_name }} {{ assistanceData.client.last_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Birth Date:</strong></label>
                            <p>{{ assistanceData.client.date_of_birth }}</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Gender:</strong></label>
                            <p>{{ assistanceData.client.gender }}</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Address:</strong></label>
                            <p>{{ assistanceData.client.barangay }} {{ assistanceData.client.municipality }} {{ assistanceData.client.province }}</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Relation to Patient:</strong></label>
                            <p>{{ assistanceData.relation_patient }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Second Accordion -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="clientAccordion">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Patient Data
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#clientAccordion">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for=""><strong>Patient Name:</strong></label>
                            <p>Jermaine Laurie Seberiaga</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Birth Date:</strong></label>
                            <p>Mar. 21, 1990</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Gender:</strong></label>
                            <p>Female</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Address:</strong></label>
                            <p>San Miguel, Jordan, Guimaras</p>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Third Accordion -->
             <div class="accordion-item">
                <h2 class="accordion-header" id="assistanceAccordion">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Assistance Data
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#clientAccordion">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for=""><strong>Assistance Type:</strong></label>
                            <p>Medical Assistance</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Category Type:</strong></label>
                            <p>Single Parent</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Amount:</strong></label>
                            <p>PHP 3,000</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Hospital:</strong></label>
                            <p>DCGNPH</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Hospital Address:</strong></label>
                            <p>San Miguel, Jordan,  Guimaras</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Doctor:</strong></label>
                            <p>Dr. Bobby Yoro</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Diagnosis:</strong></label>
                            <p>Headache</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Date and Time Requested:</strong></label>
                            <p>Sept. 22, 2022 8:00AM</p>
                        </div>
                        <div class="mb-3">
                            <label for=""><strong>Remarks:</strong></label>
                            <p>Test</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    import {reactive, ref, onMounted} from 'vue';
    import { useRoute } from 'vue-router';
export default {
    setup() {
        const assistanceData = ref({});
        const route = useRoute();

        const disabled = ref(true)

        const getAssistanceData = () => {
            axios.get(`http://127.0.0.1:8000/api/assistance/view/${route.params.id}`)
            .then((res)=>{
                assistanceData.value = res.data;
                console.log(assistanceData.value);
            })
        }

        onMounted(()=>{
            getAssistanceData();
        });

        return {
            disabled,
            assistanceData,
            getAssistanceData,
        }
    },
}
</script>