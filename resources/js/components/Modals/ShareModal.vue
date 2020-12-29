<template>
    <base-modal @closed="$emit('closed', true)">
        <h2 class="font-semibold text-lg text-gray-800">Share Fiddle</h2>
        <p v-if="sharing.errors && !sharing.success" class="mb-2 text-red-600 font-semibold text-sm">There was an issue attempting to share your fiddle. Please try again later.</p>
        <p v-if="sharing.success" class="mb-2 text-gray-800 text-sm">A sharing link for your fiddle has been generated and the link has been copied to your clipboard.</p>

        <pre v-if="sharing.success" class="my-2 bg-gray-200 p-2" v-text="sharing.url"></pre>
    </base-modal>
</template>

<script>
import BaseModal from './BaseModal'

export default {
    components: {
        BaseModal,
    },

    props: ['sharing'],
}
</script>
