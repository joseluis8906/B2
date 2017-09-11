<template lang="pug">
doctype html
v-container(fluid pt-5 pb-5 class="g-container text-xs-center")
  a(name="nosotros" style="display: hidden")
  v-layout(row wrap)
    v-flex(xs10 offset-xs1 lg8 offset-lg2)
      h3(class="text-xs-center g-title") Nuestros Profesionales
  
  v-layout(row wrap justify-space-around pt-3 pb-5 class="g-layout" )
    v-flex(xs10 md3 mb-3 v-for="(item, i) of items" :key="i")
      v-card(class="g-rh")
        h5(class="pt-3 pl-3 pb-0 mb-0 text-xs-left" v-on:mouseenter="item.over=false") {{ item.name }}
        p(class="pl-3 pt-0 mt-0 text-xs-left caption grey--text" v-on:mouseenter="item.over=false") {{ item.cargo }}
        div(class="g-card-img" :style="item.style" v-on:mouseenter="item.over=true")
          transition(name="background")
            div(class="g-info-rh pt-3 pl-3 pr-3 text-xs-center" v-show="item.over" v-on:mouseleave="item.over=false")
              transition(name="fade")
                div(v-show="item.over")
                  p Lorem ipsu dolor Lorem ipsu dolor Lorem ipsu dolor Lorem ipsu dolor Lorem ipsu dolor 
                    |Lorem ipsu dolor Lorem ipsu dolor Lorem ipsu dolor               
                  v-container(fluid)
                    v-layout(row justify-space-around pr-5 pl-5)
                      v-icon(fa class="deep-orange--text" small) facebook
                      v-icon(fa class="deep-orange--text" small) twitter
                      v-icon(fa class="deep-orange--text" small) whatsapp
                      v-icon(fa class="deep-orange--text" small) linkedin
                  v-layout(row justify-center)
                    v-btn(secondary) Mas Info

</template>

<script>
export default {
  data () {
    return {
      over2: false,
      over3: false,
      over4: false,
      items: [
        { 
          name: 'George Dust',
          cargo: 'CEO/Administrador',
          style: {backgroundImage: "url('/ceo.1.man.jpg')"},
          over: false
        },
        { 
          name: 'George Dust',
          cargo: 'CEO/Administrador',
          style: {backgroundImage: "url('/ceo.1.women.jpg')"},
          over: false
        },
        { 
          name: 'George Dust',
          cargo: 'CEO/Administrador',
          style: {backgroundImage: "url('/ceo.2.man.jpg')"},
          over: false
        },
        { 
          name: 'George Dust',
          cargo: 'CEO/Administrador',
          style: {backgroundImage: "url('/ceo.2.women.jpg')"},
          over: false
        }        
      ]
    }
  },
  methods: {
  },
  components: {
  }
}
</script>

<style lang="stylus" scoped>

deepOrange = #e64a19

.g-container
  background-color #ebebed
  border-top 2px solid #d2d2d5
  border-bottom 2px solid #d2d2d5

.g-layout
  max-width 1140px
  margin auto

.g-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background url("~assets/bottom-red.svg") no-repeat bottom

.g-rh
  min-height 420px
  max-height 420px
  overflow hidden

.g-rh h5
  font-weight bold
  
.g-card-img
  width 100%
  height 360px
  border-top deepOrange 3px solid
  background-size cover
  background-repeat no-repeat
  background-position center

.g-info-rh
  background-color white
  height 360px
  
.background-enter-active, .background-leave-active
  transition z-index .3s linear

.background-enter
  background-color white

.background-leave-to
  background-color transparent

.fade-enter-active
  transition opacity .1s linear, transform .3s linear

.fade-leave-active
  transition opacity .3s ease, transform .3s ease

.fade-enter 
  opacity 0
  transform translateY(10px)

.fade-leave-to
  opacity 0
  transform translateY(10px)
  
</style>
