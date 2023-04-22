const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Http/Livewire/**/*Table.php',
        './app/PowerGridThemes/*.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
    ],

    theme: {
        extend: {
            colors: {
                'pg-primary': colors.slate,
                'pg-secondary': colors.blue,
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class',
        }), require('@tailwindcss/typography')
    ]
    //plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
