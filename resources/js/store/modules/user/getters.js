export default {
	username: state => state.username,
	ready: state => state.ready,
	permissions: state => state.permissions,
	isSuperAdmin: state => state.permissions.find(data => data[0] == "SUPER_ADMINISTRATOR"),
	checkPermission: (state) => (action) => state.permissions.find(data => data[1] == action),
	checkAction: (state) => (method, action) => state.permissions.find(data => (data[0] == method && data[1] == action))
}