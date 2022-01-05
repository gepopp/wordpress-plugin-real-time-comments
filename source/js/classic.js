import '../scss/classic.scss';

import Vue from "vue";

import comments from "./components/comments.vue";
import commentsForm from "./components/commentsForm.vue";



import Axios from 'axios'

const Api = Axios.create({
    baseURL: rtc_xhr.rootapiurl,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': rtc_xhr.nonce
    }
});
Vue.prototype.$rest = Api;

const Ajax = Axios.create({
    baseURL: rtc_xhr.ajaxurl,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': rtc_xhr.nonce
    }
});
Vue.prototype.$xhr = Ajax;

Vue.config.ignoredElements = ['script'];


const app = new Vue({
    el: '#real-time-comments-container',
    components : {
        comments,
        commentsForm,
    }
});