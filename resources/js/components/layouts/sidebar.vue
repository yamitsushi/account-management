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
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle" v-on:click="toggleSidebar"></button>
        </div>
    </ul>
</template>
<script>
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
                return this.$route.name == name ? "active" : ""
            }
        }
    }
</script>