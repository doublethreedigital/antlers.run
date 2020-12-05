import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        request: {
            template: `<!--
    Welcome to Antlers.run! Replace the code below to get started!

    Antlers.run supports TailwindCSS and Alpine.js out of the box. Just add
    the classes and it'll just start working.
-->

<div class=" bg-gray-200 flex justify-center items-center">
    <div class="max-w-lg">
        <h2 class="text-center text-2xl mb-2 font-medium">Antlers.run</h2>
        <p class="text-center text-gray-800">Antlers.run is an online playground for Antlers, Statamic's templating language. It's built for the community by the community.</p>

        <div class="my-4 flex justify-center space-x-6">
        <a class="text-center text-gray-700 hover:statamic-hot-pink text-sm" href="https://statamic.dev/antlers">Antlers Documentation</a>
        <a class="text-center text-gray-700 hover:statamic-hot-pink text-sm" href="https://statamic.com/discord">Statamic Discord</a>
        </div>
    </div>
</div>`,
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
