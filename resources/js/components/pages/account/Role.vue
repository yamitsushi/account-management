<template>
	<div class="container-fluid">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-4 text-gray-800">Role Dashboard</h1>
		</div>

		<div class="card shadow mb-4">
			<div class="card-header d-sm-flex align-items-center justify-content-between py-3">
				<h6 class="m-0 font-weight-bold text-primary">Roles Table</h6>

				<a class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" v-b-modal.add>
					<i class="fas fa-plus-circle"></i>
					Add Role
				</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<vue-good-table :columns="columns" :rows="this.roles" :search-options="{enabled: true}">
						<template slot="emptystate">
							Please Wait
						</template>
						<template slot="table-row" slot-scope="props" >
							<b-row v-if="props.column.field == 'permissions'">
								<b-col v-for="permission in props.row.permissions" :key="permission.action.join('.')">
									<b-badge variant="primary">{{ permission.action.join(" ") }}</b-badge>
								</b-col>
							</b-row>
							<span v-else-if="props.column.field == 'action'">
								<b-button-group size="md">
									<b-button variant="info" @click="showUpdateForm(props.row)">Edit</b-button>
									<b-button variant="warning" @click="showDeleteForm(props.row)">Delete</b-button>
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

		<b-modal id="add" title="Add New Role">
			<template #default>
				<div class="form-group">
					<input type="string" class="form-control form-control-user" v-model="addForm['name']" placeholder="Role Name">
				</div>
				<div class="form-group">
					<label>Allowed Permissions</label>
					<b-form-input list="add-permission-list" v-model="addForm['temp-permission']" v-on:keyup.enter="addPermissionForm"/>
					<datalist id="add-permission-list">
						<option v-for="permission in permissions">{{ permission.action.join(' ') }}</option>
					</datalist>
					<b-row>
						<b-col v-for="(item, index) in addForm['permissions']" :key="item.action.join('.')">
							<span class="badge badge-pill badge-success" @click="addPermissionRemoveForm(index)">
							{{ item.action.join(" ") }}
						</span>
						</b-col>
					</b-row>
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

		<b-modal id="update" title="Update Role">
			<template #default>
				<div class="form-group">
					<label>Role Name</label>
					<input type="string" class="form-control form-control-user" v-model="updateForm['name']" placeholder="Role Name" disabled>
				</div>
				<div class="form-group">
					<label>Allowed Permissions</label>
					<b-form-input list="update-permission-list" v-model="updateForm['temp-permission']" v-on:keyup.enter="updatePermissionForm"/>
					<datalist id="update-permission-list">
						<option v-for="permission in permissions">{{ permission.action.join(' ') }}</option>
					</datalist>
					<b-row>
						<b-col v-for="(item, index) in updateForm['permissions']" :key="item">
							<span class="badge badge-pill badge-success" @click="updatePermissionRemoveForm(index)">{{ item }}</span>
						</b-col>
					</b-row>
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

		<b-modal id="delete" title="Delete Role">
			<template #default>
				<div class="form-group">
					<label>Role Name</label>
					<input type="string" class="form-control form-control-user" v-model="deleteForm['name']" placeholder="Role Name" disabled>
				</div>
			</template>

			<template #modal-footer="{ cancel }">
				<b-button variant="secondary" @click="cancel()">
					Cancel
				</b-button>
				<b-button variant="danger" @click="deleteFormSend()">
					Delete
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
				'roles',
				'permissions'
				])
		},
		data(){
			return {
				addForm : {
					name: null,
					permissions: []
				},
				updateForm: {
					name: null,
					permissions: []
				},
				deleteForm: [],
				columns: [
				{
					label: 'Name',
					field: 'name',
					tdClass: 'text-center',
					thClass: 'text-center',
					width: '200px',
				},
				{
					label: 'Permissions',
					field: 'permissions',
				},
				{
					label: 'Action',
					field: 'action',
					sortable: false,
					tdClass: 'text-center',
					thClass: 'text-center',
					width: '200px',
				}]
			};
		},
		methods: {
			...mapActions('account', [
				'addRole',
				'updateRole',
				'deleteRole'
				]),

			addPermissionForm() {
				if (!this.addForm['permissions'].includes(this.addForm['temp-permission'])) {
					this.addForm['permissions'].push( { action : this.addForm['temp-permission'].split(' ') } )
				}
				this.addForm['temp-permission'] = null
			},
			addPermissionRemoveForm(index) {
				this.addForm['permissions'].splice(index, 1);
			},
			addFormSend() {
				axios.post("/api/account/role", this.addForm).then(response => {
					this.addRole(response.data)
				}).catch(error => {
					alert(error.response.data.message)
				})
			},


			showUpdateForm(row) {
				this.updateForm['id'] = row.id
				this.updateForm['index'] = row.originalIndex
				this.updateForm['name'] = row.name
				this.updateForm['permissions'] = []
				row.permissions.forEach((value, index) => {
					this.updateForm['permissions'].push(value.action.join(" "))
				})
				this.$bvModal.show('update')
			},
			updatePermissionForm() {
				if (!this.updateForm['permissions'].includes(this.updateForm['temp-permission'])) {
					this.updateForm['permissions'].push( this.updateForm['temp-permission'] )
				}
				this.updateForm['temp-permission'] = null
			},
			updatePermissionRemoveForm(index) {
				this.updateForm['permissions'].splice(index, 1);
			},
			updateFormSend() {
				axios.patch("/api/account/role/" + this.updateForm.id, this.updateForm).then(response => {
					response.index = this.updateForm.index
					this.updateRole(response)
				}).catch(error => {
					alert(error.response.data.message)
				})
			},


			showDeleteForm(row) {
				this.deleteForm = row
				this.$bvModal.show('delete')
			},
			deleteFormSend() {
				axios.delete("/api/account/role/" + this.deleteForm.id).then(response => {
					this.deleteRole(this.deleteForm.originalIndex)
				}).catch(error => {
					alert(error.response.data.message)
				})
			}
		}
	}
</script>