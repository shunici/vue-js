import Axios from "axios"


const state = () => ({
        todos :[],        
        page : 5
})

const mutations = {
    SET_TODOS( state, payload) {
        state.todos = payload
    }
}

const actions = {
    getTodos({ commit, state }) {
        return new Promise( (resolve, reject) => {
            Axios.get(`/api/todo?page=${state.page}`)
            .then( (response) => {
                commit('SET_TODOS', response.data.data)
                resolve(response.data)
            })
        })
    }
}


export default {
    namespaced : true,
    state,
    mutations,
    actions
}

