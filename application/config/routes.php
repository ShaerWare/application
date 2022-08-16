<?php

return [
	// MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'locale' => [
		'controller' => 'main',
		'action' => 'locale',
	],
	// MerchantController
	'merchant/perfectmoney' => [
		'controller' => 'merchant',
		'action' => 'perfectmoney',
	],
	// DashboardController
	'dashboard/tariffs' => [
		'controller' => 'dashboard',
		'action' => 'tariffs',
	],
	'dashboard/tariffs/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'tariffs',
	],
	'dashboard/invest/{id:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'invest',
	],
	'dashboard/history' => [
		'controller' => 'dashboard',
		'action' => 'history',
	],
	'dashboard/history/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'history',
	],
	'dashboard/referrals' => [
		'controller' => 'dashboard',
		'action' => 'referrals',
	],
	'dashboard/referrals/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'referrals',
	],
	'dashboard/reg' => [
		'controller' => 'dashboard',
		'action' => 'reg',
	],
	'dashboard/reg/{ref:\w+}' => [
		'controller' => 'dashboard',
		'action' => 'reg',
	],
	'dashboard/reg/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'reg',
	],
	'dashboard/swift' => [
		'controller' => 'dashboard',
		'action' => 'swift',
	],
	'dashboard/swift/{ref:\w+}' => [
		'controller' => 'dashboard',
		'action' => 'swift',
	],
	'dashboard/swift/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'swift',
	],
	'dashboard/confirm/{token:\w+}' => [
		'controller' => 'dashboard',
		'action' => 'confirm',
	],
	// AccountController
	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],
	
	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'account/register/{ref:\w+}' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'account/recovery' => [
		'controller' => 'account',
		'action' => 'recovery',
	],
	'account/confirm/{token:\w+}' => [
		'controller' => 'account',
		'action' => 'confirm',
	],
	'account/reset/{token:\w+}' => [
		'controller' => 'account',
		'action' => 'reset',
	],
	'account/profile' => [
		'controller' => 'account',
		'action' => 'profile',
	],
	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
	],
	// AdminController
	'admin/agents' => [
		'controller' => 'admin',
		'action' => 'agents',
	],
	'admin/agents/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'agents',
	],
	'admin/zapros' => [
		'controller' => 'admin',
		'action' => 'zapros',
	],
	'admin/zapros/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'zapros',
	],
	'admin/accounts' => [
		'controller' => 'admin',
		'action' => 'accounts',
	],
	'admin/accounts/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'accounts',
	],
	'admin/withdraw' => [
		'controller' => 'admin',
		'action' => 'withdraw',
	],
	'admin/history' => [
		'controller' => 'admin',
		'action' => 'history',
	],
	'admin/history/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'history',
	],
	'admin/tariffs' => [
		'controller' => 'admin',
		'action' => 'tariffs',
	],
	'admin/tariffs/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'tariffs',
	],
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
];