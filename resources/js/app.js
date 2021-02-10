require('./bootstrap');
window.Vue = require('vue/dist/vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter)

import VueResource from 'vue-resource';
Vue.use(VueResource);

import routes from './routes.js';
const router = new VueRouter({
    routes
});

import App from './App.vue';


new Vue({
    router,
    render: h => h(App)
}).$mount('#app');