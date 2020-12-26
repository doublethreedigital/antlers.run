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
                </div>
            </div>
        </div>

        <div class="w-full min-h-screen">
            <router-view></router-view>
        </div>

        <share-modal v-show="shareModalOpen" :sharing="sharing" @closed="shareModalOpen = false"></share-modal>
        <info-modal v-show="infoModalOpen" @closed="infoModalOpen = false"></info-modal>
    </div>
</template>

<script>
import axios from 'axios'
import ShareModal from './Modals/ShareModal.vue'
import InfoModal from './Modals/InfoModal.vue'

export default {
    name: 'app',

    components: {
        ShareModal,
        InfoModal,
    },

    data() {
        return {
            sharing: {
                errors: false,
                success: false,
                url: null,
            },

            shareModalOpen: false,
            infoModalOpen: false,
        }
    },

    methods: {
        createSharedFiddle() {
            this.sharing.errors = {
                errors: false,
                success: false,
                url: null,
            }

            if (this.$store.state.request.template === '' && this.$store.state.request.frontMatter === '') {
                this.sharing.errors = true
                this.shareModalOpen = true
                return
            }

            axios.post(route('shared-fiddles.store'), this.$store.state.request)
                .then((response) => {
                    console.log('not ')
                    this.sharing = {
                        errors: false,
                        success: true,
                        url: window.domain + '/#/shared/' + response.data
                    }

                    this.shareModalOpen = true

                    navigator.clipboard.writeText(shareUrl)
                })
                .catch((error) => {
                    console.log('error')
                    this.sharing.errors = true
                    this.shareModalOpen = true
                })
        },

        openInfoModal() {
            this.infoModalOpen = true
        },
    }
}
</script>
