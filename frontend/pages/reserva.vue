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

  v-snackbar( :timeout="$store.state.notificaciones.Timeout"
              :success="$store.state.notificaciones.Context === 'success'"
              :info="$store.state.notificaciones.Context === 'info'"
              :warning="$store.state.notificaciones.Context === 'warning'"
              :error="$store.state.notificaciones.Context === 'error'"
              :primary="$store.state.notificaciones.Context === 'primary'"
              :secondary="$store.state.notificaciones.Context === 'secondary'"
              :multi-line="$store.state.notificaciones.Mode === 'multi-line'"
              :vertical="$store.state.notificaciones.Mode === 'vertical'"
              :top="true"
              v-model="$store.state.notificaciones.State" )
      h6(class="grey--text text--lighten-4 mb-0") {{ $store.state.notificaciones.Msg }}
      v-icon {{ $store.state.notificaciones.Icon }}

  v-flex( xs12 sm8 mt-3 )
    v-card
      v-layout(row wrap pt-3 light-blue)
        v-flex( xs12 )
          h5(class="grey--text text--lighten-4 text-xs-center bold")
            v-icon(ma) assignment_turned_in
            |  Reserva
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-select(label="Tipo"
                     v-bind:items="ItemsTipo"
                     v-model="Tipo"
                     dark
                     :rules="[rules.required]")

            v-select(label="Libro"
                     v-bind:items="ItemsLibro"
                     v-model="Libro"
                     dark
                     :rules="[rules.required]"
                     item-text="Isbn"
                     return-object
                     v-show="Tipo==='Libro'")

            v-select(label="VideoBean"
                    v-bind:items="ItemsVideoBean"
                    v-model="VideoBean"
                    dark
                    :rules="[rules.required]"
                    item-text="Codigo"
                    return-object
                    v-show="Tipo==='VideoBean'")

            v-select(label="Tabla de Dibujo "
                    v-bind:items="ItemsTablaDibujo"
                    v-model="TablaDibujo"
                    dark
                    :rules="[rules.required]"
                    item-text="Codigo"
                    return-object
                    v-show="Tipo==='Tabla de Dibujo'")

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="Apartar" ) Apartar
</template>

<script>

//Queries
import LIBROS from '~/queries/Libros.gql'
import VIDEOBEANS from '~/queries/VideoBeans.gql'
import TABLADIBUJOS from '~/queries/TablaDibujos.gql'

export default {
  data: () => ({
    snackbar: {
      context: 'secondary',
      mode: '',
      timeout: 6000,
      text: 'Cargando'
    },
    Id: null,
    Nombre: null,
    Tipo: null,
    ItemsTipo: ['Libro', 'VideoBean', 'Tabla de Dibujo'],
    ItemsLibro: [],
    Libro: {
      Id: null,
      Categoria: null,
      Isbn: null,
      Nombre: null,
      Editorial: null,
      Edicion: null,
      Fecha: null,
      Lugar: null,
      Estado: null,
    },
    ItemsVideoBean: [],
    VideoBean: {
      Id: null,
      Codigo: null,
      Marca: null,
      Modelo: null,
      Especificaciones: null,
      Accesorios: null,
      Estado: null,
    },
    ItemsTablaDibujo: [],
    TablaDibujo: {
      Id: null,
      Codigo: null,
      Marca: null,
      Especificaciones: null,
      Estado: null,
    },
    rules: {
      required: (value) => !!value || 'Obligatorio.',
      email: (value) => {
        const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return pattern.test(value) || 'Correo Inválido.'
      }
    },
    loading: 0
  }),
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    } else {
      var Roles = JSON.parse(sessionStorage.getItem('x-access-roles'))
      this.$store.commit('security/AddRoles', Roles);
    }
  },
  mounted () {
    this.$nextTick(() => {
      //this.$mqtt.subscribe('b2/apollo/mutation')
    })
  },
  apollo: {
    Libros: {
      query: LIBROS,
      loadingKey: 'loading',
      update (data) {
        this.ItemsLibro = []
        for(let i=0; i<data.Libros.length; i++){
          var tmp = {
            Id: data.Libros[i].Id,
            Categoria: data.Libros[i].Categoria,
            Isbn: data.Libros[i].Isbn,
            Nombre: data.Libros[i].Nombre,
            Editorial: data.Libros[i].Editorial,
            Edicion: data.Libros[i].Edicion,
            Fecha: data.Libros[i].Fecha,
            Lugar: data.Libros[i].Lugar,
            Estado: data.Libros[i].Estado,
          }
          this.ItemsLibro.push(tmp)
        }
      }
    },
    VideoBeans: {
      query: VIDEOBEANS,
      loadingKey: 'loading',
      update (data) {
        //console.log(data.VideoBeans)
        this.ItemsVideoBean = []
        for(let i=0; i<data.VideoBeans.length; i++){
          var tmp = {
            Id: data.VideoBeans[i].Id,
            Codigo: data.VideoBeans[i].Codigo,
            Marca: data.VideoBeans[i].Marca,
            Modelo: data.VideoBeans[i].Modelo,
            Especificaciones: data.VideoBeans[i].Especificaciones,
            Accesorios: data.VideoBeans[i].Accesorios,
            Estado: data.VideoBeans[i].Estado,
          }
          this.ItemsVideoBean.push(tmp)
        }
      }
    },
    TablaDibujos: {
      query: TABLADIBUJOS,
      loadingKey: 'loading',
      update (data) {
        //console.log(data.TablaDibujos)
        this.ItemsTablaDibujo = []
        for(let i=0; i<data.TablaDibujos.length; i++){
          var tmp = {
            Id: data.TablaDibujos[i].Id,
            Codigo: data.TablaDibujos[i].Codigo,
            Marca: data.TablaDibujos[i].Marca,
            Especificaciones: data.TablaDibujos[i].Especificaciones,
            Estado: data.TablaDibujos[i].Estado,
          }
          this.ItemsTablaDibujo.push(tmp)
        }
      }
    },
  },
  methods: {
    Reset () {
      this.Tipo = null
      //this.ItemsLibro = [],
      this.Libro = {
        Id: null,
        Categoria: null,
        Isbn: null,
        Nombre: null,
        Editorial: null,
        Edicion: null,
        Fecha: null,
        Lugar: null,
        Estado: null,
      }
      //this.ItemsVideoBean = []
      this.VideoBean = {
        Id: null,
        Codigo: null,
        Marca: null,
        Modelo: null,
        Especificaciones: null,
        Accesorios: null,
        Estado: null,
      }
      //this.ItemsTablaDibujo = []
      this.TablaDibujo = {
        Id: null,
        Codigo: null,
        Marca: null,
        Especificaciones: null,
        Estado: null,
      }
    },
    Apartar () {
      this.Notificaciones('Guardado', 'Exitoso')
      this.Reset()
    },
    Notificaciones (Tipo, Estado) {
      if(Tipo === 'Guardado'){
        if(Estado === 'Exitoso'){
          this.$store.commit('notificaciones/changeContext', 'success')
          this.$store.commit('notificaciones/changeIcon', 'done_all')
          this.$store.commit('notificaciones/changeMsg', 'Guardado Exitoso')
          this.$store.commit('notificaciones/changeState', 1)
        }else{
          this.$store.commit('notificaciones/changeContext', 'error')
          this.$store.commit('notificaciones/changeIcon', 'error_outline')
          this.$store.commit('notificaciones/changeMsg', 'Error en Guardado')
          this.$store.commit('notificaciones/changeState', 1)
        }
      }else if(Tipo === 'Actualización'){
        if(Estado === 'Exitosa'){
          this.$store.commit('notificaciones/changeContext', 'success')
          this.$store.commit('notificaciones/changeIcon', 'done_all')
          this.$store.commit('notificaciones/changeMsg', 'Actualización Exitosa')
          this.$store.commit('notificaciones/changeState', 1)
        }else{
          this.$store.commit('notificaciones/changeContext', 'error')
          this.$store.commit('notificaciones/changeIcon', 'error_outline')
          this.$store.commit('notificaciones/changeMsg', 'Error en Actualización')
          this.$store.commit('notificaciones/changeState', 1)
        }
      }
    },
  }
};


</script>

<style lang="stylus" scoped>
h5.bold
  font-weight bold

.alert-especial
  position absolute

</style>
