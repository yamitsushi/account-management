require('./bootstrap');

import Vue from 'vue'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import store from './store'
import router from './router'

new Vue({
	template: `<router-view/>`,
	store,
	router
}).$mount('#app')