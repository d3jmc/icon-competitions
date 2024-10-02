/** @type {import('tailwindcss').Config} */
export default {
  presets: [
    require("./vendor/wireui/wireui/tailwind.config.js"),
  ],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/wireui/wireui/src/*.php",
    "./vendor/wireui/wireui/ts/**/*.ts",
    "./vendor/wireui/wireui/src/WireUi/**/*.php",
    "./vendor/wireui/wireui/src/Components/**/*.php",
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '2rem',
        sm: '4rem'
      },
    },
    extend: {
      colors: {
        secondary: {
          DEFAULT: '#f2af29',
          100: '#352403',
          200: '#6a4906',
          300: '#9f6d09',
          400: '#d4910c',
          500: '#f2af29',
          600: '#f5be51',
          700: '#f7cf7d',
          800: '#fadfa8',
          900: '#fcefd4'
        }
      },
    },
    fontFamily: {
      body: ['Montserrat', 'sans-serif'],
    },
  },
}

