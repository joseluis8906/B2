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
            v-icon(ma) local_shipping
            |  Oferta
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-select(
              v-bind:items="ItemsProveedor"
              v-model="ProveedorId"
              item-value="Id"
              item-text="Nombre"
              label="Proveedor"
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

            v-text-field( label="Cantidad (Kg)" v-model="Cantidad" dark )

            v-text-field( label="Embalaje (Kg)" v-model="Embalaje" dark )

            v-text-field( label="Precio $" v-model="Precio" dark )


      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="CreateOrUpdate" ) Guardar
</template>

<script>

import OFERTAS from '~/queries/Ofertas.gql'
import CREATE_OFERTA from '~/queries/CreateOferta.gql'
import UPDATE_OFERTA from '~/queries/UpdateOferta.gql'
import PROVEEDORES from '~/queries/Proveedores.gql'
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
    ProveedorId: null,
    ProductoId: null,
    Cantidad: null,
    Embalaje: null,
    Precio: null,
    Fecha: null,
    ItemsProveedor: [],
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
    Ofertas: {
      query: OFERTAS,
      variables () {
        return {
          ProveedorId: this.ProveedorId,
          ProductoId: this.ProductoId,
          Fecha: this.Fecha
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Ofertas)
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
      const Oferta = {
        ProveedorId: this.ProveedorId,
        ProductoId: this.ProductoId,
        Cantidad: this.Cantidad,
        Embalaje: this.Embalaje,
        Precio: this.Precio,
        Fecha: this.Fecha
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_OFERTA,
        variables: {
          ProveedorId: Oferta.ProveedorId,
          ProductoId: Oferta.ProductoId,
          Cantidad: Oferta.Cantidad,
          Embalaje: Oferta.Embalaje,
          Precio: Oferta.Precio,
          Fecha: Oferta.Fecha
      },
      loadingKey: 'loading',
      update: (store, { data: res }) => {
        //console.log(Ente);
        try{
          var data = store.readQuery({
            query: OFERTAS,
            variables: {
              ProveedorId: res.CreateOferta.ProveedorId,
              ProductoId: res.CreateOferta.ProductoId,
              Fecha: res.CreateOferta.Fecha
            }
          })

          data.Ofertas.push(res.CreateOferta)

          store.writeQuery({
            query: OFERTAS,
            variables: {
              ProveedorId: res.CreateOferta.ProveedorId,
              ProductoId: res.CreateOferta.ProductoId,
              Fecha: res.CreateOferta.Fecha
            },
            data: data
          })

        } catch (Err) {

          var data = {Ofertas: []}

          data.Ofertas.push(res.CreateOferta)

          store.writeQuery({
            query: OFERTAS,
            variables: {
              ProveedorId: res.CreateOferta.ProveedorId,
              ProductoId: res.CreateOferta.ProductoId,
              Fecha: res.CreateOferta.Fecha
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
      const Oferta = {
        Id: this.Id,
        ProveedorId: this.ProveedorId,
        ProductoId: this.ProductoId,
        Cantidad: this.Cantidad,
        Embalaje: this.Embalaje,
        Precio: this.Precio,
        Fecha: this.Fecha
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_OFERTA,
        variables: {
          Id: Oferta.Id,
          ProveedorId: Oferta.ProveedorId,
          ProductoId: Oferta.ProductoId,
          Cantidad: Oferta.Cantidad,
          Embalaje: Oferta.Embalaje,
          Precio: Oferta.Precio,
          Fecha: Oferta.Fecha
        },
        loadingKey: 'loading',
        update: (store, { data: res }) => {
          //console.log(Ente);
          try {
            var data = store.readQuery({
              query: OFERTAS,
              variables: {
                ProveedorId: res.UpdateOferta.ProveedorId,
                ProductoId: res.UpdateOferta.ProductoId,
                Fecha: res.UpdateOferta.Fecha
              }
            })

            for (let i=0; i<data.Ofertas.length; i++) {
              if (data.Ofertas[i].Id === res.UpdateOferta.Id) {
                data.Ofertas[i].ProveedorId = res.UpdateOferta.ProveedorId
                data.Ofertas[i].ProductoId = res.UpdateOferta.ProductoId
                data.Ofertas[i].Cantidad = res.UpdateOferta.Cantidad
                data.Ofertas[i].Embalaje = res.UpdateOferta.Embalaje
                data.Ofertas[i].Precio = res.UpdateOferta.Precio
                data.Ofertas[i].Fecha = res.UpdateOferta.Fecha
              }
            }

            store.writeQuery({
              query: OFERTAS,
              variables: {
                ProveedorId: res.UpdateOferta.ProveedorId,
                ProductoId: res.UpdateOferta.ProductoId,
                Fecha: res.UpdateOferta.Fecha
              },
              data: data
            })

          } catch (Err) {

            var data = {Ofertas: []}

            data.Ofertas.push(res.UpdateOferta)

            store.writeQuery({
              query: OFERTAS,
              variables: {
                ProveedorId: res.UpdateOferta.ProveedorId,
                ProductoId: res.UpdateOferta.ProductoId,
                Fecha: res.UpdateOferta.Fecha
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
      this.ProveedorId = null
      this.ProductoId = null
      this.Cantidad = null
      this.Embalaje = null
      this.Precio = null
      this.Fecha = null
    },
    LoadUi (Ofertas) {
      if( Ofertas.length === 0 ) {
        this.Id = null
        this.Cantidad = null
        this.Embalaje = null
        this.Precio = null
      }

      for (let i=0; i<Ofertas.length; i++) {
        if (
          this.ProveedorId === Ofertas[i].ProveedorId
          &&
          this.ProductoId === Ofertas[i].ProductoId
          &&
          this.Fecha === Ofertas[i].Fecha
        ) {
          this.Id = Ofertas[i].Id
          this.Cantidad = Ofertas[i].Cantidad
          this.Embalaje = Ofertas[i].Embalaje
          this.Precio = Ofertas[i].Precio
          break
        }else{
          this.Id = null
          this.Cantidad = null
          this.Embalaje = null
          this.Precio = null
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
