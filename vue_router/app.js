//ini adalah file utama dalam penghubung dari instance

require('./bootstrap');

window.Vue = require('vue');
import App from './App.vue';


//router settingan
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


const Home = require('./pages/home.vue').default;
const About = require('./pages/about.vue').default;
const routes = [       
        {
            path: '/home',
            name: 'home',
            component: Home,            
        },
        {
            path: '/about',
            name: 'about',
            component: About,            
        },  
]

const router = new VueRouter ({
    mode : 'history',
    routes : routes
    // bisa saja ditulis routes  karena varibel nya sama
});


const app = new Vue({
    el: '#app',
    router,
    components : {
        App
    }
});
