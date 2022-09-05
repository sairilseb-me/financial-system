import axios from 'axios';
import {defineStore} from 'pinia';

const useUsersStore = defineStore('usersStore', {
    state: () =>{
        ({
            users: [],
         })
    },
    actions: {
        loadUsers() {
            axios.get('/api/clients')
            .then((response)=>{
                this.users = response.data;
            });
        }
    }
});

export default useUsersStore;