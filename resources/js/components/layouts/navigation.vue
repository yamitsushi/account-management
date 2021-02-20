<template>
	<b-navbar class="bg-white topbar mb-4 static-top shadow accordion" type="light" variant="info">
	    <button class="btn btn-link d-md-none rounded-circle mr-3" v-on:click="sidebar">
	        <i class="fa fa-bars"></i>
	    </button>
	    <ul class="navbar-nav ml-auto">
	        <li class="nav-item dropdown no-arrow mx-1">
	            <a class="nav-link" id="alertsDropdown" v-on:click="showDropdown('alert')">
	                <i class="fas fa-bell fa-fw"></i>
	                <span class="badge badge-danger badge-counter" v-if="alertCount">{{ alertCount }}</span>
	            </a>
	            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" v-bind:class="toggleAlert()">
	                <h6 class="dropdown-header">
	                    System Alert
	                </h6>
	                <a class="dropdown-item d-flex align-items-center" v-for="alert in alerts">
	                    <div class="mr-3">
	                        <div class="icon-circle bg-primary">
	                            <i class="fas fa-file-alt text-white"></i>
	                        </div>
	                    </div>
	                    <div>
	                        <div class="small text-gray-500">{{ alert.date }}</div>
	                        <span class="font-weight-bold">{{ alert.message }}</span>
	                    </div>
	                </a>
	                <a class="dropdown-item text-center small text-gray-500">Show All Alerts</a>
	            </div>
	        </li>
	        <div class="topbar-divider d-none d-sm-block"></div>
	        <li class="nav-item dropdown no-arrow">
	            <a class="nav-link" id="userDropdown" v-on:click="showDropdown('user')">
	                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ this.username }}</span>
	                <img class="img-profile rounded-circle"
	                    src="img/undraw_profile.svg">
	            </a>
	            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" v-bind:class="toggleUser()">
		            <router-link class="dropdown-item" :to="{ name : 'setting'}">
	                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
	                    Settings
		            </router-link>
	                <logout/>
	            </div>
	        </li>
	    </ul>
	</b-navbar>
</template>
<script>
	import { mapGetters } from 'vuex'
	import logout from './logout'

	export default {
        components: {
            logout
        },
		data() {
			return {
				alerts : [
					{
						'date' : "January 01, 1997",
						'message': "Birthday of Russel Dave Cruz"
					}
				],
				alertCount: 1,
				dropdown : ""
			}
		},
		computed :{
			...mapGetters('user', [
				'username'
				]),
		},
		methods: {
			sidebar (event) {
				this.$emit('toggleSidebar')
			},
			toggleAlert() {
                return this.dropdown == "alert" ? "show" : ""
			},
			toggleUser() {
                return this.dropdown == "user" ? "show" : ""
			},
			showDropdown(value) {
				if(this.dropdown == value) this.dropdown = ""
				else this.dropdown = value
			}
		},
		watch: {
			dropdown: function (val, old) {
				this.alertCount = (old == "alert") ? 0 : this.alertCount
			}
		}
	}
</script>