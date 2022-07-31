import { $http } from "./api";
// import route from "ziggy";

export async function getAllPosts() {
    return await $http.get(route('admin.posts'));
}
