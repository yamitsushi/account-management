import store from '@/store'

export default function permit(rule) {
	if(store.getters['user/isSuperAdmin']) return true

	return store.getters['user/checkPermission'](rule) ? true : false
}