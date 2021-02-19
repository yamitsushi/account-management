<template>
	<router-view/>
</template>
<script>
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
			if (!this.usersLoaded) {
				axios.get("/api/account/user").then(response => {
					this.loadUsers(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}

			if (!this.rolesLoaded) {
				axios.get("/api/account/role").then(response => {
					this.loadRoles(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}

			if (!this.permissionsLoaded) {
				axios.get("/api/account/permission").then(response => {
					this.loadPermissions(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}
		}
	}
</script>