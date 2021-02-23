<template>
	<div class="container-fluid">
		<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
		<b-row>
			<b-col>
				<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Account Permission Guide</h6>
					</div>
					<div class="card-body">
						Here are the List of default Tables<br>
						USER<br>
						ROLE<br>
						PERMISSION<br><br>
						This are the link of the default Tables<br>
						ROLE_USER<br>
						PERMISSION_ROLE<br><br>
						Followed by a dot, it is a method of the permission<br>
						READ => access the table<br>
						CREATE => create a record<br>
						UPDATE => update an existing record<br>
						DELETE => delete a record<br>
						PROVIDE => specific to link, this permit a user to make a link<br>
					</div>
				</div>
			</b-col>
			<b-col>
				<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Vue Authorization</h6>
					</div>
					<div class="card-body">
						just import the provided authorization<br>
						import permit from "@util/permit"<br><br>
						to use make a method like this<br>
						can (roles) {<br>
							return permit(roles)<br>
					}<br>
					if authorize, it will return true otherwise false<br>
					you can pass 1 to check if user is authorized<br>
					you can also pass array to check is user is authorized in any of the given permission
					</div>
				</div>
			</b-col>
		</b-row>
	</div>
</template>