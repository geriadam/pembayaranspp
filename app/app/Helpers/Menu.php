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
				'label' 	=> 'Article',
				'url' 		=> 'admin.article.index',
				'icon' 		=> 'book',
				'active' 	=> \Ekko::isActiveRoute('admin.article.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Article Category',
				'url' 		=> 'admin.articlecategory.index',
				'icon' 		=> 'bookmark',
				'active' 	=> \Ekko::isActiveRoute('admin.articlecategory.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Product Category',
				'url' 		=> 'admin.productcategory.index',
				'icon' 		=> 'caret-square-o-right',
				'active' 	=> \Ekko::isActiveRoute('admin.productcategory.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Product Brand',
				'url' 		=> 'admin.productbrand.index',
				'icon' 		=> 'tag',
				'active' 	=> \Ekko::isActiveRoute('admin.productbrand.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Contact',
				'url' 		=> 'admin.contact.index',
				'icon' 		=> 'comment-o',
				'active' 	=> \Ekko::isActiveRoute('admin.contact.*') ? true : false,
				'visible' 	=> true,
			),
			array(
				'label' 	=> 'Page',
				'url' 		=> '#',
				'icon' 		=> 'file-o',
				'active' 	=> \Ekko::isActiveRoute('admin.page.*') ? true : false,
				'visible' 	=> true,
				'items' 	=> [
					[
						'label' 	=> 'About Milestone',
						'url' 		=> 'admin.page.aboutmilestone.index',
						'icon' 		=> 'comment-o',
						'active' 	=> \Ekko::isActiveRoute('admin.page.aboutmilestone.*') ? true : false,
						'visible' 	=> true,
					],
				]

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