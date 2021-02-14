import store from '@/store'

export default function ready({ next, router }) {
	if (!store.getters['user/ready']) {
		return router.push({ name: 'preload' });
	}
	return next();
}