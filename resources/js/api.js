import axios from "axios";
import { route } from 'ziggy-js';
import { Ziggy } from './ziggy';
window.route = route;
window.Ziggy = Ziggy;

export const $http = axios.create({
    "baseURL": route('home'),
    "headers": {
        "Content-Type": "application/json",
        "Authorization": `Bearer ${localStorage.auth_token_default}`,
        "X-XSRF-TOKEN": window.Laravel.csrfToken,
        "X-Requested-With": "XMLHttpRequest",
    }
});
