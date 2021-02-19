export default {
	setUsername: ({commit}, payload) => {
		commit('setUsername', payload)

	},
	purge: ({commit}) => {
		commit('purge')

	},
	loadPermission: ({commit}, payload) => {
		commit('setPermissions', payload)
		commit('setReady', true)
	}
}