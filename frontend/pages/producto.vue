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
            v-icon(ma) local_offer
            |  Producto
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-text-field( label="Código" v-model="Codigo" dark )

            v-text-field( label="Nombre" v-model="Nombre" dark )

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="CreateOrUpdate" ) Guardar
</template>

<script>

import PRODUCTOS from '~/queries/Productos.gql'
import CREATE_PRODUCTO from '~/queries/CreateProducto.gql'
import UPDATE_PRODUCTO from '~/queries/UpdateProducto.gql'


export default {
  data: () => ({
    snackbar: {
      context: 'secondary',
      mode: '',
      timeout: 6000,
      text: 'Cargando'
    },
    Id: null,
    Codigo: null,
    Nombre: null,
    loading: 0
  }),
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    }
  },
  apollo: {
    Productos: {
      query: PRODUCTOS,
      variables () {
        return {
          Codigo: this.Codigo
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Productos)
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
      const Producto = {
        Codigo: this.Codigo,
        Nombre: this.Nombre
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_PRODUCTO,
        variables: {
          Codigo: Producto.Codigo,
          Nombre: Producto.Nombre
      },
      loadingKey: 'loading',
      update: (store, { data: res }) => {
        //console.log(Ente);
        try{
          var data = store.readQuery({
            query: PRODUCTOS,
            variables: {
              Codigo: res.CreateProducto.Codigo,
            }
          })

          data.Productos.push(res.CreateProducto)

          store.writeQuery({
            query: PRODUCTOS,
            variables: {
              Codigo: res.CreateProducto.Codigo
            },
            data: data
          })

        } catch (Err) {

          var data = {Productos: []}

          data.Productos.push(res.CreateProducto)

          store.writeQuery({
            query: PRODUCTOS,
            variables: {
              Codigo: res.CreateProducto.Codigo
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
      const Producto = {
        Id: this.Id,
        Codigo: this.Codigo,
        Nombre: this.Nombre
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_PRODUCTO,
        variables: {
          Id: Producto.Id,
          Codigo: Producto.Codigo,
          Nombre: Producto.Nombre
        },
        loadingKey: 'loading',
        update: (store, { data: res }) => {
          //console.log(Ente);
          try {
            var data = store.readQuery({
              query: PRODUCTOS,
              variables: {
                Codigo: res.UpdateProducto.Codigo
              }
            })

            for (let i=0; i<data.Productos.length; i++) {
              if (data.Productos[i].Id === res.UpdateProducot.Id) {
                data.Productos[i].Codigo = res.UpdateProducto.Codigo
                data.Productos[i].Nombre = res.UpdateProducto.Nombre
              }
            }

            store.writeQuery({
              query: PRODUCTOS,
              variables: {
                Codigo: res.UpdateProducto.Codigo
              },
              data: data
            })

          } catch (Err) {

            var data = {Productos: []}

            data.Productos.push(res.UpdateProducto)

            store.writeQuery({
              query: PRODUCTOS,
              variables: {
                Codigo: res.UpdateProducto.Codigo
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
      this.Codigo = null
      this.Nombre = null
    },
    LoadUi (Productos) {
      if( Productos.length === 0 ) {
        this.Id = null
        this.Nombre = null
      }

      for (let i=0; i<Productos.length; i++) {
        if ( this.Codigo === Productos[i].Codigo ) {
          this.Id = Productos[i].Id
          this.Codigo = Productos[i].Codigo
          this.Nombre = Productos[i].Nombre
          break
        }else{
          this.Id = null
          this.Nombre = null
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
