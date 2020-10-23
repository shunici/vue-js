import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
   
    state: {
        isLoading: false, //CODE BERARU
        profil : [
            {nama: 'ronaldo', klub:'juventus'},
            {nama: 'messi', klub:'bacelona'},
            {nama: 'sanchess', klub:'manchester united'}
          ]
    },
    mutations: {
        KONFIRMASI_PEMAIN: (state, tes) => {
            state.profil.push(tes)
        }
    },
    actions: {
        simpan_profil ({commit, state}, tess_data) {
            state.isLoading = true
            setTimeout(() => {
                commit('KONFIRMASI_PEMAIN', tess_data)
                state.isLoading = false
            }, 900)
        }
    }
})