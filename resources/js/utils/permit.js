import store from '@/store'

export default function permit(rules) {
	if(store.getters['user/isSuperAdmin'])
		return true
	
	var checks = Array.isArray(rules) ? rules : [rules]
	var checking = false

	checks.forEach(current => {
		checking = store.getters['user/checkPermission'](current) ? true : checking
	})
	
	return checking
}