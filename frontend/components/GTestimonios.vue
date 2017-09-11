<template lang="pug">
doctype html
v-container(fluid pt-0 pb-0 pr-0 pl-0)
  v-layout(row wrap pt-3 pb-5 pl-3 pr-3 class="g-testimonios-layout" justify-center)
    v-flex(xs12)
      div(class="pt-5 pb-5")
        h3(class="text-xs-center g-testimonios-title") Testimonios
        div(v-swiper:mySwiper="swiperOption")
          div(class="swiper-wrapper")
            div(class="swiper-slide" v-for="(item, i) in items" v-bind:key="i")
              v-layout(row wrap)
                v-flex(xs12 md6 offset-md3)
                  div(class="img-people text-xs-center md6")
                    p(class="g-testimonios-msg") "{{ item.msg }}"
                    v-layout(row wrap pt-4)
                      v-flex(md-6 text-xs-right)
                        img(v-bind:src="item.src" class="g-testimonios-image-people") 
                      v-flex(md-6 text-xs-left class="g-testimonios-container-name")
                        p(class="g-testimonios-name") {{ item.name }}
                          br
                          |{{ item.cargo }}
</template>

<script>
export default {
  data () {
    return {
      items: [
        {
          name: 'Maria Y Cristian',
          cargo: 'CEOS, COBALT.LTDA',
          msg: 'Es satisfactorio trabajar con un partner que ofrezca la calidad y garantía que ofrece GIS aguachia',
          src: '/business-group-1.jpg'
        },
        {
          name: 'Laura',
          cargo: 'CEO, TIRBOS.SA',
          msg: 'Somos muy exigentes con nuestros proveedores, con GIS aguachica todas nuestras peticiones se satisfacen al 100%',
          src: '/business-woman-1.jpg'
        },
        {
          name: 'David',
          cargo: 'CEO, HOSPITAL LOCAL.ESP',
          msg: 'Debemos confiar siempre en que los productos que adquirimos sean de la mas alta calidad, GIS aguachica nos ofrece esa garantía',
          src: '/business-man-1.jpg'
        }
      ],
      swiperOption: {
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
        speed: 1000,
        loop: true
      }
    }
  }
}
</script>

<style lang="stylus" scoped>
.g-testimonios-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background url('~assets/bottom-red.svg') no-repeat bottom

.g-testimonios-layout
  background-color #ebebed

.g-testimonios-image-people
  width auto
  height 128px
  border-radius 50%;

.g-testimonios-msg
  font-style italic
  font-family 'Work Sans', sans-serif
  font-weight 600
  font-size 130%

.g-testimonios-container-name
  padding 5% 0

.g-testimonios-name
  padding 0 5%
  font-family 'Roboto', sans-serif
  font-weight 400
  
.my-swiper
    height 300px;
    width 100%;
    
.swiper-slide 
  text-align center
  display flex
  justify-content center
  align-items center

</style>
