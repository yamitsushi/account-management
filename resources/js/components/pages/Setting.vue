<template>
	<div class="container-fluid">
		<h1 class="h3 mb-4 text-gray-800">Settings</h1>
		<div class="row">
			<div class="col-lg-6">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
					</div>
					<div class="card-body">
						<div class="alert alert-success" role="alert" v-if="passSuccess">
							Password Changed Successfully
						</div>
						<b-row class="my-1">
							<b-col sm="3">
								<label>Old Password:</label>
							</b-col>
							<b-col sm="9">
								<b-form-input v-model="passData['old_password']" type="password" placeholder="Old Password"/>
							</b-col>
						</b-row>

						<b-row class="my-1">
							<b-col sm="3">
								<label>New Password:</label>
							</b-col>
							<b-col sm="9">
								<b-form-input v-model="passData['password']" type="password" placeholder="Password"/>
							</b-col>
						</b-row>

						<b-row class="my-1">
							<b-col sm="3">
								<label>Confirm Password:</label>
							</b-col>
							<b-col sm="9">
								<b-form-input v-model="passData['confirm_password']" type="password" placeholder="Confirm Password"/>
							</b-col>
						</b-row>
						<a v-on:click="changePassword()" class="btn btn-primary btn-user btn-block btn-maroon">
							Change Password
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				"passData" : {
					"old_password": null,
					"password": null,
					"confirm_password": null
				},
				"passSuccess" : false 
			}
		},
		methods: {
			changePassword () {
				axios.post("/api/change-password", this.passData).then(response => {
					this.passSuccess = true
				}).catch(error => {
					alert(error.response.data.message)
				})
			},
		},

	}
</script>