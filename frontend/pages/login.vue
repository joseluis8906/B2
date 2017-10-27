<template lang="pug">
  v-layout(row wrap justify-center align-center pt-0 pb-0)
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

    v-flex(xs12 sm6 md2 )
      v-card(class="mt-5 pa-3")
        v-card-text
          div(class="text-xs-center")
            img(src="/books.svg" alt="logo")

          h6(class="pt-4 grey--text text--lighten-4") Iniciar Sessión

          v-text-field(label="Nombre de Usuario"  v-model="UserName" class="pb-3" :rules="[rules.required]" dark)
          v-text-field(label="Contraseña" v-model="Password" type="password" maxlength="4" :rules="[rules.required]" dark)


        v-card-actions
          v-btn(primary dark  class="mb-3" @click.native.stop="login" :disabled="!Completo") Continuar

</template>

<script>
  import axios from 'axios'

  export default {
    data () {
      return {
        UserName: null,
        Password: null,
        rules: {
          required: (value) => !!value || 'Obligatorio.',
          email: (value) => {
            const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'Correo Inválido.'
          }
        },
        Completo: false
      }
    },
    layout: 'plain',
    watch: {
      Usuario () {
        this.Validar()
      },
      Password () {
        this.Validar()
      }
    },
    methods: {
      Validar () {
        if (this.Usuario === null ||
            this.Usuario === '' ||
            this.Password === null ||
            this.Password === ''
        ){
          this.Completo = false
        }else{
          this.Completo = true
        }
      },
      login () {
        const UserName = this.UserName
        axios.post('/backend/login/', {
          UserName: this.UserName,
          Password: this.Password
        }).then(res => {
          if(res.data.Result === 1){
            sessionStorage.setItem('x-access-username', UserName)
            sessionStorage.setItem('x-access-token', res.data.Token)
            sessionStorage.setItem('x-access-roles', JSON.stringify(res.data.Roles))
            this.$router.push('/inspire')
          }else{
            this.$store.commit('notificaciones/changeContext', 'error')
            this.$store.commit('notificaciones/changeIcon', 'error_outline')
            this.$store.commit('notificaciones/changeMsg', 'Error en Usuario y Contraseña')
            this.$store.commit('notificaciones/changeState', 1)
          }
        });
      }
    }
  }
</script>
