import { $http } from "./api";

export const pathUploadImage = route('admin.upload.image');

export const getAllPosts = async (page, filters, sort = 'ASC') => {
    return await $http.post(route('admin.posts'), {
        ...filters,
        page,
        sort,
    });
}

export const searchPost = async (data) => {
    return await $http.post(route('admin.search'), {
        ...data
    });
}

export const getPost = async (id) => {
    return await $http.get(route('admin.get.post'), {
        "params": {id},
    });
}

export const updatePost = async (post) => {
    return await $http.post(route('admin.update.post'), post);
}

export const savePost = async (post) => {
    return await $http.post(route('admin.save.post'),
        post,{
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        });
}

export const deletePost = async (id) => {
    return await $http.get(route('admin.delete.post'), {
        "params": {
            id,
        },
    });
}
