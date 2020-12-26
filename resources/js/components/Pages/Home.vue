<template>
    <div class="flex flex-row min-h-screen">
        <div style="width: 50%;">
            <div class="bg-monaco-dark space-x-6 pl-4 py-1 pb-2">
                <button
                    class="text-sm text-white focus:outline-none p-1 border-b-2 border-transparent"
                    :class="{
                        'border-white' : view.currentTab === 'template'
                    }"
                    @click="view.currentTab = 'template'"
                >
                    Template
                </button>
                <button
                    class="text-sm text-white focus:outline-none p-1 border-b-2 border-transparent"
                    :class="{
                        'border-white' : view.currentTab === 'frontMatter'
                    }"
                    @click="view.currentTab = 'frontMatter'"
                >
                    Front matter
                </button>
            </div>

            <MonacoEditor
                v-if="view.currentTab === 'template'"
                theme="vs-dark"
                language="html"
                :value="request.template"
                :options="options"
                @change="onTemplateChange"
            >
            </MonacoEditor>

            <MonacoEditor
                v-if="view.currentTab === 'frontMatter'"
                theme="vs-dark"
                language="yaml"
                :value="request.frontMatter"
                :options="options"
                @change="onFrontMatterChange"
            >
            </MonacoEditor>
        </div>
        <div class="bg-white relative" style="width: 50%;">
            <iframe
                title="Result"
                :srcdoc="result"
                class="w-full h-full max-h-screen"
                frameborder="0"
                allowfullscreen="false"
                allowpaymentrequest="false"
                referrerpolicy="no-referrer"
            ></iframe>

            <div v-if="error" class="bg-black w-full fixed bottom-0 p-2">
                <p class="text-white block max-w-2xl" v-html="error"></p>
            </div>
        </div>
    </div>
</template>

<script>
import MonacoEditor from 'monaco-editor-vue'
import { emmetHTML } from "emmet-monaco-es"
import axios from 'axios'

export default {
    name: 'home',

    components: {
        MonacoEditor
    },

    data() {
        return {
            view: {
                currentTab: 'template',
            },

            result: '',
            error: '',
            options: {
                automaticLayout: true,
                lineHeight: 25,
                indentSize: 2,
                tabSize: 2,
            },
        }
    },

    computed: {
        request() {
            return this.$store.state.request
        }
    },

    methods: {
        onTemplateChange(value) {
            this.$store.dispatch('updateRequest', {
                template: value
            })

            if (value.includes('---')) {
                this.error = "⚠️ To use front-matter, please switch to the front matter tab."
            }

            if (value.includes('{{ collection')) {
                this.error = "Antlers.run doesn't support collections. Remove the collections tag to resolve this error."
                return
            }

            this.updateFiddle()
        },

        onFrontMatterChange(value) {
            this.$store.dispatch('updateRequest', {
                frontMatter: value
            })

            this.updateFiddle()
        },

        updateFiddle() {
            axios.post(route('run'), this.request)
                .then((response) => {
                    this.result = response.data
                })
        }
    },

    mounted() {
        this.$store.dispatch('updateRequest', {
            csrf_token: window.csrfToken,
        })

        if (this.$route.params.sharedFiddle !== undefined) {
            axios.get(route('shared-fiddles.show', {
                sharedFiddle: this.$route.params.sharedFiddle
            })).then((response) => {
                this.$store.dispatch('updateRequest', {
                    template: response.data.template,
                    frontMatter: response.data.front_matter,
                })
            }).catch((error) => {
                console.log('There was an issue fetching the shared fiddle.')
            })
        }

        emmetHTML(monaco)

        this.updateFiddle()
    }
}
</script>
