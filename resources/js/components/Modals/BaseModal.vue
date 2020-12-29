<template>
    <div>
        <div class="bg-black bg-opacity-50 fixed z-10 inset-0 overflow-y-auto flex justify-center items-center">
            <div class="bg-white rounded-md p-6 lg:w-1/2 xl:w-1/4">
                <div class="flex flex-row justify-end items-center w-full mb-6">
                    <button class="focus:outline-none" @click="closeModal">
                        <span>
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.8653 1.63604L2.13735 14.364" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                <path d="M2.1348 1.63604L14.8627 14.364" stroke="black" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </button>
                </div>
                <div>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        closeModal() {
            this.$emit('closed', true)
        },
    },
}
</script>
