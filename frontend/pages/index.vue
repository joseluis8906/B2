<template lang="pug">
div(class="hello")
  p Contable
  //g-carousel
  //g-icon-grid
  //g-section1
  //g-section3
  //g-section4
  //g-section2
  //g-section5
  //g-testimonios
  //g-contact

</template>

<script>

import GCarousel from '~components/GCarousel.vue'
import GIconGrid from '~components/GIconGrid.vue'
import GSection1 from '~components/GSection1.vue'
import GSection2 from '~components/GSection2.vue'
import GSection3 from '~components/GSection3.vue'
import GSection4 from '~components/GSection4.vue'
import GSection5 from '~components/GSection5.vue'
import GTestimonios from '~components/GTestimonios.vue'
import GContact from '~components/GContact.vue'


export default {
  data () {
    return {
    }
  },
  layout: 'page',
  components: {
    GCarousel,
    GIconGrid,
    GSection1,
    GSection2,
    GSection3,
    GSection4,
    GSection5,
    GTestimonios,
    GContact
  },
  head () {
    return {
      meta: [{name: "viewport", content: "width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no, minimal-ui"}],
      title: "Gis"
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="stylus" scoped>

h1, h2
  font-weight normal;

ul
  list-style-type none
  padding 0


li
  display inline-block
  margin 0 10px

a
  color #42b983

</style>
