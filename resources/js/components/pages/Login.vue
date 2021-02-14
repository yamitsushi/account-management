<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7 col-lg-5">
				<div class="card o-hidden shadow-lg my-5 card-border">
					<div class="card-body text-center">
						<div class="p-0">
							<img src="https://via.placeholder.com/500x100?text=Demo+Management" width="100%">
						</div>
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
							</div>
							<form v-if="isReady">
								<div class="form-group">
									<input type="string" class="form-control form-control-user" v-model="loginData['username']" placeholder="Username">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" v-model="loginData['password']" placeholder="Password">
								</div>
								<a v-on:click="login()" class="btn btn-primary btn-user btn-block btn-maroon">
									Login
								</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import { mapActions } from 'vuex'
	import router from '@/router/index'

	export default {
		data() {
			return {
				loginData : {
					username : null,
					password : null
				},
				isReady : false
			}
		},
		methods: {
			...mapActions('user', [
				'setUsername'
				]),
			login() {
				axios.get('/sanctum/csrf-cookie').then(response => {
					axios.post("/login", this.loginData).then(response => {
						this.setUsername(response.data)
						router.push({ name:'dashboard' })
					}).catch(error => {
						alert(error.response.data.message)
					})
				});
			}
		},
		mounted() {
			axios.get("/api/check").then(response => {
				this.setUsername(response.data)
				router.push({ name:'dashboard' })
			}).catch(error => {
				this.isReady = true
			})
		}
	}
</script>