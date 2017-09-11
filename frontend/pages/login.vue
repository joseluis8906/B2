<template lang="pug">
  v-layout(column justify-center align-center pt-0 pb-0)
    v-flex(xs12 sm10 md6 )

      v-card(class="mt-5 pt-3 pb-3 pl-3 pr-3")
        v-card-text
          div(class="text-xs-center")
            img(src="~assets/logo.gis.png" alt="logo.gis")
            
          h6(class="pt-4 grey--text text--lighten-4") Inicie Sessión
          p(class="pb-4") Con su cuenta GIS
          
          v-text-field(label="Nombre de Usuario"  v-model="UserName" class="pb-3")
          v-text-field(label="Contraseña" v-model="Password" type="password")
            
                
        v-card-actions
          v-btn(primary dark  class="mb-3" @click.native.stop="login") Continuar
          
</template>

<script>
  import axios from 'axios'
  
  export default {
    data () {
      return {
        UserName: null,
        Password: null
      }
    },
    layout: 'plain',
    methods: {
      login () {
        axios.post('/backend/login/', {
          UserName: this.UserName,
          Password: this.Password
        }).then(res => {
          //console.log(res.data)
          if(res.data.Result === 1){
            sessionStorage.setItem('x-access-token', res.data.Token)
            this.$router.push('/inspire')
          }
        });
      }
    }
  }
</script>
