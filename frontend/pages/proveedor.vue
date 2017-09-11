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
            v-icon(ma) person
            |  Usuario
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-text-field( label="Código" v-model="Codigo" dark )

            v-text-field( label="Nombre" v-model="Nombre" dark )

            v-text-field( label="Orígen" v-model="Origen" dark )

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="CreateOrUpdate" ) Guardar
</template>

<script>

import PROVEEDORES from '~/queries/Proveedores.gql'
import CREATE_PROVEEDOR from '~/queries/CreateProveedor.gql'
import UPDATE_PROVEEDOR from '~/queries/UpdateProveedor.gql'


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
    Origen: null,
    loading: 0
  }),
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    }
  },
  apollo: {
    Provedores: {
      query: PROVEEDORES,
      variables () {
        return {
          Codigo: this.Codigo
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Proveedores)
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
      const Proveedor = {
        Codigo: this.Codigo,
        Nombre: this.Nombre,
        Origen: this.Origen,
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_PROVEEDOR,
        variables: {
          Codigo: Proveedor.Codigo,
          Nombre: Proveedor.Nombre,
          Origen: Proveedor.Origen
      },
      loadingKey: 'loading',
      update: (store, { data: res }) => {
        //console.log(Ente);
        try{
          var data = store.readQuery({
            query: PROVEEDORES,
            variables: {
              Codigo: res.CreateProveedor.Codigo,
            }
          })

          data.Proveedores.push(res.CreateProveedor)

          store.writeQuery({
            query: PROVEEDORES,
            variables: {
              Codigo: res.CreateProveedor.Codigo
            },
            data: data
          })

        } catch (Err) {

          var data = {Proveedores: []}

          data.Proveedores.push(res.CreateProveedor)

          store.writeQuery({
            query: PROVEEDORES,
            variables: {
              Codigo: res.CreateProveedor.Codigo
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
      const Proveedor = {
        Id: this.Id,
        Codigo: this.Codigo,
        Nombre: this.Nombre,
        Origen: this.Origen
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_PROVEEDOR,
        variables: {
          Id: Proveedor.Id,
          Codigo: Proveedor.Codigo,
          Nombre: Proveedor.Nombre,
          Origen: Proveedor.Origen
        },
        loadingKey: 'loading',
        update: (store, { data: res }) => {
          //console.log(Ente);
          try {
            var data = store.readQuery({
              query: PROVEEDORES,
              variables: {
                Codigo: res.UpdateProveedor.Codigo
              }
            })

            for (let i=0; i<data.Proveedores.length; i++) {
              if (data.Proveedores[i].Id === res.UpdateProveedor.Id) {
                data.Proveedores[i].Codigo = res.UpdateProveedor.Codigo
                data.Proveedores[i].Nombre = res.UpdateProveedor.Nombre
                data.Proveedores[i].Origen = res.UpdateProveedor.Origen
              }
            }

            store.writeQuery({
              query: PROVEEDORES,
              variables: {
                Codigo: res.UpdateProveedor.Codigo
              },
              data: data
            })

          } catch (Err) {

            var data = {Proveedores: []}

            data.Proveedores.push(res.UpdateProveedor)

            store.writeQuery({
              query: PROVEEDORES,
              variables: {
                Codigo: res.UpdateProveedor.Codigo
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
      this.Origen = null
    },
    LoadUi (Proveedores) {
      if( Proveedores.length === 0 ) {
        this.Id = null
        this.Nombre = null
        this.Origen = null
      }

      for (let i=0; i<Proveedores.length; i++) {
        if ( this.Codigo === Proveedores[i].Codigo ) {
          this.Id = Proveedores[i].Id
          this.Codigo = Proveedores[i].Codigo
          this.Nombre = Proveedores[i].Nombre
          this.Origen = Proveedores[i].Origen
          break
        }else{
          this.Id = null
          this.Nombre = null
          this.Origen = null
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
