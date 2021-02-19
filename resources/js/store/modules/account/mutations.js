import defaultState from './state'

export default {
	purge (state) {
		Object.assign(state, defaultState)
	},
	setUsers (state, payload) {
		state.users = payload
		state.usersLoaded = true
	},
	setRoles (state, payload) {
		state.roles = payload
		state.rolesLoaded = true
	},
	setPermissions (state, payload) {
		state.permissions = payload
		state.PermissionsLoaded = true
	},

	addRole (state, payload) {
		state.roles.push(payload)
	},
	updateRole (state, payload) {
		Object.assign(state.roles[payload.index], payload.data)
	},
	deleteRole (state, payload) {
		state.roles.splice(payload, 1)
	},

	addUser (state, payload) {
		state.users.push(payload)
	},
	updateUser (state, payload) {
		Object.assign(state.users[payload.index], payload.data)
	}
}