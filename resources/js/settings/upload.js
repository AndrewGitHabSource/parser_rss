export const settingsUpload = {
    'Content-Type': 'multipart/form-data',
    'Authorization': `Bearer ${localStorage.auth_token_default}`,
    'X-XSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
}
