<template>
    <div class="flex">
        <div class="row">
            <div class="col-md-2">
                <side-bar></side-bar>
            </div>
            <div class="col-md-10 no-padding">
                <top-panel></top-panel>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import TopPanel from '../components/UI/TopPanel.vue';
import Sidebar from '../components/UI/TheSidebar.vue';
export default {
    components: {
        'top-panel': TopPanel,
        'side-bar': Sidebar,
    },
    setup() {
        
    },
}
</script>

<style>
    body{
        background-color: #F6F8F9;
    }

    .no-padding{
    padding: 0 0 0 0 !important;
   }
</style>