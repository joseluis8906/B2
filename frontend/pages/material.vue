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

      v-tabs(dark fixed icons centered v-model="TabActive")
        v-tabs-bar(slot="activators" class="light-blue darken-4")
          v-tabs-slider(class="success")
          v-tabs-item(href="#tab-1" @click.native="Reset")
            v-icon create
            h6(class="body-2 grey--text text--lighten-4") Editar

          v-tabs-item(href="#tab-2" @click.native="Reset")
            v-icon search
            h6(class="body-2 grey--text text--lighten-4") Listar

        v-tabs-content(id="tab-1")
          v-card-text
            v-layout( row wrap)
              v-flex( xs12 )
                v-select(label="Tipo"
                         v-bind:items="ItemsTipo"
                         v-model="Tipo"
                         dark
                         :rules="[rules.required]")

                // libros
                v-select(label="Categoria", v-bind:items="ItemsTipoLibro" v-model="Libro.Categoria" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
                v-text-field(label="Isbn" v-model="Libro.Isbn" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
                v-text-field(label="Nombre" v-model="Libro.Nombre" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
                v-text-field(label="Editorial" v-model="Libro.Editorial" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
                v-text-field(label="Edición" v-model="Libro.Edicion" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
                v-text-field(label="Fecha" v-model="Libro.Fecha" dark :rules="[rules.required]" v-show="Tipo==='Libro'")
                v-text-field(label="Lugar" v-model="Libro.Lugar" dark :rules="[rules.required]" v-show="Tipo==='Libro'")

                // Video Bean
                v-text-field(label="Codigo" v-model="VideoBean.Codigo" dark :rules="[rules.required]" v-show="Tipo==='VideoBean'")
                v-text-field(label="Marca" v-model="VideoBean.Marca" dark :rules="[rules.required]" v-show="Tipo==='VideoBean'")
                v-text-field(label="Modelo" v-model="VideoBean.Modelo" dark :rules="[rules.required]" v-show="Tipo==='VideoBean'")
                v-text-field(label="Especificaciones" v-model="VideoBean.Especificaciones" multi-line dark :rules="[rules.required]" v-show="Tipo==='VideoBean'")
                v-text-field(label="Accesorios" v-model="VideoBean.Accesorios" multi-line dark :rules="[rules.required]" v-show="Tipo==='VideoBean'")

                // Tabla de Dibujo
                v-text-field(label="Codigo" v-model="TablaDibujo.Codigo" dark :rules="[rules.required]" v-show="Tipo==='Tabla de Dibujo'")
                v-text-field(label="Marca" v-model="TablaDibujo.Marca" dark :rules="[rules.required]" v-show="Tipo==='Tabla de Dibujo'")
                v-text-field(label="Especificaciones" v-model="TablaDibujo.Especificaciones" multi-line dark :rules="[rules.required]" v-show="Tipo==='Tabla de Dibujo'")

          v-card-actions
            v-spacer
            v-btn( dark @click.native="Reset" ) Cancelar
            v-btn( dark primary @click.native="Guardar" :disabled="!Completo") Guardar

        v-tabs-content(id="tab-2")
          v-card-text
            v-layout( row wrap)
              v-flex( xs12 )
                v-select(label="Tipo"
                         v-bind:items="ItemsTipo"
                         v-model="TipoListar"
                         dark
                         :rules="[rules.required]")

                v-data-table(v-bind:headers="HeadersLibro"
                           :items="ItemsLibro"
                           class="elevation-5 grey lighten-1 grey--text text--darken-4"
                           v-show="TipoListar === 'Libro'" )

                   template(slot="headers" scope="props")
                     th(v-for="header in props.headers" :key="header"
                       class="text-xs-center") {{ header.text }}

                   template(slot="items" scope="props")
                     td(class="text-xs-center" :style="{minWidth: ''+(props.item.Categoria.length*12)+'px'}") {{ props.item.Categoria }}
                     td(class="text-xs-center" :style="{minWidth: ''+(props.item.Isbn.length*12)+'px'}") {{ props.item.Isbn }}
                     td(class="text-xs-center" :style="{minWidth: ''+(props.item.Nombre.length*12)+'px'}") {{ props.item.Nombre }}
                     td(class="text-xs-center" :style="{minWidth: ''+(props.item.Editorial.length*12)+'px'}") {{ props.item.Editorial }}
                     td(class="text-xs-center" :style="{minWidth: ''+(props.item.Edicion.length*12)+'px'}") {{ props.item.Edicion }}
                     td(class="text-xs-center")
                       v-btn(fab small class="teal" dark @click.native="Editar(props.item)")
                         v-icon create


                v-data-table(v-bind:headers="HeadersVideoBean"
                          :items="ItemsVideoBean"
                          class="elevation-5 grey lighten-1 grey--text text--darken-4"
                          v-show="TipoListar === 'VideoBean'" )

                  template(slot="headers" scope="props")
                    th(v-for="header in props.headers" :key="header"
                      class="text-xs-center") {{ header.text }}

                  template(slot="items" scope="props")
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Codigo.length*12)+'px'}") {{ props.item.Codigo }}
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Marca.length*12)+'px'}") {{ props.item.Marca }}
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Modelo.length*12)+'px'}") {{ props.item.Modelo }}
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Especificaciones.length*12)+'px'}") {{ props.item.Especificaciones }}
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Accesorios.length*12)+'px'}") {{ props.item.Accesorios }}
                    td(class="text-xs-center")
                      v-btn(fab small class="teal" dark @click.native="Editar(props.item)")
                        v-icon create


                v-data-table(v-bind:headers="HeadersTablaDibujo"
                          :items="ItemsTablaDibujo"
                          class="elevation-5 grey lighten-1 grey--text text--darken-4"
                          v-show="TipoListar === 'Tabla de Dibujo'" )

                  template(slot="headers" scope="props")
                    th(v-for="header in props.headers" :key="header"
                      class="text-xs-center") {{ header.text }}

                  template(slot="items" scope="props")
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Codigo.length*12)+'px'}") {{ props.item.Codigo }}
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Marca.length*12)+'px'}") {{ props.item.Marca }}
                    td(class="text-xs-center" :style="{minWidth: ''+(props.item.Especificaciones.length*12)+'px'}") {{ props.item.Especificaciones }}
                    td(class="text-xs-center")
                      v-btn(fab small class="teal" dark @click.native="Editar(props.item)")
                        v-icon create


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
        context: 'primary',
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
      ItemsTipo: ['Libro', 'VideoBean', 'Tabla de Dibujo'],
      Tipo: null,
      TipoListar: null,
      ItemsTipoLibro: ['Libro', 'Revista', 'Enciclopedia', 'Diccionario'],
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
      HeadersLibro: [
        {text: 'Categoria', value: 'Categoria'},
        {text: 'Isbn', value: 'Isbn'},
        {text: 'Nombre', value: 'Nombre'},
        {text: 'Editorial', value: 'Editorial'},
        {text: 'Edición', value: 'Edicion'},
      ],
      ItemsLibro: [],
      HeadersVideoBean: [
        {text: 'Codigo', value: 'Codigo'},
        {text: 'Marca', value: 'Marca'},
        {text: 'Modelo', value: 'Modelo'},
        {text: 'Especificaciones', value: 'Especificaciones'},
        {text: 'Accesorios', value: 'Accesorios'},
      ],
      ItemsVideoBean: [],
      HeadersTablaDibujo: [
        {text: 'Codigo', value: 'Codigo'},
        {text: 'Marca', value: 'Marca'},
        {text: 'Especificaciones', value: 'Especificaciones'},
      ],
      ItemsTablaDibujo: [],
      AccionEditar: false,
      TabActive: null,
      Completo: false,
      loading: 0
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
  watch: {
    Tipo () {
      if(!this.AccionEditar) {
        this.Reset2 ()
      }else{
        this.AccionEditar = false
      };
    },
    TipoListar () {
      this.CargarTipoListar()
    },
    Libro () {
      this.Validar()
    },
    VideoBean () {
      this.Validar()
    },
    TablaDibujo () {
      this.Validar()
    }
  },
  mqtt: {
    'b2/apollo/mutation': function (val) {
      //console.log('mqtt material')
      var res = (JSON.parse(val))
      var Method = res.Method
      var Obj = res.Obj

      switch (Method) {
        case 'StoreLibro':
          this.StoreLibro(Obj)
          break;

        case 'StoreVideoBean':
          this.StoreVideoBean(Obj)
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
        //console.log(data.VideoBeans)
        for(let i=0; i<data.VideoBeans.length; i++){
          this.VideoBean = {
            Id: data.VideoBeans[0].Id,
            Codigo: data.VideoBeans[0].Codigo,
            Marca: data.VideoBeans[0].Marca,
            Modelo: data.VideoBeans[0].Modelo,
            Especificaciones: data.VideoBeans[0].Especificaciones,
            Accesorios: data.VideoBeans[0].Accesorios,
            Estado: data.VideoBeans[0].Estado,
          }
        }
        if(data.VideoBeans.length === 0){
          this.VideoBean = {
            Id: null,
            Codigo: this.VideoBean.Codigo,
            Marca: null,
            Modelo: null,
            Especificaciones: null,
            Accesorios: null,
            Estado: null,
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
        //console.log(data.TablaDibujos)
        for(let i=0; i<data.TablaDibujos.length; i++){
          this.TablaDibujo = {
            Id: data.TablaDibujos[0].Id,
            Codigo: this.TablaDibujo.Codigo,
            Marca: data.TablaDibujos[0].Marca,
            Especificaciones: data.TablaDibujos[0].Especificaciones,
            Estado: data.TablaDibujos[0].Estado,
          }
        }
        if(data.TablaDibujos.length === 0){
          this.TablaDibujo = {
            Id: null,
            Codigo: this.TablaDibujo.Codigo,
            Marca: null,
            Especificaciones: null,
            Estado: null,
          }
        }
      }
    },
  },
  methods: {
    Reset () {
      this.Tipo = null
      this.TipoListar = null
      this.ItemsLibro = []
      this.ItemsVideoBean = []
      this.ItemsTablaDibujo = []
      this.Completo = false
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
    Reset2 () {
      this.ItemsLibro = []
      this.ItemsVideoBean = []
      this.ItemsTablaDibujo = []
      this.Completo = false
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
      else if(this.Tipo === 'Tabla de Dibujo') this.GuardarTablaDibujo();
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
          console.log(Err)
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

      if(VideoBean.Id === null){
        this.$apollo.mutate ({
          mutation: CREATE_VIDEOBEAN,
          variables: {
            Codigo: VideoBean.Codigo,
            Marca: VideoBean.Marca,
            Modelo: VideoBean.Modelo,
            Especificaciones: VideoBean.Especificaciones,
            Accesorios: VideoBean.Accesorios,
            Estado: 'Disponible'
          },
          loadingKey: 'loading',
          update: (store, { data: res }) => {
            this.$mqtt.publish('b2/apollo/mutation', JSON.stringify({Method: 'StoreVideoBean', Obj: res.CreateVideoBean}))
          }
        }).then(() => {
          this.Notificaciones('Guardado', 'Exitoso')
        }).catch( Err => {
          //console.log(Er)
          this.Notificaciones('Guardado', 'Error')
        })
      }else{
        this.$apollo.mutate ({
          mutation: UPDATE_VIDEOBEAN,
          variables: {
            Id: VideoBean.Id,
            Codigo: VideoBean.Codigo,
            Marca: VideoBean.Marca,
            Modelo: VideoBean.Modelo,
            Especificaciones: VideoBean.Especificaciones,
            Accesorios: VideoBean.Accesorios,
            Estado: VideoBean.Estado
          },
          loadingKey: 'loading',
          update: (store, { data: res }) => {
            this.$mqtt.publish('b2/apollo/mutation', JSON.stringify({Method: 'StoreVideoBean', Obj: res.UpdateVideoBean}))
          }
        }).then( () => {
          this.Notificaciones('Actualización', 'Exitosa')
        }).catch((Err) => {
          //console.log(Err)
          this.Notificaciones('Actualización', 'Error')
        })
      }

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

      if(TablaDibujo.Id === null){
        this.$apollo.mutate ({
          mutation: CREATE_TABLADIBUJO,
          variables: {
            Codigo: TablaDibujo.Codigo,
            Marca: TablaDibujo.Marca,
            Especificaciones: TablaDibujo.Especificaciones,
            Estado: 'Disponible'
          },
          loadingKey: 'loading',
          update: (store, { data: res }) => {
            this.$mqtt.publish('b2/apollo/mutation', JSON.stringify({Method: 'StoreTablaDibujo', Obj: res.CreateTablaDibujo}))
          }
        }).then(() => {
          this.Notificaciones('Guardado', 'Exitoso')
        }).catch( Err => {
          this.Notificaciones('Guardado', 'Error')
        })
      }else{
        this.$apollo.mutate ({
          mutation: UPDATE_TABLADIBUJO,
          variables: {
            Id: TablaDibujo.Id,
            Codigo: TablaDibujo.Codigo,
            Marca: TablaDibujo.Marca,
            Especificaciones: TablaDibujo.Especificaciones,
            Estado: TablaDibujo.Estado
          },
          loadingKey: 'loading',
          update: (store, { data: res }) => {
            this.$mqtt.publish('b2/apollo/mutation', JSON.stringify({Method: 'StoreTablaDibujo', Obj: res.UpdateTablaDibujo}))
          }
        }).then( () => {
          this.Notificaciones('Actualización', 'Exitosa')
        }).catch((Err) => {
          this.Notificaciones('Actualización', 'Error')
        })
      }

    },
    StoreLibro (Libro) {
      var store = this.$apollo.provider.defaultClient

      //libros por filtro
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

      //libros general
      try {
        var data = store.readQuery({
          query: LIBROS,
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
          data: data
        })

      } catch (Err) {console.log(Err)}

      var Existe = false
      for(let i=0; i<this.ItemsLibro.length; i++){
        if(this.ItemsLibro[i].Id === Libro.Id){
          Existe = true
          this.ItemsLibro[i].Categoria = Libro.Categoria
          this.ItemsLibro[i].Isbn = Libro.Isbn
          this.ItemsLibro[i].Nombre = Libro.Nombre
          this.ItemsLibro[i].Editorial = Libro.Editorial
          this.ItemsLibro[i].Edicion = Libro.Edicion
          this.ItemsLibro[i].Fecha = Libro.Fecha
          this.ItemsLibro[i].Lugar = Libro.Lugar
          this.ItemsLibro[i].Estado = Libro.Estado
        }
      }
      if(!Existe){
        let tmp = {
          Id: Libro.Id,
          Categoria: Libro.Categoria,
          Isbn: Libro.Isbn,
          Nombre: Libro.Nombre,
          Editorial: Libro.Editorial,
          Edicion: Libro.Edicion,
          Fecha: Libro.Fecha,
          Lugar: Libro.Lugar,
          Estado: Libro.Estado,
        }
        this.ItemsLibro.push(tmp)
      }

    },
    StoreVideoBean (VideoBean) {
      var store = this.$apollo.provider.defaultClient

      //videobeans por filtro
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


      //videobeans general
      try {
        var data = store.readQuery({
          query: VIDEOBEANS,
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
          data: data
        })

      } catch (Err) {console.log(Err)}

      var Existe = false
      for(let i=0; i<this.ItemsVideoBean.length; i++){
        if(this.ItemsVideoBean[i].Id === VideoBean.Id){
          Existe = true
          this.ItemsVideoBean[i].Codigo = VideoBean.Codigo
          this.ItemsVideoBean[i].Marca = VideoBean.Marca
          this.ItemsVideoBean[i].Modelo = VideoBean.Modelo
          this.ItemsVideoBean[i].Especificaciones = VideoBean.Especificaciones
          this.ItemsVideoBean[i].Accesorios = VideoBean.Accesorios
        }
      }

      if(!Existe) {
        let tmp = {
          Id: Libro.Id,
          Codigo: Libro.Codigo,
          Marca: Libro.Marca,
          Modelo: Libro.Modelo,
          Especificaciones: Libro.Especificaciones,
          Accesorios: Libro.Accesorios,
          Estado: Libro.Estado
        }

        this.ItemsVideoBean.push(tmp)
      }

    },
    StoreTablaDibujo (TablaDibujo) {
      var store = this.$apollo.provider.defaultClient

      //tabladibujo por filtro
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


      //tabladibujo general
      try {
        var data = store.readQuery({
          query: TABLADIBUJOS
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
          data: data
        })

      } catch (Err) {console.log(Err)}

      var Existe = false
      for(let i=0; i<this.ItemsTablaDibujo.length; i++){
        if(this.ItemsTablaDibujo[i].Id === TablaDibujo.Id){
          Existe = true
          this.ItemsTablaDibujo[i].Codigo = TablaDibujo.Codigo
          this.ItemsTablaDibujo[i].Marca = TablaDibujo.Marca
          this.ItemsTablaDibujo[i].Especificaciones = TablaDibujo.Especificaciones
        }
      }

      if(!Existe) {
        let tmp = {
          Id: Libro.Id,
          Codigo: Libro.Codigo,
          Marca: Libro.Marca,
          Especificaciones: Libro.Especificaciones,
          Estado: Libro.Estado
        }

        this.ItemsTablaDibujo.push(tmp)
      }

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
    CargarTipoListar () {
      if(this.TipoListar === 'Libro'){
        this.$apollo.query({
          query: LIBROS,
          loadingKey: 'loading'
        }).then( res => {
          //console.log(res)
          this.ItemsLibro = []
          for (let i=0; i<res.data.Libros.length; i++) {
            var tmp = {
              Id: res.data.Libros[i].Id,
              Categoria: res.data.Libros[i].Categoria,
              Isbn: res.data.Libros[i].Isbn,
              Nombre: res.data.Libros[i].Nombre,
              Editorial: res.data.Libros[i].Editorial,
              Edicion: res.data.Libros[i].Edicion,
              Fecha: res.data.Libros[i].Fecha,
              Lugar: res.data.Libros[i].Lugar
            }
            this.ItemsLibro.push(tmp)
          }
        });
      }
      else if(this.TipoListar === 'VideoBean'){
        this.$apollo.query({
          query: VIDEOBEANS,
          loadingKey: 'loading'
        }).then( res => {
          //console.log(res)
          this.ItemsVideoBean = []
          for (let i=0; i<res.data.VideoBeans.length; i++) {
            var tmp = {
              Id: res.data.VideoBeans[i].Id,
              Codigo: res.data.VideoBeans[i].Codigo,
              Marca: res.data.VideoBeans[i].Marca,
              Modelo: res.data.VideoBeans[i].Modelo,
              Especificaciones: res.data.VideoBeans[i].Especificaciones,
              Accesorios: res.data.VideoBeans[i].Accesorios,
            }
            this.ItemsVideoBean.push(tmp)
          }
        });
      }
      else if(this.TipoListar === 'Tabla de Dibujo'){
        this.$apollo.query({
          query: TABLADIBUJOS,
          loadingKey: 'loading'
        }).then( res => {
          //console.log(res)
          this.ItemsTablaDibujo = []
          for (let i=0; i<res.data.TablaDibujos.length; i++) {
            var tmp = {
              Id: res.data.TablaDibujos[i].Id,
              Codigo: res.data.TablaDibujos[i].Codigo,
              Marca: res.data.TablaDibujos[i].Marca,
              Especificaciones: res.data.TablaDibujos[i].Especificaciones,
            }
            this.ItemsTablaDibujo.push(tmp)
          }
        });
      }

    },
    Editar (Item) {
      this.AccionEditar = true
      if(this.TipoListar === 'Libro'){
        this.Tipo = 'Libro'
        this.Libro = {
          Id: Item.Id,
          Categoria: Item.Categoria,
          Isbn: Item.Isbn,
          Nombre: Item.Nombre,
          Editorial: Item.Editorial,
          Edicion: Item.Edicion,
          Fecha: Item.Fecha,
          Lugar: Item.Lugar
        }
      }
      else if(this.TipoListar === 'VideoBean'){
        this.Tipo = 'VideoBean'
        this.VideoBean = {
          Id: Item.Id,
          Codigo: Item.Codigo,
          Marca: Item.Marca,
          Modelo: Item.Modelo,
          Especificaciones: Item.Especificaciones,
          Accesorios: Item.Accesorios,
        }
      }
      else if(this.TipoListar === 'Tabla de Dibujo'){
        this.Tipo = 'Tabla de Dibujo'
        this.TablaDibujo = {
          Id: Item.Id,
          Codigo: Item.Codigo,
          Marca: Item.Marca,
          Especificaciones: Item.Especificaciones,
        }
      }
      this.TabActive = "tab-1"
    },
    Validar () {
      this.Completo = false
      if(this.Tipo === 'Libro'){
        if (
          this.Libro.Categoria === null ||
          this.Libro.Isbn === null ||
          this.Libro.Nombre === null ||
          this.Libro.Editorial === null ||
          this.Libro.Edicion === null ||
          this.Libro.Fecha === null ||
          this.Libro.Lugar === null
        ){
          this.Completo = false
        }else{
          this.Completo = true
        }
      }
      else if(this.Tipo === 'VideoBean'){
        if (
          this.VideoBean.Codigo === null ||
          this.VideoBean.Marca === null ||
          this.VideoBean.Modelo === null ||
          this.VideoBean.Especificaciones === null ||
          this.VideoBean.Accesorios === null
        ){
          this.Completo = false
        }else{
          this.Completo = true
        }
      }
      else if(this.Tipo === 'Tabla de Dibujo'){
        if (
          this.TablaDibujo.Codigo === null ||
          this.TablaDibujo.Marca === null ||
          this.TablaDibujo.Especificaciones === null
        ){
          this.Completo = false
        }else{
          this.Completo = true
        }
      }
    },
  }
}
</script>
