const colors = require('tailwindcss/colors')
import preset from './vendor/filament/filament/tailwind.config.preset'

module.exports = {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",

        './vendor/lara-zeus/core/resources/views/**/*.blade.php',
        './vendor/lara-zeus/wind/resources/views/**/*.blade.php',
        './vendor/lara-zeus/sky/resources/views/**/*.blade.php',
        './vendor/lara-zeus/bolt/resources/views/**/*.blade.php',
        './vendor/lara-zeus/thunder/resources/views/**/*.blade.php',
        './vendor/lara-zeus/artemis/resources/views/**/*.blade.php',
        './vendor/lara-zeus/rain/resources/views/**/*.blade.php',
        './vendor/lara-zeus/rhea/resources/views/**/*.blade.php',

        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',



        // Core
        './resources/views/**/*.blade.php',
        // Wind
        '../wind/resources/views/themes/**/*.blade.php',
        // Sky
        '../sky/resources/views/themes/**/*.blade.php',
        // Bolt
        '../bolt/resources/views/themes/**/*.blade.php',
        '../bolt/src/Models/FormsStatus.php',
        // Thunder
        '../thunder/resources/views/themes/**/*.blade.php',
        '../thunder/src/Models/TicketsStatus.php',
        // Rain
        '../rain/resources/views/themes/**/*.blade.php',
        '../rain/src/Models/Columns.php',
        // filament
        './vendor/filament/**/*.blade.php',
        './src/CoreServiceProvider.php',
        '../rain/src/Models/Columns.php',
        '../sky/src/Models/PostStatus.php',
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
                primary: colors.emerald,
                custom: colors.emerald,
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
