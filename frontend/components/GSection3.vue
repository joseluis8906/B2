<template lang="pug">
doctype html
v-container(fluid pt-0 pb-5 class="g-container text-xs-center")
  a(name="identidad" style="display: hidden")
  v-layout(row wrap)
    v-flex(xs12 md8 offset-md2)
      p(class="white--text pt-5 mt-5 g-text-small") CONOZCA NUESTROS 
        span(class="deep-orange--text text--darken-2") PRINCIPIOS 
      h2(class="white--text pt-0 g-section3-title") Identidad Empresarial
  v-layout(row wrap justify-space-around pt-3 pb-5 class="g-layout")
    v-flex(xs10 md3 mb-4 class="g-card-container" v-on:mouseover="over1 = true" v-on:mouseout="over1 = false")
      v-card(class="g-card"  v-bind:class="{ flipped: over1 }")
        div(class="front pt-5 pb-5 text-xs-center")
          img(src="~assets/group.svg" class="g-card-img mt-5")
          h2(class="text-xs-center display-1 grey--text text--darken-2 pt-2") Misión
        div(class="back pt-3 pl-3 pr-3 pb-3 text-xs-justify")
          p 
            |Somos una organización dedicada a la producción de oxigeno medicinal e industrial 
            |y la comercialización de gases del aire con productos de alta calidad, con servicios 
            |eficientes y oportunos a través de un equipo humano y técnico altamente calificado, 
            |contribuyendo así al mejoramiento de la salud y el desarrollo sostenible de la sociedad.
   
    v-flex(xs10 md3 mb-4 class="g-card-container" v-on:mouseover="over2 = true" v-on:mouseout="over2 = false")
      v-card(class="g-card"  v-bind:class="{ flipped: over2 }")
        div(class="front pt-5 pb-5 text-xs-center")
          img(src="~assets/airplane.svg" class="g-card-img mt-5")
          h2(class="text-xs-center display-1 grey--text text--darken-2 pt-2") Visión 
        div(class="back pt-3 pl-3 pr-3 pb-3 text-xs-justify")
          p 
            |Ser líderes en el año 2020, en la comercialización y producción de gases en el sector 
            |medicinal e industrial en los departamentos del Cesar,  Norte de Santander, Bolívar, 
            |Magdalena y Santander; además ser reconocidos a nivel nacional por la entrega oportuna 
            |y la calidad de nuestro sproductos y/o servicios, buscando el beneficio de la comunidad, 
            |la satisfacción de nuestros clientes, colaboradores y socios; generando crecimiento 
            |económico y desarrollo social.

    v-flex(xs10 md3 class="g-card-container" v-on:mouseover="over3 = true" v-on:mouseout="over3 = false")
      v-card(class="g-card"  v-bind:class="{ flipped: over3 }")
        div(class="front pt-5 pb-5 text-xs-center")
          img(src="~assets/law.svg" class="g-card-img mt-5")
          h2(class="text-xs-center display-1 grey--text text--darken-2 pt-2") Politicas
        div(class="back pt-3 pl-3 pr-3 pb-3 text-xs-justify")
          p 
            |Somos una empresa orientada a la producción y comercialización de gases del aire en el 
            |sector medicinal e industrial, a través del cumplimiento de las disposiciones legales 
            |vigentes, generando un producto de óptima calidad buscando la satisfacción de nuestros 
            |clientes gracias al mejoramiento continuo del Sistema de Gestión de Calidad que satisfaga 
            |las necesidades del sector medicinal e industrial, respondiendo de esta forma la confianza 
            |depositada por parte de nuestros socios, colaboradores y proveedores.
            

</template>

<script>
export default {
  data () {
    return {
      over1: false,
      over2: false,
      over3: false
    }
  },
  methods: {
    printOver: function () {
      console.log(this.over)
    }
  },
  components: {
  }
}
</script>

<style lang="stylus" scoped>
.g-section3-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background url('~assets/bottom-red.svg') no-repeat bottom

.g-section3-title
  font-family 'Roboto', sans
  font-weight bold
  line-height 140%
  padding-top 0.8em
  padding-bottom 0.6em
  margin-bottom: 1em

.g-container
  background url('~assets/books_.jpg')
  background-size cover
  background-position center

.g-layout
  max-width 1140px
  margin auto

.g-card-container
  perspective 512px
  height 360px

.g-card
  transform-style preserve-3d
  transition transform 1s
  position relative
  height 360px

.front
  width 100%
  height 360px
  backface-visibility hidden
  position absolute

.back
  transform rotateY( 180deg )
  height 360px
  backface-visibility hidden

.flipped
  transform: rotateY( 180deg )

.g-card-img
  height 72px

.g-text-small
  font-family "Archivo Black", sans-serif 

</style>
