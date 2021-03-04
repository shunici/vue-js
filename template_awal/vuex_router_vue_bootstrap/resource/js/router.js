import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
const todoIndex = require('./pages/index.vue').default;

const routes = [       
        {
            path: '/index',
            name: 'todo.index',
            component: todoIndex,            
        }
       
]

const router = new VueRouter ({
    mode : 'history',
    routes : routes
 
});

export default router
