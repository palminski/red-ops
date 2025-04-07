/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        vt323: ["VT323", "sans-serif"],
        fakeWindows: ["FakeWindows", "sans-serif"],
      },
      backgroundImage: {
        'world-map': "url(/assets/images/RedOpsMap.svg)"
      },
      colors: {
        'redops-red': {
          bright:'#860f0f',
          dark:'#344347',
        },
      },
    },
  },
  plugins: [],
}