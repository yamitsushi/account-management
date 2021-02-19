export default {
	purge: ({commit}) => {
		commit('purge')
	},
	loadUsers: ({commit}, payload) => {
		commit('setUsers', payload)
	},
	loadRoles: ({commit}, payload) => {
		commit('setRoles', payload)
	},
	loadPermissions: ({commit}, payload) => {
		commit('setPermissions', payload)
	},

	addRole: ({commit}, payload) => {
		commit('addRole', payload)
	},
	updateRole: ({commit}, payload) => {
		commit('updateRole', payload)
	},
	deleteRole: ({commit}, payload) => {
		commit('deleteRole', payload)
	},

	addUser: ({commit}, payload) => {
		commit('addUser', payload)
	},
	updateUser: ({commit}, payload) => {
		commit('updateUser', payload)
	}
}