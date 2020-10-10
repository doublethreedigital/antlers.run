<template>
    <div class="flex flex-row min-h-screen">
        <div class="" style="width: 50%;">
            <div class="bg-black p-1">
                <button class="text-white mx-4 text-sm focus:outline-none" @click="view.currentTab = 'template'">Template</button>
                <button class="text-white mx-4 text-sm focus:outline-none" @click="view.currentTab = 'frontMatter'">Front matter</button>
            </div>

            <MonacoEditor
                v-show="view.currentTab === 'template'"
                theme="vs-dark"
                language="javascript"
                :value="request.template"
                :options="options"
                @change="onTemplateChange"
            >
            </MonacoEditor>

            <MonacoEditor
                v-else-show="view.currentTab === 'frontMatter'"
                theme="vs-dark"
                language="javascript"
                :value="request.frontMatter"
                :options="options"
                @change="onFrontMatterChange"
            >
            </MonacoEditor>
        </div>
        <div class="bg-white" style="width: 50%;">
            <iframe
                :srcdoc="result"
                class="w-full h-full"
                frameborder="0"
                allowfullscreen="false"
                allowpaymentrequest="false"
                referrerpolicy="no-referrer"
                title="Result"
            ></iframe>
        </div>
    </div>
</template>

<script>
import MonacoEditor from 'monaco-editor-vue'
import axios from 'axios'

export default {
    name: 'app',

    components: {
        MonacoEditor
    },

    data() {
        return {
            request: {
                template: '',
                frontMatter: '',
                csrf_token: window.csrfToken
            },

            view: {
                currentTab: 'template'
            },

            result: '',
            options: {}
        }
    },

    methods: {
        onTemplateChange(value) {
            this.request.template = value
            this.updateFiddle()
        },

        onFrontMatterChange(value) {
            this.request.frontMatter = value
            this.updateFiddle()
        },

        updateFiddle() {
            axios.post(route('run'), this.request)
                .then((response) => {
                    this.result = response.data
                })
                .catch((error) => {
                    // alert(error)
                })
        }
    },

    mounted() {
        this.updateFiddle()
    }
}
</script>
