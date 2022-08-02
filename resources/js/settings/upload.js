export const settingsUpload = {
    'X-Requested-With': 'XMLHttpRequest',
    "Authorization": `Bearer ${localStorage.auth_token_default}`,
    "X-XSRF-TOKEN": window.Laravel.csrfToken,
}
