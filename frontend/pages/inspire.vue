<template>
  <v-layout column justify-center align-center>
    <img src="/v.png" alt="Vuetify.js" class="mb-5" width="75px" />
    <blockquote>
      &#8220;Bievenido a Biblioteca U.P.C.&#8221;
      <footer>
        <small>
          <em>&mdash;Aréa de Administración</em>
        </small>
      </footer>
    </blockquote>
  </v-layout>
</template>

<script>
export default {
  beforeMount () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    } else {
      var Roles = JSON.parse(sessionStorage.getItem('x-access-roles'))
      this.$store.commit('security/AddRoles', Roles);
    }
  }
}
</script>
