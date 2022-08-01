<template>
    <div class="container">
        <h2>Create Post</h2>

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
import { reactive, onMounted, ref, watch } from "vue";
import {pathUploadImage, getPost, updatePost, getAllPosts} from '../../endpoints.js';
import { useRoute } from 'vue-router';
import { genFileId } from 'element-plus';

export default {
    setup() {
        let title = ref("Edit");
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

        const onSubmit = async () => {
            try {
                await updatePost(post);
            } catch (error) {
                console.log(error);
            }
        }

        return {
            title,
            post,
            onSubmit,
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
