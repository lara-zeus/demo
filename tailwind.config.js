const colors = require('tailwindcss/colors')
import preset from './vendor/filament/filament/tailwind.config.preset'

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

        './vendor/lara-zeus/rain/resources/views/**/*.blade.php',
        './vendor/lara-zeus/rain/src/Models/Columns.php',

        './vendor/lara-zeus/rhea/resources/views/**/*.blade.php',

        // hermes
        './vendor/lara-zeus/hermes/resources/views/**/*.blade.php',

        // Bolt Pro
        './vendor/lara-zeus/bolt-pro/resources/views/**/*.blade.php',
        './vendor/sawirricardo/filament-nouislider/resources/views/forms/components/nouislider.blade.php',

        // Bolt Preset
        './vendor/lara-zeus/bolt-preset/resources/views/**/*.blade.php',

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
                gray: colors.stone,
                primary: {  DEFAULT: '#45B39D',  50: '#C6E9E2',  100: '#B8E4DB',  200: '#9AD8CC',  300: '#7DCDBD',  400: '#5FC1AE',  500: '#45B39D',  600: '#358B79',  700: '#266256',  800: '#163A32',  900: '#07110F',  950: '#000000'},
                //custom: {  DEFAULT: '#45B39D',  50: '#C6E9E2',  100: '#B8E4DB',  200: '#9AD8CC',  300: '#7DCDBD',  400: '#5FC1AE',  500: '#45B39D',  600: '#358B79',  700: '#266256',  800: '#163A32',  900: '#07110F',  950: '#000000'},
                secondary: {  DEFAULT: '#F1948A',  50: '#FDF2F0',  100: '#FCE7E5',  200: '#F9D2CE',  300: '#F6BEB8',  400: '#F4A9A1',  500: '#F1948A',  600: '#EB6658',  700: '#E53826',  800: '#BC2717',  900: '#8A1C11',  950: '#71170E'},
                //primary: colors.green,
                //secondary: colors.yellow,
                //custom: colors.pink,
                danger: colors.red,
                success: colors.green,
                warning: colors.yellow,
                info: colors.blue,
            }
        },
    },
    plugins: [
        require('tailwindcss-debug-screens'),
    ],
}
