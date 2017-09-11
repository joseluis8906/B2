<template lang="pug">
doctype html
v-container(fluid pt-0 pb-0 especial pr-0 pl-0)
  a(name="sobre" style="display: hidden")
  v-layout(row wrap pt-3 class="g-section-layout")
    v-flex(xs10 offset-xs1 md8 offset-md2 pt-5 pb-5)
      div(class="pt-5 pb-5")
        h3(class="text-xs-center g-section-title") Sobre Nosotros
        div
          p(class="text-xs-center grey--text text--darken-4 g-section-msg") 
            |El objetivo de nuesta compañía es 
            |ofrecer servicios y productos que se adecuen a las necesidades de nuestros clientes, 
            |trabajamos en pro del desarrollo económico e industial de la región, desde 
            |nuestos inicios nos hemos caráterizado por brindar productos y servicios de excelente calidad y por 
            |la responsabilidad de nuestros profesionales. 
            |Nacimos el 26 de abril del año 2000 y con una trayectoria marcada por una familia de la 
            |Provincia de Ocaña, surge la idea de crear una Sociedad de Responsabilidad Limitada cuyo objeto 
            |social es: “comercialización y distribución de gases del aire medicinales e  industriales, compra y 
            |venta de artículos de  ferretería, compra de accesorios de  instrumentación hospitalaria y
            |quirúrgica, alquiler de equipos y todo lo  relacionado con el ramo. En general celebrar toda 
            |clase de  actos, operaciones que tengan relación directa  con las  actividades  que integran el 
            |objetivo principal o cuya finalidad sea ejercer los derechos o  cumplir las obligaciones legales 
            |o convencionalmente derivados de la existencia de la  misma”.
            br
            br
            |Se inició en la ciudad de Ocaña (Norte de Santander), en la comercialización de gases del aire, 
            |con el incremento de sus clientes se crearon dos nuevas agencias en El Banco (Magdalena) y Aguachica
            |(Cesar). Por consiguiente se atiende los habitantes y Entidades Hospitalarias de 38 municipios de la
            |región, suscritos a los departamentos de Cesar, Norte de Santander, Bolívar, Magdalena y Santander.
            br
            br
            |Actualmente dispuso de un establecimiento con laboratorio farmacéutico para la producción de oxígeno
            |medicinal en sitio, bajo los parámetros de la resolución 4410 de 2009. El 10 de Julio de 2014 se 
            |modifica el tipo de sociedad de la empresa, pasando de Gases Industriales de los Santanderes Ltda 
            |a Gases Industriales de los Santanderes S.A.S.

    v-flex(xs12 pb-5 mb-5)
      g-charts
</template>

<script>
import GCharts from '~components/GCharts'

export default {
  data () {
    return {
    }
  },
  methods: {
  },
  components: {
    GCharts
  }
}
</script>

<style lang="stylus" scoped>
.g-section-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background url('~assets/bottom-red.svg') no-repeat bottom

.g-section-msg  
  font-family 'Work Sans', sans-serif
  font-size 130%
  font-weight bold

.g-section-layout
  background-color #ebebed

.especial
  border-bottom 2px solid #d2d2d5

</style>
