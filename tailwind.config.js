module.exports = {
  future: {
    extendedSpacingScale: true,
    purgeLayersByDefault: true,
    removeDeprecatedGapUtilities: true,
  },
  purge: {
    content: [
      './resources/views/**/*.php',
      './resources/js/**/*.js',
      './resources/js/**/*.vue',
    ],
    options: {
      whitelist: []
    }
  },
  theme: {
    extend: {
        colors: {
            'statamic-hot-pink': '#FF269E',
            'statamic-yellow': '#FAF77D',
            'statamic-fresh-mint': '#01D7B0',
            'statamic-teal': '#01d7b0',
            'monaco-dark': '#1e1e1e',
        }
    },
  },
  variants: {},
  plugins: [],
}
