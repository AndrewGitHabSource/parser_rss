import { $http } from "./api";

export async function getAllPosts() {
    return await $http.get('/admin/posts');
}
