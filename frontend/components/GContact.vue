<template lang="pug">
doctype html
v-container(fluid class="g-contact-layout")
  a(name="contacto" style="display: hidden")
  v-layout(row wrap pt-5 pb-5)    
    v-flex(xs12 md6 offset-md3)
      h3(class="text-xs-center g-contact-title grey--text text--lighten-4") Contáctenos 
    v-flex(xs5 offset-xs1 text-xs-center md2 offset-md4 text-md-right)
      p(class="g-contact-paragraph grey--text text--lighten-1 body-2 pr-3") Calle 21 Nº 4 - 34
        br
        |Aguachica Cesar, Colombia
    v-flex(xs5 text-xs-center md3 text-md-left)
      p(class="g-contact-paragraph grey--text text--lighten-1 body-2 pl-3") Teléfono (5) 565 34 95
        br
        |Móvil 321 345 3895 - 311 643 4875
    
  v-layout(row wrap pb-5)
    v-flex(xs2 text-xs-center md1 offset-md3)
      v-icon(fa dark large) facebook
    v-flex(xs2 text-xs-center md1)
      v-icon(fa dark large) twitter
    v-flex(xs2 text-xs-center md1)
      v-icon(fa dark large) youtube
    v-flex(xs2 text-xs-center md1)
      v-icon(fa dark large) pinterest
    v-flex(xs2 text-xs-center md1)
      v-icon(fa dark large) google-plus
    v-flex(xs2 text-xs-center md1)
      v-icon(fa dark large) linkedin
    
  v-layout(row wrap)
    v-flex(xs8 offset-xs2)
      v-text-field(name="input-1" label="Nombre" id="Nombre" dark prepend-icon="person" single-line)
    v-flex(xs8 offset-xs2)
      v-text-field(name="input-2" label="Correo" id="Correo" dark prepend-icon="email" single-line)  
    v-flex(xs8 offset-xs2)
      v-text-field(name="input-3" label="Comentario" id="Comentario" dark prepend-icon="book" single-line multi-line)
    v-flex(xs8 offset-xs2)
      v-btn(dark error) Enviar

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

<style>
</style>

<style lang="stylus" scoped>
.g-contact-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background url('~assets/bottom-red.svg') no-repeat bottom

.g-contact-layout
  background url('~assets/factory.jpg') no-repeat
  background-size cover
  background-position center

.g-contact-paragraph
  font-family 'Roboto', sans-serif
</style>
