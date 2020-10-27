# Antlers.run

[Antlers.run](https://antlers.run) is like CodePen or JSFiddle but for Antlers, the templating language that comes from Statamic. You can set the Antlers template you want to parse and some front matter data you'd like to use.

Under the hood, this project uses the *same* parser stuff that Statamic would use when parsing normal views in a normal site. However there are a few limitations:

* There's no content, meaning you can't use the collection tags, reference globals or fetch assets (well technically you could but it might break)
* You can't split stuff up into multiple files, so this rules out the ability to use layouts and partials.
* You don't have access to as many variables, to see what there is, use the `{{ dump }}` tag.
* And... obviously you can't use tags provided by addons because no addons are installed.

## How it works
1. The front-end of the site is a small Vue SPA, literally just because it's a lot cleaner than Vanilla JavaScript. 
2. When you type any code on either the template view or the front matter view, the code will instantly be sent to the server and processed by the Antler's parser. The result will be output in the `<iframe>`.

## Installation

1. Clone this repository `git@github.com:doublethreedigital/antlers.run.git`
2. Install Composer dependencies `composer install`
3. Copy the `.env.example` file to `.env`, then run `php artisan key:generate`
4. Configure a database in your `.env` file, it's used to save shared fiddles.
5. Install and build front-end assets `npm install && npm run production`

## Contributing

This project is open-source so everyone's welcome to contribute. We've got [a Trello board](https://trello.com/b/SvjfaQ3D/antlersrun) of feature requests and a flow of [Github issues](https://github.com/doublethreedigital/antlers.run/issues), filled with bugs.
