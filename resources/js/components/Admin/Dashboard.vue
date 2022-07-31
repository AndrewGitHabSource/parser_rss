<template>
    <div class="container">
        <h1>Admin panel</h1>

        <div class="container" v-loading="isLoading">
            <ul>
                <li v-for="item in posts.key" :key="item.id">
                    <strong>{{ item.title }}</strong>

                    <span>Author: {{ item.author }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { inject, reactive, computed, onMounted, ref } from "vue";
import { getAllPosts } from '../../endpoints.js';

export default {
     setup() {
        const isLoading = ref(true);
        let posts = reactive({"key": null});

        async function getPosts() {
            isLoading.value = true;

            try {
                let {data} = await getAllPosts();
                posts.key = data;
            } catch (error) {
                console.log(error);
            } finally {
                isLoading.value = false;
            }
         }

        onMounted(getPosts);

        return {
            posts,
            isLoading
        }
    }
}
</script>

<style scoped>
    .container {
        min-height: 400px;
    }
</style>
