<template>
	<router-view/>
</template>
<script>
	import permit from '@/utils/permit'
	import { mapGetters, mapActions } from 'vuex'

	export default {
		methods: {
			...mapActions('account', [
				'loadUsers',
				'loadRoles',
				'loadPermissions'
				])
		},
		computed :{
			...mapGetters('account', [
				'usersLoaded',
				'rolesLoaded',
				'permissionsLoaded'
				])
		},
		mounted() {
			if (!this.usersLoaded && permit('USER.READ')) {
				axios.get("/api/account/user").then(response => {
					this.loadUsers(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}

			if (!this.rolesLoaded && permit('ROLE.READ')) {
				axios.get("/api/account/role").then(response => {
					this.loadRoles(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}

			if (!this.permissionsLoaded && permit('PERMISSION.READ')) {
				axios.get("/api/account/permission").then(response => {
					this.loadPermissions(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}
		}
	}
</script>