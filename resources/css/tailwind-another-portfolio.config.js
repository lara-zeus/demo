const colors = require('tailwindcss/colors');
import preset from '../../vendor/filament/filament/tailwind.config.preset';

module.exports = {
    presets: [preset],
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

        './vendor/lara-zeus/dynamic-dashboard/resources/views/**/*.blade.php',
        './vendor/lara-zeus/dynamic-dashboard/src/Models/Columns.php',

        './vendor/lara-zeus/rhea/resources/views/**/*.blade.php',

        './vendor/lara-zeus/hermes/resources/views/**/*.blade.php',

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
                //gray: colors.slate,
                //primary: colors.sky,
                //secondary: colors.amber,

                danger: colors.red,
                success: colors.green,
                warning: colors.yellow,
                info: colors.blue,

                custom: {
                    '50': '#fdf4f3',
                    '100': '#fce6e4',
                    '200': '#fbd1cd',
                    '300': '#f6b2ab',
                    '400': '#f1948a',
                    '500': '#e45d4f',
                    '600': '#d04132',
                    '700': '#af3326',
                    '800': '#912e23',
                    '900': '#792b23',
                    '950': '#41130e',
                },
                primary: {
                    '50': '#fdf4f3',
                    '100': '#fce6e4',
                    '200': '#fbd1cd',
                    '300': '#f6b2ab',
                    '400': '#f1948a',
                    '500': '#e45d4f',
                    '600': '#d04132',
                    '700': '#af3326',
                    '800': '#912e23',
                    '900': '#792b23',
                    '950': '#41130e',
                },
                secondary: {
                    '50': '#F6FBF9',
                    '100': '#d4f3eb',
                    '200': '#a8e7d6',
                    '300': '#75d3bd',
                    '400': '#45b39d',
                    '500': '#2f9d89',
                    '600': '#237e6f',
                    '700': '#20655b',
                    '800': '#1e514a',
                    '900': '#1d443f',
                    '950': '#0b2825',
                },
                gray: {
                    '50': '#F6FBF9',
                    '100': '#d4f3eb',
                    '200': '#a8e7d6',
                    '300': '#75d3bd',
                    '400': '#45b39d',
                    '500': '#2f9d89',
                    '600': '#237e6f',
                    '700': '#20655b',
                    '800': '#1e514a',
                    '900': '#1d443f',
                    '950': '#0b2825',
                },
            }
        },
    },
    plugins: [
        require('tailwindcss-debug-screens'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}
