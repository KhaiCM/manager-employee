import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Router from './routes';

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000/api';
const token = localStorage.getItem('token')
if (token) {
    axios.defaults.headers.common['Authorization'] = token
}

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.router = Router
App.router = Vue.router
new Vue(App).$mount('#app');
