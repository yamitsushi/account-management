<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"  v-bind:class="hideSidebar()">
        <router-link class="sidebar-brand d-flex align-items-center justify-content-center" :to="{ name : 'dashboard'}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Demo Management</div>
        </router-link>
        <hr class="sidebar-divider my-0">
        <li class="nav-item" v-bind:class="isActive('dashboard')">
            <router-link class="nav-link" :to="{ name : 'dashboard'}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>
        <div class="sidebar-heading">
            Interface
        </div>
        <li class="nav-item" v-bind:class="isActive('account')" v-if="can(['USER', 'ROLE'])">
            <a class="nav-link" v-b-toggle href="#collapseTwo" @click.prevent>
                <i class="fas fa-hotel"></i>
                <span>Account</span>
            </a>
            <b-collapse id="collapseTwo">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Account Controller:</h6>
                    <router-link class="collapse-item" :to="{ name : 'account.dashboard'}" exact-path>
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </router-link>
                    <router-link class="collapse-item" :to="{ name : 'account.user'}" v-if="can('USER')" exact-path>
                        <i class="fas fa-fw fa-users"></i>
                        <span>User Controller</span>
                    </router-link>
                    <router-link class="collapse-item" :to="{ name : 'account.role'}" v-if="can('ROLE')" exact-path>
                        <i class="fas fa-fw fa-user-tag"></i>
                        <span>Role Controller</span>
                    </router-link>
                </div>
            </b-collapse>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle" v-on:click="toggleSidebar"></button>
        </div>
    </ul>
</template>
<script>
    import permit from '@/utils/permit'

    export default {
        props: [
        'isHidden'
        ],
        methods: {
            toggleSidebar (event) {
                this.$emit('toggleSidebar')
            },
            hideSidebar() {
                return this.isHidden ? "toggled" : ""
            },
            isActive(name) {
                return this.$route.name.split('.')[0].includes(name) ? "active" : ""
            },
            can (roles) {
                return permit(roles)
            }
        }
    }
</script>