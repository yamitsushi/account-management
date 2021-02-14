<template>
    <div id="wrapper">
        <sidebar :isHidden="sidebar" @toggleSidebar="hideSidebar"/>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navigation @toggleSidebar="hideSidebar"/>
                <router-view/>
            </div>
            <copywrite/>
        </div>
    </div>
</template>

<script>
    import sidebar from './sidebar'
    import navigation from './navigation'
    import copywrite from './copywrite'
    
    export default {
        data() {
            return {
                sidebar : false
            }
        },
        components: {
            sidebar,
            navigation,
            copywrite
        },
        methods: {
            hideSidebar() {
                this.sidebar = this.sidebar ? false : true;
            }
        }
    }
</script>