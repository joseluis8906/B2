module.exports = {
  /*
  ** Headers of the page
  */
  head: {
    title: 'Gis',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/png', href: '/logo.gis.favicon.png' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Work+Sans:200'},
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Archivo+Black'},
      { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'},
      { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/1.9.33/css/materialdesignicons.min.css'}
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#3B8070' },
  /*
  ** Build configuration
  */
  build: {
    extend (config) {
      config.module.rules.push({
        test: /\.(graphql|gql)$/,
        exclude: /node_modules/,
        loader: 'graphql-tag/loader',
      })
    },
    vendor: [
      'apollo-client',
      'axios',
      'graphql-tag',
      'isomorphic-fetch',
      'vue-apollo',
      'vuetify'
    ]
  },
  plugins: [
    '~plugins/vuetify.js',
    '~plugins/vue-awesome-swiper.js',
    {src: '~plugins/vue-chartjs.js', ssr: false},
    {src: '~plugins/apollo-client.js', injectAs: 'apolloProvider'}
  ],
  css: [
    'swiper/dist/css/swiper.css',
    { src: '~assets/style/app.styl', lang: 'styl' }
  ],
  
}
