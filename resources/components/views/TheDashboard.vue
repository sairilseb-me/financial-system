<template>
    <h1>Dashboard</h1>
</template>


<script>

import {useAssistanceStore} from '../../js/Store/AssistanceStore';
import {useUsersStore} from '../../js/Store/UsersStore';
import { onMounted } from 'vue';

export default {
    setup(){
        const assistStore = useAssistanceStore();
        const userStore = useUsersStore();

        onMounted(()=>{
            console.log(assistStore.assistanceData);
            console.log(userStore);
        })

    }
    
}


</script>
