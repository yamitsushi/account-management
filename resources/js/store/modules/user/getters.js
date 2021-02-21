export default {
	username: state => state.username,
	ready: state => state.ready,
	permissions: state => state.permissions,
	isSuperAdmin: state => state.permissions.find(data => data == "SUPER_ADMINISTRATOR"),
	checkPermission: (state) => (action) => state.permissions.find(data => data == action)
}