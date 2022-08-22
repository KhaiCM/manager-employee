import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Router from './routes';
import authBasic from '@websanova/vue-auth/dist/drivers/auth/basic.js';
import httpVueResource from '@websanova/vue-auth/dist/drivers/http/vue-resource.1.x.js';
import routerVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.js';
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://localhost:8000/api';
Vue.router = Router
Vue.use(require('@websanova/vue-auth'), {
    auth: authBasic,
    http: httpVueResource,
    router: routerVueRouter,
});
App.router = Vue.router
new Vue(App).$mount('#app');
