import { $http } from "./api";

export const getAllPosts = async  (page) => {
    return await $http.get(route('admin.posts'), {
        "params": {
            "page": page,
        }
    });
}

export const filterPost = async  (filters) => {
    return await $http.post(route('admin.filter'), filters);
}
