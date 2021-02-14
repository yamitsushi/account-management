import state from './state.js'
import getters from './getters.js'
import actions from './actions'
import mutations from './mutations'

export default {
	namespaced: true,
	state() {
		return {...state}
	},
	getters,
	actions,
	mutations
}