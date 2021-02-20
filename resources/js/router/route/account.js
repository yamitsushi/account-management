import auth from '../middleware/auth'
import ready from '../middleware/ready'

import Preload from "@/components/pages/account/Preload"

import Dashboard from "@/components/pages/account/Dashboard"
import User from "@/components/pages/account/User"
import Role from "@/components/pages/account/Role"

export default {
	path: 'account',
	component: Preload,
	children: [
	{
		path: '/',
		name: 'account.dashboard',
		component: Dashboard,
		meta: {
			middleware: [auth, ready],
			permit: ['USER', 'ROLE']
		}
	},
	{
		path: 'user',
		name: 'account.user',
		component: User,
		meta: {
			middleware: [auth, ready],
			permit: ['USER']
		}
	},
	{
		path: 'role',
		name: 'account.role',
		component: Role,
		meta: {
			middleware: [auth, ready],
			permit: ['ROLE']
		}
	}]
}