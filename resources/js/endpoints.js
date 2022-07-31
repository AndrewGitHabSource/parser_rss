import { $http } from "./api";

export const getAllPosts = async  (page) => {
    return await $http.get(route('admin.posts'), {
        "params": {
            "page": page
        }
    });
}
