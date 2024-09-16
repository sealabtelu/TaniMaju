/** @type {import('tailwindcss').Config} */

import preset from './vendor/filament/support/tailwind.config.preset'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default {
  presets: [preset],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        'cornsilk': '#FEFAE0',
        'sage': '#C0C78C',
        'olivine': '#A6B37D',
        'camel': '#B99470',
        'eerie-black': '#181818'
      },
      fontFamily: {
        'poppins': ["Poppins", 'sans-serif']
      },
      backgroundImage: {
        'scene-tanimaju': "url('/public/assets/bg.jpg')"
      }
    },
  },
  plugins: [
    laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: [
            ...refreshPaths,
            'app/Livewire/**',
        ],
    }),
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}