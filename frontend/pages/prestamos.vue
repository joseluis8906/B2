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
            v-icon(ma) assignment
            |  Prestamos
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-select( label="Tipo"
                      :items="Tipos"
                      v-model="Tipo" )

            v-select( label="Usuario"
                      :items="Usuarios"
                      v-show="Tipo==='Por Usuario'"
                      v-model="UsuarioId"
                      item-text="Busqueda"
                      item-value="Id"
                      autocomplete )

            v-data-table(v-bind:headers="Headers"
                      :items="Items"
                      class="elevation-5 grey lighten-1 grey--text text--darken-4" )

              template(slot="headers" scope="props")
                th(v-for="header in props.headers" :key="header"
                  class="text-xs-center") {{ header.text }}

              template(slot="items" scope="props")
                td(class="text-xs-center") {{ props.index + 1 }}
                td(class="text-xs-center") {{ props.item.Material }}
                td(class="text-xs-center" :style="{minWidth: ''+(props.item.Codigo.length*16)+'px'}") {{ props.item.Codigo }}
                td(class="text-xs-center" ) {{ props.item.FechaReserva }}
                td(class="text-xs-center") {{ props.item.FechaPrestamo }}
                td(class="text-xs-center") {{ props.item.FechaDevolucion }}
                td(class="text-xs-center") {{ props.item.Sancion }}
                td(class="text-xs-center")
                  v-btn(small icon class="teal" dark @click.native="Prestar(props.item)" :disabled="DisablePrestar(props.item.Estado)")
                    v-icon compare_arrows
                td(class="text-xs-center")
                  v-btn(small icon class="teal" dark @click.native="Devolver(props.item)" :disabled="DisableDevolver(props.item.Estado)")
                    v-icon autorenew

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="Buscar" ) Buscar

</template>

<style lang="stylus" scoped>
h5.bold
  font-weight bold

.alert-especial
  position absolute
</style>

<script>
import USUARIOS from '~/queries/Usuarios.gql';
import PRESTAMOS from '~/queries/Prestamos.gql';

import UPDATE_PRESTAMO from '~/queries/UpdatePrestamo.gql';

import LIBROS from '~/queries/Libros.gql';
import UPDATE_LIBRO from '~/queries/UpdateLibro.gql';

import VIDEOBEANS from '~/queries/VideoBeans.gql';
import UPDATE_VIDEOBEAN from '~/queries/UpdateVideoBean.gql';

import TABLADIBUJOS from '~/queries/TablaDibujos.gql';
import UPDATE_TABLA_DIBUJO from '~/queries/UpdateTablaDibujo.gql';

export default {
  data () {
    return {
      snackbar: {
        context: 'secondary',
        mode: '',
        timeout: 6000,
        text: 'Cargando'
      },
      Tipo: null,
      UsuarioId: null,
      Usuarios: [],
      Tipos: [
        'Todos',
        'Por Usuario'
      ],
      Meses: [
        {text: 'Enero', value: '01'},
        {text: 'Febrero', value: '02'},
        {text: 'Marzo', value: '03'},
        {text: 'Abril', value: '04'},
        {text: 'Mayo', value: '05'},
        {text: 'Junio', value: '06'},
        {text: 'Julio', value: '07'},
        {text: 'Agosto', value: '08'},
        {text: 'Septiembre', value: '09'},
        {text: 'Octubre', value: '10'},
        {text: 'Noviembre', value: '11'},
        {text: 'Diciembre', value: '12'},
      ],
      Headers: [
        {text: 'N°', value: ''},
        {text: 'Material', value: 'Material'},
        {text: 'Código', value: 'Codigo'},
        {text: 'F. de Reserva', value: 'FechaReserva'},
        {text: 'F. de Prestamo', value: 'FechaPrestamo'},
        {text: 'F. de Devolución', value: 'FechaDevolucion'},
        {text: 'Sanción', value: 'Sancion'},
        {text: 'Prestar', value: 'Prestar'},
        {text: 'Devolución', value: 'Devolucion'},
      ],
      Items: [],
      rules: {
        required: (value) => !!value || 'Obligatorio.',
        email: (value) => {
          const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Correo Inválido.'
        }
      },
      loading: 0
    }
  },
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
      this.$mqtt.subscribe('b2/apollo/mutation')
    })
  },
  beforeDestroy () {
    this.$mqtt.unsubscribe('b2/apollo/mutation')
  },
  apollo:{
    QUsuarios: {
      query: USUARIOS,
      loadingKey: 'loading',
      update (data) {
        this.Usuarios = [];
        for(let i=0; i<data.Usuarios.length; i++){
          let tmp = {
            Busqueda: data.Usuarios[i].Cedula+' - '+data.Usuarios[i].Nombre+' '+data.Usuarios[i].Apellido,
            Id: data.Usuarios[i].Id
          };
          if(data.Usuarios[i].Cedula !== 'root'){
            this.Usuarios.push(tmp);
          }
        }
      }
    }
  },
  methods: {
    Reset () {
      this.Items = [];
      this.Tipo = null;
      this.UsuarioId = null;
    },
    Buscar () {
      if(this.Tipo === 'Todos'){

        this.$apollo.query({
          query: PRESTAMOS
        }).then(res => {

          this.Items = [];

          for(let i=0; i<res.data.Prestamos.length; i++){
            let tmp = {};
            tmp.Id = res.data.Prestamos[i].Id;
            tmp.UsuarioId = res.data.Prestamos[i].UsuarioId;

            if(res.data.Prestamos[i].LibroId !== null){
              tmp.Material = 'Libro';
              tmp.Codigo = res.data.Prestamos[i].Libro.Isbn;
              tmp.LibroId = res.data.Prestamos[i].Libro.Id;
            }
            else if(res.data.Prestamos[i].VideoBeanId !== null){
              tmp.Material = 'VideoBean';
              tmp.Codigo = res.data.Prestamos[i].VideoBean.Codigo;
              tmp.VideoBeanId = res.data.Prestamos[i].VideoBean.Id;
            }
            else if(res.data.Prestamos[i].TablaDibujoId !== null){
              tmp.Material = 'Tabla de Dibujo';
              tmp.Codigo = res.data.Prestamos[i].TablaDibujo.Codigo;
              tmp.TablaDibujoId = res.data.Prestamos[i].TablaDibujo.Id;
            }

            tmp.FechaReserva =  res.data.Prestamos[i].FechaReserva;
            tmp.FechaPrestamo = res.data.Prestamos[i].FechaPrestamo;
            tmp.FechaDevolucion = res.data.Prestamos[i].FechaDevolucion;

            tmp.Estado = res.data.Prestamos[i].Estado;
            tmp.Sancion = res.data.Prestamos[i].Sancion;

            this.Items.push(tmp);
          }

        });

      }else{

        this.$apollo.query({
          query: PRESTAMOS,
          variables: {
            UsuarioId: this.UsuarioId
          }
        }).then(res => {

          this.Items = [];

          for(let i=0; i<res.data.Prestamos.length; i++){
            let tmp = {};

            tmp.Id = res.data.Prestamos[i].Id;
            tmp.UsuarioId = res.data.Prestamos[i].UsuarioId;

            if(res.data.Prestamos[i].LibroId !== null){
              tmp.Material = 'Libro';
              tmp.Codigo = res.data.Prestamos[i].Libro.Isbn;
              tmp.LibroId = res.data.Prestamos[i].Libro.Id;
            }
            else if(res.data.Prestamos[i].VideoBeanId !== null){
              tmp.Material = 'VideoBean';
              tmp.Codigo = res.data.Prestamos[i].VideoBean.Codigo;
              tmp.VideoBeanId = res.data.Prestamos[i].VideoBean.Id;
            }
            else if(res.data.Prestamos[i].TablaDibujoId !== null){
              tmp.Material = 'Tabla de Dibujo';
              tmp.Codigo = res.data.Prestamos[i].TablaDibujo.Codigo;
              tmp.TablaDibujoId = res.data.Prestamos[i].TablaDibujo.Id;
            }

            tmp.FechaReserva =  res.data.Prestamos[i].FechaReserva;
            tmp.FechaPrestamo = res.data.Prestamos[i].FechaPrestamo;
            tmp.FechaDevolucion = res.data.Prestamos[i].FechaDevolucion;

            tmp.Estado = res.data.Prestamos[i].Estado;
            tmp.Sancion = res.data.Prestamos[i].Sancion;

            this.Items.push(tmp);
          }

        });

      }
    },
    Prestar (Item) {

      var Hoy = new Date(Date.now()).toISOString().split('T')[0];

      this.$apollo.mutate({
        mutation: UPDATE_PRESTAMO,
        variables: {
          Id: Item.Id,
          Estado: "Prestado",
          FechaPrestamo: Hoy
        },
        update: (store, {data: res}) => {

          try{
            var data = store.readQuery({
              query: PRESTAMOS
            });

            for(let i=0; i < data.Prestamos.length; i++){
              if(data.Prestamos[i].Id === res.UpdatePrestamo.Id){
                data.Prestamos[i] = res.UpdatePrestamo;
              }
            }

            store.writeQuery({
              query: PRESTAMOS,
              data
            });
          }
          catch (Err){console.log(Err);}

          try{
            var data = store.readQuery({
              query: PRESTAMOS,
              variables: {
                UsuarioId: this.UsuarioId
              }
            });

            for(let i=0; i < data.Prestamos.length; i++){
              if(data.Prestamos[i].Id === res.UpdatePrestamo.Id){
                data.Prestamos[i] = res.UpdatePrestamo;
              }
            }

            store.writeQuery({
              query: PRESTAMOS,
              variables: {
                UsuarioId: this.UsuarioId
              },
              data
            });
          }
          catch (Err){console.log(Err);}

        }
      }).then(() => {
        this.Buscar();
      });

    },
    Devolver (Item) {

      var Hoy = new Date(Date.now()).toISOString().split('T')[0];

      var FechaPrestamo = Item.FechaPrestamo;

      var Dias = (new Date(Hoy+'T00:00:00') - new Date(FechaPrestamo+'T00:00:00'))/24/60/60/1000;

      var Sancion = null;

      if(Dias > 3){
        Sancion = 25000;
      }

      this.$apollo.mutate({
        mutation: UPDATE_PRESTAMO,
        variables: {
          Id: Item.Id,
          Estado: "Devuelto",
          FechaDevolucion: Hoy,
          Sancion: Sancion
        },
        update: (store, {data: res}) => {

          try{
            var data = store.readQuery({
              query: PRESTAMOS
            });

            for(let i=0; i < data.Prestamos.length; i++){
              if(data.Prestamos[i].Id === res.UpdatePrestamo.Id){
                data.Prestamos[i] = res.UpdatePrestamo;
              }
            }

            store.writeQuery({
              query: PRESTAMOS,
              data
            });
          }
          catch (Err){console.log(Err);}

          try{
            var data = store.readQuery({
              query: PRESTAMOS,
              variables: {
                UsuarioId: this.UsuarioId
              }
            });

            for(let i=0; i < data.Prestamos.length; i++){
              if(data.Prestamos[i].Id === res.UpdatePrestamo.Id){
                data.Prestamos[i] = res.UpdatePrestamo;
              }
            }

            store.writeQuery({
              query: PRESTAMOS,
              variables: {
                UsuarioId: this.UsuarioId
              },
              data
            });
          }
          catch (Err){console.log(Err);}

        }
      }).then(() => {
        this.Buscar();

        var Id = null;
        var Mutation = null;

        if(Item.LibroId !== null){
          Id = Item.LibroId;
          Mutation = UPDATE_LIBRO;
        }
        else if(Item.VideoBeanId !== null){
          Id = Item.VideoBeanId;
          Mutation = UPDATE_VIDEOBEAN;
        }
        else if(Item.TablaDibujoId !== null){
          Id = Item.TablaDibujoId;
          Mutation = UPDATE_TABLA_DIBUJO;
        }

        this.$apollo.mutate({
          mutation: Mutation,
          variables: {
            Id: Id,
            Estado: 'Disponible'
          },
          update: (store, {data: res}) => {
            console.log(res);
          }
        });

      });

    },
    DisablePrestar(Estado){
      if(Estado === 'Prestado' || Estado === 'Devuelto'){
        return true;
      }
      else{
        return false;
      }
    },
    DisableDevolver(Estado){
      if(Estado === 'Reservado' || Estado === 'Devuelto'){
        return true;
      }
      else{
        return false;
      }
    }
  },
  components: {
  }
}
</script>
