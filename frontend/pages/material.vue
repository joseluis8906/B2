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
        v-btn( dark primary @click.native="" ) Guardar
</template>

<style lang="stylus" scoped>
h5.bold
  font-weight bold

.alert-especial
  position absolute

</style>

<script>
import LIBROS from '~/queries/Libros.gql'
import VIDEOBEANS from '~/queries/VideoBeans.gql'
import TABLADIBUJOS from '~/queries/TablaDibujos.gql'

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
        Codigo: null,
        Marca: null,
        Modelo: null,
        Especificaciones: null,
        Accesorios: null,
        Estado: null,
      },
      TablaDibujo: {
        Codigo: null,
        Marca: null,
        Especificaciones: null,
        Estado: null,
      },
      loading: 0,
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
        console.log(data.Libros)
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
        console.log(data.VideoBeans)
      }
    },
  },
  methods: {
    Reset () {
      this.Tipo = null
      this.Libro = {
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
        Codigo: null,
        Marca: null,
        Modelo: null,
        Especificaciones: null,
        Accesorios: null,
        Estado: null,
      }
      this.TablaDibujo = {
        Codigo: null,
        Marca: null,
        Especificaciones: null,
        Estado: null,
      }
    },
    Guardar () {
      if(this.Tipo === 'Libro') GuardarLibro();
      else if(this.Tipo === 'VideoBean') GuardarVideoBean();
      else if(this.Tipo === 'TablaDibujo') GuardarTablaDibujo();
      else return null;
    },
    GuardarLibro (){
      const Libro = {
        Categoria: this.Libro.Categoria,
        Isbn: this.Libro.Isbn,
        Nombre: this.Libro.Nombre,
        Editorial: this.Libro.Editorial,
        Edicion: this.Libro.Edicion,
        Fecha: this.Libro.Fecha,
        Lugar: this.Libro.Lugar,
        Estado: this.Libro.Estado
      }
    },
    GuardarVideoBean (){
      const VideoBean = {
        Codigo: this.VideoBean.Codigo,
        Marca: this.VideoBean.Marca,
        Modelo: this.VideoBean.Modelo,
        Especificaciones: this.VideoBean.Especificaciones,
        Accesorios: this.VideoBean.Accesorios,
        Estado: this.VideoBean.Estado
      }
    },
    GuardarTablaDibujo (){
      const TablaDibujo = {
        Codigo: this.TablaDibujo.Codigo,
        Marca: this.TablaDibujo.Marca,
        Especificaciones: this.TablaDibujo.Especificaciones,
        Estado: this.TablaDibujo.Estado
      }
    }
  }
}
</script>
