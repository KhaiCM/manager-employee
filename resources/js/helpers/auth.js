import bearer from '@websanova/vue-auth/dist/drivers/auth/bearer';
import axios from '@websanova/vue-auth/dist/drivers/http/axios.1.x';
import router from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x';

const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'auth-token',
    tokenStore: ['cookie'],
    notFoundRedirect: {
        path: '/'
    },
    registerData: {
        url: '/auth/register',
        method: 'POST',
        redirect: null,
    },
    loginData: {
        url: '/auth/login',
        method: 'POST',
        redirect: '/',
        fetchUser: true,
    },
    logoutData: {
        url: '/auth/logout',
        method: 'POST',
        redirect: '/login',
        makeRequest: true
    },
    fetchData: {
        url: '/auth/user',  
        method: 'GET',
        enabled: true
    },
    parseUserData (data) {
        return data || {}
    },
};

export default config;