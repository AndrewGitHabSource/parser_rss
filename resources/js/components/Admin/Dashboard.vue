<template>
    <div class="container">
        <h1>Admin panel</h1>

        <h2>Filter posts</h2>

        <nav>
            <el-button @click="addPost()" type="primary">Add Post</el-button>

            <el-button @click="sort()" type="primary">Sort</el-button>
        </nav>

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
                <el-table-column label="Author" prop="author" sortable />

                <el-table-column label="Title" prop="title" sortable />

                <el-table-column label="Link" prop="link" />

                <el-table-column align="right">
                    <template #header>
                        <el-input v-model="search" size="small" placeholder="Type to search" />
                    </template>

                    <template #default="scope">
                        <el-button size="small" @click="edit(scope.row)">Edit</el-button>

                        <el-button size="small" type="danger" @click="drop(scope.row)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <el-pagination
                @current-change="currentChange"
                :total="total"
                :page-size="5"
                small
                background
                layout="prev, pager, next"
                class="mt-4"/>
        </div>
    </div>
</template>

<script>
    import { inject, reactive, onMounted, ref, watch } from "vue";
    import { getAllPosts, deletePost, filterPost, searchPost } from '../../endpoints.js';

    export default {
         setup() {
            const isLoading = ref(true);
            let router = inject("router");
            let search = ref("");
            let form = reactive({
                "author": "",
                "title": "",
                "description": "",
            });
            let posts = reactive({"key": null});
            let currentPage = ref();
            let sortParam = false;
            let currentUrl = "posts";
            let total = ref(1);

            const getPosts = async () => {
                isLoading.value = true;
                currentUrl = "post";

                try {
                    let {data} = await getAllPosts(currentPage.value);
                    posts.key = data.posts;
                    total.value = data.total;
                } catch (error) {
                    console.log(error);
                } finally {
                    isLoading.value = false;
                }
            }

            const currentChange = async (value) => {
                currentPage.value = value;
                let data = {};

                switch (currentUrl) {
                    case "posts":
                        data = await getAllPosts(value);
                        break;
                    case "search":
                        data = await searchPost({"search": search.value, "page": value});
                        break;
                    case "filter":
                        data = await filterPost({...form, "page": value});
                        break;
                    default:
                        data = await getAllPosts(value);
                }

                posts.key = data.data.posts;
            }

            const edit = ({id}) => {
                router.push({name: 'editPost', params: {id}});
            }

            const addPost = () => {
                router.push({name: 'savePost' });
            }

            const sort = async () => {
                sortParam = !sortParam;
                let param = sortParam ? 'DESC' : 'ASC';
                let {data} = await getAllPosts(currentPage.value, param);
                posts.key = data.posts;
            }

            const drop = async ({id}) => {
                try {
                    await deletePost(id);
                    let {data} = await getAllPosts(currentPage.value);
                    posts.key = data;
                } catch (error) {
                    console.log(error);
                }
            }

            onMounted(getPosts);

            watch(() => _.cloneDeep(form), async () => {
                currentUrl = "filter";

                let {data} = await filterPost({...form, "page": currentPage.value});
                    posts.key = data.posts;
                    total.value = data.total;
                }
            );

            watch(search, async () => {
                currentUrl = "search";

                let {data} = await searchPost({"search": search.value, "page": currentPage.value});
                posts.key = data.posts;
                total.value = data.total;
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
                addPost,
                sort,
                total,
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

    nav {
        margin-bottom: 20px;
    }
</style>
