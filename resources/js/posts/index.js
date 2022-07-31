import axios from 'axios';
import { createStore } from 'vuex';
import {$http} from '../api.js';
import { inject } from 'vue';

export default {
    state() {
        return {
            posts: null
        }
    },

    getters: {
        allPosts(state) {
            return state.posts;
        }
    },

    mutations: {
        setPosts(state, payload) {
            state.posts = payload;
        }
    },

    actions: {
        async getPosts(context) {
            try {
                let response =  await $http.get('/');
                context.commit('setPosts', response.data);
            } catch (error) {
                console.log(error);
            }
        }
    },
}
