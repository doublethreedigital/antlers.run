// // Import npm deps
// import Vue from 'vue'
// import axios from 'axios'
// import CodeMirror from 'codemirror'

// // Grab all the elements we need to interact with
// const templateEditor = document.getElementById('template-editor')
// const frontMatter = document.getElementById('front-matter')
// const resultIframe = document.getElementById('result-iframe')

// var codemirror = CodeMirror.fromTextArea(templateEditor, {
//     lineNumbers: true,
//     tabSize: 2,
//     mode: 'javascript',
//     theme: 'synthwave-84'
// })

// new Vue({
//     el: '#app',

//     methods: {
//         runCode() {
//             codemirror.setOption('readOnly', true)
//             frontMatter.readOnly = true

//             let params = {
//                 template: codemirror.getValue(),
//                 frontMatter: frontMatter.value,
//             }

//             axios.post('/submit', params)
//                 .then((response) => {
//                     resultIframe.setAttribute('srcdoc', response.data)
//                     resultIframe.setAttribute('src', '')

//                     codemirror.setOption('readOnly', false)
//                     frontMatter.readOnly = false
//                 })
//                 .catch((error) => {
//                     codemirror.setOption('readOnly', false)
//                     frontMatter.readOnly = false

//                     alert(error)
//                 })
//         },
//     },
// })
