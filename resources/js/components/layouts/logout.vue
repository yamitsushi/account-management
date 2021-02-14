<template>
	<div>
		<a class="dropdown-item" v-b-modal.logout>
			<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
			Logout
		</a>
		<b-modal class="in" id="logout" title="Ready to Leave?">
			<template #default>
				Select "Logout" below if you are ready to end your current session.
			</template>

			<template #modal-footer="{ cancel }">
				<b-button variant="secondary" @click="cancel()">
					Cancel
				</b-button>
				<b-button variant="primary" @click="logout()">
					Logout
				</b-button>
			</template>
		</b-modal>
	</div>
</template>
<script>
	import { mapActions, mapGetters } from 'vuex'
	import router from '@/router/index'

	export default {
		data() {
			return {
				showing : false
			}
		},
		methods: {
			...mapActions('user', [
				'purge',
				]),
			logout() {
				axios.post("/logout").then(response => {
					this.purge()
					router.push({ name:'login' })
				}).catch(error => {
					alert(error.response.data.message)
				})
			}
		}
	}
</script>
