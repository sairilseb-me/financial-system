<template>
    <div class="container mt-5">
        <div class="flex justify-content-between">
            <div class="row flex justify-content-around">
                <h3 class="col-md-12">Assistance Details:</h3>
                <hr>
                <div class="col-md-3 border bg-white py-3">
                    <h5><strong>Client Data</strong></h5>
                    <hr>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Client Name:</strong></label>
                        <p>Sairil Seberiaga</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Birth Date:</strong></label>
                        <p>Sept. 14, 1985</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Gender:</strong></label>
                        <p>Male</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Client Address:</strong></label>
                        <p>San Miguel, Jordan, Guimaras</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Relation to Patient:</strong></label>
                        <p>Wife</p>
                    </div>
                    <div class="mb-3">
                        <button class="col-md-12 btn btn-warning">Edit</button>
                    </div>
                </div>
                <div class="col-md-3 border bg-white py-3">
                    <h5><strong>Patient Data</strong></h5>
                    <hr>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Patient Name:</strong></label>
                        <p>Jermaine Laurie Seberiaga</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Patient Birthdate:</strong></label>
                        <p>March 21, 1990</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Gender:</strong></label>
                        <p>Female</p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Patient Address:</strong></label>
                        <p>San Miguel, Jordan, Guimaras</p>
                    </div>
                    <div class="mb-3">
                        <button class="col-md-12 btn btn-warning">Edit</button>
                    </div>
                </div>
                <div class="col-md-5 border bg-white py-3">
                    <h5><strong>Assistance Data</strong></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for=""><strong>Assistance Type:</strong></label>
                            <p>Hospital Bill</p>
                            </div>
                            <div class="mb-3">
                                <label for=""><strong>Category Type:</strong></label>
                                <p>Disaster Victim</p>
                            </div>
                            <div class="mb-3">
                                <label for=""><strong>Amount:</strong></label>
                                <p>PHP 1,300</p>
                            </div>
                            <div class="mb-3">
                                <label for=""><strong>Hospital:</strong></label>
                                <p>DCGNPH</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for=""><strong>Hospital Address:</strong></label>
                            <p>San Miguel, Jordan, Guimaras</p>
                            </div>
                            <div class="mb-3">
                                <label for=""><strong>Doctor's Name:</strong></label>
                                <p>Dr. Bobby Yoro</p>
                            </div>
                            <div class="mb-3">
                                <label for=""><strong>Diagnosis:</strong></label>
                                <p>Headache</p>
                            </div>
                            <div class="mb-3">
                                <label for=""><strong>Remarks:</strong></label>
                                <p>N/A</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="col-md-12 btn btn-warning">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    import {reactive, ref} from 'vue';
export default {
    setup() {
        
        const data =  reactive({
            client_name: "Sairil Seberiaga"
        })

        const disabled = ref(true)

        return {
            data,
            disabled
        }
    },
}
</script>