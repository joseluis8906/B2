<template lang="pug">
v-container(pt-0 pr-0 pb-0 pl-0 mt-0 mb-0)
  page(v-bind:size="page.Size" v-bind:layout="page.Layout" v-for="(page, i) in pages" :key="i")
    table(style="width: 100%; height: auto; margin-bottom: 3mm")
      thead
      tbody
        tr
          th(rowspan="5" style="width: 7.5%; text-align: center")
            img(src="~assets/logo.gis.png" style="width: 100%")
          th(rowspan="5" style="text-align: center; width: 75%") CERTIFICADO DE PRODUCCIÓN
        tr
          td(class="lado") Código
          td(class="lado") FVT-020
        tr
          td(class="lado") Página
          td(class="lado") 0{{ i+1 }}
        tr
          td(class="lado") Versión
          td(class="lado") 03
        tr
          td(class="lado") Fecha
          td(class="lado") {{ Fecha }}

    table(style="width: 49%; height: auto; display: inline-block; vertical-align: top;" class="table-kardex" )
      tbody
        tr
          td(style="text-align: left") Fecha:
          td(style="text-align: right") {{ Fecha }}
        tr
          td(style="text-align: left") Peoducto:
          td(style="text-align: right") {{ Producto }}
        tr
          td(style="text-align: left") Cantidad:
          td(style="text-align: right") {{ Cantidad }}
        tr
          td(style="text-align: left") Cantidad M³:
          td(style="text-align: right") {{ CantidadM3 }} {{ UnidadDeMedida }}
        tr
          td(style="text-align: left") Fecha Inicial:
          td(style="text-align: right") {{ FechaInicial }}
        tr
          td(style="text-align: left") Fecha Final:
          td(style="text-align: right") {{ FechaFinal }}

    table(style="width: 49%; margin-left: 2%; height: auto; display: inline-block;" class="table-kardex" )
      tbody
        tr
          td(style="text-align: left") Op Nº:
          td(style="text-align: right") {{ Orden }}
        tr
          td(style="text-align: left") Turno:
          td(style="text-align: right") {{ Turno }}
        tr
          td(style="text-align: left") Nº De Lote:
          td(style="text-align: right") {{ Lote }}
        tr
          td(style="text-align: left") Fecha Fabricación:
          td(style="text-align: right") {{ FechaFabricacion }}
        tr
          td(style="text-align: left") Fecha Vencimiento:
          td(style="text-align: right") {{ FechaVencimiento }}
        tr
          td(style="text-align: left") Hora Inicial:
          td(style="text-align: right") {{ HoraInicial }}
        tr
          td(style="text-align: left") Hora Final:
          td(style="text-align: right") {{ HoraFinal }}

    table(style="width: 49%; height: auto; display: inline-block;" class="table-kardex" )
      thead
        tr(class="green lighten-3")
          th(style="width: 5%") Cap
          th(style="width: 12%") Producto
          th(style="width: 6%") Número
          th(style="width: 16%") Cliente

      tbody
        tr(v-for="(item, j) in items1" :key="j")
          td(style="text-align: right") {{ item.Envase.Capacidad }}
          td(style="text-align: center") {{ item.Producto.Nombre }}
          td(style="text-align: center") {{ item.Envase.Numero }}
          td(style="text-align: center") {{ item.Cliente.Nombre }}

    table(style="width: 49%; margin-left: 2%; height: auto; display: inline-block;")
      thead
        tr(class="green lighten-3")
          th(style="width: 5%") Cap
          th(style="width: 12%") Producto
          th(style="width: 6%") Número
          th(style="width: 16%") Cliente

      tbody
        tr(v-for="(item, k) in items2" :key="k")
          td(style="text-align: right") {{ item.Envase.Capacidad }}
          td(style="text-align: center") {{ item.Producto.Nombre }}
          td(style="text-align: center") {{ item.Envase.Numero }}
          td(style="text-align: center") {{ item.Cliente.Nombre }}

    div(style="width: 49%; height:40mm; margin-top: 3mm; display: inline-block; vertical-align: top;")
      h6(class="headlines") Observación: {{ Observacion }}

    table(style="width: 25%; height: auto; display:inline-block; margin-top: 15mm; margin-left: 25%;")
      tbody
        tr
          td(style="text-align: left") % Pureza Final:
          td(style="text-align: right") {{ PurezaFinal }}
        tr
          td(style="text-align: left") Presión Final:
          td(style="text-align: right") {{ PresionFinal }}

    div(style="width: 49%; height:40mm; margin-top: 5mm; display: inline-block; vertical-align: top;")
      h6(class="body-2") Elaboró ___________________________________
      p(class="body-2") Jefe de Producción y Mantenimiento

    div(style="width: 49%; margin-left: 2%; height:40mm; margin-top: 5mm; display: inline-block; vertical-align: top;")
      h6(class="body-2") Revisó ____________________________________
      p(class="body-2") Dirección Técnica y Jefe de Control de Calidad
</template>

<script>

//import PRODUCCIONS from '~/queries/Produccions.gql'
import { mapMutations } from 'vuex'

export default {
  data () {
    return {
      pages: [
        {Size: 'Letter', Layout: 'Portrait'}
      ],
      Fecha: null,
      Producto: null,
      Cantidad: null,
      CantidadM3: null,
      UnidadDeMedida: null,
      FechaInicial: null,
      FechaFinal: null,
      Turno: null,
      Lote: null,
      FechaFabricacion: null,
      FechaVencimiento: null,
      HoraInicial: null,
      HoraFinal: null,
      PurezaFinal: null,
      PresionFinal: null,
      Observacion: null,

      items1: [],
      items2: [],
      loading: 0
    }
  },
  layout: 'report',
  fetch ({ store }) {
    store.commit('reports/changeTitle', 'PROUCCIÓN')
  },
  computed: {
    Orden () {
      return this.$store.state.produccion.Orden
    }
  },
  apollo: {
    Produccions: {
      query: PRODUCCIONS,
      variables () {
        return {
          Orden: this.Orden !== null ? this.Orden : '',
        }
      },
      loadingKey: 'loading',
      update (data) {
        console.log(data)
        if (data.Produccions.length > 0) {
          this.Turno = data.Produccions[0].Turno
          this.Fecha = data.Produccions[0].Fecha
          this.Lote = data.Produccions[0].Lote
          this.FechaInicial = data.Produccions[0].FechaInicial
          this.FechaFinal = data.Produccions[0].FechaFinal
          this.HoraInicial = data.Produccions[0].HoraInicial
          this.HoraFinal = data.Produccions[0].HoraFinal
          this.FechaFabricacion = data.Produccions[0].FechaFabricacion
          this.FechaVencimiento = data.Produccions[0].FechaVencimiento
          this.Producto = data.Produccions[0].Producto.Nombre
          this.PurezaFinal = data.Produccions[0].PurezaFinal
          this.PresionFinal = data.Produccions[0].PresionFinal
          this.Observacion = data.Produccions[0].Observacion

          this.items1 = []
          this.Cantidad = 0
          this.CantidadM3 = 0.0
          this.UnidadDeMedida = data.Produccions[0].Producto.UnidadDeMedida
          var length = data.Produccions.length;

          for ( let i=0; i<=21; i++ ) {
            if( i < length ) {
              var tmp = {
                Producto: {
                  Id: data.Produccions[i].Producto.Id,
                  Nombre: data.Produccions[i].Producto.Nombre
                },
                Envase: {
                  Id: data.Produccions[i].Envase.Id,
                  Numero: data.Produccions[i].Envase.Numero,
                  Capacidad: data.Produccions[i].Envase.Capacidad,
                  UnidadDeMedida: data.Produccions[i].Producto.UnidadDeMedida
                },
                Cliente: {
                  Id: data.Produccions[i].Cliente.Id,
                  Nombre: data.Produccions[i].Cliente.Nombre
                },
                Cantidad: data.Produccions[i].Cantidad,
              }

              this.Cantidad++
              this.CantidadM3 += data.Produccions[i].Cantidad

            } else {
              var tmp = {
                Producto: {
                  Id: null,
                  Nombre: null
                },
                Envase: {
                  Id: null,
                  Numero: null,
                  Capacidad: null,
                  UnidadDeMedida: null
                },
                Cliente: {
                  Id: null,
                  Nombre: null
                },
                Cantidad: null
              }
            }

            this.items1.push(tmp)
          }

          this.items2 = []

          for ( let i=21; i<43; i++ ) {
            if( i < length ) {
              var tmp = {
                Producto: {
                  Id: data.Produccions[i-21].Producto.Id,
                  Nombre: data.Produccions[i-21].Producto.Nombre
                },
                Envase: {
                  Id: data.Produccions[i-21].Envase.Id,
                  Numero: data.Produccions[i-21].Envase.Numero,
                  Capacidad: data.Produccions[i-21].Envase.Capacidad,
                  UnidadDeMedida: data.Produccions[i-21].Producto.UnidadDeMedida
                },
                Cliente: {
                  Id: data.Produccions[i-21].Cliente.Id,
                  Nombre: data.Produccions[i-21].Cliente.Nombre
                },
                Cantidad: data.Produccions[i-21].Cantidad,
              }

              this.Cantidad++
              this.CantidadM3 += data.Produccions[i].Cantidad

            } else {
              var tmp = {
                Producto: {
                  Id: null,
                  Nombre: null
                },
                Envase: {
                  Id: null,
                  Numero: null,
                  Capacidad: null,
                  UnidadDeMedida: null
                },
                Cliente: {
                  Id: null,
                  Nombre: null
                },
                Cantidad: null
              }
            }

            this.items2.push(tmp)
          }

        }
      }
    }
  }
}
</script>

<style lang="stylus" scoped>

@page
  size letter portrait
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
