export const state = {
  Tipo: null,
  Fecha: null,
  Cliente: null,
  Envase: null,
  FechaInicial: null,
  FechaFinal: null
}

export const mutations = {
  changeTipo (state, Tipo) {
    state.Tipo = Tipo
  },
  changeFecha (state, Fecha) {
    state.Fecha = Fecha
  },
  changeCliente (state, Cliente) {
    state.Cliente = Cliente
  },
  changeEnvase (state, Envase) {
    state.Envase = Envase
  },
  changeFechaInicial (state, FechaInicial) {
    state.FechaInicial = FechaInicial
  },
  changeFechaFinal (state, FechaFinal) {
    state.FechaFinal = FechaFinal
  }
}

