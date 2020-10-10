<!DOCTYPE html>
<html lang="en">
<head>
    <title>Antlers Fiddle</title>
    <meta name="title" content="Antlers Fiddle">
    <meta name="description" content="An online playground for Antlers, Statamic's templating language.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="http://antlers-fiddle.duncanm.dev/">
    <meta property="og:title" content="Antlers Fiddle">
    <meta property="og:description" content="An online playground for Antlers, Statamic's templating language.">
    <meta property="og:image" content="https://antlers-fiddle.duncanm.dev/social.png">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://antlers-fiddle.duncanm.dev/">
    <meta property="twitter:title" content="Antlers Fiddle">
    <meta property="twitter:description" content="An online playground for Antlers, Statamic's templating language.">
    <meta property="twitter:image" content="https://antlers-fiddle.duncanm.dev/social.png">

    <script>
        window.csrfToken = '{{ csrf_token() }}';
        window.domain = '{{ config('app.url') }}';
    </script>
    @routes
    @if(app()->environment() === 'production')
        <!-- Fathom - beautiful, simple website analytics -->
        <script src="https://bear.duncanm.dev/script.js" site="UUSKXPZQ" defer></script>
        <!-- / Fathom -->
    @endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen w-full overflow-hidden font-fira">
    <div id="app"></div>
    <script src="/js/app.js"></script>
</body>
</html>
