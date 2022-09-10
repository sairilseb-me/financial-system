import { createRouter, createWebHistory } from "vue-router";
import TheDashboard from '../components/views/TheDashboard.vue';
import TheClients from '../components/views/TheClients.vue';
import SpecificClient from '../components/views/SpecificClient.vue';
import Assistance from '../components/views/Assistance.vue';

const routes = [
    {
        path: '/',
        component: TheDashboard,
        name: 'dashboard'
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
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;