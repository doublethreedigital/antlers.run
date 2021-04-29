<template>
    <base-modal @closed="$emit('closed', true)">
        <h2 class="font-semibold text-lg text-gray-800">About Antlers.run</h2>
        <p class="mb-2 text-gray-800 text-sm">Antlers.run is an online playground for Antlers, Statamic's templating language. Antlers.run is run by <a href="https://duncanmcclean.com">Duncan McClean</a> and has no affilation with Statamic or Wilderborn LLC.</p>
        <a class="text-gray-600 text-sm font-semibold" href="https://github.com/doublethreedigital/antlers.run">View on GitHub</a>
            
        <div class="mt-4 flex items-center justify-center">
            <a href="https://www.digitalocean.com/?refcode=2b7296f7ed75&utm_campaign=Referral_Invite&utm_medium=Referral_Program&utm_source=badge"><img src="https://web-platforms.sfo2.digitaloceanspaces.com/WWW/Badge%202.svg" alt="DigitalOcean Referral Badge" /></a>    
        </div>
    </base-modal>
</template>

<script>
import BaseModal from './BaseModal'

export default {
    components: {
        BaseModal,
    },
}
</script>
