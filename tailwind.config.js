import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#0d5c3a',
                    light: '#167a4e',
                },
                secondary: {
                    DEFAULT: '#D4A017',
                    light: '#e8b820',
                },
                accent: {
                    DEFAULT: '#0f1923',
                    green: '#0d2818',
                },
                cream: '#f8f5ee',
            },
        },
    },

    plugins: [forms],
};
