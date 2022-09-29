import { createRouter, createWebHistory } from "vue-router";
import TheDashboard from '../components/views/TheDashboard.vue';
import TheClients from '../components/views/TheClients.vue';
import SpecificClient from '../components/views/SpecificClient.vue';
import Assistance from '../components/views/Assistance.vue';
import AddAssistance from '../components/views/AddAssistance.vue';
import SelectPatient from '../components/views/SelectPatient.vue';
import InputAssistance from '../components/views/InputAssistance.vue';
import Login from '../components/views/Login.vue'
import AssistanceView from '../components/views/ViewAssistance.vue';
const routes = [
    {
        path: '/',
        component: TheDashboard,
        name: 'dashboard'
    },
    {
        path: '/login',
        component: Login,
        name: "login"
    },
    {
        path: '/clients',
        component: TheClients,
        name: 'clients'
    },
    {
        path: '/clients/view',
        component: SpecificClient,
        name: 'specific-client',
        params: true,
    },
    {
        path: '/assistance/',
        component: Assistance,
        name: 'assistance',
        params: true,
    },
    {
        path: '/assistance/view',
        component: AssistanceView,
        name: 'view-assistance',
        params: true,
    },
    {
        path: '/add-assistance/',
        component: AddAssistance,
        name: 'add-assistance',
        children: [
            {
                path: ':clientId',
                component: InputAssistance,
                name: 'input-assistance',
                params: true,
            }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;