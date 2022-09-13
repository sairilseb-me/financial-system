<template>
    <div class="flex flex-col justify-content-center align-items-center pt-5 bg-color">
        <div class="text-center mb-5">
            <h3>Financial System</h3>
        </div>
        
        <div class="d-grid gap-2 col-10 mx-auto">
            <router-link class="btn btn-primary mt-2" :to="{name: 'dashboard'}">Dashboard</router-link>
            <router-link class="btn btn-primary mt-2" :to="{name: 'clients'}">Clients</router-link>
            <router-link class="btn btn-primary mt-2" :to="{name: 'assistance'}">Assistance</router-link>
        </div>
        
    </div>
</template>

<style scoped>
    .bg-color{
        background-color: white;
        height: 100%;
    }

    a{
        width: 99%;
    }

</style>
