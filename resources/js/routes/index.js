import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home.vue';
Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: configRoutes(),
})
function configRoutes() {
    return [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                auth: true
            }
        }
    ]
}
