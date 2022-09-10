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
            <div class="row mt-3">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>