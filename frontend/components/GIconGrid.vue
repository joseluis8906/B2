<template lang="pug">
doctype html
v-container(fluid pt-0 pb-0 pl-0 pr-0)
  v-layout(row pt-5 pb-5 wrap special)
    v-flex(xs12 md2)
      a(nuxt link href="/#productos")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/gears.svg" height="116px" class="g-img-icon-grid")
        p(class="text-xs-center g-icon-grid-text") Servicios

    v-flex(xs12 md3)
      a(nuxt link href="/#nosotros")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/businessmen.svg" height="116px" class="g-img-icon-grid")
        p(class="text-xs-center") Nosotros

    v-flex(xs12 md2)
      a(nuxt link href="/#identidad")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/puzzle.svg" height="116px" class="g-img-icon-grid")
        p(class="text-xs-center") Identidad

    v-flex(xs12 md3)
      a(nuxt link href="/#productos")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/check-list.svg" height="116px" class="g-img-icon-grid")
        p(class="text-xs-center") Productos

    v-flex(xs12 md2)
      a(nuxt link href="/#contacto")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/hand-shake.svg" height="116px" class="g-img-icon-grid")
        p(class="text-xs-center") Contactenos
</template>

<script>
export default {
  data () {
    return {
      fly: false
    }
  },
  methods: {
    overImg: function (_evt) {
      this.ok = !this.ok
    }
  }
}
</script>

<style lang="stylus" scoped>
a
  color gray
  
.special
  background linear-gradient(to bottom, #f5f5f5 0%, #dfdfe2 100%)
  border-bottom 2px solid #d2d2d5

.g-container-img-icon-grid
  height 128px

.g-img-icon-grid
  margin-top 6px
  transition margin-top .25s

.g-img-icon-grid:hover
  margin-top 0px
  transition margin-top .25s

.g-img-icon-grid:leave
  margin-top 6px
  transition margin-top .25s
</style>
