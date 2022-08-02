import { reactive, ref } from 'vue';
import { FormInstance, FormRules } from 'element-plus';

export const rules = reactive({
    login: [
        { required: true, message: 'Please input Login', trigger: 'blur' },
        { min: 2, max: 20, message: 'Length should be 2 to 20', trigger: 'blur' },
    ],
    password: [
        {
            required: true,
            message: 'Please select Password',
            trigger: 'change',
        },
    ],
})

export const checkForm = async (formEl) => {
    await formEl.validate((valid, fields) => {
        if (valid) {
            console.log('submit!')
        } else {
            console.log('error submit!', fields)
        }
    });
}
