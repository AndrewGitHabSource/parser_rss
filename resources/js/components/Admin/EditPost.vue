<template>
    <div class="container">
        <h2>Edit Post</h2>

        <el-form :model="post" label-width="120px">
            <el-form-item label="Author">
                <el-input v-model="post.author" />
            </el-form-item>

            <el-form-item label="Title">
                <el-input v-model="post.title" />
            </el-form-item>

            <el-form-item label="Description">
                <el-input v-model="post.description" type="textarea" />
            </el-form-item>

            <el-form-item label="Link">
                <el-input v-model="post.link" />
            </el-form-item>

            <el-upload
                ref="upload"
                class="upload"
                name="image"
                :headers="{
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Authorization': `Bearer ${auth}`,
                }"
                :action="pathUploadImage"
                :limit="1"
                :on-exceed="handleExceed"
                :auto-upload="false"
                :data="data">

                <template #trigger>
                    <el-button type="primary" class="button-select">
                        select file
                    </el-button>
                </template>

                <el-button class="ml-3" type="success" @click="submitUpload">
                    Upload to server
                </el-button>

                <template #tip>
                    <div class="el-upload__tip text-red">
                        Limit 1 file, new file will cover the old file
                    </div>
                </template>
            </el-upload>

            <div class="image">
                <div class="image-container">
                    <h4>Image</h4>

                    <img v-bind:src="post.image" alt="Image"/>
                </div>
            </div>

            <el-form-item>
                <el-button type="primary" @click="onSubmit">Save</el-button>

                <el-button>Cancel</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import {reactive, onMounted, ref, inject} from "vue";
import {pathUploadImage, getPost, updatePost} from '../../endpoints.js';
import { useRoute } from 'vue-router';
import { genFileId } from 'element-plus';

export default {
    setup() {
        const token = window.Laravel.csrfToken;
        const auth = localStorage.auth_token_default;
        let router = inject("router");
        const route = useRoute();
        let post = reactive({
            "id": "",
            "author": "",
            "title": "",
            "description": "",
            "image": "",
            "link": "",
        });
        let initPost = (data) => {
            post.id = data.id;
            post.author = data.author;
            post.title = data.title;
            post.image = data.image;
            post.description = data.description;
            post.link = data.link;
        };
        const upload = ref(null);
        const data = {
            "id": route.params.id,
        }

        const handleExceed = (files) => {
            upload.value.clearFiles();
            const file = files[0];
            file.uid = genFileId();
            upload.value.handleStart(file);
        }

        const submitUpload = () => {
            upload.value.submit();
        }

        const onSubmit = async () => {
            try {
                await updatePost(post);
                router.push({name: 'dashboard'});
            } catch (error) {
                console.log(error);
            }
        }

        onMounted(async () => {
            try {
                let {data} = await getPost(route.params.id);
                initPost(data);
            } catch (error) {
                console.log(error);
            }
        });

        return {
            post,
            submitUpload,
            handleExceed,
            pathUploadImage,
            onSubmit,
            data,
            upload,
            token,
            auth,
        }
    }
}
</script>

<style scoped>
    .image {
        display: flex;
    }

    .image-container {
        max-width: 400px;
        margin-right: 40px;
    }

    .image-container img {
        max-width: 100%;
    }

    .button-select {
        position: relative;
        top: 2px;
    }

    .el-button--primary {
        margin: 0 10px 0 0;
    }
</style>
