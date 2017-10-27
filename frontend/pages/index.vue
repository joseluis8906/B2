<template lang="pug">
div(class="hello")
  img(src="/books2.jpg" style="width:100%")

</template>

<script>
import GCarousel from '~components/GCarousel.vue'

export default {
  data () {
    return {
    }
  },
  layout: 'page',
  components: {
    GCarousel,
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
