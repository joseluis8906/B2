<template lang="pug">
v-layout( align-center justify-center )
  v-snackbar(
    :timeout="snackbar.timeout"
    :success="snackbar.context === 'success'"
    :info="snackbar.context === 'info'"
    :warning="snackbar.context === 'warning'"
    :error="snackbar.context === 'error'"
    :primary="snackbar.context === 'primary'"
    :secondary="snackbar.context === 'secondary'"
    :multi-line="snackbar.mode === 'multi-line'"
    :vertical="snackbar.mode === 'vertical'"
    :top="true"
    v-model="loading" )
      v-icon(style="margin-right: 10px") {{ snackbar.icon }}
      h6(class="grey--text text--lighten-4 mb-0") {{ snackbar.text }}


  v-flex( xs12 mt-3 md8 lg6 )
    v-card
      v-layout(row wrap pt-3 light-blue)
        v-flex( xs12 )
          h5(class="grey--text text--lighten-4 text-xs-center bold")
            v-icon(ma) backup
            |  Cargue Masivo
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )

            label Formatos xlsx

            br

            v-chip( class="green white--text" )
              v-avatar
                v-icon assignment
              a(href="/ModeloOferta.xlsx") Oferta

            v-chip( class="green white--text" )
              v-avatar
                v-icon assignment
              a(href="/ModeloDemanda.xlsx") Demanda

            br
            br

            v-select(
              v-bind:items="ItemsTipo"
              v-model="Tipo"
              item-value="text"
              label="Tipo"
              autocomplete
              bottom )

            upload-button( title="Subir Archivo" :selectedCallback="ArchivoSeleccionado" v-if="PermitirArchivo" )

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="CreateOrUpdate" ) Guardar
</template>

<script>

import DEMANDAS from '~/queries/Demandas.gql'
import CREATE_DEMANDA from '~/queries/CreateDemanda.gql'
import UPDATE_DEMANDA from '~/queries/UpdateDemanda.gql'
import LOCALIDADES from '~/queries/Localidades.gql'
import PRODUCTOS from '~/queries/Productos.gql'
import PROVEEDORES from '~/queries/Proveedores.gql'
import XLSX from 'xlsx'

import UploadButton from '~/components/UploadButton'

export default {
  data: () => ({
    snackbar: {
      context: 'secondary',
      icon: 'autorenew',
      mode: '',
      timeout: 6000,
      text: 'Cargando'
    },
    Tipo: null,
    PermitirArchivo: false,
    ItemsTipo: [
      {text: "Oferta"},
      {text: "Demanda"}
    ],
    loading: 0
  }),
  components: {
    UploadButton,
  },
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    }
  },
  watch: {
    Tipo (Value) {
      if (Value === 'Oferta' || Value === 'Demanda')
      {
        this.PermitirArchivo = true
      }
      else {
        this.PermitirArchivo = false
      }
    }
  },
  apollo: {
    Localidades: {
      query: LOCALIDADES,
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.ItemsLocalidad = data.Localidades
      }
    },
    Productos: {
      query: PRODUCTOS,
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.ItemsProducto = data.Productos
      }
    },
    Proveedores: {
      query: PROVEEDORES,
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.ItemsProveedor = data.Proveedores
      }
    },
  },
  methods: {
    ArchivoSeleccionado (Archivo) {
      var reader = new FileReader()
      reader.onload = this.LoadArchivo.bind(this)
      reader.readAsBinaryString(Archivo)
    },
    LoadArchivo (e) {
        var data = e.target.result
        var LibroDeTrabajo = XLSX.read(data, {type: 'binary'})
        var NombrePrimeraHoja = LibroDeTrabajo.SheetNames[0]

        var HojaDeTrabajo = LibroDeTrabajo.Sheets[NombrePrimeraHoja]
        var DireccionDeCelda = 'A1'

        var CeldaSeleccionada = HojaDeTrabajo[DireccionDeCelda]

        var ValorSeleccionado = (CeldaSeleccionada ? CeldaSeleccionada.v : undefined)
        if (ValorSeleccionado === 'Oferta' && this.Tipo === 'Oferta') {
          this.ProcesarOferta (HojaDeTrabajo)
        }
        else if (ValorSeleccionado === 'Demanda' && this.Tipo === 'Demanda') {
          this.ProcesarDemanda (HojaDeTrabajo)
        }
        else {
          this.snackbar.text = "Error: Formato o Tipo incompatible"
          this.snackbar.context = "error"
          this.snackbar.icon = 'error_outline'
          this.loading = 1
        }
    },
    ProcesarOferta (HojaDeTrabajo) {
      var ListaDeOferta = []
      var i = 3
      var Continuar = true
      while (Continuar) {
        var NuevaOferta = {
          CodigoProveedor: HojaDeTrabajo[`A${i}`] ? HojaDeTrabajo[`A${i}`].v : null,
          CodigoProducto: HojaDeTrabajo[`B${i}`] ? HojaDeTrabajo[`B${i}`].v : null,
          Fecha: HojaDeTrabajo[`C${i}`] ? HojaDeTrabajo[`C${i}`].v : null,
          Cantidad: HojaDeTrabajo[`D${i}`] ? HojaDeTrabajo[`D${i}`].v : null,
          Embalaje: HojaDeTrabajo[`E${i}`] ? HojaDeTrabajo[`E${i}`].v : null,
          Precio: HojaDeTrabajo[`F${i}`] ? HojaDeTrabajo[`F${i}`].v : null,
        }
        if (NuevaOferta.CodigoProducto !== null) {
          ListaDeOferta.push(NuevaOferta)
        } else {
          Continuar = false
        }
        i++
      }
      console.log(ListaDeOferta)
    },
    ProcesarDemanda (HojaDeTrabajo) {
      var ListaDeDemanda = []
      var i = 3
      var Continuar = true
      while (Continuar) {
        var NuevaDemanda = {
          CodigoLocalidad: HojaDeTrabajo[`A${i}`] ? HojaDeTrabajo[`A${i}`].v : null,
          CodigoProducto: HojaDeTrabajo[`B${i}`] ? HojaDeTrabajo[`B${i}`].v : null,
          Fecha: HojaDeTrabajo[`C${i}`] ? HojaDeTrabajo[`C${i}`].v : null,
          ConsumoPromedio: HojaDeTrabajo[`D${i}`] ? HojaDeTrabajo[`D${i}`].v : null
        }
        if (NuevaDemanda.CodigoLocalidad !== null) {
          ListaDeDemanda.push(NuevaDemanda)
        } else {
          Continuar = false
        }
        i++
      }
      console.log(ListaDeDemanda)
    },
    Reset () {
      this.Tipo = null
    }
  }
};


</script>

<style lang="stylus" scoped>
h5.bold
  font-weight bold

.alert-especial
  position absolute

a
  color: white !important
  text-decoration none !important
</style>
