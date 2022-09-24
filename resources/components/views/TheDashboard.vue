<template>
    <div class="container mt-5 flex">
        <div class="row p-2">
            <div class="col-md-3">
                <h4 class="justify-content-center">Number of Clients:</h4>
                <data-cards>
                    <template v-slot:body>
                        96
                    </template>
                </data-cards>
            </div>
            <div class="col-md-3">
                <h4 class="justify-content-center">Number of Clients:</h4>
                <data-cards>
                    <template v-slot:body>
                        96
                    </template>
                </data-cards>
            </div>
            <div class="col-md-3">
                <h4 class="justify-content-center">Number of Clients:</h4>
                <data-cards>
                    <template v-slot:body>
                        96
                    </template>
                </data-cards>
            </div>
            <div class="col-md-3">
                <h4 class="justify-content-center">Number of Clients:</h4>
                <data-cards>
                    <template v-slot:body>
                        96
                    </template>
                </data-cards>
            </div>
        </div>
        <div class="row mt-2 justify-content-end">
            <div class="col-md-6 d-flex justify-content-end">
                <input type="date" name="" id="" class="me-2 form-control">
                <label for="" style="padding-top: 5px;">To</label>
                <input type="date" name="" id="" class="ms-2 form-control">
            </div>
        </div>
    </div>
</template>


<script>

import {useAssistanceStore} from '../../js/Store/AssistanceStore';
import {useUsersStore} from '../../js/Store/UsersStore';
import { onMounted } from 'vue';
import DataCards from '../UI/DataCards.vue';

export default {
    components: {
        'data-cards': DataCards,
    },
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

<style scoped>
    input[type="date"]{
        width: 20rem;
        text-align: center;
    }
</style>
