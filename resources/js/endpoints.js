import { $http } from "./api";
import axios from "axios";


export const pathUploadImage = route('admin.upload.image');

export const getAllPosts = async (page, sort = 'ASC') => {
    return await $http.get(route('admin.posts'), {
        "params": {
            "page": page,
            "sort": sort,
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

export const updatePost = async (post) => {
    return await $http.post(route('admin.update.post'), post);
}

export const savePost = async (post) => {
    return await $http.post(route('admin.save.post'),
        post,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
}



