<template>
    <div class="container">
        <h1>List posts</h1>

        <ul>
            <li v-for="item in posts" :key="item.id">
                <strong>{{ item.title }}</strong>

                <span>Author: {{ item.author }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
import { inject } from "vue";
import { computed } from "vue";
import { onMounted } from "vue";

export default {
    setup() {
        let store = inject("store");
        const posts = computed(() => store.getters.allPosts);

        onMounted(() => store.dispatch('getPosts'));

        return {
            posts,
        }
    }
}
</script>

<style scoped>
    ul li {
        margin-bottom: 20px;
        border: 1px solid #718096;
        padding: 10px;
    }

    strong {
        display: block;
    }
</style>
