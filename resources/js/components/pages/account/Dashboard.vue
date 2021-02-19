<template>
	<div class="container-fluid">
		<h1 class="h3 mb-4 text-gray-800">Account Dashboard</h1>

		<div class="row">
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Users</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ this.totalUsers }}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-users fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Active Users</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ this.activeUsers }}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user-friends fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-danger shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Deleted Users</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ this.deletedUsers }}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-users-slash fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Roles</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ this.totalRoles }}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user-tag fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Permissions</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{ this.totalPermissions }}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user-cog fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
    import { mapGetters } from 'vuex'
    
	export default {
		computed :{
			...mapGetters('account', [
				'totalUsers',
				'activeUsers',
				'deletedUsers',

				'totalRoles',
				'totalPermissions'
				])
		}
	}
</script>