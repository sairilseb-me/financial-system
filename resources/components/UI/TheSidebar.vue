<template>
    <div class="flex flex-col justify-content-center align-items-center pt-5 bg-color">
        <div class="text-center mb-5">
            <h3>Financial System</h3>
        </div>
        
        <div class="d-grid gap-2 col-10 mx-auto">
            <router-link class="btn btn-primary mt-2" :to="{name: 'dashboard'}">Dashboard</router-link>
            <router-link class="btn btn-primary mt-2" :to="{name: 'users'}">Users</router-link>
        </div>
        
    </div>
</template>

<style scoped>
    .bg-color{
        background-color: white;
        height: 100vh;
    }

    a{
        width: 99%;
    }

</style>
