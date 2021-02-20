<template>
	<div class="container-fluid">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-4 text-gray-800">User Dashboard</h1>
		</div>

		<div class="card shadow mb-4">
			<div class="card-header d-sm-flex align-items-center justify-content-between py-3">
				<h6 class="m-0 font-weight-bold text-primary">Users Table</h6>

				<a class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" v-b-modal.add>
					<i class="fas fa-plus-circle"></i>
					Add User
				</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<vue-good-table :columns="columns" :rows="this.users" :search-options="{enabled: true}">
						<template slot="table-row" slot-scope="props" >
							<span v-if="props.column.field == 'status'">
								{{ props.row.deleted_at ? 'Deactivated' : 'Active' }}
							</span>
							<b-row v-else-if="props.column.field == 'roles'">
								<b-col v-for="role in props.row.roles" :key="role.name">
									<b-badge variant="primary">{{ role.name }}</b-badge>
								</b-col>
							</b-row>
							<b-row v-else-if="props.column.field == 'permissions'">
								<b-col v-for="permission in props.row.permissions" :key="permission.action.join('.')">
									<b-badge variant="primary">{{ permission.action.join(" ") }}</b-badge>
								</b-col>
							</b-row>
							<span v-else-if="props.column.field == 'action'">
								<b-button-group size="md">
									<b-button variant="info" @click="showUpdateForm(props.row)">Update</b-button>
								</b-button-group>
							</span>
							<span v-else>
								{{ props.formattedRow[props.column.field] }}
							</span>
						</template>
					</vue-good-table>
				</div>
			</div>
		</div>

		<b-modal id="add" title="Add New User">
			<template #default>
				<div class="form-group">
					<input type="string" class="form-control form-control-user" v-model="addForm['username']" placeholder="Username">
				</div>
				<div class="form-group">
					<label>Assigned Role</label>
					<b-form-input list="add-role-list" v-model="addForm['temp-role']" v-on:keyup.enter="addRoleForm"></b-form-input>
					<datalist id="add-role-list">
						<option v-for="role in roles">{{ role.name }}</option>
					</datalist>
					<b-row>
						<b-col v-for="(item, index) in addForm['roles']" :key="item">
							<span class="badge badge-pill badge-success" @click="addRoleRemoveForm(index)">{{ item }}</span>
						</b-col>
					</b-row>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" v-model="addForm['password']" placeholder="Password">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" v-model="addForm['password_confirmation']" placeholder="Confirm Password">
				</div>
			</template>

			<template #modal-footer="{ cancel }">
				<b-button variant="secondary" @click="cancel()">
					Cancel
				</b-button>
				<b-button variant="primary" @click="addFormSend()">
					Create
				</b-button>
			</template>
		</b-modal>

		<b-modal id="update" title="Update User">
			<template #default>
				<div class="form-group">
					<label>Username</label>
					<input type="string" class="form-control form-control-user" v-model="updateForm['username']" placeholder="Username">
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" v-model="updateForm['deactivate']">
					<label>Deactivate</label>
				</div>
				<div class="form-group" v-if="!updateForm['deactivate']">
					<label>Assigned Role</label>
					<b-form-input list="update-role-list" v-model="updateForm['temp-role']" v-on:keyup.enter="updateRoleForm"></b-form-input>
					<datalist id="update-role-list">
						<option v-for="role in roles">{{ role.name }}</option>
					</datalist>
					<b-row>
						<b-col v-for="(item, index) in updateForm['roles']" :key="item">
							<span class="badge badge-pill badge-success" @click="updateRoleRemoveForm(index)">{{ item }}</span>
						</b-col>
					</b-row>
				</div>
				<div class="form-group" v-if="!updateForm['deactivate']">
					<input type="password" class="form-control" v-model="updateForm['password']" placeholder="New Password">
				</div>
				<div class="form-group" v-if="!updateForm['deactivate']">
					<input type="password" class="form-control" v-model="updateForm['password_confirmation']" placeholder="Confirm Password">
				</div>
			</template>

			<template #modal-footer="{ cancel }">
				<b-button variant="secondary" @click="cancel()">
					Cancel
				</b-button>
				<b-button variant="primary" @click="updateFormSend()">
					Update
				</b-button>
			</template>
		</b-modal>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	import { VueGoodTable } from 'vue-good-table'

	export default {
		components: {
			VueGoodTable,
		},
		computed :{
			...mapGetters('account', [
				'users',
				'roles'
				])
		},
		data(){
			return {
				columns: [
				{
					label: 'Username',
					field: 'username',
					tdClass: 'text-center',
					thClass: 'text-center',
					width: '200px',
				},
				{
					label: 'Status',
					field: 'status',
					tdClass: 'text-center',
					thClass: 'text-center',
					width: '150px',
				},
				{
					label: 'Roles',
					field: 'roles',
				},
				{
					label: 'Creation Date',
					field: 'created_at',
					width: '250px',
				},
				{
					label: 'Action',
					field: 'action',
					sortable: false,
					tdClass: 'text-center',
					thClass: 'text-center',
					width: '200px',
				}],

				addForm : {
					username: null,
					roles: []
				},
				updateForm: {
					username: null,
					roles: [],
					deactivate: false
				},
			};
		},
		methods: {
			...mapActions('account', [
				'addUser',
				'updateUser',
				'deleteUser'
				]),

			addRoleForm() {
				if (!this.addForm['roles'].includes(this.addForm['temp-role'])) {
					this.addForm['roles'].push(this.addForm['temp-role'])
				}
				this.addForm['temp-role'] = null
			},
			addRoleRemoveForm(index) {
				this.addForm['roles'].splice(index, 1);
			},
			addFormSend() {
				axios.post("/api/account/user", this.addForm).then(response => {
					this.addUser(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			},


			showUpdateForm(row) {
				this.updateForm['id'] = row.id
				this.updateForm['index'] = row.originalIndex
				this.updateForm['username'] = row.username
				this.updateForm['deactivate'] = row['deleted_at'] ? true : false
				this.updateForm['roles'] = []
				this.updateForm['password'] = []
				this.updateForm['password_confirmation'] = []
				row.roles.forEach((value, index) => {
					this.updateForm['roles'].push(value.name)
				})
				this.$bvModal.show('update')
			},
			updateRoleForm() {
				if (!this.updateForm['roles'].includes(this.updateForm['temp-role'])) {
					this.updateForm['roles'].push( this.updateForm['temp-role'] )
				}
				this.updateForm['temp-role'] = null
			},
			updateRoleRemoveForm(index) {
				this.updateForm['roles'].splice(index, 1);
			},
			updateFormSend() {
				axios.patch("/api/account/user/" + this.updateForm.id, this.updateForm).then(response => {
					response.index = this.updateForm.index
					this.updateUser(response)
				}).catch(error => {
					alert(error.response.data.message)
				})
			},
		},
	}
</script>