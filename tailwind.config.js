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
        // primary: '#000000',
        // secondary: '#fcd34d',
      },
    },
    fontFamily: {
      body: ['Montserrat', 'sans-serif'],
    },
  },
}

