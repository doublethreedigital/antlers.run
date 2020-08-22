# Antlers Fiddle

> An online playground for Antlers, Statamic's templating language.

## How it works
Behind the scenes, this application has its own installation of Statamic, located in the `statamic` folder. It get's cloned down during every deployment. During that time, the application is taken down for maintainance, as otherwise it would be unusable.

When a user clicks the `Run` button, a POST request is sent to the `/submit` endpoint which gives the Antlers parser the template content and the front-matter data and it'll return a JSON response of the data.

## Installation

1. Clone this repository `git@github.com:damcclean/antlers-fiddle.git`
2. Point your web server to the `public` directory (Valet will do this for you by default)
3. Install Statamic `composer create-project statamic/statamic statamic --prefer-dist --stability=dev`
3. You might also want to install and compile front-end dependencies `npm install && npm run production`

## Features
* [] Front-matter data
* [] Ability to use tags, like `{{ if }}`
* [] Ability to save & share fiddles
