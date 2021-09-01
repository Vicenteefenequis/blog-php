const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        borderColor: theme => ({
            ...theme('colors'),
            DEFAULT: theme('colors.black', 'currentColor'),
            'primary': '#f8eaea',
            'secondary': '#ffed4a',
            'danger': '#e3342f',
        }),
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            ...colors,
            black: {
                ...colors.black,
                DEFAULT: "#1C232D",
            },
            brown: {
                DEFAULT: "#897A7A"
            }
        },

    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
