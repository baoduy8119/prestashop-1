<?php

if (!defined('_PS_VERSION_'))
	exit;
$path = dirname( _PS_ADMIN_DIR_ );
 
include_once( $path. '/config/config.inc.php');
include_once( $path.'/init.php');

//azmegamenu
$samples['azmegamenu'] = 
	"INSERT INTO `"._DB_PREFIX_."azmegamenu` (`id_azmegamenu`, `id_azmegamenu_group`, `id_parent`, `value`, `type`, `width`, `menu_class`, `show_title`, `show_sub_title`, `sub_menu`, `sub_width`, `group`, `type_submenu`, `lesp`, `cat_subcategories`, `az_lesp`, `position`, `active`) VALUES
(1, 1, 0, '', '', '', '', 1, 1, '', '', 0, 0, 0, 0, 1, 1, 1),
(2, 1, 1, 'a:1:{s:8:\"category\";s:1:\"3\";}', 'category', '', 'mega_type', 1, 1, 'yes', '', 0, 0, 0, 0, 1, 0, 1),
(3, 1, 1, 'a:1:{s:8:\"category\";s:2:\"13\";}', 'category', '', 'mega_type type2', 1, 1, 'yes', '', 0, 0, 0, 0, 2, 1, 1),
(7, 1, 2, 'a:5:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:6:\"limit3\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '20%', '', 0, 1, 'yes', '', 1, 0, 0, 4, 2, 0, 1),
(8, 1, 2, 'a:5:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:6:\"limit3\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '20%', '', 0, 1, 'yes', '', 1, 0, 0, 8, 2, 1, 1),
(10, 1, 2, 'a:2:{s:4:\"type\";s:8:\"featured\";s:5:\"limit\";s:1:\"2\";}', 'productlist', '60%', 'featured-products', 1, 1, 'no', '', 1, 0, 0, 0, 2, 3, 1),
(12, 1, 3, 'a:5:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:6:\"limit3\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '20%', '', 1, 1, 'yes', '', 1, 0, 0, 25, 3, 0, 1),
(13, 1, 3, 'a:5:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:6:\"limit3\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '20%', '', 1, 0, 'yes', '', 1, 0, 0, 26, 3, 2, 1),
(16, 1, 3, 'a:2:{s:4:\"type\";s:7:\"special\";s:5:\"limit\";s:1:\"2\";}', 'html', '30%', 'image', 0, 0, 'no', '', 1, 0, 0, 0, 3, 1, 1),
(20, 1, 1, '', 'url', '', 'css_type blog', 1, 1, 'no', '180px', 0, 0, 0, 0, 3, 3, 1),
(21, 1, 1, 'a:1:{s:3:\"cms\";s:1:\"4\";}', 'cms', '', '', 1, 1, 'no', '', 0, 0, 0, 0, 3, 4, 1),
(22, 1, 1, '', 'url', '', 'css_type contact', 1, 1, 'no', '180px', 0, 0, 0, 0, 3, 5, 1),
(43, 1, 39, '', 'url', '', '', 1, 1, 'no', '', 1, 0, 0, 0, 3, 11, 1),
(55, 0, 1, '', 'url', '', '', 1, 1, 'yes', '', 1, 0, 0, 0, 2, 23, 1),
(56, 1, 3, 'a:2:{s:4:\"type\";s:7:\"special\";s:5:\"limit\";s:1:\"2\";}', 'html', '30%', 'image', 0, 0, 'no', '', 1, 0, 0, 0, 3, 3, 1),
(57, 1, 1, 'a:5:{s:6:\"limit1\";s:0:\"\";s:6:\"limit2\";s:0:\"\";s:6:\"limit3\";s:0:\"\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '', 'css_type', 1, 0, 'yes', '', 0, 0, 0, 12, 2, 2, 1),
(59, 1, 57, 'a:5:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:6:\"limit3\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '', 'css_type', 0, 0, 'yes', '', 0, 0, 0, 12, 3, 24, 1);";

//spmegamenu_group
$samples['azmegamenu_group'] = 
	"INSERT INTO `"._DB_PREFIX_."azmegamenu_group` (`id_azmegamenu_group`, `hook`, `params`, `status`, `position`) VALUES
(1, 'displayMenu', '', 1, 1); ";

//spmegamenu_group_lang
$samples['azmegamenu_group_lang'] = 
	"INSERT INTO `"._DB_PREFIX_."azmegamenu_group_lang` (`id_azmegamenu_group`, `id_lang`, `title`, `content`) VALUES
(1, _ID_LANG_, 'AZ Mega Menu', NULL) ";

//spmegamenu_group_shop
$samples['azmegamenu_group_shop'] = 
	"INSERT INTO `"._DB_PREFIX_."azmegamenu_group_shop` (`id_azmegamenu_group`, `id_shop`) VALUES
(1, _ID_SHOP_);";
	
//spmegamenu_lang
$samples['azmegamenu_lang'] =  
	"INSERT INTO `"._DB_PREFIX_."azmegamenu_lang` (`id_azmegamenu`, `id_lang`, `title`, `label`, `short_description`, `sub_title`, `html`, `url`) VALUES
(1, _ID_LANG_, 'Root', NULL, NULL, NULL, '', ''),
(2, _ID_LANG_, 'Shop', NULL, NULL, NULL, '', '#'),
(3, _ID_LANG_, 'Fashion', NULL, NULL, NULL, '', '#'),
(7, _ID_LANG_, 'Men''s', '', '', '', '', ''),
(8, _ID_LANG_, 'Women''s', '', '', '', '', ''),
(10, _ID_LANG_, 'Featured Products', '', '', '', '', ''),
(12, _ID_LANG_, 'Men''s', '', '', '', '', ''),
(13, _ID_LANG_, 'Women''s', '', '', '', '', ''),
(16, _ID_LANG_, 'Category Image1', '', '', '', '<div><img src=\"../themes/az_leonard/img/cms/banner02.jpg\" alt=\"\" /></div>', ''),
(20, _ID_LANG_, 'Blog', NULL, NULL, NULL, '', 'index.php?fc=module&module=smartblog&controller=category'),
(21, _ID_LANG_, 'About us', NULL, NULL, NULL, '', 'index.php?controller=contact'),
(22, _ID_LANG_, 'Contact us', NULL, NULL, NULL, '', 'index.php?controller=contact'),
(43, _ID_LANG_, 'Blog Listing Large Image', NULL, NULL, NULL, '', 'index.php?fc=module&module=smartblog&controller=category?SP_blogStyle=blog-large_image'),
(55, _ID_LANG_, 'alo', NULL, NULL, NULL, '', '#'),
(56, _ID_LANG_, 'Category Image2', '', '', '', '<div><img src=\"../themes/az_leonard/img/cms/banner03.jpg\" alt=\"\" /></div>', ''),
(57, _ID_LANG_, 'Accesories', '', '', '', '', ''),
(59, _ID_LANG_, 'Accesories Submenu', '', '', '', '', '');";

//spmegamenu_shop
$samples['azmegamenu_shop'] =
	"INSERT INTO `"._DB_PREFIX_."azmegamenu_shop` (`id_azmegamenu`, `id_shop`) VALUES
(1, _ID_SHOP_),
(2, _ID_SHOP_),
(3, _ID_SHOP_),
(7, _ID_SHOP_),
(8, _ID_SHOP_),
(10, _ID_SHOP_),
(12, _ID_SHOP_),
(13, _ID_SHOP_),
(16, _ID_SHOP_),
(20, _ID_SHOP_),
(21, _ID_SHOP_),
(22, _ID_SHOP_),
(43, _ID_SHOP_),
(55, _ID_SHOP_),
(56, _ID_SHOP_),
(57, _ID_SHOP_),
(59, _ID_SHOP_);";
	
foreach ($samples as $sample){
	if($sample){
		$datas = str_replace( '_ID_SHOP_', (int)Context::getContext()->shop->id, $sample );	
		$datas = preg_split('#;\s*[\r\n]+#', $datas);	
		foreach ($datas as $sql) {
			if($sql){
				if( strstr($sql,"_ID_LANG_") ){	
					$languages = Language::getLanguages(true, Context::getContext()->shop->id);
					foreach ($languages as $lang) {	
						$str = str_replace( '_ID_LANG_', (int) $lang["id_lang"], $sql );
						Db::getInstance()->execute(($str));
					}
				}
				else
					Db::getInstance()->execute($sql);
			}
		}
	}
}	


