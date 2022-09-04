import { createRouter, createWebHistory } from "vue-router";
import TheDashboard from '../components/views/TheDashboard.vue';
import TheUsers from '../components/views/TheUsers.vue';

const routes = [
    {
        path: '/',
        component: TheDashboard,
        name: 'dashboard'
    },
    {
        path: '/users',
        component: TheUsers,
        name: 'users'
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;