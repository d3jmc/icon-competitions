/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
    "./vendor/livewire/flux/stubs/**/*.blade.php",
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
          '50': '#f6f6f6',
          '100': '#e7e7e7',
          '200': '#d1d1d1',
          '300': '#b0b0b0',
          '400': '#888888',
          '500': '#6d6d6d',
          '600': '#5d5d5d',
          '700': '#4f4f4f',
          '800': '#454545',
          '900': '#3d3d3d',
          '950': '#000000',
          DEFAULT: '#000000',
        },
        secondary: {
          '50': '#fffaeb',
          '100': '#fef1c7',
          '200': '#fde28a',
          '300': '#fcd34d',
          '400': '#fbc924',
          '500': '#f5be0b',
          '600': '#d9a806',
          '700': '#b48c09',
          '800': '#92730e',
          '900': '#785f0f',
          '950': '#453603',
          DEFAULT: '#fcd34d',
        },
      },
    },
    fontFamily: {
      body: ['Montserrat', 'sans-serif'],
    },
  },
  plugins: [],
}

