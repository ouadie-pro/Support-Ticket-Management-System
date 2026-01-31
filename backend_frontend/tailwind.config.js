/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
            colors: {
        primary: "#195de6",
      },
    },
  },
  plugins: [],
}
