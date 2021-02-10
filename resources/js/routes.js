import Home from './pages/Home.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';

export default [
    {
        path: '/',
        redirect: "/login",
        component: Login,
        name: 'home'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/home',
        component: Home,
        name: 'homepage'
    },
]