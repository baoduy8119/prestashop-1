<?php
/**
 * package AZ Templates
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.zikathemes.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;
include_once ( dirname (__FILE__).'/AzStatics.php' );

class AzStaticsBlock extends Module
{
	protected $error = false;
	private $html;
	private $default_hook = array( 
		'displayStatic1',
		'displayStatic2',
		'displayStatic3',
		'displayStatic4',
		'displayStatic5',
		'displayStatic6',
		'displayStatic7',
		'displayStatic8',
		'displayStatic9',
		'displayStatic10',
		'displayFooter',
		'displayLeftColumn',
		'displayStaticFooter' );

	public function __construct()
	{
		$this->name = 'azstaticsblock';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'AZ Templates';
		$this->secure_key = Tools::encrypt ($this->name);
		$this->bootstrap = true;
		parent::__construct ();
		$this->displayName = $this->l('AZ Statics Block');
		$this->description = $this->l('This Module allows you to create your own Statics Module using a WYSIWYG editor.');
		$this->confirmUninstall = $this->l('Are you sure?');
		$this->ps_versions_compliancy = array('min' => '1.6.0.9', 'max' => _PS_VERSION_);
	}

	public function install()
	{
		if (parent::install () == false || !$this->registerHook ('header') || !$this->registerHook ('actionShopDataDuplication'))
			return false;
		foreach ($this->default_hook as $hook)
		{
			if (!$this->registerHook ($hook))
				return false;
		}
		$azstaticsblock = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azstaticsblock`')
			&& Db::getInstance ()->Execute ('CREATE TABLE `'._DB_PREFIX_.'azstaticsblock` (`id_azstaticsblock` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`hook` int(10) unsigned, 
			`params` text NOT NULL DEFAULT \'\' ,
			`active` tinyint(1) NOT NULL DEFAULT \'1\',
			`ordering` int(10) unsigned NOT NULL,
			PRIMARY KEY (`id_azstaticsblock`)) ENGINE=InnoDB default CHARSET=utf8');
		$azstaticsblock_shop = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azstaticsblock_shop`')
			&& Db::getInstance ()->Execute ('CREATE TABLE `'._DB_PREFIX_.'azstaticsblock_shop` (`id_azstaticsblock` int(10) unsigned NOT NULL,
			`id_shop` int(10) unsigned NOT NULL, 
			`active` tinyint(1) NOT NULL DEFAULT \'1\',
			PRIMARY KEY (`id_azstaticsblock`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
		$azstaticsblock_lang = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azstaticsblock_lang`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'azstaticsblock_lang (`id_azstaticsblock` int(10) unsigned NOT NULL,
			`id_lang` int(10) unsigned NOT NULL,
			`title_module` varchar(255) NOT NULL DEFAULT \'\',
			`content` text,
			PRIMARY KEY (`id_azstaticsblock`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
		if (!$azstaticsblock || !$azstaticsblock_shop || !$azstaticsblock_lang)
			return false;

		$this->installFixtures();

		return true;
	}

	public function uninstall()
	{
		if (parent::uninstall () == false)
			return false;
		if (!Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azstaticsblock`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azstaticsblock_shop`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azstaticsblock_lang`'))
			return false;
		$this->clearCacheItemForHook ();
		return true;
	}
	public function installFixtures()
	{
		$datas = array(
			array(
				'id_azstaticsblock' => 1,
				'active' => 1,
				'title_module' => 'Banner Left',
				'display_title_module' => 0,
				'moduleclass_sfx' => '',
				'hook' => Hook::getIdByName('displayLeftColumn'),
				'content' => '<div class="az_banner"><a class="img" href="#"><img src="../themes/az_leonard/img/cms/banner_left.jpg" alt="" /></a></div>'
			),
			array(
				'id_azstaticsblock' => 2,
				'active' => 1,
				'title_module' => 'Header Contact',
				'display_title_module' => 0,
				'moduleclass_sfx' => 'header-contact',
				'hook' => Hook::getIdByName('displayStatic1'),
				'content' => '<div class="hd-phone"><span class="fa fa-phone"></span> +(00) 1212 1212</div>',
			),
			array(
				'id_azstaticsblock' => 3,
				'active' => 1,
				'title_module' => 'Banner Index',
				'display_title_module' => 0,
				'moduleclass_sfx' => '',
				'hook' => Hook::getIdByName('displayStatic2'),
				'content' => '<div class="az_banner">
								<div class="row">
								<div class="col-sm-6 col-xs-12"><a href="#" class="img img1"><img src="../themes/az_leonard/img/cms/banner01.jpg" alt="#" /></a></div>
								<div class="col-sm-6 col-xs-12">
								<div class="row">
								<div class="col-sm-6 col-xs-6"><a href="#" class="img img2"><img src="../themes/az_leonard/img/cms/banner02.jpg" alt="#" /></a></div>
								<div class="col-sm-6 col-xs-6"><a href="#" class="img img3"><img src="../themes/az_leonard/img/cms/banner03.jpg" alt="#" /></a></div>
								<div class="col-sm-12 col-xs-12"><a href="#" class="img img4"><img src="../themes/az_leonard/img/cms/banner04.jpg" alt="#" /></a></div>
								</div>
								</div>
								</div>
								</div>'
			),
			array(
				'id_azstaticsblock' => 4,
				'active' => 1,
				'title_module' => 'Promotion',
				'display_title_module' => 0,
				'moduleclass_sfx' => '',
				'hook' => Hook::getIdByName('displayStatic3'),
				'content' => '<div class="az_promotion">
								<div class="row">
								<div class="col-sm-4">
								<div class="item item1">
								<div class="icon"><span>Icon1</span></div>
								<div class="text">
								<p>Satisfaction</p>
								<p>100% GUARANTEED</p>
								</div>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="item item2">
								<div class="icon"><span>Icon2</span></div>
								<div class="text">
								<p>Free shipping</p>
								<p>ON ORDERS OVER $99</p>
								</div>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="item item3">
								<div class="icon"><span>Icon3</span></div>
								<div class="text">
								<p>14 Day</p>
								<p>EASY RETURN</p>
								<p></p>
								</div>
								</div>
								</div>
								</div>
								</div>'
			),
			array(
				'id_azstaticsblock' => 9,
				'active' => 1,
				'title_module' => 'Testimonials',
				'display_title_module' => 0,
				'moduleclass_sfx' => '',
				'hook' => Hook::getIdByName('displayStatic4'),
				'content' => '<div class="az_testimonial">
								<div class="banner"><img src="../themes/az_leonard/img/cms/testimonial.jpg" alt="#" /></div>
								<div class="az_ttnm owl-carousel">
								<div class="content">
								<div class="avatar"><img src="../themes/az_leonard/img/cms/t1.png" alt="#" /></div>
								<div class="text titleFont">"I am so happy because I found this Leonard, and it just made my life easier. Thanks so much for sharing."</div>
								<div class="name">-Mr. John Doe-</div>
								</div>
								<div class="content">
								<div class="avatar"><img src="../themes/az_leonard/img/cms/t1.png" alt="#" /></div>
								<div class="text titleFont">"I am so happy because I found this Leonard, and it just made my life easier. Thanks so much for sharing."</div>
								<div class="name">-Mrs. Angenlia-</div>
								</div>
								<div class="content">
								<div class="avatar"><img src="../themes/az_leonard/img/cms/t1.png" alt="#" /></div>
								<div class="text titleFont">"I am so happy because I found this Leonard, and it just made my life easier. Thanks so much for sharing."</div>
								<div class="name">-Mrs. Emily-</div>
								</div>
								</div>
								</div>'
			),
			array(
				'id_azstaticsblock' => 8,
				'active' => 1,
				'title_module' => 'Our Services',
				'display_title_module' => 0,
				'moduleclass_sfx' => 'col-md-2 col-sm-3 az_boxFooter',
				'hook' => Hook::getIdByName('displayFooter'),
				'content' => '<div class="footer-links">
								<h3 class="titlebox">OUR Services</h3>
								<ul>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Shipping & Taxes</a></li>
								<li><a href="#">Return Policy</a></li>
								<li><a href="#">Site Map</a></li>
								<li><a href="#">Contact Us</a></li>
								</ul>
								</div>'
			),
			array(
				'id_azstaticsblock' => 5,
				'active' => 1,
				'title_module' => 'My Account',
				'display_title_module' => 0,
				'moduleclass_sfx' => 'col-md-2 col-sm-3 az_boxFooter',
				'hook' => Hook::getIdByName('displayFooter'),
				'content' => '<div class="footer-links">
							<h3 class="titlebox">My Account</h3>
							<ul>
							<li><a href="../my-account">My Account</a></li>
							<li><a href="../order">Wishlist</a></li>
							<li><a href="../my-account">Shoppingcart</a></li>
							<li><a href="../my-account">Checkout</a></li>
							<li><a href="../my-account">My orders</a></li>
							</ul>
							</div>'
			),
			array(
				'id_azstaticsblock' => 7,
				'active' => 1,
				'title_module' => 'Our Support',
				'display_title_module' => 0,
				'moduleclass_sfx' => 'col-md-2 col-sm-3 az_boxFooter',
				'hook' => Hook::getIdByName('displayFooter'),
				'content' => '<div class="footer-links">
								<h3 class="titlebox">OUR SUPPORT</h3>
								<ul>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Shipping & Taxes</a></li>
								<li><a href="#">Return Policy</a></li>
								<li><a href="#">Site Map</a></li>
								<li><a href="#">Contact Us</a></li>
								</ul>
								</div>'
			),
			array(
				'id_azstaticsblock' => 6,
				'active' => 1,
				'title_module' => 'Information',
				'display_title_module' => 0,
				'moduleclass_sfx' => 'col-md-2 col-sm-3 az_boxFooter',
				'hook' => Hook::getIdByName('displayFooter'),
				'content' => '<div class="footer-links">
								<h3 class="titlebox">Information</h3>
								<ul>
								<li><a href="../content/4-about-us">About Us</a></li>
								<li><a href="#">Top Sellers</a></li>
								<li><a href="#">Special Products</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Delivery </a></li>
								</ul>
								</div>'
			)
		);
		$return = true;
		foreach ($datas as $i => $data)
		{
			$customs = new AzStatics();
			$customs->hook = $data['hook'];
			$customs->active = $data['active'];
			$customs->ordering = $i;
			$customs->params = serialize($data);
			foreach (Language::getLanguages(false) as $lang)
			{
				$customs->content[$lang['id_lang']] = $data['content'];
				$customs->title_module[$lang['id_lang']] = $data['title_module'];
			}
			$return &= $customs->add();
		}
		return $return;
		
	}

	public function getContent()
	{	
		
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if ($this->postValidation())
			{
				$this->html .= $this->postProcess();
				$this->html .= $this->renderForm();
			}
			else
				$this->html .= $this->renderForm();
		}
		elseif (Tools::isSubmit ('addItem') || (Tools::isSubmit('editItem')
				&& $this->moduleExists((int)Tools::getValue('id_azstaticsblock'))) || Tools::isSubmit ('saveItem'))
		{
			if (Tools::isSubmit('addItem'))
				$mode = 'add';
			else
				$mode = 'edit';
			
			if ($mode == 'add')
			{
				if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL)
					$this->html .= $this->renderForm ();
				else
					$this->html .= $this->getShopContextError(null, $mode);
			}
			else
			{
				$associated_shop_ids = AzStatics::getAssociatedIdsShop((int)Tools::getValue('id_azstaticsblock'));
				$context_shop_id = (int)Shop::getContextShopID();
				
				if ($associated_shop_ids === false)
					$this->html .= $this->getShopAssociationError((int)Tools::getValue('id_azstaticsblock'));
				else if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL
					&& in_array($context_shop_id, $associated_shop_ids))
				{
					if (count($associated_shop_ids) > 1)
						$this->html = $this->getSharedSlideWarning();
					$this->html .= $this->renderForm();
					
				}
				else
				{
					$shops_name_list = array();
					foreach ($associated_shop_ids as $shop_id)
					{
						$associated_shop = new Shop((int)$shop_id);
						$shops_name_list[] = $associated_shop->name;
					}
					$this->html .= $this->getShopContextError($shops_name_list, $mode);
					
				}
				
			}
		}
		else
		{
			if ($this->postValidation())
			{
				$this->html .= $this->postProcess();
				$this->html .= $this->displayForm ();
			}
			else
				$this->html .= $this->displayForm ();
		}
		return $this->html;
	}
	private function postValidation()
	{	$errors = array();
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (!Validate::isInt(Tools::getValue('active')) || (Tools::getValue('active') != 0
					&& Tools::getValue('active') != 1))
				$errors[] = $this->l('Invalid slide state.');
			if (!Validate::isInt(Tools::getValue('position')) || (Tools::getValue('position') < 0))
				$errors[] = $this->l('Invalid slide position.');
			if (Tools::isSubmit('id_azstaticsblock'))
			{
				if (!Validate::isInt(Tools::getValue('id_azstaticsblock'))
					&& !$this->moduleExists(Tools::getValue('id_azstaticsblock')))
					$errors[] = $this->l('Invalid module ID');
			}
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('title_module_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
				if (Tools::strlen(Tools::getValue('content_'.$language['id_lang'])) > 4000)
					$errors[] = $this->l('The content is too long.');
			}
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('title_module_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title module is not set.');
			if (Tools::strlen(Tools::getValue('content_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The content is not set.');
			if (Tools::strlen(Tools::getValue('moduleclass_sfx')) > 255)
				$errors[] = $this->l('The Module Class Suffix  is too long.');
		}elseif (Tools::isSubmit('id_azstaticsblock')
			&& (!Validate::isInt(Tools::getValue('id_azstaticsblock'))
				|| !$this->moduleExists((int)Tools::getValue('id_azstaticsblock'))))
			$errors[] = $this->l('Invalid module ID');
		if (count($errors))
		{
			$this->html .= $this->displayError(implode('<br />', $errors));
			return false;
		}
		return true;
	}

	private function postProcess()
	{
		$currentIndex = AdminController::$currentIndex;
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (Tools::getValue('id_azstaticsblock'))
			{
				$staticsblock = new AzStatics((int)Tools::getValue ('id_azstaticsblock'));
				if (!Validate::isLoadedObject($staticsblock))
				{
					$this->html .= $this->displayError($this->l('Invalid slide ID'));
					return false;
				}
			}
			else
				$staticsblock = new AzStatics();
			$next_ps = $this->getNextPosition();
			$staticsblock->ordering = (!empty($staticsblock->ordering)) ? (int)$staticsblock->ordering : $next_ps;
			$staticsblock->active = (Tools::getValue('active')) ? (int)Tools::getValue('active') : 0;
			$staticsblock->hook	= (int)Tools::getValue('hook');
			$tmp_data = array();
			$id_azstaticsblock = (int)Tools::getValue ('id_azstaticsblock');
			$id_azstaticsblock = $id_azstaticsblock ? $id_azstaticsblock : (int)$staticsblock->getHigherModuleID();
			$tmp_data['id_azstaticsblock'] = $id_azstaticsblock;

			$tmp_data['active'] = (int)Tools::getValue ('active', 1);
			$tmp_data['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx');
			$tmp_data['display_title_module'] = Tools::getValue ('display_title_module');
			$tmp_data['hook '] = Tools::getValue('hook');
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				$staticsblock->title_module[$language['id_lang']] = Tools::getValue('title_module_'.$language['id_lang']);
				$staticsblock->content[(int)$language['id_lang']] = Tools::getValue ('content_'.$language['id_lang']);
			}
			$staticsblock->params = serialize($tmp_data);
			(Tools::getValue ('id_azstaticsblock')
		&& $this->moduleExists((int)Tools::getValue ('id_azstaticsblock')) )? $staticsblock->update() : $staticsblock->add ();
			$this->clearCacheItemForHook ();
			if (Tools::isSubmit ('saveAndStay'))
			{
				$tool_id_azstaticsblock = Tools::getValue ('id_azstaticsblock');
				$higher_module = $staticsblock->getHigherModuleID();
				$id_azstaticsblock = $tool_id_azstaticsblock?(int)$tool_id_azstaticsblock:(int)$higher_module;
				Tools::redirectAdmin ($currentIndex.'&configure='
				.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azstaticsblock='
					.$id_azstaticsblock.'&updateItemConfirmation');
			}
			else
				Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
					.'&token='.Tools::getAdminTokenLite ('AdminModules').'&saveItemConfirmation');
		}
		elseif (Tools::isSubmit('changeStatusItem') && Tools::getValue ('id_azstaticsblock'))
		{
			$staticsblock = new AzStatics((int)Tools::getValue ('id_azstaticsblock'));
			if ($staticsblock->active == 0)
				$staticsblock->active = 1;
			else
				$staticsblock->active = 0;
			$staticsblock->update();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
				.'&token='.Tools::getAdminTokenLite ('AdminModules'));
		}
		elseif (Tools::isSubmit ('deleteItem') && Tools::getValue ('id_azstaticsblock'))
		{
			$staticsblock = new AzStatics((int)Tools::getValue ('id_azstaticsblock'));
			$staticsblock->delete ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='
				.Tools::getAdminTokenLite ('AdminModules').'&deleteItemConfirmation');
		}
		elseif (Tools::isSubmit ('duplicateItem') && Tools::getValue ('id_azstaticsblock'))
		{
			$staticsblock = new AzStatics(Tools::getValue ('id_azstaticsblock'));
			foreach (Language::getLanguages (false) as $lang)
				$staticsblock->title_module[(int)$lang['id_lang']] = $staticsblock->title_module[(int)$lang['id_lang']]
					.$this->l(' (Copy)');
			$staticsblock->duplicate();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='
				.Tools::getAdminTokenLite ('AdminModules').'&duplicateItemConfirmation');
		}
		elseif (Tools::isSubmit ('saveItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully updated!'));
		elseif (Tools::isSubmit ('deleteItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully deleted!'));
		elseif (Tools::isSubmit ('duplicateItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully duplicated!'));
		elseif (Tools::isSubmit ('updateItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully updated!'));
	}

	private function clearCacheItemForHook()
	{
		$this->_clearCache ('default.tpl');
	}
	public function moduleExists($id_azstaticsblock)
	{
		$req = 'SELECT cs.`id_azstaticsblock` 
				FROM `'._DB_PREFIX_.'azstaticsblock` cs
				WHERE cs.`id_azstaticsblock` = '.(int)$id_azstaticsblock;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

		return ($row);
		
	}
	
	
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(cs.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'azstaticsblock` cs, `'._DB_PREFIX_.'azstaticsblock_shop` css
			WHERE css.`id_azstaticsblock` = cs.`id_azstaticsblock` AND css.`id_shop` = '.(int)$this->context->shop->id
		);

		return (++$row['next_position']);
	}

	private function getGridItems()
	{
		$this->context = Context::getContext ();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		$sql = 'SELECT b.`id_azstaticsblock`,  b.`hook`, b.`ordering`, bs.`active`, bl.`title_module`, bl.`content`
			FROM `'._DB_PREFIX_.'azstaticsblock` b
			LEFT JOIN `'._DB_PREFIX_.'azstaticsblock_shop` bs ON (b.`id_azstaticsblock` = bs.`id_azstaticsblock` )
			LEFT JOIN `'._DB_PREFIX_.'azstaticsblock_lang` bl ON (b.`id_azstaticsblock` = bl.`id_azstaticsblock`)
			WHERE bs.`id_shop` = '.(int)$id_shop.' 
			AND bl.`id_lang` = '.(int)$id_lang.'
			ORDER BY b.`ordering`';
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql );
	}

	private function getHookTitle($id_hook, $name = false)
	{
		if (!$result = Db::getInstance ()->getRow ('
			SELECT `name`,`title`
			FROM `'._DB_PREFIX_.'hook`
			WHERE `id_hook` = '.( $id_hook )))
			return false;
		return ( ( $result['title'] != '' && $name )?$result['title']:$result['name'] );
	}

	private function displayForm()
	{
		$currentIndex = AdminController::$currentIndex;
		$modules = array();
		$this->html .= $this->headerHTML ();
		if (Shop::getContext() == Shop::CONTEXT_GROUP || Shop::getContext() == Shop::CONTEXT_ALL)
			$this->html .= $this->getWarningMultishopHtml();
		else if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL)
		{
			$modules = $this->getGridItems ();
			if (!empty($modules))
			{
				foreach ($modules as $key => $mod)
				{
					$associated_shop_ids = AzStatics::getAssociatedIdsShop((int)$mod['id_azstaticsblock']);
					if ($associated_shop_ids && count($associated_shop_ids) > 1)
						$modules[$key]['is_shared'] = true;
					else
						$modules[$key]['is_shared'] = false;
				}
			}
		}
		$this->html .= '
	 	<div class="panel">
			<div class="panel-heading">
			'.$this->l('Module Manager').'
			<span class="panel-heading-action">
					<a class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name
			.'&token='.Tools::getAdminTokenLite ('AdminModules').'&addItem">
			<span data-toggle="tooltip" class="label-tooltip" data-original-title="'
			.$this->l('Add new module').'" data-html="true"><i class="process-icon-new "></i></span></a>
			</span>
			</div>
			<table width="100%" class="table" cellspacing="0" cellpadding="0">
			<thead>
			<tr class="nodrag nodrop">
				<th>'.$this->l('Module ID').'</th>
				<th>'.$this->l('Module Ordering').'</th>
				<th class=" left">'.$this->l('Module Title').'</th>
				<th class=" left">'.$this->l('Module Hook').'</th>
				<th class=" left">'.$this->l('Module Status').'</th>
				<th class=" right"><span class="title_box text-right">'.$this->l('Actions').'</span></th>
			</tr>
			</thead>
			<tbody id="gird_items">';
		if (!empty($modules))
		{
			static $irow;
			foreach ($modules as $staticsblock)
			{
				$this->html .= '
				<tr id="item_'.$staticsblock['id_azstaticsblock'].'" class=" '.( $irow ++ % 2?' ':'' ).'">
					<td class=" 	" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azstaticsblock='
					.$staticsblock['id_azstaticsblock'].'\'">'
					.$staticsblock['id_azstaticsblock'].'</td>
					<td class=" dragHandle"><div class="dragGroup"><div class="positions">'.$staticsblock['ordering']
					.'</div></div></td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_azstaticsblock='.$staticsblock['id_azstaticsblock'].'\'">'.$staticsblock['title_module']
					.' '.($staticsblock['is_shared'] ? '<span class="label color_field"
		style="background-color:#108510;color:white;margin-top:5px;">'.$this->l('Shared').'</span>' : '').'</td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name
					.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azstaticsblock='
					.$staticsblock['id_azstaticsblock'].'\'">'
					.( Validate::isInt ($staticsblock['hook'])?$this->getHookTitle ($staticsblock['hook']):'' ).'</td>
					<td class="  "> <a href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&changeStatusItem&id_azstaticsblock='.$staticsblock['id_azstaticsblock'].'&status='
					.$staticsblock['active'].'&hook='.$staticsblock['hook'].'">'.( $staticsblock['active']?'
					<i class="icon-check"></i>':'<i class="icon-remove"></i>' ).'</a> </td>
					<td class="text-right">
						<div class="btn-group-action">
							<div class="btn-group pull-right">
								<a class="btn btn-default" href="'.$currentIndex.'&configure='.$this->name.'&token='
		.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azstaticsblock='.$staticsblock['id_azstaticsblock'].'">
									<i class="icon-pencil"></i> Edit
								</a> 
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<span class="caret"></span>&nbsp;
								</button>
								<ul class="dropdown-menu">
									<li>
							<a onclick="return confirm(\''
					.$this->l('Are you sure want duplicate this item?', __CLASS__, true, false)
					.'\');"  title="'.$this->l('Duplicate').'" href="'.$currentIndex.'&configure='
					.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&duplicateItem&id_azstaticsblock='
					.$staticsblock['id_azstaticsblock'].'">
											<i class="icon-copy"></i> '.$this->l('Duplicate').'
										</a>								
									</li>
									<li class="divider"></li>
									<li>
										<a title ="'.$this->l('Delete').'" onclick="return confirm(\''
					.$this->l('Are you sure?', __CLASS__, true, false).'\');" href="'.$currentIndex
					.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&deleteItem&id_azstaticsblock='
					.$staticsblock['id_azstaticsblock'].'">
											<i class="icon-trash"></i> '.$this->l('Delete').'
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>';
			}
		}
		else
		{
			$this->html .= '<td colspan="5" class="list-empty">
								<div class="list-empty-msg">
									<i class="icon-warning-sign list-empty-icon"></i>
									'.$this->l('No records found').'
								</div>
							</td>';
		}
		$this->html .= '
			</tbody>
			</table>
		</div>';
	}

	public function getHookList()
	{
		$hooks = array();
		foreach ($this->default_hook as $key => $hook)
		{
			$id_hook = Hook::getIdByName ($hook);
			$name_hook = $this->getHookTitle ($id_hook);
			$hooks[$key]['key'] = $id_hook;
			$hooks[$key]['name'] = $name_hook;
		}
		return $hooks;

	}

	public function renderForm()
	{
		$default_lang = (int)Configuration::get ('PS_LANG_DEFAULT');
		$hooks = $this->getHookList ();
		$this->fields_form[0]['form'] = array(
			'tinymce' => true,
			'legend'  => array(
				'title' => $this->l('General Options'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'   => 'switch',
					'label'  => $this->l('Active Module'),
					'name'   => 'active',
					'hint'   => $this->l('Status Of Module'),
					'values' => array(
						array(
							'id'    => 'active_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'active_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'     => 'text',
					'label'    => $this->l('Module Title'),
					'lang'     => true,
					'name'     => 'title_module',
					'class'    => 'fixed-width-xl',
					'hint'     => $this->l('Title Of Module')
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Active Module Title'),
					'name'   => 'display_title_module',
					'hint'   => $this->l('Display Title Of Module'),
					'values' => array(
						array(
							'id'    => 'active_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'active_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Special Module Class'),
					'name'  => 'moduleclass_sfx',
					'hint'  => $this->l('A suffix to be applied to the CSS class of the module.
					This allows for individual module styling.'),
					'class' => 'fixed-width-xl'
				),
				
				
				array(
					'type'    => 'select',
					'label'   => $this->l('Module Hook'),
					'name'    => 'hook',
					'hint'    => $this->l('Select Hook for Module'),
					'options' => array(
						'query' => $hooks,
						'id'    => 'key',
						'name'  => 'name'
					)
				),
				array(
					'type'         => 'textarea',
					'label'        => $this->l('Module Content'),
					'name'         => 'content',
					'hint'         => $this->l('Show Content Of Module'),
					'lang'         => true,
					'autoload_rte' => true,
					'cols'         => 40,
					'rows'         => 10
				)
			),
			'submit'  => array(
				'title' => $this->l('Save')
			),
			'buttons' => array(
				array(
					'title' => $this->l('Save and stay'),
					'name'  => 'saveAndStay',
					'type'  => 'submit',
					'class' => 'btn btn-default pull-right',
					'icon'  => 'process-icon-save'
				)
			)
		);
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'azstaticsblock';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite ('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='
			.Tools::getAdminTokenLite ('AdminModules');
		foreach (Language::getLanguages (false) as $lang)
			$helper->languages[] = array(
				'id_lang'    => $lang['id_lang'],
				'iso_code'   => $lang['iso_code'],
				'name'       => $lang['name'],
				'is_default' => ( $default_lang == $lang['id_lang']?1:0 )
			);
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'saveItem';
		$helper->toolbar_btn = array(
			'save' => array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name
					.'&save'.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules'),
				'desc' => $this->l('Back to list') )
		);
		$id_azstaticsblock = (int)Tools::getValue ('id_azstaticsblock');

		if (Tools::isSubmit ('id_azstaticsblock') && $id_azstaticsblock)
		{
			$staticsblock = new AzStatics((int)$id_azstaticsblock);
			$params = unserialize($staticsblock->params);
			$this->fields_form[0]['form']['input'][] = array(
				'type' => 'hidden',
				'name' => 'id_azstaticsblock' );
		$helper->fields_value['id_azstaticsblock'] = Tools::getValue ('id_azstaticsblock', $staticsblock->id_azstaticsblock);
		}
		else
		{
			$staticsblock = new AzStatics();
			$params = array();
		}
		foreach (Language::getLanguages (false) as $lang)
		{
			$helper->fields_value['title_module'][(int)$lang['id_lang']] = Tools::getValue ('title_module_'
				.(int)$lang['id_lang'],
				$staticsblock->title_module[(int)$lang['id_lang']]);
			$helper->fields_value['content'][(int)$lang['id_lang']] = Tools::getValue ('content_'.(int)$lang['id_lang'],
				$staticsblock->content[(int)$lang['id_lang']]);
		}
		$helper->fields_value['hook'] = Tools::getValue ('hook', $staticsblock->hook);
		$helper->fields_value['active'] = (int)Tools::getValue('active', $staticsblock->active);
		$display_title_module = isset( $params['display_title_module'] ) ? $params['display_title_module'] : 1;
		$helper->fields_value['display_title_module'] = Tools::getValue ('display_title_module', $display_title_module);
		$helper->fields_value['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx',
			isset($params['moduleclass_sfx']) ? $params['moduleclass_sfx'] : '' );
		$this->html .= $helper->generateForm ($this->fields_form);
	}

	private function getItemInHook($hook_name)
	{
		$list = array();
		$this->context = Context::getContext ();
		$id_shop = $this->context->shop->id;
		$id_hook = Hook::getIdByName ($hook_name);
		if ($id_hook)
		{
			$sql = 'SELECT b.`id_azstaticsblock` FROM `'._DB_PREFIX_.'azstaticsblock` b
			LEFT JOIN `'._DB_PREFIX_.'azstaticsblock_shop` bs ON (b.`id_azstaticsblock` = bs.`id_azstaticsblock`)
			WHERE bs.`active` = 1 AND (bs.`id_shop` = '.$id_shop.')
			AND b.`hook` = '.( $id_hook ).' ORDER BY b.`ordering`';
			$results = Db::getInstance ()->ExecuteS ($sql);
			foreach ($results as $row)
			{
				$temp = new AzStatics((int)$row['id_azstaticsblock']);
				$temp->params = unserialize($temp->params);
				$list[] = $temp;
			}
		}
		return $list;
		
	}

	public function hookHeader()
	{
		$this->context->controller->addCSS ($this->_path.'views/css/azstaticsblock.css', 'all');
		return $this->display (__FILE__, 'header.tpl');
	}
	
	
	public function hookDisplayStatic1()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic1');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic1');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic2()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic2');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic2');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic3()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic3');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic3');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic4()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic4');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic4');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic5()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic5');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic5');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic6()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic6');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic6');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic7()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic7');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic7');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic8()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic8');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic8');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic9()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic9');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic9');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStatic10()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStatic10');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStatic10');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayStaticFooter()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayStaticFooter');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayStaticFooter');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayFooter()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayFooter');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayFooter');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayLeftColumn()
	{
		$smarty_cache_id = $this->getCacheId ('azstaticsblock_displayLeftColumn');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayLeftColumn');
			if (empty($list))
				return;
			$this->context->smarty->assign (array(
				'list' => $list
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
	}


	public function headerHTML()
	{
		if (Tools::getValue ('controller') != 'AdminModules' && Tools::getValue ('configure') != $this->name)
			return;
		$this->context->controller->addJqueryUI ('ui.sortable');
		$html = '<script type="text/javascript">
			$(function() {
				var $gird_items = $("#gird_items");
				$gird_items.sortable({
					opacity: 0.6,
					cursor: "move",
					handle: ".dragGroup",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
							$.ajax({
								type: "POST",
								dataType: "json",
								data:order,
								url:"'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/ajax_'.$this->name
			.'.php?secure_key='.$this->secure_key.'",
								success: function (msg){
									if (msg.error)
									{
										showErrorMessage(msg.error);
										return;
									}
									$(".positions", $gird_items).each(function(i){
										$(this).text(i);
									});
									showSuccessMessage(msg.success);
								}
							});
						
						}
					});
					$(".dragGroup",$gird_items).hover(function() {
						$(this).css("cursor","move");
					},
					function() {
						$(this).css("cursor","auto");
				    });
			});
		</script>
		';
		$html .= '<style type="text/css">#gird_items .ui-sortable-helper{display:table!important;}</style>';
		return $html;
	}
	private function getWarningMultishopHtml()
	{
		if (Shop::getContext() == Shop::CONTEXT_GROUP || Shop::getContext() == Shop::CONTEXT_ALL)
			return '<p class="alert alert-warning">'.
						$this->l('You cannot manage modules items from a "All Shops" or a "Group Shop" context,
						select directly the shop you want to edit').
					'</p>';
		else
			return '';
	}

	private function getShopContextError($shop_contextualized_name, $mode)
	{
		if (is_array($shop_contextualized_name))
			$shop_contextualized_name = implode('<br/>', $shop_contextualized_name);

		if ($mode == 'edit')
			return '<p class="alert alert-danger">'.
							sprintf($this->l('You can only edit this module from the shop(s) context: %s'),
								$shop_contextualized_name).
					'</p>';
		else
			return '<p class="alert alert-danger">'.
							sprintf($this->l('You cannot add modules from a "All Shops" or a "Group Shop" context')).
					'</p>';
	}

	private function getShopAssociationError($id_staticsblock)
	{
		return '<p class="alert alert-danger">'.
			sprintf($this->l('Unable to get module shop association information (id_module: %d)'), (int)$id_staticsblock).
				'</p>';
	}


	private function getCurrentShopInfoMsg()
	{
		$shop_info = null;

		if (Shop::isFeatureActive())
		{
			if (Shop::getContext() == Shop::CONTEXT_SHOP)
			$shop_info = sprintf($this->l('The modifications will be applied to shop: %s'), $this->context->shop->name);
			else if (Shop::getContext() == Shop::CONTEXT_GROUP)
				$shop_info = sprintf($this->l('The modifications will be applied to this group: %s'),
					Shop::getContextShopGroup()->name);
			else
				$shop_info = $this->l('The modifications will be applied to all shops and shop groups');

			return '<div class="alert alert-info">'.
						$shop_info.
					'</div>';
		}
		else
			return '';
	}
	private function getSharedSlideWarning()
	{
		return '<p class="alert alert-warning">'.
					$this->l('This module is shared with other shops!
					All shops associated to this module will apply modifications made here').
				'</p>';
	}

	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance ()->execute ('
		INSERT IGNORE INTO `'._DB_PREFIX_.'azstaticsblock_shop` (`id_azstaticsblock`, `id_shop`)
		SELECT `id_azstaticsblock`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'azstaticsblock_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}
}
