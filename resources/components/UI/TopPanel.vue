<template>
    <div class="flex container-fluid bg-color py-2"> 
        <div class="row">
            <div class="col-md-8">
                <h5>Welcome</h5>
            </div>
            <div class="flex align-items-end col-md-4 text-end">
                <font-awesome-icon icon="fa-user"></font-awesome-icon>
                <button class="ms-2 btn btn-outline-info btn-sm mx-2">Logout</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .bg-color{
        background-color: white;
    }

    button{
        width: 20%;
        height: 30px;
    }
</style>