<template>
    <div class="flex flex-row">
        <div class="w-16 min-h-screen">
            <div class="h-full flex flex-col space-y-6">
                <div class="flex items-center justify-center py-3">
                    <img class="w-8" src="/img/statamic.svg" alt="Antlers.run">
                </div>

                <div class="flex flex-col">
                    <button class="mb-2 focus:outline-none flex justify-center" @click="createSharedFiddle" alt="Share">
                        <img class="h-8" src="/img/share.svg">
                    </button>
                    <button class="mb-2 focus:outline-none flex justify-center" @click="openInfoModal" alt="Information">
                        <img class="h-8" src="/img/info.svg">
                    </button>
                    <button class="mb-2">S</button>
                </div>
            </div>
        </div>

        <div class="w-full min-h-screen">
            <router-view></router-view>
        </div>

        <info-modal v-show="infoModalOpen" @closed="infoModalOpen = false"></info-modal>
    </div>
</template>

<script>
import axios from 'axios'
import InfoModal from './Modals/InfoModal.vue'

export default {
    name: 'app',

    components: {
        InfoModal,
    },

    data() {
        return {
            sharedSucessfully: false,
            sharedWithError: false,

            infoModalOpen: false,
        }
    },

    methods: {
        createSharedFiddle() {
            this.sharedSucessfully = false
            this.sharedWithError = false

            if (this.$store.state.request.template === '' && this.$store.state.request.frontMatter === '') {
                this.sharedWithError = true
                return
            }

            axios.post(route('shared-fiddles.store'), this.$store.state.request)
                .then((response) => {
                    this.sharedSucessfully = true

                    navigator.clipboard.writeText(window.domain+'/#/shared/'+response.data)
                    window.fathom.trackGoal('FPUQODLR', 0)
                })
                .catch((error) => {
                    this.sharedWithError = true
                })
        },

        openInfoModal() {
            this.infoModalOpen = true
        },
    }
}
</script>
