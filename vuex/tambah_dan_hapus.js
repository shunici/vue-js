  //diatas ini inputan v-model
  
  export default {
     data (){
         return {
             pemain : {
                 nama : '', klub : ''
             }
         }
     },
     methods :  {
         tambah (){
             this.$store.dispatch('simpan', this.pemain);
             this.pemain = {
                 nama : '',
                 klub : ''
             }
         }
     }
    }
    
  // store.js
  import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      pemain : [
          {nama : 'ronaldo', klub : 'juventus'},
          {nama : 'messi', klub : 'barcelona'}
      ]
    },
    mutations : {
        DISIMPAN : (state, tes) => {
            state.pemain.push(tes)
        },
        DIHAPUS : (state, tes) => {
            state.pemain.splice(tes, 1)
        }
    },
    actions : {
        simpan({commit}, tes) {
            commit('DISIMPAN', tes )
        },
        hapus ({commit}, tes) {
            commit('DIHAPUS', tes)
        }
    }

})

// main.js

import Vue from 'vue'
import App from './App.vue'
import store from './store'

Vue.config.productionTip = false

new Vue({
  store,
  render: h => h(App),
}).$mount('#app')
