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

            <el-form-item label="Image">
                <input @change="onFileChange" type="file" name="image" accept="image/jpeg, image/png">
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit">Save</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import { reactive, ref, inject } from "vue";
import { savePost } from '../../endpoints.js';

export default {
    setup() {
        let router = inject("router");
        let title = ref("Edit");
        let post = reactive({
            "id": "",
            "author": "",
            "title": "",
            "description": "",
            "image": null,
            "link": "",
        });

        const onSubmit = async () => {
            try {
                let formData = new FormData();
                formData.append("author", post.author);
                formData.append("title", post.title);
                formData.append("description", post.description);
                formData.append("image", post.image);
                formData.append("link", post.link);

                await savePost(formData);
                router.push({name: 'dashboard'});
            } catch (error) {
                console.log(error);
            }
        }

        const onFileChange = (e) => {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            post.image = files[0];
        };

        return {
            title,
            post,
            onSubmit,
            onFileChange,
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
