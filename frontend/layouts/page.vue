<template lang="pug">
doctype html
v-app(light)
  a(name="inicio" style="display: hidden")
  v-navigation-drawer(temporary :floating="true" v-model="drawer" overflow enable-resize-watcher light class="hidden-md-and-up" style="z-index: 10001")
    v-list(dense)
      v-list-tile(nuxt link href="/#inicio" @click.native.stop="drawer = !drawer")
        v-list-tile-action
          v-icon home
        v-list-tile-content
          v-list-tile-title Inicio
      v-list-tile(nuxt link href="/#identidad" @click.native.stop="drawer = !drawer")
        v-list-tile-action
          v-icon gavel
        v-list-tile-content
          v-list-tile-title Misión
      v-list-tile(nuxt link href="/#nosotros" @click.native.stop="drawer = !drawer")
        v-list-tile-action
          v-icon flight_takeoff
        v-list-tile-content
          v-list-tile-title Nosotros
      v-list-tile(nuxt link href="/#sobre" @click.native.stop="drawer = !drawer")
        v-list-tile-action
          v-icon accessibility
        v-list-tile-content
          v-list-tile-title Historia
      v-list-tile(nuxt link href="/#productos" @click.native.stop="drawer = !drawer")
        v-list-tile-action
          v-icon shopping_cart
        v-list-tile-content
          v-list-tile-title Servicios
      v-list-tile(nuxt link href="/#contacto" @click.native.stop="drawer = !drawer")
        v-list-tile-action
          v-icon speaker_notes
        v-list-tile-content
          v-list-tile-title Contacto
  v-toolbar(dense dark xs12)
    v-icon(dark class="hidden-sm-and-down") desktop_mac
    v-icon(dark class="hidden-md-and-up") phone_iphone
    v-spacer
    v-btn(outline dark small nuxt link to="/login") Login
  v-toolbar(prominent v-bind:class="{ 'g-navbar-fixed': navFixed }")
    img(src="~assets/logo.gis.extended.png", class="img_icon")
    v-spacer
    v-toolbar-side-icon(class="hidden-md-and-up" @click.native.stop="drawer = !drawer")
    v-toolbar-items(class="hidden-sm-and-down")
      a(href="#inicio")
        v-btn(flat class='especial') Inicio
      a(href="#identidad")
        v-btn(flat class='especial') Identidad
      a(href="#nosotros")
        v-btn(flat class='especial') Nosotros
      a(href="#sobre")
        v-btn(flat class='especial') Historia
      a(href="#productos")
        v-btn(flat class='especial') Servicios
      a(href="#contacto")
        v-btn(flat class='especial') Contacto
  main
    nuxt
  v-footer(fluid style="height:auto")
    v-spacer
      v-layout(row wrap)
        v-flex(xs12 md6 offset-md3)
          div(class="text-xs-center g-footer")  Copyright ©  {{ new Date().getFullYear() }} 
            span(class="orange--text text--darken-4") Jose Luis Cáceres Escudero 
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

