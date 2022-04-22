const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        debugScreens: {
            style: {
                fontSize: '24px',
            },
        },
        extend: {
            fontFamily: {
                'el-messiri': ['El Messiri', 'sans-serif'],
                'koho': ['KoHo', 'sans-serif'],
            },
            colors: {
                gray: colors.stone,
                primary: colors.emerald,
                green: colors.emerald,
                secondary: colors.yellow,
                danger: colors.rose,
                success: colors.emerald,
                warning: colors.yellow,
                info: colors.blue,

                emerald: {
                    50: "#d1fae5",
                    100: "#a7f3d0",
                    200: "#6ee7b7",
                    300: "#34d399",
                    400: "#10b981",
                    600: "#059669",
                    500: "#059669",
                    700: "#047857",
                    800: "#065f46",
                    900: "#064e3b",
                },
            }
        },
    },
    plugins: [
        require('tailwindcss-debug-screens'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
