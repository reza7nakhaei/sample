/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: ["./public/**/*.html", "./src/js/**/*.js"],
  theme: {
    extend: {
      borderWidth: {
        'pro': '0.5px', // کلاس border-pro می‌سازه
      },
      scale: {
        '300': '3',
        'y-300': '3',
        '275': '2.75',
        'y-275': '2.75',
        '250': '2.5',
        'y-250': '2.5',
        '200': '2',
        'y-200': '2',
        '175': '1.75',
        'y-175': '1.75',
        '150': '1.5',
        'y-150': '1.5',
        '125': '1.25',
        'y-125': '1.25',
        '100': '1',
        '90': '0.9',
        '75': '0.75',
        '50': '0.5',
        '25': '0.25',
        '0': '0',
      },
      
      fontFamily: {
        oswald: ['Oswald', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [],
}
