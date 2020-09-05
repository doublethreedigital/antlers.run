# Antlers Fiddle

> An online playground for Antlers, Statamic's templating language.

## About

[Antlers Fiddle](https://antlers-fiddle.duncanm.dev) is kindna like CodePen or JSFiddle but for Antlers, the templating language that comes from Statamic. You can set the Antlers template you want to parse and some front matter data you'd like to use.

Under the hood, this project uses the *same* parser stuff that Statamic would use when parsing normal views in a normal site. However there are a few limitations:

* There's no content, meaning you can't use the collection tags, reference globals or fetch assets (well technically you could but it might break)
* You can't split stuff up into multiple files, so this rules out the ability to use layouts and partials.
* You don't have access to as many variables, to see what there is, use the `{{ dump }}` tag.
* And... obviously you can't use tags provided by addons because no addons are installed.

## Installation

1. Clone this repository `git@github.com:damcclean/antlers-fiddle.git`
2. Install Composer dependencies `composer install`
3. Copy the `.env.example` file to `.env`, then run `php artisan key:generate`
4. Install and build front-end assets `npm install && npm run production`
