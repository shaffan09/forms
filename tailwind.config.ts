import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: [
      {
        mytheme: {
          "primary": "#5b65cc",
          "secondary": "#66f49a",
          "accent": "#2ccc9c",
          "neutral": "#23222A",
          "base-100": "#EFEEF2",
          "info": "#5C87EB",
          "success": "#68E3CD",
          "warning": "#FB900E",
          "error": "#F8121D",
        },
      },
    ],
  },
  plugins: [daisyui],
}

