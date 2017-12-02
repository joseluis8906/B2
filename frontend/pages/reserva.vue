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

            v-data-table(v-bind:headers="HeadersLibro"
                       :items="ItemsLibro"
                       class="elevation-5 grey lighten-1 grey--text text--darken-4"
                       v-show="Tipo === 'Libro'" )

               template(slot="headers" scope="props")
                 th(v-for="header in props.headers" :key="header"
                   class="text-xs-center") {{ header.text }}

               template(slot="items" scope="props")
                 td(class="text-xs-center" :style="{minWidth: ''+(props.item.Categoria.length*12)+'px'}") {{ props.item.Categoria }}
                 td(class="text-xs-center" :style="{minWidth: ''+(props.item.Isbn.length*16)+'px'}") {{ props.item.Isbn }}
                 td(class="text-xs-center" :style="{minWidth: ''+(props.item.Nombre.length*12)+'px'}") {{ props.item.Nombre }}
                 td(class="text-xs-center" :style="{minWidth: ''+(props.item.Editorial.length*12)+'px'}") {{ props.item.Editorial }}
                 td(class="text-xs-center" :style="{minWidth: ''+(props.item.Edicion.length*12)+'px'}") {{ props.item.Edicion }}
                 td(class="text-xs-center")
                   v-btn(small icon class="teal" dark @click.native="Reservar(props.item)")
                     v-icon compare_arrows


            v-data-table(v-bind:headers="HeadersVideoBean"
                      :items="ItemsVideoBean"
                      class="elevation-5 grey lighten-1 grey--text text--darken-4"
                      v-show="Tipo === 'VideoBean'" )

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
                  v-btn(small icon class="teal" dark @click.native="Reservar(props.item)")
                    v-icon compare_arrows


            v-data-table(v-bind:headers="HeadersTablaDibujo"
                      :items="ItemsTablaDibujo"
                      class="elevation-5 grey lighten-1 grey--text text--darken-4"
                      v-show="Tipo === 'Tabla de Dibujo'" )

              template(slot="headers" scope="props")
                th(v-for="header in props.headers" :key="header"
                  class="text-xs-center") {{ header.text }}

              template(slot="items" scope="props")
                td(class="text-xs-center" :style="{minWidth: ''+(props.item.Codigo.length*12)+'px'}") {{ props.item.Codigo }}
                td(class="text-xs-center" :style="{minWidth: ''+(props.item.Marca.length*12)+'px'}") {{ props.item.Marca }}
                td(class="text-xs-center" :style="{minWidth: ''+(props.item.Especificaciones.length*12)+'px'}") {{ props.item.Especificaciones }}
                td(class="text-xs-center")
                  v-btn(small icon class="teal" dark @click.native="Reservar(props.item)")
                    v-icon compare_arrows
</template>

<script>

//Queries
import LIBROS from '~/queries/Libros.gql';
import VIDEOBEANS from '~/queries/VideoBeans.gql';
import TABLADIBUJOS from '~/queries/TablaDibujos.gql';

import USUARIOS from '~/queries/Usuarios.gql';

import CREATE_PRESTAMO from '~/queries/CreatePrestamo.gql';

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
    HeadersLibro: [
      {text: 'Categoria', value: 'Categoria'},
      {text: 'Isbn', value: 'Isbn'},
      {text: 'Nombre', value: 'Nombre'},
      {text: 'Editorial', value: 'Editorial'},
      {text: 'Edición', value: 'Edicion'},
      {text: 'Reservar', value: 'Reservar'},
    ],
    HeadersTablaDibujo: [
      {text: 'Codigo', value: 'Codigo'},
      {text: 'Marca', value: 'Marca'},
      {text: 'Especificaciones', value: 'Especificaciones'},
      {text: 'Reservar', value: 'Reservar'},
    ],
    HeadersVideoBean: [
      {text: 'Codigo', value: 'Codigo'},
      {text: 'Marca', value: 'Marca'},
      {text: 'Modelo', value: 'Modelo'},
      {text: 'Especificaciones', value: 'Especificaciones'},
      {text: 'Accesorios', value: 'Accesorios'},
      {text: 'Reservar', value: 'Reservar'},
    ],
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
    Usuario: {
      Id: null,
      UserName: null,
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

      this.$store.commit('security/SetUserName', sessionStorage.getItem('x-access-username'));
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
          if(tmp.Estado === 'Disponible'){
            this.ItemsLibro.push(tmp)
          }
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
          if(tmp.Estado === 'Disponible'){
            this.ItemsVideoBean.push(tmp)
          }
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
          if(tmp.Estado === 'Disponible'){
            this.ItemsTablaDibujo.push(tmp)
          }
        }
      }
    },
    QUsuario: {
      query: USUARIOS,
      variables () {
        return {
          UserName: this.$store.state.security.UserName,
        }
      },
      update (data) {
        if(data.Usuarios.length > 0){
          this.Usuario.Id = data.Usuarios[0].Id;
          this.Usuario.UserName = data.Usuarios[0].UserName;
        }
      }
    }
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
    Reservar (Item) {
      var Hoy = new Date(Date.now()).toISOString().split('T')[0];

      const NewReserva = {
        UsuarioId: this.Usuario.Id,
        LibroId: this.Tipo === 'Libro' ? Item.Id : null,
        VideoBeanId: this.Tipo === 'VideoBean' ? Item.Id : null,
        TablaDibujoId: this.Tipo === 'Tabla de Dibujo' ? Item.Id : null,
        FechaReserva: Hoy,
        Estado: 'Reservado'
      };

      this.$apollo.mutate({
        mutation: CREATE_PRESTAMO,
        variables: {
          UsuarioId: NewReserva.UsuarioId,
          LibroId: NewReserva.LibroId,
          VideoBeanId: NewReserva.VideoBeanId,
          TablaDibujoId: NewReserva.TablaDibujoId,
          FechaReserva: NewReserva.FechaReserva,
          Estado: NewReserva.Estado
        },
        update: (store, {data: res}) => {
          console.log(res.CreatePrestamo);
        }
      });

      this.Notificaciones('Error', 'Error en apartado');
      this.Reset();
    },
    Notificaciones (Tipo, Message) {
      if(Tipo === 'Success'){
        this.$store.commit('notificaciones/changeContext', 'success')
        this.$store.commit('notificaciones/changeIcon', 'done_all')
        this.$store.commit('notificaciones/changeMsg', Message)
        this.$store.commit('notificaciones/changeState', 1)
      }else if(Tipo === 'Error'){
        this.$store.commit('notificaciones/changeContext', 'error')
        this.$store.commit('notificaciones/changeIcon', 'error_outline')
        this.$store.commit('notificaciones/changeMsg', Message)
        this.$store.commit('notificaciones/changeState', 1)
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
