<template lang="pug">
doctype html
v-layout(row wrap pt-3)
  v-flex(xs12 md2)
  v-flex(xs12 md2 v-for="(item, i) in PieData" v-bind:key="i")
    div(class="text-xs-center g-container-img-icon-grid")
      div(class="")
        div(class="small")
          v-pie(v-if="showPie" :data="item.datacollection" :options="options")
        h3(class="text-xs-center g-charts-percent") {{ item.datacollection.title }}%
        p(class="text-xs-center g-charts-percent") {{ item.datacollection.body }}
  v-flex(xs12 md2)
</template>

<script>
const deepOrange = '#e64a19'
const transparent = 'grey'
export default {
  data () {
    return {
      showPie: false,
      PieData: [
        {
          datacollection: {}
        },
        {
          datacollection: {}
        },
        {
          datacollection: {}
        },
        {
          datacollection: {}
        }
      ],
      options: { tooltips: { enabled: false } }
    }
  },
  mounted () {
    this.showPie = true
    this.fillData();
  },
  methods: {
    fillData () {
      var datas = [
        {porcentaje: 47, body: 'Expansión De Mercado'},
        {porcentaje: 33, body: 'Crecimiento De Empleo'},
        {porcentaje: 71, body: 'Volumen De Inversion'},
        {porcentaje: 60, body: 'Aumento Salarial'}
      ]
      
      for (let i = 0; i < this.PieData.length; i++) {
        this.PieData[i].datacollection = {
          labels: [],
          datasets: [
            {
              label: '',
              borderColor: '#ebebed',
              backgroundColor: [deepOrange, transparent],
              data: [datas[i].porcentaje, (100 - datas[i].porcentaje)]
            }
          ],
          title: datas[i].porcentaje,
          body: datas[i].body
        }
      }
    }
  }
}
</script>

<style lang="stylus" scope>
.small 
  max-width 148px;
  margin 0 auto 0.75em auto
  
.g-charts-percent
  font-weight bold
  color black

</style>
