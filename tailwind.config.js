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
          bright:'#b30b06',
          dark:'#860f0f',
        },
        'window': {
          bright: '#c2c0ba',
        }
      },
    },
  },
  plugins: [],
}