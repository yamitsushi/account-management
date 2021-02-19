export default {
	users: state => state.users,
	roles: state => state.roles,
	permissions: state => state.permissions,

	usersLoaded: state => state.usersLoaded,
	rolesLoaded: state => state.rolesLoaded,
	permissionsLoaded: state => state.permissionsLoaded,

	totalUsers: state => state.users ? state.users.length : "Loading",
	activeUsers: state => state.users ? state.users.filter(data => !data.deleted_at).length : "Loading",
	deletedUsers: state => state.users ? state.users.filter(data => data.deleted_at).length : "Loading",

	totalRoles: state => state.roles ? state.roles.length : "loading",
	totalPermissions: state => state.permissions ? state.permissions.length : "loading"
}