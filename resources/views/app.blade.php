<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Primary Meta Tags -->
    <title>Antlers Fiddle</title>
    <meta name="title" content="Antlers Fiddle">
    <meta name="description" content="An online playground for Antlers, Statamic's templating language.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://antlers-fiddle.duncanm.dev/">
    <meta property="og:title" content="Antlers Fiddle">
    <meta property="og:description" content="An online playground for Antlers, Statamic's templating language.">
    <meta property="og:image" content="https://antlers-fiddle.duncanm.dev/social.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://antlers-fiddle.duncanm.dev/">
    <meta property="twitter:title" content="Antlers Fiddle">
    <meta property="twitter:description" content="An online playground for Antlers, Statamic's templating language.">
    <meta property="twitter:image" content="https://antlers-fiddle.duncanm.dev/social.png">

    <!-- Fathom - beautiful, simple website analytics -->
    <script src="https://bear.duncanm.dev/script.js" site="UUSKXPZQ" defer></script>
    <!-- / Fathom -->
</head>
<body class="min-h-screen w-full overflow-hidden font-fira">
    <header id="header" class="bg-statamic-hot-pink w-full flex flex-row items-center justify-between py-2">
        <div class="px-6">
            <span class="text-white font-bold flex flex-row items-center whitespace-no-wrap">
                <img class="mr-2 h-6" src="/img/statamic.svg" alt="Statamic">
                Antlers Fiddle
            </span>
        </div>

        <div class="mx-6 flex items-center">
            <a
                href="https://github.com/damcclean/antlers-fiddle"
                target="_blank"
                class="text-white text-sm font-medium mr-6 focus:outline-none"
            >Github</a>

            <button
                id="run-button"
                class="button focus:outline-none"
            >Run</button>
        </div>
    </header>

    <main id="app" class="app-height w-full flex flex-col md:flex-row overflow-hidden">
        <div class="w-full h-half md:w-1/2 md:h-full bg-black">
            <div id="template-editor-container" class="w-full h-full" style="height: 70%;">
                <textarea
                    id="template-editor"
                    class="h-full w-full"
                ></textarea>
            </div>
            <div class="p-4 text-white overflow-hidden" style="height: 30%;">
                <!-- <span>---</span> -->
                <textarea id="front-matter" class="w-full focus:outline-none bg-black" rows="6" placeholder="# And your front matter (YAML) goes here"></textarea>
                <!-- <span>---</span> -->
            </div>
        </div>
        <div id="result-area" class="w-full h-half md:w-1/2 md:h-full bg-white">
            <iframe
                id="result-iframe"
                src="/statamic-home"
                class="w-full h-full"
                frameborder="0"
                allowfullscreen="false"
                allowpaymentrequest="false"
                referrerpolicy="no-referrer"
                title="Result"
            ></iframe>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.57.0/codemirror.min.js"></script>
    <script src="https://codemirror.net/addon/display/placeholder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/emmet-codemirror@1.2.5/dist/emmet.js"></script>
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
            theme: 'synthwave-84',
            placeholder: '<!-- Template code goes here... -->',
            mode: 'text/html',
            lint: true,
            closeTag: true,
            mode: 'htmlmixed',
            extraKeys: {
                'Tab': 'emmetExpandAbbreviation',
                'Esc': 'emmetResetAbbreviation',
                'Enter': 'emmetInsertLineBreak'
            },
            emmet: {
                // emmetEnterAbbreviationMode: true,
                // emmetExpandAbbreviation: true,
                mark: true,
                markTagPairs: true,
                previewOpenTag: false,
                autoRenameTags: true,
                markupStyle: 'html',
            }
        })

        function run() {
            codemirror.setOption('readOnly', true)
            frontMatter.readOnly = true

            let params = {
                template: codemirror.getValue(),
                frontMatter: frontMatter.value,
            }

            if (params.template === undefined || params.template === null || params.template === '') {
                alert("Don't be silly, you can't parse nothing. Add something to your template and try again.")
                return
            }

            axios.post('{{ route('run') }}', params)
                .then((response) => {
                    resultIframe.setAttribute('srcdoc', response.data)
                    resultIframe.setAttribute('src', '')

                    codemirror.setOption('readOnly', false)
                    frontMatter.readOnly = false
                })
                .catch((error) => {
                    codemirror.setOption('readOnly', false)
                    frontMatter.readOnly = false

                    alert(error)
                })
        }

        runButton.addEventListener('click', run)
    </script>
</body>
</html>
