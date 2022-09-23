import axios from 'axios';
import {defineStore} from 'pinia';

export const useUsersStore = defineStore('usersStore', {
    id: 'user',
    state: () =>{
        ({
            users: [],
            user: {},
            isLoading: false,
            pagination: {},
         })
    },
    getters: {
        getUsers: (state) => {
            return state.users;
        },
        getUser: (state) => {
            return state.user;
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
                    .then(({data})=>{
                        this.users = data.data;
                        this.pagination = data.data;
                    }).finally(()=>{
                        this.isLoading = false
                    })
                }else{
                    this.loadUsers();
                }
            },
        }
});

