import store from '@/store'

export default function permit(rule) {
	return store.getters['user/permissions'].includes(rule)
}