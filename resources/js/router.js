import { createRouter, createWebHistory } from "vue-router";
import TheDashboard from '../components/views/TheDashboard.vue';
import TheClients from '../components/views/TheClients.vue';

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
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;