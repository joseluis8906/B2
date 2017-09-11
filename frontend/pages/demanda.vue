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
      h6(class="grey--text text--lighten-4 mb-0") {{ snackbar.text }}
      v-icon autorenew

  v-flex( xs12 mt-3 md8 lg6 )
    v-card
      v-layout(row wrap pt-3 light-blue)
        v-flex( xs12 )
          h5(class="grey--text text--lighten-4 text-xs-center bold")
            v-icon(ma) shopping_cart
            |  Demanda
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-select(
              v-bind:items="ItemsLocalidad"
              v-model="LocalidadId"
              item-value="Id"
              item-text="Nombre"
              label="Localidad"
              autocomplete
              bottom )

            v-select(
              v-bind:items="ItemsProducto"
              v-model="ProductoId"
              item-value="Id"
              item-text="Nombre"
              label="Producto"
              autocomplete
              bottom )

            v-menu( lazy
                    :close-on-content-click="true"
                    v-model="menu1"
                    transition="scale-transition"
                    offset-y
                    full-width
                    :nudge-left="40"
                    max-width="290px" )

              v-text-field( slot="activator"
                            label="Fecha"
                            v-model="Fecha"
                            readonly )

              v-date-picker( :months="months"
                           :days="days"
                           first-day-of-week="D"
                           :header-date-format="({ monthName, year }) => { return `${monthName} ${year}` }"
                           v-model="Fecha"
                           no-title
                           dark )
                template( scope="{ save, cancel }" )
                  v-card-actions
                    v-btn( dark warning @click.native="Fecha=null" ) Limpiar

            v-text-field( label="Consumo Promedio (Kg)" v-model="ConsumoPromedio" dark )


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


export default {
  data: () => ({
    snackbar: {
      context: 'secondary',
      mode: '',
      timeout: 6000,
      text: 'Cargando'
    },
    Id: null,
    LocalidadId: null,
    ProductoId: null,
    ConsumoPromedio: null,
    Fecha: null,
    ItemsLocalidad: [],
    ItemsProducto: [],
    menu1: false,
    months: [
      'Enero',
      'Febrero',
      'Marzo',
      'Abril',
      'Mayo',
      'Junio',
      'Julio',
      'Agosto',
      'Septiembre',
      'Octubre',
      'Noviembre',
      'Diciembre'],
    days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    loading: 0
  }),
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    }
  },
  apollo: {
    Demandas: {
      query: DEMANDAS,
      variables () {
        return {
          LocalidadId: this.LocalidadId,
          ProductoId: this.ProductoId,
          Fecha: this.Fecha
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Demandas)
      }
    },
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
  },
  methods: {
    CreateOrUpdate () {
      if (this.Id === null) {
        this.Create();
      }else{
        this.Update();
      }
    },
    Create () {
      const Demanda = {
        LocalidadId: this.LocalidadId,
        ProductoId: this.ProductoId,
        ConsumoPromedio: this.ConsumoPromedio,
        Fecha: this.Fecha
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_DEMANDA,
        variables: {
          LocalidadId: Demanda.LocalidadId,
          ProductoId: Demanda.ProductoId,
          ConsumoPromedio: Demanda.ConsumoPromedio,
          Fecha: Demanda.Fecha
      },
      loadingKey: 'loading',
      update: (store, { data: res }) => {
        //console.log(Ente);
        try{
          var data = store.readQuery({
            query: DEMANDAS,
            variables: {
              LocalidadId: res.CreateDemanda.LocalidadId,
              ProductoId: res.CreateDemanda.ProductoId,
              Fecha: res.CreateDemanda.Fecha
            }
          })

          data.Demandas.push(res.CreateDemanda)

          store.writeQuery({
            query: DEMANDAS,
            variables: {
              LocalidadId: res.CreateDemanda.LocalidadId,
              ProductoId: res.CreateDemanda.ProductoId,
              Fecha: res.CreateDemanda.Fecha
            },
            data: data
          })

        } catch (Err) {

          var data = {Demandas: []}

          data.Demandas.push(res.CreateDemanda)

          store.writeQuery({
            query: DEMANDAS,
            variables: {
              LocalidadId: res.CreateDemanda.LocalidadId,
              ProductoId: res.CreateDemanda.ProductoId,
              Fecha: res.CreateDemanda.Fecha
            },
            data: data
          })

        }

      },
      }).then( data => {
        //console.log(data)
      }).catch( Err => {
        //console.log(Err)
      })
    },
    Update () {
      const Demanda = {
        Id: this.Id,
        LocalidadId: this.LocalidadId,
        ProductoId: this.ProductoId,
        ConsumoPromedio: this.ConsumoPromedio,
        Fecha: this.Fecha
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_DEMANDA,
        variables: {
          Id: Demanda.Id,
          LocalidadId: Demanda.LocalidadId,
          ProductoId: Demanda.ProductoId,
          ConsumoPromedio: Demanda.ConsumoPromedio,
          Fecha: Demanda.Fecha
        },
        loadingKey: 'loading',
        update: (store, { data: res }) => {
          //console.log(Ente);
          try {
            var data = store.readQuery({
              query: DEMANDAS,
              variables: {
                LocalidadId: res.UpdateDemanda.LocalidadId,
                ProductoId: res.UpdateDemanda.ProductoId,
                Fecha: res.UpdateDemanda.Fecha
              }
            })

            for (let i=0; i<data.Demandas.length; i++) {
              if (data.Demandas[i].Id === res.UpdateDemanda.Id) {
                data.Demandas[i].LocalidadId = res.UpdateDemanda.LocalidadId
                data.Demandas[i].ProductoId = res.UpdateDemanda.ProductoId
                data.Demandas[i].ConsumoPromedio = res.UpdateDemanda.ConsumoPromedio
                data.Demandas[i].Fecha = res.UpdateDemanda.Fecha
              }
            }

            store.writeQuery({
              query: DEMANDAS,
              variables: {
                LocalidadId: res.UpdateDemanda.LocalidadId,
                ProductoId: res.UpdateDemanda.ProductoId,
                Fecha: res.UpdateDemanda.Fecha
              },
              data: data
            })

          } catch (Err) {

            var data = {Demandas: []}

            data.Demandas.push(res.UpdateDemanda)

            store.writeQuery({
              query: DEMANDAS,
              variables: {
                LocalidadId: res.UpdateDemanda.LocalidadId,
                ProductoId: res.UpdateDemanda.ProductoId,
                Fecha: res.UpdateDemanda.Fecha
              },
              data: data
            })

          }

        },
      }).then( data => {
        //console.log(data)
      }).catch( Err => {
        //console.log(Err)
      })
    },
    Reset () {
      this.Id = null
      this.LocalidadId = null
      this.ProductoId = null
      this.ConsumoPromedio = null
      this.Fecha = null
    },
    LoadUi (Demandas) {
      if( Demandas.length === 0 ) {
        this.Id = null
        this.ConsumoPromedio = null
      }

      for (let i=0; i<Demandas.length; i++) {
        if (
          this.LocalidadId === Demandas[i].LocalidadId
          &&
          this.ProductoId === Demandas[i].ProductoId
          &&
          this.Fecha === Demandas[i].Fecha
        ) {
          this.Id = Demandas[i].Id
          this.ConsumoPromedio = Demandas[i].ConsumoPromedio
          break
        }else{
          this.Id = null
          this.ConsumoPromedio = null
        }
      }

    }
  }
};


</script>

<style lang="stylus" scoped>
h5.bold
  font-weight bold

.alert-especial
  position absolute

</style>
