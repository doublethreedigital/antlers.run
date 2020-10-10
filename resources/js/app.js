import Vue from 'vue'
import router from './router'
import App from './components/App'
import Ziggy from 'ziggy-js'

const app = new Vue({
    el: '#app',
    router,
    render: (h) => h(App),
})
