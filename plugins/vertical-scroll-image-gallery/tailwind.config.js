/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./**/*.vue"],
  theme: {
    fontSize: {
      'xsm': '0.7rem',
      'sm': '0.8rem',
      'base': '1rem',
      'lg': '1.125rem',
      'xl': '1.25rem',
      '2xl': '1.563rem',
      '3xl': '1.953rem',
      '4xl': '2.441rem',
      '5xl': '3.052rem',
      '6xl': '3.852rem',
      '7xl': '5.52rem',
    },
    fontFamily: {
      'sans': ['Inter'],
      'serif': ['Butler'],
    },
    extend: {
      padding: {
        '1/3': '33.33333%',
        '2/3': '66.66667%',
        '70': '70%',
      },
      colors: {
        'black': '#1C1B19',
        'beige': '#E7E4DD',
      },
    },
  },
  corePlugins: {
    aspectRatio: true,
  },
  plugins: [
  ],
};
