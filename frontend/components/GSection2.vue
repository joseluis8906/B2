<template lang="pug">
doctype html
v-container(fluid pt-0 pb-0)
  v-layout(row wrap pt-5 pb-5 class="g-section2-layout")
    v-flex(xs12 md3)
      div(class="pt-5 pb-5 pl-5 pr-5")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/delivery-truck-with-circular-clock.svg" height="64px")
        h6(class="text-xs-center blue-grey--text text--darken-4 g-section2-title") Somos Lideres
          br
          | En La Industria
        p(class="text-xs-center body-1 grey--text text--darken-1") Con nuestros productos y servicios no tendrá preocupaciones, 
          |nuestros profesionales están altamente capacitados

    v-flex(xs12 md3)
      div(class="pt-5 pb-5 pl-5 pr-5")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/factory-with-chimney.svg" height="64px")
        h6(class="text-xs-center blue-grey--text text--darken-4 g-section2-title") Nuestra Tecnología 
          br
          | De Producción
        p(class="text-xs-center body-1 grey--text text--darken-1") Usamos ingeniería y tecnología de manufactura 
          |que hace nuestra producción rápida, simple y mas efectiva

    v-flex(xs12 md3)
      div(class="pt-5 pb-5 pl-5 pr-5")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/ascendant-bars-graphic.svg" height="64px")
        h6(class="text-xs-center blue-grey--text text--darken-4 g-section2-title") 
          |Crecimiento
          br
          |Profesional 
        p(class="text-xs-center body-1 grey--text text--darken-1") Además de un excelente ambiente de trabajo 
          |ofrecemos a nuestros empleados salarios competitivos

    v-flex(xs12 md3)
      div(class="pt-5 pb-5 pl-5 pr-5")
        div(class="text-xs-center g-container-img-icon-grid")
          img(src="~assets/world.svg" height="64px")
        h6(class="text-xs-center blue-grey--text text--darken-4 g-section2-title") Investigación y Desarrollo
        p(class="text-xs-center body-1 grey--text text--darken-1") No solo hacemos productos y servicios de calidad, 
          |cada día investigamos mejores ténicas de desarrollo

</template>

<script>
export default {
  data () {
    return {
    }
  },
  methods: {
  },
  components: {
  }
}
</script>

<style lang="stylus" scoped>
.g-section2-title
  font-family 'Roboto', sans
  font-weight bold
  line-height 140%
  padding-top 0.8em
  padding-bottom 0.6em
  margin-bottom: 1em

.g-section2-layout
  background-color white
</style>
