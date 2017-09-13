import axios from 'axios';

const NEW_POST = "NEW_POST";
const SET_POSTS = "SET_POSTS";

let actions = {
    getPosts({commit}) {
        let token = localStorage.getItem('token');

        return window.axios.get('posts?token=' + token).then(function (response) {
            let data = response.data;

            commit(SET_POSTS, data.posts);
        }).catch(function (error) {
            console.log('Error', error);
        });
    },

    sendPost({commit}, post) {
        let token = localStorage.getItem('token');

        const config = {
            baseURL: 'http://local.dogshare.com.br/api/v1/',
            timeout: 999999,
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]'),
                'X-Requested-With': XMLHttpRequest,
                'Content-Type': 'multipart/form-data',
            }
        };

        return axios.post('posts?token=' + token, post, config).then(function (response) {
            let data = response.data;
            commit(NEW_POST, {
                obj: data.post,
            });
        }).catch(function (error) {
            console.log('Error', error);
        });
    },
};

export default actions;