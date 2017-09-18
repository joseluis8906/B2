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

  v-flex( xs12 mt-3 md8 lg6 )
    v-card
      v-layout(row wrap pt-3 light-blue)
        v-flex( xs12 )
          h5(class="grey--text text--lighten-4 text-xs-center bold")
            v-icon(ma) person
            |  Usuario
      v-card-text
        v-layout( row wrap)
          v-flex( xs12 )
            v-text-field( label="Nombre De Usuario" v-model="UserName" dark )

            v-text-field( label="Contraseña" v-model="UiPassword" type="Password" maxlength="4" dark )

            v-select( v-bind:items="ItemsActive"
                      v-model="Active"
                      label="Activo"
                      item-value="text"
                      dark )

            v-select( label="Grupos"
                      v-bind:items="ItemsGroup"
                      v-model="SelectedGrupos"
                      item-text="Name"
                      item-value="Id"
                      multiple
                      chips
                      hint="Roles Seleccionados"
                      persistent-hint
                      return-object
                      class="select-special"
                      :disabled="DisableGroupSelect")

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
      context: 'secondary',
      mode: '',
      timeout: 6000,
      text: 'Cargando'
    },
    Id: null,
    UserName: null,
    Password: null,
    Active: null,
    UiPassword: null,
    SelectedGrupos: [],
    OldSelectedGrupos: [],
    SelectedGruposForUi: false,
    DisableGroupSelect: true,
    ItemsActive: [
      {text: 'Si'},
      {text: 'No'}
    ],
    ItemsGroup: [],
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
  apollo: {
    Users: {
      query: USUARIOS,
      variables () {
        return {
          UserName: this.UserName
        }
      },
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.LoadUi(data.Users)
      }
    },
    Grupos: {
      query: GRUPOS,
      loadingKey: 'loading',
      update (data) {
        //console.log(data)
        this.ItemsGroup = data.Grupos
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
              UserId: this.Id,
              GroupId: this.SelectedGrupos[this.SelectedGrupos.length-1].Id
            };

            this.$apollo.mutate ({
              mutation: USUARIO_ADD_GRUPO,
              variables: {
                UserId: UsuarioAddGrupo.UserId,
                GroupId: UsuarioAddGrupo.GroupId
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

                for (let i=0; i<data.Users.length; i++) {
                  if (data.Users[i].Id === res.UsuarioAddGrupo.Id) {
                    data.Users[i].Grupos = res.UsuarioAddGrupo.Grupos
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

                var data = {Users: []}

                data.Users.push(res.UsuarioAddGrupo)

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
                  UserId: this.Id,
                  GroupId: this.OldSelectedGrupos[i].Id
                };

                this.$apollo.mutate ({
                  mutation: USUARIO_REMOVE_GRUPO,
                  variables: {
                    UserId: UsuarioRemoveGrupo.UserId,
                    GroupId: UsuarioRemoveGrupo.GroupId
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

                    for (let i=0; i<data.Users.length; i++) {
                      if (data.Users[i].Id === res.UsuarioRemoveGrupo.Id) {
                        data.Users[i].Grupos = res.UsuarioRemoveGrupo.Grupos
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

                    var data = {Users: []}

                    data.Users.push(res.UsuarioRemoveGrupo)

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
        Active: this.Active,
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: CREATE_USUARIO,
        variables: {
          UserName: User.UserName,
          Password: User.Password,
          Active: User.Active
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

          data.Users.push(res.CreateUsuario)

          store.writeQuery({
            query: USUARIOS,
            variables: {
              UserName: res.CreateUsuario.UserName
            },
            data: data
          })

        } catch (Err) {

          var data = {Users: []}

          data.Users.push(res.CreateUsuario)

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
        Active: this.Active
      };

      this.Reset ();

      this.$apollo.mutate ({
        mutation: UPDATE_USUARIO,
        variables: {
          Id: User.Id,
          UserName: User.UserName,
          Password: User.Password,
          Active: User.Active
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

            for (let i=0; i<data.Users.length; i++) {
              if (data.Users[i].Id === res.UpdateUsuario.Id) {
                data.Users[i].UserName = res.UpdateUsuario.UserName
                data.Users[i].Password = res.UpdateUsuario.Password
                data.Users[i].Active = res.UpdateUsuario.Active
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

            var data = {Users: []}

            data.Users.push(res.UpdateUsuario)

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
      this.UiPassword = null
      this.Active = null
      this.SelectedGrupos = []
    },
    LoadUi (Users) {
      if( Users.length === 0 ) {
        this.Id = null
        this.Password = null
        this.UiPassword = null
        this.Active = null
        this.SelectedGrupos = []
        this.OldSelectedGrupos = []
      }

      for (let i=0; i<Users.length; i++) {
        if ( this.UserName === Users[i].UserName ) {
          this.Id = Users[i].Id
          this.UserName = Users[i].UserName
          this.Password = Users[i].Password
          this.Active = Users[i].Active
          this.SelectedGruposForUi = true
          this.SelectedGrupos = Users[i].Grupos
          this.OldSelectedGrupos = Users[i].Grupos
          break
        }else{
          this.Id = null
          this.Password = null
          this.UiPassword = null
          this.Active = null
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
