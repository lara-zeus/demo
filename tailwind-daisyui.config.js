const colors = require('tailwindcss/colors')
module.exports = {
    content: [
        //App
        './resources/views/**/*.blade.php',

        './vendor/lara-zeus/core/resources/views/**/*.blade.php',
        './vendor/lara-zeus/core/src/CoreServiceProvider.php',

        './vendor/lara-zeus/wind/resources/views/**/*.blade.php',
        './vendor/lara-zeus/wind/src/Filament/Resources/LetterResource.php',

        './vendor/lara-zeus/sky/resources/views/**/*.blade.php',
        './vendor/lara-zeus/sky/src/Models/PostStatus.php',

        './vendor/lara-zeus/bolt/resources/views/**/*.blade.php',

        './vendor/lara-zeus/thunder/resources/views/**/*.blade.php',

        './vendor/lara-zeus/artemis/resources/views/**/*.blade.php',

        './vendor/lara-zeus/rain/resources/views/**/*.blade.php',
        './vendor/lara-zeus/rain/src/Models/Columns.php',

        './vendor/lara-zeus/rhea/resources/views/**/*.blade.php',

        // filament
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        './vendor/awcodes/filament-versions/resources/**/*.blade.php',
        './vendor/awcodes/filament-quick-create/resources/**/*.blade.php',
        './vendor/awcodes/overlook/resources/**/*.blade.php',
        './vendor/ryangjchandler/filament-navigation/resources/**/*.blade.php',
        './vendor/wire-elements/spotlight/resources/views/spotlight.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                gray: colors.slate,
                primary: colors.sky,
                custom: colors.amber,
                secondary: colors.amber,
            }
        },
    },
    daisyui: {
        styled: true,
        themes: true,
        base: true,
        utils: true,
        logs: false,
        rtl: true,
        prefix: "",
        darkTheme: "dark",
    },
    plugins: [
        require("daisyui"),
        require('tailwindcss-debug-screens'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}
