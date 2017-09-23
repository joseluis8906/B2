<template lang="pug">
doctype html
v-app(light)
  v-toolbar(dense dark xs12)
    v-icon(dark class="hidden-sm-and-down") desktop_mac
    v-icon(dark class="hidden-md-and-up") phone_iphone
    v-spacer
    v-btn(outline dark small nuxt link to="/login") Login
  main
    nuxt
  v-footer(fluid style="height:auto")
    v-spacer
      v-layout(row wrap)
        v-flex(xs12 md6 offset-md3)
          div(class="text-xs-center g-footer")  Copyright ©  {{ new Date().getFullYear() }}
            span(class="orange--text text--darken-4") Jose L. Cáceres E. & Joiner Sanchez M.
            span Todos los derechos reservados.
        v-flex(xs12 md6 offset-md3 pb-3)
          div(class="text-xs-center g-footer") Icons made by
            a(href="http://www.freepik.com" title="Freepik" class="orange--text text--darken-4") Freepik
            span from
            a(href="http://www.flaticon.com" title="Flaticon" class="orange--text text--darken-4") www.flaticon.com
            span is licensed by
            a(href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank" class="orange--text text--darken-4") CC 3.0 BY
</template>

<script>
export default {
  data () {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        { icon: 'bubble_chart', title: 'Inspire' }
      ],
      miniVariant: false,
      right: false,
      rightDrawer: false,
      title: 'Vuetify.js',
      navFixed: false
    }
  },
  methods: {
    handleScroll () {
      if (process.BROWSER_BUILD) {
        if (window.scrollY > 128) {
          this.navFixed = true
        } else {
          this.navFixed = false
        }
      }
    }
  },
  created () {
    if (process.BROWSER_BUILD) {
      window.addEventListener('scroll', this.handleScroll)
    }
  },
  destroyed () {
    if (process.BROWSER_BUILD) {
      window.removeEventListener('scroll', this.handleScroll)
    }
  }
}
</script>

<style lang="stylus" scoped>

a
  margin none
  padding none
  text-decoration none

.img_icon
  height 80%

.container
  padding-right 0
  padding-left 0

.g-footer
  font-family 'Roboto', sans-serif

@keyframes example
  from
    transform-origin 50% 0
    transform scaleY(0)
    opacity 0
  to
    transform-origin 50% 0
    transform scaleY(1)
    opacity 1

.g-navbar-fixed
  position fixed
  z-index 1000
  margin-top 0
  top 0
  padding-top 0
  opacity 1
  animation-name example
  animation-duration 1s

button.especial
  width 100%
  height 100%
  margin 0
  padding 0

</style>
