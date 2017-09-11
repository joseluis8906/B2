<template lang="pug">
v-container(fluid pt-1 pb-0 pl-0 pr-0 id="inicio")
  v-layout(row wrap pt-0 mt-0)
    v-flex(xs12)
      div(v-swiper:mySwiper="swiperOption")
         div(class="swiper-wrapper")
           div( class="swiper-slide" v-for="(item, i) in items" v-bind:key="i" )
             div(class="g-slide" :style="item.style")
</template>

<script>
export default {
data () {
  return {
    items: [
      {
        style: {'background-image': "url('/slide.one.jpg')"}
      },
      {
        style: {'background-image': "url('/slide.two.jpg')"}
      },
      {
        style: {'background-image': "url('/slide.tree.jpg')"}
      },
      {
        style: {'background-image': "url('/slide.four.jpg')"}
      },
      {
        style: {'background-image': "url('/slide.five.jpg')"}
      }
    ],
    swiperOption: {
      autoplay: 5000,
      autoplayDisableOnInteraction: false,
      speed: 1000,
      loop: true,
      effect: 'fade'
    }
  }
}
}
</script>

<style lang="stylus" scoped>
.my-swiper
  height 512px;
  width 100%;
    
.swiper-slide 
  text-align center
  display flex
  justify-content center
  align-items center
  height 100%
  
.g-slide
  width 100%
  min-height 512px
  background-color black
  background-size cover
  background-position center
</style>
