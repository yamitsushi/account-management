export default {
	setUsername: ({commit}, payload) => {
		commit('setUsername', payload)

	},
	purge: ({commit}) => {
		commit('purge')

	},
	preload: ({commit}, payload) => {
		commit('setReady', payload)
	}
}