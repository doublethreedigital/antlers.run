<template>
    <div>
        <header class="w-full bg-statamic-hot-pink py-3 px-4 flex flex-row items-center justify-between">
            <h2 class="text-white font-bold">Antlers Fiddle</h2>

            <div>
                <span v-show="sharedSucessfully" class="mx-4 text-xs text-white font-bold">Link copied to clipboard</span>
                <span v-show="sharedWithError" class="mx-4 text-xs text-white font-bold">There was an issue sharing your fiddle</span>

                <button class="button focus:outline-none" @click="createSharedFiddle">Share</button>
            </div>
        </header>

        <router-view></router-view>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'app',

    data() {
        return {
            sharedSucessfully: false,
            sharedWithError: false
        }
    },

    methods: {
        createSharedFiddle() {
            this.sharedSucessfully = false
            this.sharedWithError = false

            axios.post(route('shared-fiddles.store'), this.$store.state.request)
                .then((response) => {
                    this.sharedSucessfully = true
                    navigator.clipboard.writeText(window.domain+'/#/shared/'+response.data)
                })
                .catch((error) => {
                    this.sharedWithError = true
                })
        }
    }
}
</script>
