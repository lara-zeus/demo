const colors = require('tailwindcss/colors')
import preset from './vendor/filament/filament/tailwind.config.preset'

module.exports = {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",

        './vendor/lara-zeus/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
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
                primary: colors.emerald,
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
