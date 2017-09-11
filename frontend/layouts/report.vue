<template lang="pug">
doctype html
v-app(id="sandbox" :dark="dark" :light="!dark" standalone)
  v-toolbar
    v-toolbar-title {{ $store.state.reports.title }}
  main
    v-container(fluid ml-0 mt-0 mr-0 mb-0 pl-0 pt-3 pr-0 pb-3 class="blue-grey lighten-4")
      nuxt
      
  v-footer
    <span> © {{ new Date().getFullYear() }} </span> Jose Luis Cáceres Escudero
    
</template>

<script>

import { mapState } from 'vuex'

export default {
  data: () => ({
    dark: false,
    footer: {
      fixed: true
    }
  })
}
</script>

<style lang="stylus">

#sandbox
  border 1px solid rgba(0, 0, 0, .1)
  overflow hidden
  
@media print
  body, page
    margin 0 !important
    box-shadow 0 !important
  
  .toolbar
    display none !important
  
  .footer
    display none !important
    
  .container.pb-3.pt-3
    margin 0 !important
    padding 0 !important
  
  .progress
    display none !important
  
  #sandbox
    margin 0 !important
    padding 0 !important

page
  background white
  display block
  overflow: hidden
  margin 12px auto 0px auto
  margin-bottom 0.5cm
  box-shadow 0 0 0.5cm rgba(0,0,0,0.5)
  
page[size="MidLetter"][layout="Landscape"]
  width 215.9mm
  height 139.7mm
  padding 6mm
  
page[size="Letter"][layout="Portrait"]
  width 215.9mm
  height 279.4mm
  padding 6mm
  
page[size="Letter"][layout="Landscape"]
  width 279.4mm
  height 215.9mm
  padding 6mm
  
</style>
