<template>
    <header class="header">Login</header>

    <div v-if="error" class="error">

    </div>

    <form>
        <el-input v-model="form.login" placeholder="Please input login"/>

        <el-input v-model="form.password" placeholder="Please input password"/>

        <el-button @click="login">Submit</el-button>
    </form>
</template>

<script>
    import { reactive } from "vue";
    import { ref } from "vue";
    import { inject } from 'vue';

    export default {
        setup() {
            let auth = inject("auth");
            let form = reactive({
                login: "",
                password: "",
            });
            let error = ref(null);

            function login() {
                try {
                    auth.login({
                        "data": {
                            "login": form.login,
                            "password": form.password,
                        },
                        "redirect": {name: 'dashboard'},
                        "rememberMe": true,
                        "staySignedIn": true,
                        "fetchUser": true,
                    });
                } catch (error) {
                    console.log(error);
                    throw error;
                }
            }

            return {
                form,
                login,
                error,
            }
        }
    }
</script>

<style scoped>
    .el-input {
        margin-bottom: 20px;
    }

    .error {
        color: red;
    }
</style>
