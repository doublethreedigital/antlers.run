<template>
    <div>
        <header class="w-full bg-statamic-hot-pink py-3 px-4 flex flex-row items-center justify-between">
            <h2 class="text-white font-medium">Antlers Fiddle</h2>

            <div>
                <button class="button focus:outline-none">Share</button>
            </div>
        </header>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'app',
}
</script>
