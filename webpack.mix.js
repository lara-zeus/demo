const mix = require('laravel-mix');

mix
    .js("resources/js/another-portfolio.js", "public/js")
    .js("resources/js/app.js", "public/js")

    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])

    .postCss("resources/css/daisy.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/another-portfolio.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/filament-zeus.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/filament-guests.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    /*.postCss("resources/css/filament-xp.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])*/

    .postCss("resources/css/filament-brush.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/filament-daisy.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/filament-another-portfolio.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .copy('resources/css/flag-icons.css','public/css/flag-icons.css');

if (mix.inProduction()) {
    mix.version();
}
