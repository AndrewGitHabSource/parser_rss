<template>
    <div class="container">
        <h1>Admin panel</h1>

        <h2>Filter posts</h2>

        <el-form class="form-filter" :model="form" label-width="120px">
            <el-form-item class="form-element" label="Filter author">
                <el-input v-model="form.author" />
            </el-form-item>

            <el-form-item class="form-element" label="Filter title">
                <el-input v-model="form.title" />
            </el-form-item>

            <el-form-item class="form-element" label="Filter description">
                <el-input v-model="form.description" />
            </el-form-item>
        </el-form>

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
                        <el-button size="small" @click="edit(scope.row)">Edit</el-button>

                        <el-button size="small" type="danger" @click="drop(scope.$index, scope.row)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <el-pagination @current-change="currentChange" small background layout="prev, pager, next" :total="50" class="mt-4"/>
        </div>
    </div>
</template>

<script>
    import { inject, reactive, computed, onMounted, ref, watch } from "vue";
    import { getAllPosts } from '../../endpoints.js';
    import { filterPost } from '../../endpoints.js';
    import { searchPost } from '../../endpoints.js';

    export default {
         setup() {
            let router = inject("router");
            const isLoading = ref(true);
            let search = ref("");
            let form = reactive({
                "author": "",
                "title": "",
                "description": "",
            });
            let posts = reactive({"key": null});
            let currentPage = ref(1);

            const getPosts = async () => {
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

            const currentChange = async (value) => {
                currentPage.value = value;

                let {data} = await getAllPosts(currentPage.value);
                posts.key = data;
            }

            const edit = ({id}) => {
                router.push({name: 'editPost', params: {id} });
            }

            const drop = () => {

            }

            onMounted(getPosts);

             watch(() => _.cloneDeep(form), async () => {
                     let {data} = await filterPost(form);
                     posts.key = data;
                 }
             );

             watch(search, async () => {
                 let {data} = await searchPost(search.value);
                 posts.key = data;
             });

            return {
                posts,
                isLoading,
                search,
                edit,
                drop,
                currentChange,
                currentPage,
                form,
            }
        }
    }
</script>

<style scoped>
    .container {
        min-height: 400px;
    }

    .form-element {
        max-width: 30%;
    }

    .form-filter {
        display: flex;
        justify-content: space-between;
    }
</style>
