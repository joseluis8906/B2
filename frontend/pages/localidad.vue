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
            v-icon(ma) group
            |  Localidad
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-text-field( label="Código" v-model="Codigo" dark )

            v-text-field( label="Nombre" v-model="Nombre" dark )

            v-text-field( label="Población" v-model="Poblacion" dark )

            v-text-field( label="Altitud" v-model="Altitud" dark )

            v-text-field( label="Temperatura" v-model="Temperatura" dark )

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="CreateOrUpdate" ) Guardar
</template>

<script>

import LOCALIDADES from '~/queries/Localidades.gql'
import CREATE_LOCALIDAD from '~/queries/CreateLocalidad.gql'
import UPDATE_LOCALIDAD from '~/queries/UpdateLocalidad.gql'


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
    Poblacion: null,
    Altitud: null,
    Temperatura: null,
    loading: 0
  }),
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    }
  },
  apollo: {
    Localidades: {
      query: LOCALIDADES,
      variables () {
        return {
          Codigo: this.Codigo
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Localidades)
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
      const Localidad = {
        Codigo: this.Codigo,
        Nombre: this.Nombre,
        Poblacion: this.Poblacion,
        Altitud: this.Altitud,
        Temperatura: this.Temperatura
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_LOCALIDAD,
        variables: {
          Codigo: Localidad.Codigo,
          Nombre: Localidad.Nombre,
          Poblacion: Localidad.Poblacion,
          Altitud: Localidad.Altitud,
          Temperatura: Localidad.Temperatura
      },
      loadingKey: 'loading',
      update: (store, { data: res }) => {
        //console.log(Ente);
        try{
          var data = store.readQuery({
            query: LOCALIDADES,
            variables: {
              Codigo: res.CreateLocalidad.Codigo,
            }
          })

          data.Localidades.push(res.CreateLocalidad)

          store.writeQuery({
            query: LOCALIDADES,
            variables: {
              Codigo: res.CreateLocalidad.Codigo
            },
            data: data
          })

        } catch (Err) {

          var data = {Localidades: []}

          data.Localidades.push(res.CreateLocalidad)

          store.writeQuery({
            query: LOCALIDADES,
            variables: {
              Codigo: res.CreateLocalidad.Codigo
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
      const Localidad = {
        Id: this.Id,
        Codigo: this.Codigo,
        Nombre: this.Nombre,
        Poblacion: this.Poblacion,
        Altitud: this.Altitud,
        Temperatura: this.Temperatura
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_LOCALIDAD,
        variables: {
          Id: Localidad.Id,
          Codigo: Localidad.Codigo,
          Nombre: Localidad.Nombre,
          Poblacion: Localidad.Poblacion,
          Altitud: Localidad.Altitud,
          Temperatura: Localidad.Temperatura
        },
        loadingKey: 'loading',
        update: (store, { data: res }) => {
          //console.log(Ente);
          try {
            var data = store.readQuery({
              query: LOCALIDADES,
              variables: {
                Codigo: res.UpdateLocalidad.Codigo
              }
            })

            for (let i=0; i<data.Localidades.length; i++) {
              if (data.Localidades[i].Id === res.UpdateLocalidad.Id) {
                data.Localidades[i].Codigo = res.UpdateLocalidad.Codigo
                data.Localidades[i].Nombre = res.UpdateLocalidad.Nombre
                data.Localidades[i].Poblacion = res.UpdateLocalidad.Poblacion
                data.Localidades[i].Altitud = res.UpdateLocalidad.Altitud
                data.Localidades[i].Temperatura = res.UpdateLocalidad.Temperatura
              }
            }

            store.writeQuery({
              query: LOCALIDADES,
              variables: {
                Codigo: res.UpdateLocalidad.Codigo
              },
              data: data
            })

          } catch (Err) {

            var data = {Localidades: []}

            data.Localidades.push(res.UpdateLocalidad)

            store.writeQuery({
              query: LOCALIDADES,
              variables: {
                Codigo: res.UpdateLocalidad.Codigo
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
      this.Poblacion = null
      this.Altitud = null
      this.Temperatura = null
    },
    LoadUi (Localidades) {
      if( Localidades.length === 0 ) {
        this.Id = null
        this.Nombre = null
        this.Poblacion = null
        this.Altitud = null
        this.Temperatura = null
      }

      for (let i=0; i<Localidades.length; i++) {
        if ( this.Codigo === Localidades[i].Codigo ) {
          this.Id = Localidades[i].Id
          this.Codigo = Localidades[i].Codigo
          this.Nombre = Localidades[i].Nombre
          this.Poblacion = Localidades[i].Poblacion
          this.Altitud = Localidades[i].Altitud
          this.Temperatura = Localidades[i].Temperatura
          break
        }else{
          this.Id = null
          this.Nombre = null
          this.Poblacion = null
          this.Altitud = null
          this.Temperatura = null
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
