# Antlers Fiddle

> An online playground for Antlers, Statamic's templating language.

## How it works
This project is just a fairly barebones Laravel/Statamic application. There's no fancy controllers or anything, most stuff is just done in the `routes/web.php` file.

Although, you probably want to know how the parsing stuff actually works, after all that's what you came for. Basically, when the user hits the `Run` button in the front-end, a POST request will be made to the back-end with two params, the template data and some front matter. Both of those things get parsed using Statamic/Symfony's fanciness. The HTML contents of the template will be returned as part of a JSON response which will be shown to the user.

## Installation

1. Clone this repository `git@github.com:damcclean/antlers-fiddle.git`
2. Install Composer dependencies `composer install`
3. Copy the `.env.example` file to `.env`, then run `php artisan key:generate`
4. Install and build front-end assets `npm install && npm run production`

## Features
* [ ] Front-matter data
* [ ] Ability to use tags, like `{{ if }}`
* [ ] Ability to save & share fiddles
* [ ] Ability to login via Github?
