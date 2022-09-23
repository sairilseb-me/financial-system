import axios from 'axios';
import {defineStore} from 'pinia';
import router from '../router.js';

export const useUsersStore = defineStore('usersStore', {
    id: 'user',
    state: () =>{
        ({
            users: [],
            user: {},
            isLoading: false,
            pagination: {},
            hasError: false,
            errorMessage: '',
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
            updateClient(id, payload){
                axios.post(`http://127.0.0.1:8000/api/clients/update/${id}`, payload)
                .then((response)=>{
                    this.loadUsers();
                }).catch((err)=>{
                    this.hasError = true;
                    setTimeout(() => {
                        this.hasError = false;
                    }, 5000);
                })
            },
            deleteClient(id){
                axios.delete(`http://127.0.0.1:8000/api/clients/delete/${id}`)
                .then((response)=>{
                    if(response.data.status === 'success'){
                        this.loadUsers();
                        router.push('/clients');
                    }
                }).catch((err)=>{
                    console.log(err);
                })
            }
        }
});

