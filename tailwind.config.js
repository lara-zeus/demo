const colors = require('tailwindcss/colors')
import preset from './vendor/filament/filament/tailwind.config.preset'

module.exports = {
    presets: [preset],
    content: [
        //App
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',

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
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            /*fontFamily: {
                'el-messiri': ['El Messiri', 'sans-serif'],
                'koho': ['KoHo', 'sans-serif'],
            },*/
            colors: {
                gray: colors.stone,
                primary: colors.green,
                custom: colors.yellow,
                secondary: colors.yellow,
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
