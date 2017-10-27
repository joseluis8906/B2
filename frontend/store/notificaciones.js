export const state = {
  State: 0,
  Msg: 'Por defecto',
  Icon: 'autorenew',
  Context: 'primary',
  Mode: 'multi-line',
  Timeout: 2500
}

export const mutations = {
  changeState (state, State) {
    state.State = State
  },
  changeMsg (state, Msg) {
    state.Msg = Msg
  },
  changeIcon (state, Icon) {
    state.Icon = Icon
  },
  changeContext (state, Context) {
    state.Context = Context
  }
}
