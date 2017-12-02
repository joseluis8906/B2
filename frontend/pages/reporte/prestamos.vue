<template lang="pug">
v-container(pt-0 pr-0 pb-0 pl-0 mt-0 mb-0)
  page(v-bind:size="page.Size" v-bind:layout="page.Layout" v-for="(page, i) in pages" :key="i")
    table(style="width: 100%; height: auto; margin-bottom: 3mm")
      thead
      tbody
        tr
          th(rowspan="3" style="text-align: center; width: 80%") PRESTAMOS
        tr
          td(class="lado") Página
          td(class="lado") 0{{ i+1 }}
        tr
          td(class="lado") Fecha
          td(class="lado") {{ Fecha }}

    table(style="width: 100%; height: auto" class="table-kardex" )
      thead
        tr(class="green lighten-3")
          th(style="width: 10%") N°
          th(style="width: 25%") Usuario
          th(style="width: 10%") Material
          th(style="width: 15%") Código
          th(style="width: 10%") Fecha
            br
            | Reserva
          th(style="width: 10%") Fecha
            br
            | Prestamo
          th(style="width: 10%") Fecha
            br
            | Devolución
          th(style="width: 10%") Sanción

      tbody
        tr(v-for="(item, j) in page.Items" :key="j")
          td(class="text-xs-center") {{ j + 1 }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.Usuario.Nombre }} {{ item.Usuario.Apellido }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.Material }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.Codigo }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.FechaReserva }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.FechaPrestamo }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.FechaDevolucion }}
          td(style="text-align: right; font-size: 7.5pt;") {{ item.Sancion }}

</template>

<script>

import PRESTAMOS from '~/queries/Prestamos.gql'

export default {
  data () {
    return {
      pages: [],
      loading: 0,
      Fecha: new Date(Date.now()).toISOString().split('T')[0],
    }
  },
  layout: 'report',
  fetch ({ store }) {
    store.commit('reports/changeTitle', 'Prestamos')
  },
  apollo: {
    QPrestamos: {
      query: PRESTAMOS,
      update (data) {
        let page = 0;
        for(let i=0; i<data.Prestamos.length; i++){
          let tmp = {};
          tmp.Id = data.Prestamos[i].Id;
          tmp.UsuarioId = data.Prestamos[i].UsuarioId;
          tmp.Usuario = data.Prestamos[i].Usuario;

          if(data.Prestamos[i].LibroId !== null){
            tmp.Material = 'Libro';
            tmp.Codigo = data.Prestamos[i].Libro.Isbn;
            tmp.LibroId = data.Prestamos[i].Libro.Id;
          }
          else if(data.Prestamos[i].VideoBeanId !== null){
            tmp.Material = 'VideoBean';
            tmp.Codigo = data.Prestamos[i].VideoBean.Codigo;
            tmp.VideoBeanId = data.Prestamos[i].VideoBean.Id;
          }
          else if(data.Prestamos[i].TablaDibujoId !== null){
            tmp.Material = 'Tabla de Dibujo';
            tmp.Codigo = data.Prestamos[i].TablaDibujo.Codigo;
            tmp.TablaDibujoId = data.Prestamos[i].TablaDibujo.Id;
          }

          tmp.FechaReserva =  data.Prestamos[i].FechaReserva;
          tmp.FechaPrestamo = data.Prestamos[i].FechaPrestamo;
          tmp.FechaDevolucion = data.Prestamos[i].FechaDevolucion;

          tmp.Estado = data.Prestamos[i].Estado;
          tmp.Sancion = data.Prestamos[i].Sancion;

          if( Number.isInteger(i / 34) ){
            page = Math.trunc(i / 34);
            this.pages.push({Size: 'Letter', Layout: 'Landscape', Items: []});
          }

          this.pages[page].Items.push(tmp);
        }
      }
    }
  },
  methods: {
    MaxLength ( value ) {
      if( value ){
        //console.log(value.length)
        return value.length >= 26 ? value.substr(0, 20)+'...'+value.substr(-6, 6) : value;
      }
    }
  }
}
</script>

<style lang="stylus" scoped>

@page
  size letter landscape
  margin 0mm
  padding 0mm

table
  font-size: 9pt
  border-spacing 0px
  border-collapse collapse

th, td
  border 1px solid black

th
  height 9mm
  line-height 10pt

td
  height 5mm
  padding-left 1mm
  padding-right 1mm

.lado
  height 4mm
  font-size 8pt
  padding-left 1mm
  padding-right 1mm
  text-align right
</style>
