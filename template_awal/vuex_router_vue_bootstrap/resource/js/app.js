
require('./bootstrap');

window.Vue = require('vue');
import App from './app.vue';


import router from './router.js'

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import store from './store'

const app = new Vue({
    el: '#app',
    router,
    store,
    components : {
        App
    }
});
