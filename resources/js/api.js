import axios from "axios";

export const $http = axios.create({
    "baseURL": "http://crud-post.loc/api",
    "headers": {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.token}`,
    }
});
