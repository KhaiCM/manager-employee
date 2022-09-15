import Vue from 'vue';
import Router from 'vue-router';
import Dashboard from '../pages/Dashboard.vue';
import Home from '../pages/Home.vue';
import Register from '../pages/Register.vue';
import Login from '../pages/Login.vue';
import ChangePassword from '../pages/ChangePassword.vue';
import SendMail from '../pages/SendPasswordResetEmail.vue';
Vue.use(Router);
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
            path: '/send-password-reset-mail',
            name: 'sendMail',
            component: SendMail,
            meta: {
                auth: false
            }
        },
        {
            path: '/change-password',
            name: 'changePassword',
            component: ChangePassword,
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
