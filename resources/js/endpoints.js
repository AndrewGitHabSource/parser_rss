import { $http } from "./api";

export const pathUploadImage = route('admin.upload.image');

export const getAllPosts = async (page) => {
    return await $http.get(route('admin.posts'), {
        "params": {
            "page": page,
        }
    });
}

export const filterPost = async (filters) => {
    return await $http.post(route('admin.filter'), filters);
}

export const searchPost = async (search) => {
    return await $http.post(route('admin.search'), {
        search,
    });
}

export const getPost = async (id) => {
    return await $http.get(route('admin.get.post'), {
        "params": {id},
    });
}



