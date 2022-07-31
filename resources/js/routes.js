import Home from './components/Front/Home.vue';
import Register from './components/Front/Login.vue';
import Dashboard from './components/Admin/Dashboard.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
    },
    {
        name: 'login',
        path: '/login',
        component: Register,
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: {
            auth: true
        },
    },
];
