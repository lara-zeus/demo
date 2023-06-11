const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        './vendor/filament/**/*.blade.php',
        './vendor/lara-zeus/bolt/resources/views/**/*.blade.php',
        './vendor/lara-zeus/sky/resources/views/**/*.blade.php',
        './vendor/lara-zeus/wind/resources/views/**/*.blade.php',
        './vendor/lara-zeus/thunder/resources/views/**/*.blade.php',
        './vendor/lara-zeus/artemis/resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                'el-messiri': ['El Messiri', 'sans-serif'],
                'koho': ['KoHo', 'sans-serif'],
            },
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
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
