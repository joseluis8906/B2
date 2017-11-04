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
            v-icon(ma) person
            |  Usuario
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-text-field( label="Nombre De Usuario" v-model="UserName" :rules="[rules.required]" dark )

            v-text-field( label="Contraseña" v-model="UiPassword" type="Password" maxlength="4" dark )

            v-text-field( label="Cédula" v-model="Cedula" :rules="[rules.required]" dark )

            v-text-field( label="Nombre" v-model="Nombre" :rules="[rules.required]" dark )

            v-text-field( label="Apellido" v-model="Apellido" :rules="[rules.required]" dark )

            v-text-field( label="Ocupación" v-model="Ocupacion" :rules="[rules.required]" dark )

            v-text-field( label="Correo" v-model="Email" :rules="[rules.required]" dark )

            v-text-field( label="Dirección" v-model="Direccion" :rules="[rules.required]" dark )

            v-text-field( label="Teléfono" v-model="Telefono" :rules="[rules.required]" dark )

            v-select( v-bind:items="ItemsActivo"
                      v-model="Activo"
                      label="Activo"
                      item-value="text"
                      :rules="[rules.required]"
                      dark )

            v-select( label="Grupos"
                      v-bind:items="ItemsGrupo"
                      v-model="SelectedGrupos"
                      item-text="Nombre"
                      item-value="Id"
                      multiple
                      chips
                      hint="Roles Seleccionados"
                      persistent-hint
                      return-object
                      class="select-special"
                      :disabled="DisableGroupSelect")

            //-div(style="width: 90%; height: scroll")
              //-pre {{ TodosUsuariosDb }}

      v-card-actions
        v-spacer
        v-btn( dark @click.native="Reset" ) Cancelar
        v-btn( dark primary @click.native="CryptPassword" ) Guardar
</template>

<script>

import USUARIOS from '~/queries/Usuarios.gql'
import CREATE_USUARIO from '~/queries/CreateUsuario.gql'
import UPDATE_USUARIO from '~/queries/UpdateUsuario.gql'
import GRUPOS from '~/queries/Grupos.gql'
import USUARIO_ADD_GRUPO from '~/queries/UsuarioAddGrupo.gql'
import USUARIO_REMOVE_GRUPO from '~/queries/UsuarioRemoveGrupo.gql'

import axios from 'axios'

export default {
  data: () => ({
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
    Id: null,
    UserName: null,
    Password: null,
    Cedula: null,
    Nombre: null,
    Apellido: null,
    Ocupacion: null,
    Email: null,
    Direccion: null,
    Telefono: null,
    Activo: null,
    UiPassword: null,
    SelectedGrupos: [],
    OldSelectedGrupos: [],
    SelectedGruposForUi: false,
    DisableGroupSelect: true,
    ItemsActivo: [
      {text: 'Si'},
      {text: 'No'}
    ],
    ItemsGrupo: [],
    TodosUsuariosDb: [],
    loading: 0
  }),
  mounted () {
    if (sessionStorage.getItem('x-access-token') === null || sessionStorage.getItem('x-access-token') === null) {
      this.$router.push('/')
    } else {
      var Roles = JSON.parse(sessionStorage.getItem('x-access-roles'))
      this.$store.commit('security/AddRoles', Roles);
    }
  },
  apollo: {
    Usuarios: {
      query: USUARIOS,
      variables () {
        return {
          UserName: this.UserName
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Usuarios)
      }
    },
    Grupos: {
      query: GRUPOS,
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.ItemsGrupo = data.Grupos
      }
    },
  },
  watch: {
    SelectedGrupos () {
      this.CheckGrupos()
    },
    Id (value) {
      (value === null) ? this.DisableGroupSelect = true : this.DisableGroupSelect = false
    }
  },
  methods: {
    CheckGrupos () {
      if(this.Id !== null) {
        if(!this.SelectedGruposForUi) {
          if (this.SelectedGrupos.length > this.OldSelectedGrupos.length) {
            //console.log('Nuevo Rol')
            const UsuarioAddGrupo = {
              UsuarioId: this.Id,
              GrupoId: this.SelectedGrupos[this.SelectedGrupos.length-1].Id
            };

            this.$apollo.mutate ({
              mutation: USUARIO_ADD_GRUPO,
              variables: {
                UsuarioId: UsuarioAddGrupo.UsuarioId,
                GrupoId: UsuarioAddGrupo.GrupoId
            },
            loadingKey: 'loading',
            update: (store, { data: res }) => {
              //console.log(res);
              try{
                var data = store.readQuery({
                  query: USUARIOS,
                  variables: {
                    UserName: res.UsuarioAddGrupo.UserName,
                  }
                })

                for (let i=0; i<data.Usuarios.length; i++) {
                  if (data.Usuarios[i].Id === res.UsuarioAddGrupo.Id) {
                    data.Usuarios[i].Grupos = res.UsuarioAddGrupo.Grupos
                  }
                }

                store.writeQuery({
                  query: USUARIOS,
                  variables: {
                    UserName: res.UsuarioAddGrupo.UserName
                  },
                  data: data
                })

              } catch (Err) {

                var data = {Usuarios: []}

                data.Usuarios.push(res.UsuarioAddGrupo)

                store.writeQuery({
                  query: USUARIOS,
                  variables: {
                    UserName: res.UsuarioAddGrupo.UserName
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
            this.OldSelectedGrupos = this.SelectedGrupos
          }
          else if (this.SelectedGrupos.length < this.OldSelectedGrupos.length) {
            //console.log('Rol Eliminado')
            for(let i=0; i<this.OldSelectedGrupos.length; i++){
              if(this.SelectedGrupos.indexOf(this.OldSelectedGrupos[i]) === -1){

                const UsuarioRemoveGrupo = {
                  UsuarioId: this.Id,
                  GrupoId: this.OldSelectedGrupos[i].Id
                };

                this.$apollo.mutate ({
                  mutation: USUARIO_REMOVE_GRUPO,
                  variables: {
                    UsuarioId: UsuarioRemoveGrupo.UsuarioId,
                    GrupoId: UsuarioRemoveGrupo.GrupoId
                },
                loadingKey: 'loading',
                update: (store, { data: res }) => {
                  //console.log(res);
                  try{
                    var data = store.readQuery({
                      query: USUARIOS,
                      variables: {
                        UserName: res.UsuarioRemoveGrupo.UserName,
                      }
                    })

                    for (let i=0; i<data.Usuarios.length; i++) {
                      if (data.Usuarios[i].Id === res.UsuarioRemoveGrupo.Id) {
                        data.Usuarios[i].Grupos = res.UsuarioRemoveGrupo.Grupos
                      }
                    }

                    store.writeQuery({
                      query: USUARIOS,
                      variables: {
                        UserName: res.UsuarioRemoveGrupo.UserName
                      },
                      data: data
                    })

                  } catch (Err) {

                    var data = {Usuarios: []}

                    data.Usuarios.push(res.UsuarioRemoveGrupo)

                    store.writeQuery({
                      query: USUARIOS,
                      variables: {
                        UserName: res.UsuarioRemoveGrupo.UserName
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
                break
              }
            }
            this.OldSelectedGrupos = this.SelectedGrupos
          }
        }
        this.SelectedGruposForUi = false
      }
    },
    CryptPassword (){
      if (this.UiPassword !== null && this.UiPassword !== '') {
        axios.get(`/backend/generatepassword/${this.UiPassword}`).then(res => {
          this.Password = res.data.Password
          console.log(this.Password)
          this.CreateOrUpdate()
        }).catch(err => {
          console.log(err)
        });
      } else {
        this.CreateOrUpdate()
      }
    },
    CreateOrUpdate () {
      if (this.Id === null) {
        this.Create();
      }else{
        this.Update();
      }
    },
    Create () {
      const User = {
        UserName: this.UserName,
        Password: this.Password,
        Cedula: this.Cedula,
        Nombre: this.Nombre,
        Apellido: this.Apellido,
        Ocupacion: this.Ocupacion,
        Email: this.Email,
        Direccion: this.Direccion,
        Telefono: this.Telefono,
        Activo: this.Activo
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_USUARIO,
        variables: {
          UserName: User.UserName,
          Password: User.Password,
          Cedula: User.Cedula,
          Nombre: User.Nombre,
          Apellido: User.Apellido,
          Ocupacion: User.Ocupacion,
          Email: User.Email,
          Direccion: User.Direccion,
          Telefono: User.Telefono,
          Activo: User.Activo
      },
      loadingKey: 'loading',
      update: (store, { data: res }) => {
        //console.log(Ente);
        try{
          var data = store.readQuery({
            query: USUARIOS,
            variables: {
              UserName: res.CreateUsuario.UserName,
            }
          })

          data.Usuarios.push(res.CreateUsuario)

          store.writeQuery({
            query: USUARIOS,
            variables: {
              UserName: res.CreateUsuario.UserName
            },
            data: data
          })

        } catch (Err) {

          var data = {Usuarios: []}

          data.Usuarios.push(res.CreateUsuario)

          store.writeQuery({
            query: USUARIOS,
            variables: {
              UserName: res.CreateUsuario.UserName
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
      //console.log(this.Password)
      const User = {
        Id: this.Id,
        UserName: this.UserName,
        Password: this.Password,
        Cedula: this.Cedula,
        Nombre: this.Nombre,
        Apellido: this.Apellido,
        Ocupacion: this.Ocupacion,
        Email: this.Email,
        Direccion: this.Direccion,
        Telefono: this.Telefono,
        Activo: this.Activo
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_USUARIO,
        variables: {
          Id: User.Id,
          UserName: User.UserName,
          Password: User.Password,
          Cedula: User.Cedula,
          Nombre: User.Nombre,
          Apellido: User.Apellido,
          Ocupacion: User.Ocupacion,
          Email: User.Email,
          Direccion: User.Direccion,
          Telefono: User.Telefono,
          Activo: User.Activo
        },
        loadingKey: 'loading',
        update: (store, { data: res }) => {
          //console.log(Ente);
          try {
            var data = store.readQuery({
              query: USUARIOS,
              variables: {
                UserName: res.UpdateUsuario.UserName
              }
            })

            for (let i=0; i<data.Usuarios.length; i++) {
              if (data.Usuarios[i].Id === res.UpdateUsuario.Id) {
                data.Usuarios[i].UserName = res.UpdateUsuario.UserName
                data.Usuarios[i].Password = res.UpdateUsuario.Password
                data.Usuarios[i].Cedula = res.UpdateUsuario.Cedula
                data.Usuarios[i].Nombre = res.UpdateUsuario.Nombre
                data.Usuarios[i].Apellido = res.UpdateUsuario.Apellido
                data.Usuarios[i].Ocupacion = res.UpdateUsuario.Ocupacion
                data.Usuarios[i].Email = res.UpdateUsuario.Email
                data.Usuarios[i].Direccion = res.UpdateUsuario.Direccion
                data.Usuarios[i].Telefono = res.UpdateUsuario.Telefono
                data.Usuarios[i].Activo = res.UpdateUsuario.Activo
              }
            }

            store.writeQuery({
              query: USUARIOS,
              variables: {
                UserName: res.UpdateUsuario.UserName
              },
              data: data
            })

          } catch (Err) {

            var data = {Usuarios: []}

            data.Usuarios.push(res.UpdateUsuario)

            store.writeQuery({
              query: USUARIOS,
              variables: {
                UserName: res.UpdateUsuario.UserName
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
      this.UserName = null
      this.Password = null
      this.Cedula = null
      this.Nombre = null
      this.Apellido = null
      this.Ocupacion = null
      this.Email = null
      this.Direccion = null
      this.Telefono = null
      this.UiPassword = null
      this.Activo = null
      this.SelectedGrupos = []
    },
    LoadUi (Usuarios) {
      if( Usuarios.length === 0 ) {
        this.Id = null
        this.Password = null
        this.Cedula = null
        this.Nombre = null
        this.Apellido = null
        this.Ocupacion = null
        this.Email = null
        this.Direccion = null
        this.Telefono = null
        this.UiPassword = null
        this.Activo = null
        this.SelectedGrupos = []
        this.OldSelectedGrupos = []
      }

      for (let i=0; i<Usuarios.length; i++) {
        if ( this.UserName === Usuarios[i].UserName ) {
          this.Id = Usuarios[i].Id
          this.UserName = Usuarios[i].UserName
          this.Password = Usuarios[i].Password
          this.Cedula = Usuarios[i].Cedula
          this.Nombre = Usuarios[i].Nombre
          this.Apellido = Usuarios[i].Apellido
          this.Ocupacion = Usuarios[i].Ocupacion
          this.Email = Usuarios[i].Email
          this.Direccion = Usuarios[i].Direccion
          this.Telefono = Usuarios[i].Telefono
          this.Activo = Usuarios[i].Activo
          this.SelectedGruposForUi = true
          this.SelectedGrupos = Usuarios[i].Grupos
          this.OldSelectedGrupos = Usuarios[i].Grupos
          break
        }else{
          this.Id = null
          this.Password = null
          this.Cedula = null
          this.Nombre = null
          this.Apellido = null
          this.Ocupacion = null
          this.Email = null
          this.Direccion = null
          this.Telefono = null
          this.Activo = null
          this.UiPassword = null
          this.SelectedGrupos = []
          this.OldSelectedGrupos = []
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
