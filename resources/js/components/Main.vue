<template>
    <div class="content">
        <h1 class="text-secondary">RSS Posts Application</h1>

        <nav class="nav">
            <ul>
                <li>
                    <router-link :to="{name:'home'}">Home</router-link>
                </li>
                <li v-if="auth.user()">
                    <router-link :to="{name:'dashboard'}">Admin</router-link>
                </li>
                <li v-else>
                    <router-link :to="{name:'login'}">Login</router-link>
                </li>
            </ul>
        </nav>

        <router-view></router-view>
    </div>
</template>

<script>
import { inject } from 'vue';
import { ref } from "vue";

export default {
    setup() {
        let auth = inject("auth");

        return {
            auth,
        }
    }
}
</script>

<style scoped>
    h1 {
        font: 28px Verdana;
        text-align: center;
        color: #718096;
    }

    .nav {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #0e2b4f;
    }

    .nav ul {
        padding: 0;
        display: flex;
        justify-content: space-between;
    }

    .nav li {
        display: block;
        font: 15px Verdana;
        margin: 0;
        color: #fff;
    }

    .content {
        padding: 0 15px;
    }
</style>
