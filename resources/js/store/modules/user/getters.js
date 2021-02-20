export default {
	username: state => state.username,
	ready: state => state.ready,
	permissions: state => state.permissions,
	isSuperAdmin: state => state.permissions.find(data => data == "SUPER_ADMINISTRATOR"),
	checkPermission: (state) => (action) => state.permissions.find(data => data.split('.')[0] == action),
	checkAction: (state) => (action, method) => state.permissions.find(data => (data.split('.')[0] == method && data.split('.')[1] == action))
}