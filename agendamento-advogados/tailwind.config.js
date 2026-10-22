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
            colors: {
                'dust-grey': '#d6d6d6',
                'bright-lemon': '#ffee32',
                'bright-amber': '#ffd100',
                'carbon-black': '#202020',
                'graphite': '#333533',
                // Dark-Luxury Palette
                'preto-absoluto': '#0D0D0D',
                'cinza-grafite': '#2C2C2C',
                'dourado-prestigio': '#D4AF37',
                'dourado-light': '#F3E5AB',
                'dourado-dark': '#9A7B20',
                'prata-moderno': '#848484',
                'prata-light': '#B4B4B4',
                'off-white': '#F9F9FB',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Cormorant Garamond', 'Playfair Display', 'Cinzel', ...defaultTheme.fontFamily.serif],
                cinzel: ['Cinzel', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
