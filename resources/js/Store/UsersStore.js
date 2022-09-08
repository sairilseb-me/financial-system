import axios from 'axios';
import {defineStore} from 'pinia';

const useUsersStore = defineStore('usersStore', {
    state: () =>{
        ({
            users: [],
            isLoading: false,
            pagination: {},
         })
    },
    getters: {
        getUsers: (state) => {
            console.log(state.users);
            return state.users;
        }
    },
    actions: {
        loadUsers() {
            axios.get('http://127.0.0.1:8000/api/clients')
            .then(({data})=>{
                this.users = data.data.data;
                this.pagination = data.data;
            });
        },
         searchUser(payload){
                if(payload !== '' && payload !== ' '){
                    this.isLoading = true
                    axios.get(`http://127.0.0.1:8000/api/clients/search/${payload}`)
                    .then((response)=>{
                        this.users = response.data;
                    }).finally(()=>{
                        this.isLoading = false
                    })
                }else{
                    this.loadUsers();
                }
            }
        }
});

export default useUsersStore;