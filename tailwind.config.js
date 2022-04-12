const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./resources/**/*.blade.php",
    ],
    theme: {
        debugScreens: {
            style: {
                fontSize: '24px',
            },
        },
        extend: {
            colors: {
                gray: colors.stone,
                primary: colors.green,
                secondary: colors.yellow,
                danger: colors.rose,
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
