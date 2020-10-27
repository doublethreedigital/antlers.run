<template>
    <div class="flex flex-row min-h-screen">
        <div class="" style="width: 50%;">
            <div class="bg-statamic-fresh-mint p-1">
                <button class="text-white mx-4 text-sm focus:outline-none" @click="view.currentTab = 'template'">Template</button>
                <button class="text-white mx-4 text-sm focus:outline-none" @click="view.currentTab = 'frontMatter'">Front matter</button>
            </div>

            <MonacoEditor
                v-if="view.currentTab === 'template'"
                theme="vs-dark"
                language="javascript"
                :value="request.template"
                :options="options"
                @change="onTemplateChange"
            >
            </MonacoEditor>

            <MonacoEditor
                v-if="view.currentTab === 'frontMatter'"
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
    name: 'home',

    components: {
        MonacoEditor
    },

    data() {
        return {
            view: {
                currentTab: 'template'
            },

            result: '',
            options: {}
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
                    window.fathom.trackGoal('GWA1WCOK', 0)
                })
                .catch((error) => {
                    window.fathom.trackGoal('YT9HMPXN', 0)
                    // TODO: add error to bottom of iframe
                })
        }
    },

    mounted() {
        this.$store.dispatch('updateRequest', {
            csrf_token: window.csrfToken,
        })

        if (this.$route.params.sharedFiddle !== undefined) {
            window.fathom.trackGoal('FHXZR17H', 0)

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

        this.updateFiddle()
    }
}
</script>
