import store from '@/store'

export default function guest({ next, router }) {
	if (store.getters['user/username']) {
		return router.push({ name: 'dashboard' });
	}
	return next();
}