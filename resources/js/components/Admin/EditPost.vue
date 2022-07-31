<template>
    <div class="container">
        <h2>{{title}}</h2>

        <el-form :model="post" label-width="120px">
            <el-form-item label="Author">
                <el-input v-model="post.author" />
            </el-form-item>

            <el-form-item label="Title">
                <el-input v-model="post.title" />
            </el-form-item>

            <el-form-item label="Description">
                <div class="wrap-editor">
                    <QuillEditor v-model="post.description" theme="snow" />
                </div>
            </el-form-item>

            <el-form-item label="Link">
                <el-input v-model="post.link" />
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit">Create</el-button>
                <el-button>Cancel</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import { inject, reactive, computed, onMounted, ref, watch } from "vue";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    components: {
        QuillEditor,
    },

    setup() {
        let title = ref("Edit");
        let post = reactive({
            "author": "",
            "title": "",
            "description": "",
            "image": "",
            "link": "",
        });

        const onSubmit = () => {

        };

        return {
            title,
            post,
            onSubmit,
        }
    }
}
</script>

<style scoped>
    .wrap-editor {
        margin-bottom: 20px;
        width: 100%;
    }
</style>
