const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")

    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])

    .postCss("resources/css/daisyui.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/filament-zeus.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .postCss("resources/css/filament-daisyui.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ])

    .copy('resources/css/flag-icons.css','public/css/flag-icons.css');

if (mix.inProduction()) {
    mix.version();
}
