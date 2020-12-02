let mix = require('laravel-mix')
let MonacoWebpackPlugin = require('monaco-editor-webpack-plugin')

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .webpackConfig({
        plugins: [
            new MonacoWebpackPlugin({
                languages: [
                    'html',
                    'yaml',
                ],
            }),
        ],
    })
