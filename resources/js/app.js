import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Router from './routes';
import auth from './helpers/auth';
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://localhost:8000/api';
Vue.router = Router
Vue.use(require('@websanova/vue-auth'), auth);
App.router = Vue.router
new Vue(App).$mount('#app');
