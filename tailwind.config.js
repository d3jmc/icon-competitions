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
        primary: {
          DEFAULT: '#000000',
          50: '#f6f6f6',
          100: '#e7e7e7',
          200: '#d1d1d1',
          300: '#b0b0b0',
          400: '#888888',
          500: '#000000',
          600: '#5d5d5d',
          700: '#4f4f4f',
          800: '#454545',
          900: '#3d3d3d',
        },
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
        },
      },
      backgroundImage: {
        'text-gradient': 'linear-gradient(90deg, #F7CF7Dff, #F6C768ff, #F5BF53ff, #F3B73Eff, #F2AF29ff)',
      }
    },
    fontFamily: {
      body: ['Montserrat', 'sans-serif'],
    },
  },
}

