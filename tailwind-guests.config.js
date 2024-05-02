const colors = require('tailwindcss/colors')
import preset from './vendor/filament/filament/tailwind.config.preset'

const plugin = require('tailwindcss/plugin')

module.exports = {
    presets: [preset],
    content: [
        //App
        './resources/views/**/*.blade.php',
        // filament
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
        './vendor/awcodes/matinee/resources/views/**/*.blade.php',
        './vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php',

    ],
    darkMode: 'class',
    theme: {
        extend: {
        },
    },
}
