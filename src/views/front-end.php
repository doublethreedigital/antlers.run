<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antlers Fiddle</title>
    <meta name="description" value="An online playground for Statamic's Antlers templating language.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen w-full overflow-hidden font-fira">
    <header id="header" class="bg-statamic-hot-pink w-full flex flex-row items-center justify-between">
        <div class="px-6">
            <span class="text-white font-bold flex flex-row items-center">
                <img class="mr-2 h-8" src="/img/statamic.svg" alt="Statamic">
                Antlers Fiddle
            </span>
        </div>

        <button
            id="run-button"
            class="py-4 px-12 bg-statamic-fresh-mint hover:bg-statamic-teal text-white text-center font-medium focus:outline-none"
        >Run</button>
    </header>

    <main class="app-height w-full flex flex-row">
        <div class="md:w-1/2 h-full bg-black">
            <div id="template-editor-container" class="w-full h-full" style="height: 70%;">
                <textarea
                    id="template-editor"
                    class="h-full w-full"
                ></textarea>
            </div>
            <div class="p-4 text-white" style="height: 30%;">
                <span>---</span>
                <textarea id="front-matter" class="w-full focus:outline-none bg-black" rows="6"></textarea>
                <span>---</span>
            </div>
        </div>
        <div id="result-area" class="md:w-1/2 h-full bg-white">
            <iframe
                id="result-iframe"
                src="/statamic-home"
                class="w-full h-full"
                frameborder="0"
                allowfullscreen="false"
                allowpaymentrequest="false"
                referrerpolicy="no-referrer"
            ></iframe>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.js"></script>
    <script>
        const templateEditor = document.getElementById('template-editor')
        const frontMatter = document.getElementById('front-matter')
        const result = document.getElementById('result-area')
        const resultIframe = document.getElementById('result-iframe')
        const runButton = document.getElementById('run-button')

        var codemirror = CodeMirror.fromTextArea(templateEditor, {
            lineNumbers: true,
            tabSize: 2,
            mode: 'javascript',
            theme: 'synthwave-84'
        })

        function run() {
            codemirror.setOption('readOnly', true)
            frontMatter.readOnly = true

            let params = {
                template: codemirror.getValue(),
                frontMatter: frontMatter.value,
            }

            axios.post('/submit', params)
                .then((response) => {
                    // result.innerHTML = response.data.result
                    resultIframe.setAttribute('srcdoc', response.data.result)
                    resultIframe.setAttribute('src', '')

                    codemirror.setOption('readOnly', false)
                    frontMatter.readOnly = false
                })
                .catch((error) => {
                    codemirror.setOption('readOnly', false)
                    frontMatter.readOnly = false
                })
        }

        runButton.addEventListener('click', run)
    </script>
</body>
</html>
