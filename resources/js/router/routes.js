import auth from './middleware/auth'
import guest from './middleware/guest'
import preload from './middleware/preload'
import ready from './middleware/ready'


import Template from "@/components/layouts/Template"

import Missing from "@/components/pages/Missing"

import Login from "@/components/pages/Login"
import Setting from "@/components/pages/Setting"
import Loading from "@/components/pages/Loading"
import Dashboard from "@/components/pages/Dashboard"

const Empty = { template: '<router-view/>' }

export default [
{
	path: '/login',
	component: Login,
	meta: { middleware: [guest] },
	name: 'login'
},
{
	path: '/',
	component: Template,
	children: [
	{
		path: '/',
		name: 'dashboard',
		component: Dashboard,
		meta: { middleware: [auth, ready]}
	},
	{
		path: 'setting',
		name: 'setting',
		component: Setting,
		meta: { middleware: [auth, ready]}
	},
	{
		path: '/loading',
		component: Loading,
		meta: { middleware: [auth, preload] },
		name: 'preload'
	},
	{
		path: '*',
		component: Missing,
		meta: { middleware: [auth, ready] }
	}]
}]