import axios from 'axios';
import lodash from 'lodash';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VeeValidate from 'vee-validate';
import VueSweetAlert from 'vue-sweetalert';

window._ = lodash;

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios = axios.create({
        baseURL: 'http://local.dogshare.com.br/api/v1/',
        timeout: 999999,
        headers: {
            'X-CSRF-TOKEN': token.content,
            'X-Requested-With': XMLHttpRequest,
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = Vue;
window.Vue.use(VueRouter);
window.Vue.use(Vuex);
window.Vue.use(VeeValidate);
window.Vue.use(VueSweetAlert);