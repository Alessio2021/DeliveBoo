/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import '../sass/app.scss';

window.Vue = require('vue');
import App from './views/App';
import Home from './pages/Home';
import About from './pages/About';
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import CategoryRestaurants from './pages/CategoryRestaurants';
import Menu from './pages/Menu';






import VueRouter from 'vue-router';
import Vue from 'vue';
Vue.use(VueRouter);

const router = new VueRouter({
    mode:'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/category/:category',
            name: 'category',
            params: {category: ''} ,
            component: CategoryRestaurants
        },
        {
            path: '/restaurant/:restaurant',
            name: 'restaurant',
            params: {restaurant: ''} ,
            component: Menu
        },
    ]
});



const app = new Vue({
    el: '#app',
    render:h => h(App),
    router
});

