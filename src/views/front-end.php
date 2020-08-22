<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antlers Fiddle</title>
    <meta name="description" value="An online playground for Statamic's Antlers templating language.">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen w-full overflow-hidden">
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
            <textarea
                id="template-editor"
                cols="30"
                rows="10"
                class="w-full h-full bg-transparent focus:outline-none text-white"
            ></textarea>
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
        const result = document.getElementById('result-area')
        const runButton = document.getElementById('run-button')

        CodeMirror(templateEditor, {
            lineNumbers: true,
            tabSize: 2,
            value: 'console.log("Hello, World");'
        });

        function run() {
            templateEditor.readOnly = true

            let params = {
                template: templateEditor.value
            }

            axios.post('/submit', params)
                .then((response) => {
                    console.log('good good')

                    result.innerHTML = response.data.result
                    templateEditor.readOnly = false
                })
                .catch((error) => {
                    console.log('bad bad')

                    alert('Template could not be parsed.')
                    templateEditor.readOnly = false
                })
        }

        runButton.addEventListener('click', run)
    </script>
</body>
</html>
