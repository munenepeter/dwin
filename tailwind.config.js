/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'geebung': {
          '50': '#fef7e8',
          '100': '#feebc3',
          '200': '#fed98a',
          '300': '#fdc247',
          '400': '#fab015',
          '500': '#eaa108',
          '600': '#ca8a04',
          '700': '#a16f07',
          '800': '#855f0e',
          '900': '#715212',
          '950': '#422f06',
        },
      }
    },
  },
  plugins: [],
}