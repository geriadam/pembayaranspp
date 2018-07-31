<?php 
namespace App\Helpers;
use Request;

class Menu
{
	public static function getArrOfMenu()
	{
		return array(
			array(
				'label' 	=> 'Home',
				'url' 		=> 'admin.home',
				'icon' 		=> 'home',
				'active' 	=> \Ekko::isActiveRoute('admin.home') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Tipe Pembayaran',
				'url' 		=> 'admin.paymenttype.index',
				'icon' 		=> 'credit-card',
				'active' 	=> \Ekko::isActiveRoute('admin.paymenttype.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Santri',
				'url' 		=> 'admin.santri.index',
				'icon' 		=> 'group',
				'active' 	=> \Ekko::isActiveRoute('admin.santri.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Transaksi',
				'url' 		=> 'admin.transaction.index',
				'icon' 		=> 'money',
				'active' 	=> \Ekko::isActiveRoute('admin.transaction.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'User',
				'url' 		=> 'admin.user.index',
				'icon' 		=> 'user',
				'active' 	=> \Ekko::isActiveRoute('admin.user.*') ? true : false,
				'visible' 	=> true,
			),
		);
	}
}	