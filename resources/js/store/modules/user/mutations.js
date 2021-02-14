import defaultState from './state'

export default {
	setUsername (state, payload) {
		state.username = payload ?? null
	},
	setReady (state, payload) {
		state.ready = payload
	},
	purge (state) {
		Object.assign(state, defaultState)
	}
}