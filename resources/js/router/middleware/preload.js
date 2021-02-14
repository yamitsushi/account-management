import store from '@/store'

export default function preload({ next, router }) {
	if (store.getters['user/ready']) {
		return router.push({ name: 'dashboard' });
	}
	return next();
}