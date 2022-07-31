import { createApp } from 'vue';
import * as VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Main from './components/Main';
import { routes } from './routes';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import { createStore } from 'vuex';
import {createAuth}          from '@websanova/vue-auth';
import driverAuthBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios       from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
import {$http} from './api.js';
import storeData from './posts/index';


const router = VueRouter.createRouter({
    mode: "history",
    history: VueRouter.createWebHistory(),
    routes,
});

const auth = createAuth({
    plugins: {
        http: $http,
        router: router
    },
    drivers: {
        http: driverHttpAxios,
        auth: driverAuthBearer,
        router: driverRouterVueRouter,
    },
    options: {
        rolesKey: 'type',
        notFoundRedirect: {name: 'home'},
    }
});

const store = createStore(storeData);

const vue = createApp(Main);
vue.use(ElementPlus)
vue.use(router);
vue.use(store);
vue.use(auth);
vue.provide('store', store);
vue.provide('auth', auth);
vue.mount('#app');
