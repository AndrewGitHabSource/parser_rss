<template>
    <header class="header">Login</header>

    <div v-if="error" class="error">

    </div>

    <el-form
        ref="ruleFormLogin"
        :model="form"
        :rules="rules"
        label-width="120px"
        class="demo-ruleForm"
        status-icon>

        <el-form-item label="Login" prop="login">
            <el-input v-model="form.login" />
        </el-form-item>
        <el-form-item label="Password" prop="password">
            <el-input v-model="form.password" />
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="login(ruleFormLogin)">Create</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import { reactive } from "vue";
    import { ref } from "vue";
    import { inject } from 'vue';
    import { checkForm, rules } from '../validation/login';

    export default {
        setup(props) {
            let auth = inject("auth");
            let form = reactive({
                login: "",
                password: "",
            });
            let error = ref(null);
            let ruleFormLogin = ref();

            const login = async (ruleFormLogin) => {
                await checkForm(ruleFormLogin);

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
                ruleFormLogin,
                rules,
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
