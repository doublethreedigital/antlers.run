import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../components/Pages/Home'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'hash',

    routes: [
        {
            path: '*',
            component: Home,
        },
        {
            path: '/shared/:sharedFiddle',
            component: Home,
        }
    ],
})

export default router
