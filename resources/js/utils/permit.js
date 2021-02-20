import store from '@/store'

export default function permit(rules, method = null) {
	if(store.getters['user/isSuperAdmin'])
		return true
	
	var checks = Array.isArray(rules) ? rules : [rules]

	var checking = false
	checks.forEach(current => {
		if(method)
			checking = store.getters['user/checkAction'](current, method) ? true : checking
		else
			checking = store.getters['user/checkPermission'](current) ? true : checking
	})
	return checking
}