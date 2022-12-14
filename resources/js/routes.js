import Home from './components/Front/Home.vue';
import Register from './components/Front/Login.vue';
import Dashboard from './components/Admin/Dashboard.vue';
import EditPost from './components/Admin/EditPost.vue';
import SavePost from './components/Admin/SavePost.vue';

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
            auth: true,
        },
    },
    {
        name: 'editPost',
        path: '/admin/edit-post/:id',
        component: EditPost,
        meta: {
            auth: true,
        },
    },
    {
        name: 'savePost',
        path: '/admin/save-post',
        component: SavePost,
        meta: {
            auth: true,
        },
    },
];
