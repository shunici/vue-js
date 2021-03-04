import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import todo from './stores/todo'

const store = new Vuex.Store({  
    modules : {
        todo
    }
})


export default store
