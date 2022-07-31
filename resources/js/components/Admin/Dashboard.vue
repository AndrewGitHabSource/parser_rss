<template>
    <div class="container">
        <h1>Admin panel</h1>

        <div class="container" v-loading="isLoading">
            <el-table :data="posts.key" style="width: 100%">
                <el-table-column label="Author" prop="author" />
                <el-table-column label="Title" prop="title" />
                <el-table-column label="Link" prop="link" />
                <el-table-column align="right">
                    <template #header>
                        <el-input v-model="search" size="small" placeholder="Type to search" />
                    </template>
                    <template #default="scope">
                        <el-button size="small" @click="edit(scope.$index, scope.row)">Edit</el-button>
                        <el-button size="small" type="danger" @click="drop(scope.$index, scope.row)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <el-pagination @current-change="currentChange" small background layout="prev, pager, next" :total="50" class="mt-4"/>
        </div>
    </div>
</template>

<script>
import { inject, reactive, computed, onMounted, ref } from "vue";
import { getAllPosts } from '../../endpoints.js';

export default {
     setup() {
        const isLoading = ref(true);
        let search = ref('');
        let posts = reactive({"key": null});
        let currentPage = ref(1);

        async function getPosts() {
            isLoading.value = true;

            try {
                let {data} = await getAllPosts(currentPage.value);
                posts.key = data;
            } catch (error) {
                console.log(error);
            } finally {
                isLoading.value = false;
            }
        }

        const  currentChange = async (value) => {
            currentPage.value = value;

            let {data} = await getAllPosts(currentPage.value);
            posts.key = data;
        }

        const edit = (index, row) => {

        }

        const drop = () => {

        }

        onMounted(getPosts);

        return {
            posts,
            isLoading,
            search,
            edit,
            drop,
            currentChange,
            currentPage
        }
    }
}
</script>

<style scoped>
    .container {
        min-height: 400px;
    }
</style>
