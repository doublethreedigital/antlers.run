import Vue from 'vue'
import router from './router'
import store from './store'
import App from './components/App'
import Ziggy from 'ziggy-js'

const app = new Vue({
    el: '#app',
    router,
    store,
    render: (h) => h(App),
})
