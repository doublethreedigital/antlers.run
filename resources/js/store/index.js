import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        request: {
            template: '',
            frontMatter: '',
            csrf_token: '',
        }
    },

    mutations: {
        updateRequest(state, data) {
            state.request = {
                ...state.request,
                ...data,
            }
        }
    },

    actions: {
        updateRequest({ commit }, data) {
            commit('updateRequest', data)
        }
    }
})

export default store
