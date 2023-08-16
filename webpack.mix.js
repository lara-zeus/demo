const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    .copy('resources/css/flag-icons.css','public/css/flag-icons.css')
    .postCss("resources/css/filament.css", "public/css", [
        require("tailwindcss/nesting"),
        require("autoprefixer"),
        require("tailwindcss"),
    ]);

if (mix.inProduction()) {
    mix.version();
}
