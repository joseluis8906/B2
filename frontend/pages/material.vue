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
            v-icon(ma) book
            |  Material
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-select(label="Tipo"
                     v-bind:items="ItemsTipo"
                     v-model="Tipo"
                     dark
                     :rules="[rules.required]")

            // libros
            v-select(label="Categoria", v-bind:items="ItemsLibro" v-model="Libro.Categoria" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
            v-text-field(label="Isbn" v-model="Libro.Isbn" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
            v-text-field(label="Nombre" v-model="Libro.Nombre" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
            v-text-field(label="Editorial" v-model="Libro.Editorial" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
            v-text-field(label="Edición" v-model="Libro.Edicion" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
            v-text-field(label="Fecha" v-model="Libro.Fecha" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
            v-text-field(label="Lugar" v-model="Libro.Lugar" dark :rules="[rules.required]" v-show="Tipo==='Libro'")

            // Video Bean
            v-text-field(label="Codigo" v-model="VideoBean.Codigo" dark :rules="[rules.required]" v-show="Tipo==='Video Bean'")
            v-text-field(label="Marca" v-model="VideoBean.Marca" dark :rules="[rules.required]" v-show="Tipo==='Video Bean'")
            v-text-field(label="Modelo" v-model="VideoBean.Modelo" dark :rules="[rules.required]" v-show="Tipo==='Video Bean'")
            v-text-field(label="Especificaciones" v-model="VideoBean.Especificaciones" multi-line dark :rules="[rules.required]" v-show="Tipo==='Video Bean'")
            v-text-field(label="Accesorios" v-model="VideoBean.Accesorios" multi-line dark :rules="[rules.required]" v-show="Tipo==='Video Bean'")

            // Tabla de Dibujo
            v-text-field(label="Codigo" v-model="TablaDibujo.Codigo" dark :rules="[rules.required]" v-show="Tipo==='Tabla de Dibujo'")
            v-text-field(label="Marca" v-model="TablaDibujo.Marca" dark :rules="[rules.required]" v-show="Tipo==='Tabla de Dibujo'")
            v-text-field(label="Especificaciones" v-model="TablaDibujo.Especificaciones" multi-line dark :rules="[rules.required]" v-show="Tipo==='Tabla de Dibujo'")

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="Guardar" ) Guardar
</template>

<style lang="stylus" scoped>
h5.bold
  font-weight bold

.alert-especial
  position absolute

</style>

<script>
//Queries
import LIBROS from '~/queries/Libros.gql'
import VIDEOBEANS from '~/queries/VideoBeans.gql'
import TABLADIBUJOS from '~/queries/TablaDibujos.gql'

//Inserts
import CREATE_LIBRO from '~/queries/CreateLibro.gql'
import CREATE_VIDEOBEAN from '~/queries/CreateVideoBean.gql'
import CREATE_TABLADIBUJO from '~/queries/CreateTablaDibujo.gql'

//Updates
import UPDATE_LIBRO from '~/queries/UpdateLibro.gql'
import UPDATE_VIDEOBEAN from '~/queries/UpdateVideoBean.gql'
import UPDATE_TABLADIBUJO from '~/queries/UpdateTablaDibujo.gql'


export default {
  data () {
    return {
      snackbar: {
        context: 'secondary',
        mode: '',
        timeout: 3000,
        text: 'Cargando'
      },
      rules: {
        required: (value) => !!value || 'Obligatorio.',
        email: (value) => {
          const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Correo Inválido.'
        }
      },
      ItemsTipo: ['Libro', 'Video Bean', 'Tabla de Dibujo'],
      Tipo: null,
      ItemsLibro: ['Libro', 'Revista', 'Enciclopedia', 'Diccionario'],
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
      VideoBean: {
        Id: null,
        Codigo: null,
        Marca: null,
        Modelo: null,
        Especificaciones: null,
        Accesorios: null,
        Estado: null,
      },
      TablaDibujo: {
        Id: null,
        Codigo: null,
        Marca: null,
        Especificaciones: null,
        Estado: null,
      },
      loading: 0,
    }
  },
  mounted () {
    this.$nextTick(() => {
      this.$mqtt.subscribe('b2/apollo/mutation')
    })
  },
  beforeDestroy () {
    this.$mqtt.unsubscribe('b2/apollo/mutation')
  },
  mqtt: {
    'b2/apollo/mutation': function (val) {
      console.log('mqtt material')
      var res = (JSON.parse(val))
      var Method = res.Method
      var Obj = res.Obj

      switch (Method) {
        case 'StoreLibro':
          this.StoreLibro(Obj)
          break;

        case 'StoreVideBean':
          this.StoreVideBean(Obj)
          break;

        case 'StoreTablaDibujo':
          this.StoreTablaDibujo(Obj)
          break;
      }

    }
  },
  apollo:{
    Libros: {
      query: LIBROS,
      variables () {
        return {
          Categoria: this.Libro.Categoria || 'null',
          Isbn: this.Libro.Isbn || 'null',
          Estado: 'Disponible'
        }
      },
      loadingKey: 'loading',
      update (data) {
        for(let i=0; i<data.Libros.length; i++){
          this.Libro = {
            Id: data.Libros[i].Id,
            Categoria: this.Libro.Categoria,
            Isbn: this.Libro.Isbn,
            Nombre: data.Libros[i].Nombre,
            Editorial: data.Libros[i].Editorial,
            Edicion: data.Libros[i].Edicion,
            Fecha: data.Libros[i].Fecha,
            Lugar: data.Libros[i].Lugar,
            Estado: data.Libros[i].Estado,
          }
        }
        if(data.Libros.length === 0){
          this.Libro = {
            Id: null,
            Categoria: this.Libro.Categoria,
            Isbn: this.Libro.Isbn,
            Nombre: null,
            Editorial: null,
            Edicion: null,
            Fecha: null,
            Lugar: null,
            Estado: null,
          }
        }
      }
    },
    VideoBeans: {
      query: VIDEOBEANS,
      variables () {
        return {
          Codigo: this.VideoBean.Codigo || 'null',
          Estado: 'Disponible'
        }
      },
      loadingKey: 'loading',
      update (data) {
        console.log(data.VideoBeans)
        for(let i=0; i<data.VideoBeans.length; i++){
          this.VideoBean = {

          }
        }
        if(data.VideoBeans.length === 0){
          this.VideoBean = {

          }
        }
      }
    },
    TablaDibujos: {
      query: TABLADIBUJOS,
      variables () {
        return {
          Codigo: this.TablaDibujo.Codigo || 'null',
          Estado: 'Disponible'
        }
      },
      loadingKey: 'loading',
      update (data) {
        console.log(data.TablaDibujos)
      }
    },
  },
  methods: {
    Reset () {
      this.Tipo = null
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
      this.VideoBean = {
        Id: null,
        Codigo: null,
        Marca: null,
        Modelo: null,
        Especificaciones: null,
        Accesorios: null,
        Estado: null,
      }
      this.TablaDibujo = {
        Id: null,
        Codigo: null,
        Marca: null,
        Especificaciones: null,
        Estado: null,
      }
    },
    Guardar () {
      if(this.Tipo === 'Libro') this.GuardarLibro();
      else if(this.Tipo === 'VideoBean') this.GuardarVideoBean();
      else if(this.Tipo === 'TablaDibujo') this.GuardarTablaDibujo();
      else return null;
    },
    GuardarLibro () {
      const Libro = {
        Id: this.Libro.Id,
        Categoria: this.Libro.Categoria,
        Isbn: this.Libro.Isbn,
        Nombre: this.Libro.Nombre,
        Editorial: this.Libro.Editorial,
        Edicion: this.Libro.Edicion,
        Fecha: this.Libro.Fecha,
        Lugar: this.Libro.Lugar,
        Estado: this.Libro.Estado
      }

      this.Reset()

      if(Libro.Id === null){
        this.$apollo.mutate ({
          mutation: CREATE_LIBRO,
          variables: {
            Categoria: Libro.Categoria,
            Isbn: Libro.Isbn,
            Nombre: Libro.Nombre,
            Editorial: Libro.Editorial,
            Edicion: Libro.Edicion,
            Fecha: Libro.Fecha,
            Lugar: Libro.Lugar,
            Estado: 'Disponible'
          },
          loadingKey: 'loading',
          update: (store, { data: res }) => {
            this.$mqtt.publish('b2/apollo/mutation', JSON.stringify({Method: 'StoreLibro', Obj: res.CreateLibro}))
          }
        }).then(() => {
          this.Notificaciones('Guardado', 'Exitoso')
        }).catch( Err => {
          this.Notificaciones('Guardado', 'Error')
        })
      }else{
        this.$apollo.mutate ({
          mutation: UPDATE_LIBRO,
          variables: {
            Id: Libro.Id,
            Categoria: Libro.Categoria,
            Isbn: Libro.Isbn,
            Nombre: Libro.Nombre,
            Editorial: Libro.Editorial,
            Edicion: Libro.Edicion,
            Fecha: Libro.Fecha,
            Lugar: Libro.Lugar,
            Estado: Libro.Estado
          },
          loadingKey: 'loading',
          update: (store, { data: res }) => {
            this.$mqtt.publish('b2/apollo/mutation', JSON.stringify({Method: 'StoreLibro', Obj: res.UpdateLibro}))
          }
        }).then( () => {
          this.Notificaciones('Actualización', 'Exitosa')
        }).catch((Err) => {
          this.Notificaciones('Actualización', 'Error')
        })
      }


    },
    GuardarVideoBean (){
      const VideoBean = {
        Id: this.VideoBean.Id,
        Codigo: this.VideoBean.Codigo,
        Marca: this.VideoBean.Marca,
        Modelo: this.VideoBean.Modelo,
        Especificaciones: this.VideoBean.Especificaciones,
        Accesorios: this.VideoBean.Accesorios,
        Estado: this.VideoBean.Estado
      }
      this.Reset()
    },
    GuardarTablaDibujo (){
      const TablaDibujo = {
        Id: this.TablaDibujo.Id,
        Codigo: this.TablaDibujo.Codigo,
        Marca: this.TablaDibujo.Marca,
        Especificaciones: this.TablaDibujo.Especificaciones,
        Estado: this.TablaDibujo.Estado
      }
      this.Reset()
    },
    StoreLibro (Libro) {
      var store = this.$apollo.provider.defaultClient

      try {
        var data = store.readQuery({
          query: LIBROS,
          variables: {
            Categoria: Libro.Categoria,
            Isbn: Libro.Isbn,
            Estado: 'Disponible'
          }
        })

        var Existe = false

        for (let i=0; i<data.Libros.length; i++) {
          if (data.Libros[i].Id === Libro.Id) {
            Existe = true
            data.Libros[i] = Libro
          }
        }

        (!Existe) ? data.Libros.push(Usuario) : null;

        store.writeQuery({
          query: LIBROS,
          variables: {
            Categoria: Libro.Categoria,
            Isbn: Libro.Isbn,
            Estado: 'Disponible'
          },
          data: data
        })

      } catch (Err) {console.log(Err)}
    },
    StoreVideBean (VideoBean) {
      var store = this.$apollo.provider.defaultClient

      try {
        var data = store.readQuery({
          query: VIDEOBEANS,
          variables: {
            Codigo: VideoBean.Codigo,
            Estado: 'Disponible'
          }
        })

        var Existe = false

        for (let i=0; i<data.VideoBeans.length; i++) {
          if (data.VideoBeans[i].Id === VideoBean.Id) {
            Existe = true
            data.VideoBeans[i] = VideoBean
          }
        }

        (!Existe) ? data.VideoBeans.push(VideoBean) : null;

        store.writeQuery({
          query: VIDEOBEANS,
          variables: {
            Codigo: VideoBean.Codigo,
            Estado: 'Disponible'
          },
          data: data
        })

      } catch (Err) {console.log(Err)}
    },
    StoreTablaDibujo (TablaDibujo) {
      var store = this.$apollo.provider.defaultClient

      try {
        var data = store.readQuery({
          query: TABLADIBUJOS,
          variables: {
            Codigo: TablaDibujo.Codigo,
            Estado: 'Disponible'
          }
        })

        var Existe = false

        for (let i=0; i<data.TablaDibujos.length; i++) {
          if (data.TablaDibujos[i].Id === TablaDibujo.Id) {
            Existe = true
            data.TablaDibujos[i] = TablaDibujo
          }
        }

        (!Existe) ? data.TablaDibujos.push(TablaDibujo) : null;

        store.writeQuery({
          query: TABLADIBUJOS,
          variables: {
            Codigo: TablaDibujo.Codigo,
            Estado: 'Disponible'
          },
          data: data
        })

      } catch (Err) {console.log(Err)}
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
    }
  }
}
</script>
