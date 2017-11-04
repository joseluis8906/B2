export const state = {
  UserName: null,
  Roles: null
}

export const mutations = {
  AddRoles (state, Roles) {
    state.Roles = Roles
  },
  SetUserName (state, UserName) {
    state.UserName = UserName
  }
}
