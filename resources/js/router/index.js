import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../components/Pages/Home'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'hash',

    routes: [
        {
            path: '*',
            meta: { layout: 'auth' },
            component: Home,
        }
    ],
})

export default router
