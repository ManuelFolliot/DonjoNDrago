/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    keyframes: {
      slowpan: {
      '0%': { backgroundPosition: 'top left' },
      '100%': { backgroundPosition: 'bottom right' },
    },
    spin: {
      '0%': { transform: 'rotate(0deg)' },
      '100%': { transform: 'rotate(360deg)' },
    },
  },
    animation: {
      slowpan: 'slowpan 15s linear infinite',
      spin: 'spin 750ms ease-in',
    },
    extend: {},
  },
  plugins: [],
}
