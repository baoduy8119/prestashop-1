<?php
/**
 * package AZ Tabs
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.zikathemes.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;
include_once ( dirname (__FILE__).'/azTabsClass.php' );

class azTabs extends Module
{
	protected $categories = array();
	protected $error = false;
	private $html;
	private $default_hook = array( 'displayTab', 'displayTab2', 'displayTab3', 'displayTab4', 'displayTab5');

	public function __construct()
	{
		$this->name = 'aztabs';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'AZ Templates';
		$this->secure_key = Tools::encrypt ($this->name);
		$this->bootstrap = true;
		parent::__construct ();
		$this->displayName = $this->l('AZ Tabs');
		$this->description = $this->l('Display products in each tabs categories/field product with listing view.');
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
	$aztabs = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'aztabs`')
			&& Db::getInstance ()->Execute ('
			CREATE TABLE '._DB_PREFIX_.'aztabs (
				`id_aztabs` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`hook` int(10) unsigned,
				`params` text NOT NULL DEFAULT \'\' ,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				`ordering` int(10) unsigned NOT NULL,
				PRIMARY KEY (`id_aztabs`)) ENGINE=InnoDB default CHARSET=utf8');
	$aztabs_shop = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'aztabs_shop`')
			&& Db::getInstance ()->Execute ('
				CREATE TABLE '._DB_PREFIX_.'aztabs_shop (
				`id_aztabs` int(10) unsigned NOT NULL,
				`id_shop` int(10) unsigned NOT NULL,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				 PRIMARY KEY (`id_aztabs`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
	$aztabs_lang = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'aztabs_lang`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'aztabs_lang (
				`id_aztabs` int(10) unsigned NOT NULL,
				`id_lang` int(10) unsigned NOT NULL,
				`title_module` varchar(255) NOT NULL DEFAULT \'\',
				PRIMARY KEY (`id_aztabs`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
		if (!$aztabs || !$aztabs_shop || !$aztabs_lang)
			return false;
		$this->installSamples();
		return true;
	}

	public function uninstall()
	{
		if (parent::uninstall () == false)
			return false;
		if (!Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'aztabs`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'aztabs_shop`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'aztabs_lang`'))
			return false;
		$this->clearCacheItemForHook ();
		return true;
	}

	public function installSamples()
	{
		$image_cat_types = ImageType::getImagesTypes ('categories');
		$cat_types = array_shift($image_cat_types);
		$image_pro_types = ImageType::getImagesTypes ('products');
		$_value_df = 'home_default';
		$flag = true;
		foreach($image_pro_types  as $_image){
			if($flag && $_image['name'] == $_value_df){
				$_value_df = $_image['name'] ;
				$flag = false;
			}
		}
		if ($flag) {
			$product_type = array_shift($image_pro_types);
			$_value_df = $_value = isset($product_type['name']) ?  $product_type['name'] : 'none';	
		}
		$datas = array(
			array(
				'id_aztabs' => 1,
				'title_module' => 'Featured Products',
				'display_title_module' => 1,
				'active' => 1,
				'moduleclass_sfx' => 'featured_products',
				'hook' => Hook::getIdByName('displayTab'),
				'nb_column1' => 4,
				'nb_column2' => 4,
				'nb_column3' => 3,
				'nb_column4' => 2,
				'target' => '_self',
				'show_loadmore_slider' => 'slider',
				
				'filter_type' => 'categories',
				'catids' => 'all',
				'count_number' => '10',
				'category_preload' => '',
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				
				'field_select' => 'name',
				'field_preload' => 'sales',
				'field_direction' => 'DESC',
				
				'display_tab_all' => 1,
				'display_icon' => 0,
				'cat_image_size' => isset($cat_types['name']) ? $cat_types['name'] : 'none',
				'cat_name_maxlength' => 25,
				'cat_field_ordering' => 'id_category',
				'cat_field_direction' => 'ASC',
		
				
				'image_size' => $_value_df ,
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				'display_wishlist' => 1,
				'display_compare' => 1,
				'display_addtocart' => 1,
				'display_detail' => 0,

				'duration' => 200,
				'interval' => 800,
				'effect' => 'zoomOut',
				
				'center' => 0,
				'nav' => 0,
				'loop' => 1,
				'margin' => 0,
				'slideBy' => 1,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'smartSpeed' => 1000,
				'startPosition' => 1,
				'mouseDrag' => 1,
				'touchDrag' => 1,
				'pullDrag' => 1
			),
			array(
				'id_aztabs' => 2,
				'title_module' => 'New Products',
				'display_title_module' => 1,
				'active' => 1,
				'moduleclass_sfx' => 'new_products',
				'hook' => Hook::getIdByName('displayTab2'),
				'nb_column1' => 4,
				'nb_column2' => 4,
				'nb_column3' => 3,
				'nb_column4' => 2,
				'target' => '_self',
				'show_loadmore_slider' => 'slider',
				
				'filter_type' => 'categories',
				'catids' => 'all',
				'count_number' => '10',
				
				'category_preload' => '',
				'products_ordering' => 'date_add',
				'ordering_direction' => 'ASC',
				
				'field_select' => 'date_add',
				'field_preload' => 'sales',
				'field_direction' => 'DESC',
				
				'display_tab_all' => 1,
				'display_icon' => 0,
				'cat_image_size' => isset($cat_types['name']) ? $cat_types['name'] : 'none',
				'cat_name_maxlength' => 25,
				'cat_field_ordering' => 'id_category',
				'cat_field_direction' => 'ASC',
		
				
				'image_size' => $_value_df ,
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				'display_wishlist' => 1,
				'display_compare' => 1,
				'display_addtocart' => 1,
				'display_detail' => 0,

				'duration' => 200,
				'interval' => 800,
				'effect' => 'zoomOut',
				'center' => 0,
				'nav' => 0,
				'loop' => 1,
				'margin' => 0,
				'slideBy' => 1,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'smartSpeed' => 1000,
				'startPosition' => 1,
				'mouseDrag' => 1,
				'touchDrag' => 1,
				'pullDrag' => 1
			)
		);

		$return = true;
		foreach ($datas as $i => $data)
		{
			$aztabs = new azTabsClass();
			$aztabs->hook = $data['hook'];
			$aztabs->active = $data['active'];
			$aztabs->ordering = $i;
			$aztabs->params = serialize($data);
			foreach (Language::getLanguages(false) as $lang)
				$aztabs->title_module[$lang['id_lang']] = $data['title_module'];

			$return &= $aztabs->add();
			
		}

		return $return;
	}
	
	public function getContent()
	{
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay') || Tools::isSubmit ('updateItemConfirmation'))
		{
			if ($this->postValidation())
			{
				if (Tools::isSubmit ('updateItemConfirmation') || Tools::isSubmit ('saveItem'))
					$this->html .= $this->displayConfirmation ($this->l('Module successfully updated!'));
				$this->html .= $this->postProcess();
				$this->html .= $this->renderForm();
			}
			else
				$this->html .= $this->renderForm();
		}
		elseif (Tools::isSubmit ('addItem') || (Tools::isSubmit('editItem')
				&& $this->moduleExists((int)Tools::getValue('id_aztabs'))) || Tools::isSubmit ('saveItem'))
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
				$associated_shop_ids = azTabsClass::getAssociatedIdsShop((int)Tools::getValue('id_aztabs'));
				$context_shop_id = (int)Shop::getContextShopID();
				if ($associated_shop_ids === false)
					$this->html .= $this->getShopAssociationError((int)Tools::getValue('id_aztabs'));
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
	{
		$errors = array();
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (!Validate::isInt(Tools::getValue('active')) || (Tools::getValue('active') != 0
					&& Tools::getValue('active') != 1))
				$errors[] = $this->l('Invalid module state.');
			if (!Validate::isInt(Tools::getValue('position')) || (Tools::getValue('position') < 0))
				$errors[] = $this->l('Invalid module position.');

			if (!Validate::isInt(Tools::getValue('count_number')) || floor (Tools::getValue('count_number')) < 0)
				$errors[] = $this->l('Invalid Count Number.');

			if (Tools::isSubmit('id_aztabs'))
			{
				if (!Validate::isInt(Tools::getValue('id_aztabs'))
					&& !$this->moduleExists(Tools::getValue('id_aztabs')))
					$errors[] = $this->l('Invalid module ID');
			}
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('  _'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
			}
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('title_module_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title module is not set.');
			if (Tools::strlen(Tools::getValue('moduleclass_sfx')) > 255)
				$errors[] = $this->l('The Module Class Suffix  is too long.');

			if (!is_numeric (Tools::getValue('count_number')) || floor (Tools::getValue('count_number')) < 0)
				$errors[] = $this->l('Invalid Count Number.');

			if (!is_numeric (Tools::getValue('interval')) || floor (Tools::getValue('interval')) < 0)
				$errors[] = $this->l('Invalid Interval');

			if (!is_numeric (Tools::getValue('duration')) || floor (Tools::getValue('duration')) < 0)
				$errors[] = $this->l('Invalid Speed');
		}
		elseif (Tools::isSubmit('id_aztabs') && (!Validate::isInt(Tools::getValue('id_aztabs'))
				|| !$this->moduleExists((int)Tools::getValue('id_aztabs'))))
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
			if (Tools::getValue('id_aztabs'))
			{
				$aztabs = new azTabsClass((int)Tools::getValue ('id_aztabs'));
				if (!Validate::isLoadedObject($aztabs))
				{
					$this->html .= $this->displayError($this->l('Invalid slide ID'));
					return false;
				}
			}
			else
				$aztabs = new azTabsClass();
			$aztabs = new azTabsClass(Tools::getValue ('id_aztabs'));
			$next_ps = $this->getNextPosition();
			$aztabs->ordering = (!empty($aztabs->ordering)) ? (int)$aztabs->ordering : $next_ps;
			$aztabs->active = (Tools::getValue('active')) ? (int)Tools::getValue('active') : 0;
			$aztabs->hook	= (int)Tools::getValue('hook');
			$tmp_data = array();
			//general options
			$id_aztabs = (int)Tools::getValue ('id_aztabs');
			$id_aztabs = $id_aztabs ? $id_aztabs : (int)$aztabs->getHigherModuleID();
			$tmp_data['id_aztabs'] = (int)$id_aztabs;
			$tmp_data['display_title_module'] = Tools::getValue ('display_title_module');
			$tmp_data['active'] = Tools::getValue ('active');
			$tmp_data['hook'] = Tools::getValue ('hook');
			for ($i = 1; $i < 5; $i ++)
				$tmp_data['nb_column'.$i] = Tools::getValue ('nb_column'.$i);
			$tmp_data['target'] = Tools::getValue ('target');
			$tmp_data['show_loadmore_slider'] = (string)Tools::getValue ('show_loadmore_slider');
			//source option
			$tmp_data['filter_type'] = Tools::getValue ('filter_type');
			$catids = Tools::getValue ('catids');
			$catids = ( is_array ($catids) && !empty( $catids ) )?implode (',', $catids):false;
			$tmp_data['catids'] = $catids;
			$tmp_data['count_number'] = Tools::getValue ('count_number');
			$tmp_data['category_preload'] = Tools::getValue ('category_preload');
			$tmp_data['products_ordering'] = Tools::getValue ('products_ordering');
			$tmp_data['ordering_direction'] = Tools::getValue ('ordering_direction');
			$field_select = Tools::getValue ('field_select');
			$field_select = ( is_array ($field_select) && !empty( $field_select ) )?implode (',', $field_select):false;
			$tmp_data['field_select'] = $field_select;
			$tmp_data['field_preload'] = Tools::getValue ('field_preload');
			$tmp_data['field_direction'] = Tools::getValue ('field_direction');
			//tab options
			$tmp_data['cat_image_size'] = Tools::getValue ('cat_image_size');
			$tmp_data['display_tab_all'] = Tools::getValue ('display_tab_all');
			$tmp_data['cat_name_maxlength'] = Tools::getValue ('cat_name_maxlength');
			$tmp_data['cat_field_ordering'] = Tools::getValue ('cat_field_ordering');
			$tmp_data['cat_field_direction'] = Tools::getValue ('cat_field_direction');
			$tmp_data['display_icon'] = Tools::getValue ('display_icon');
			//product options
			$tmp_data['image_size'] = Tools::getValue ('image_size');
			$tmp_data['display_name'] = Tools::getValue ('display_name');
			$tmp_data['name_maxlength'] = Tools::getValue ('name_maxlength');
			$tmp_data['display_description'] = Tools::getValue ('display_description');
			$tmp_data['description_maxlength'] = Tools::getValue ('description_maxlength');
			$tmp_data['display_price'] = Tools::getValue ('display_price');
			$tmp_data['display_wishlist'] = Tools::getValue ('display_wishlist');
			$tmp_data['display_compare'] = Tools::getValue ('display_compare');
			$tmp_data['display_addtocart'] = Tools::getValue ('display_addtocart');
			$tmp_data['display_detail'] = Tools::getValue ('display_detail');
			//effect options
			$tmp_data['duration'] = Tools::getValue ('duration');
			$tmp_data['interval'] = Tools::getValue ('interval');
			$tmp_data['effect'] = Tools::getValue ('effect');
			$tmp_data['center'] = (int)Tools::getValue ('center', 0);
			$tmp_data['nav'] = (int)Tools::getValue ('nav');
			$tmp_data['loop'] = (int)Tools::getValue ('loop');
			$tmp_data['margin'] = (int)Tools::getValue ('margin');
			$tmp_data['slideBy'] = (int)Tools::getValue ('slideBy');
			$tmp_data['autoplay'] = (int)Tools::getValue ('autoplay');
			$tmp_data['autoplayTimeout'] = (int)Tools::getValue ('autoplayTimeout');
			$tmp_data['autoplayHoverPause'] = (int)Tools::getValue ('autoplayHoverPause');
			$tmp_data['autoplaySpeed'] = (int)Tools::getValue ('autoplaySpeed');
			$tmp_data['navSpeed'] = (int)Tools::getValue ('navSpeed');
			$tmp_data['smartSpeed'] = (int)Tools::getValue ('smartSpeed');
			$tmp_data['startPosition'] = (int)Tools::getValue ('startPosition');
			$tmp_data['mouseDrag'] = (int)Tools::getValue ('mouseDrag');
			$tmp_data['touchDrag'] = (int)Tools::getValue ('touchDrag');
			$tmp_data['pullDrag'] = (int)Tools::getValue ('pullDrag');
			//addvance options
			$tmp_data['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx');
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
				$aztabs->title_module[$language['id_lang']] = Tools::getValue('title_module_'.$language['id_lang']);
			$aztabs->params = serialize($tmp_data);
			$get_id = Tools::getValue ('id_aztabs');
			($get_id && $this->moduleExists($get_id) )? $aztabs->update() : $aztabs->add ();
			$this->clearCacheItemForHook ();
			if (Tools::isSubmit ('saveAndStay'))
			{
				$id_aztabs = Tools::getValue ('id_aztabs')?
					(int)Tools::getValue ('id_aztabs'):(int)$aztabs->getHigherModuleID ();

				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_aztabs='
					.$id_aztabs.'&updateItemConfirmation');
			}
			else
				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&saveItemConfirmation');
		}
		elseif (Tools::isSubmit ('changeStatusItem') && Tools::getValue ('id_aztabs'))
		{
			$aztabs = new azTabsClass((int)Tools::getValue ('id_aztabs'));
			if ($aztabs->active == 0)
				$aztabs->active = 1;
			else
				$aztabs->active = 0;
			$aztabs->update();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
				.'&token='.Tools::getAdminTokenLite ('AdminModules'));
		}
		elseif (Tools::isSubmit ('deleteItem') && Tools::getValue ('id_aztabs'))
		{
			$aztabs = new azTabsClass(Tools::getValue ('id_aztabs'));
			$aztabs->delete ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
				.'&deleteItemConfirmation');
		}
		elseif (Tools::isSubmit ('duplicateItem') && Tools::getValue ('id_aztabs'))
		{
			$aztabs = new azTabsClass(Tools::getValue ('id_aztabs'));
			foreach (Language::getLanguages (false) as $lang)
				$aztabs->title_module[(int)$lang['id_lang']] = $aztabs->title_module[(int)$lang['id_lang']].$this->l(' (Copy)');
			$aztabs->duplicate ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&duplicateItemConfirmation');
		}
		elseif (Tools::isSubmit ('saveItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module created successfully!'));
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

	private function getHookName($id_hook)
	{
		if (!$result = Db::getInstance ()->getRow ('
		SELECT `name`,`title` FROM `'._DB_PREFIX_.'hook` WHERE `id_hook` = '.( $id_hook )))
			return false;
		return $result['name'];
	}

	public function moduleExists($id_module)
	{
		$req = 'SELECT cs.`id_aztabs`
				FROM `'._DB_PREFIX_.'aztabs` cs
				WHERE cs.`id_aztabs` = '.(int)$id_module;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
		return ($row);
	}
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(cs.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'aztabs` cs, `'._DB_PREFIX_.'aztabs_shop` css
			WHERE css.`id_aztabs` = cs.`id_aztabs`
			AND css.`id_shop` = '.(int)$this->context->shop->id
		);
		return (++$row['next_position']);
	}

	private function getGridItems()
	{
		$this->context = Context::getContext ();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		if (!$result = Db::getInstance ()->ExecuteS ('
			SELECT b.`id_aztabs`, b.`hook`, b.`ordering`, bs.`active`, bl.`title_module`
			FROM `'._DB_PREFIX_.'aztabs` b
			LEFT JOIN `'._DB_PREFIX_.'aztabs_shop` bs ON (b.`id_aztabs` = bs.`id_aztabs`)
			LEFT JOIN `'._DB_PREFIX_.'aztabs_lang` bl ON (b.`id_aztabs` = bl.`id_aztabs`'
			.( $id_shop?'AND bs.`id_shop` = '.$id_shop:' ' ).')
			WHERE bl.`id_lang` = '.(int)$id_lang.( $id_shop?' AND bs.`id_shop` = '.$id_shop:' ' ).'
			ORDER BY b.`ordering`'))
			return false;
		return $result;
	}
	private function getHookTitle($id_hook, $name = false)
	{
		if (!$result = Db::getInstance ()->getRow ('
			SELECT `name`,`title` FROM `'._DB_PREFIX_.'hook` WHERE `id_hook` = '.( $id_hook )))
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
					$associated_shop_ids = azTabsClass::getAssociatedIdsShop((int)$mod['id_aztabs']);
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
					<a class="list-toolbar-btn" href="'.$currentIndex
			.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
			.'&addItem"><span data-toggle="tooltip" class="label-tooltip" data-original-title="'
			.$this->l('Add new module').'" data-html="true"><i class="process-icon-new "></i></span></a>
			</span>
			</div>
			<table width="100%" class="table" cellspacing="0" cellpadding="0">
			<thead>
			<tr class="nodrag nodrop">
				<th>'.$this->l('Module ID').'</th>
				<th>'.$this->l('Module Ordering').'</th>
				<th class=" left">'.$this->l('Module Title').'</th>
				<th class=" left">'.$this->l('Module Hook ').'</th>
				<th class=" left">'.$this->l('Module Status').'</th>
				<th class=" right"><span class="title_box text-right">'.$this->l('Actions').'</span></th>
			</tr>
			</thead>
			<tbody id="gird_items">';
		if (!empty($modules))
		{
			static $irow;
			foreach ($modules as $mod)
			{
				$this->html .= '
				<tr id="item_'.$mod['id_aztabs'].'" class=" '.( $irow ++ % 2?' ':'' ).'">
					<td class=" 	" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_aztabs='
					.$mod['id_aztabs'].'\'">'
					.$mod['id_aztabs'].'</td>
					<td class=" dragHandle"><div class="dragGroup"><div class="positions">'.$mod['ordering']
					.'</div></div></td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_aztabs='.$mod['id_aztabs'].'\'">'
					.$mod['title_module'].' '
					.($mod['is_shared'] ? '<span class="label color_field"
				style="background-color:#108510;color:white;margin-top:5px;">'.$this->l('Shared').'</span>' : '').'</td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_aztabs='.$mod['id_aztabs'].'\'">'
					.( Validate::isInt ($mod['hook'])?$this->getHookTitle ($mod['hook']):'' ).'</td>
					<td class="  "> <a href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&changeStatusItem&id_aztabs='
					.$mod['id_aztabs'].'&status='
					.$mod['active'].'&hook='.$mod['hook'].'">'
					.( $mod['active']?'<i class="icon-check"></i>':'<i class="icon-remove"></i>' ).'</a> </td>
					<td class="text-right">
						<div class="btn-group-action">
							<div class="btn-group pull-right">
								<a class="btn btn-default" href="'.$currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_aztabs='
					.$mod['id_aztabs'].'">
									<i class="icon-pencil"></i> Edit
								</a>
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<span class="caret"></span>&nbsp;
								</button>
								<ul class="dropdown-menu">
									<li>
									<a onclick="return confirm(\''.$this->l('Are you sure want duplicate this item?',
						__CLASS__, true, false).'\');"  title="'.$this->l('Duplicate').'" href="'
					.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&duplicateItem&id_aztabs='
					.$mod['id_aztabs'].'">
											<i class="icon-copy"></i> '.$this->l('Duplicate').'
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a title ="'.$this->l('Delete')
					.'" onclick="return confirm(\''.$this->l('Are you sure?',
						__CLASS__, true, false).'\');" href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&deleteItem&id_aztabs='
					.$mod['id_aztabs'].'">
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

	protected function generateCategoriesOption($categories, $current = null, $id_selected = 1)
	{
		foreach ($categories as $category)
		{
			$this->categories[$category['id_category']] = str_repeat(' -|- ', $category['level_depth'] * 1)
				.Tools::stripslashes($category['name']);
			if (isset($category['children']) && !empty($category['children']))
			{
				$current = $category['id_category'];
				$this->generateCategoriesOption($category['children'], $current, $id_selected);
			}
		}
	}
	public function customGetNestedCategories($shop_id, $root_category = null, $id_lang = false, $active = true,
		$groups = null, $use_shop_restriction = true, $sql_filter = '',
		$sql_sort = '', $sql_limit = '')
	{
		if (isset($root_category) && !Validate::isInt($root_category))
			die(Tools::displayError());
		if (!Validate::isBool($active))
			die(Tools::displayError());
		if (isset($groups) && Group::isFeatureActive() && !is_array($groups))
			$groups = (array)$groups;
		$cache_id = 'Category::getNestedCategories_'.md5((int)$shop_id
				.(int)$root_category.(int)$id_lang.(int)$active.(int)$active
				.(isset($groups) && Group::isFeatureActive() ? implode('', $groups) : ''));
		if (!Cache::isStored($cache_id))
		{
			$result = Db::getInstance()->executeS('
				SELECT c.*, cl.*
				FROM `'._DB_PREFIX_.'category` c
				INNER JOIN `'._DB_PREFIX_.'category_shop` category_shop
				ON (category_shop.`id_category` = c.`id_category` AND category_shop.`id_shop` = "'.(int)$shop_id.'")
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
				ON (c.`id_category` = cl.`id_category` AND cl.`id_shop` = "'.(int)$shop_id.'")
				WHERE 1 '.$sql_filter.' '.($id_lang ? 'AND cl.`id_lang` = '.(int)$id_lang : '').'
				'.($active ? ' AND (c.`active` = 1 OR c.`is_root_category` = 1)' : '').'
			'.(isset($groups) && Group::isFeatureActive() ? ' AND cg.`id_group` IN ('.implode(',', $groups).')' : '').'
				'.(!$id_lang || (isset($groups) && Group::isFeatureActive()) ? ' GROUP BY c.`id_category`' : '').'
				'.($sql_sort != '' ? $sql_sort : ' ORDER BY c.`level_depth` ASC , c.`nleft` ASC').'
				'.($sql_sort == '' && $use_shop_restriction ? ', category_shop.`position` ASC' : '').'
				'.($sql_limit != '' ? $sql_limit : '')
			);

			$categories = array();
			$buff = array();
			foreach ($result as $row)
			{
				$current = &$buff[$row['id_category']];
				$current = $row;
				if ($row['id_parent'] == 0)
					$categories[$row['id_category']] = &$current;
				else
					$buff[$row['id_parent']]['children'][$row['id_category']] = &$current;
			}
			Cache::store($cache_id, $categories);
		}
		return Cache::retrieve($cache_id);
	}

	private function descFormHtml($text = null)
	{
		return array(
			'type'         => 'html',
			'name'         => 'description',
			'html_content' => '<div style="color:#666;font-weight:bold;text-transform:uppercase;
			border-bottom:solid 1px #666;padding-bottom:5px;width:250px;">
        <i class="icon-star"></i>  '.$text.'</div>',
		);
	}

	public function getCatSelect($default = false)
	{
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));
		$catopt = array();
		if (!empty( $this->categories ))
		{
			foreach ($this->categories as $key => $cat)
			{
				if ($cat !== 'Root')
				{
					if ($default)
						$catopt[] = $key;
					else
					{
						$tmp = array();
						if ($cat != '')
						{
							$tmp['id_option'] = $key;
							$tmp['name'] = $cat;
							$catopt[] = $tmp;
						}
					}
				}
			}
		}
		return $catopt;
	}

	public function renderForm()
	{
		$image_cat_types = ImageType::getImagesTypes ('categories');
		$image_pro_types = ImageType::getImagesTypes ('products');
		array_push ($image_cat_types, array( 'name' => 'none' ));
		array_push ($image_pro_types, array( 'name' => 'none' ));
		$default_lang = (int)Configuration::get ('PS_LANG_DEFAULT');
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));

		$catopt = $this->getCatSelect();

		$hooks = $this->getHookList ();
		$opt_column = array(
			array(
				'id_option' => 1,
				'name'      => 1
			),
			array(
				'id_option' => 2,
				'name'      => 2
			),
			array(
				'id_option' => 3,
				'name'      => 3
			),
			array(
				'id_option' => 4,
				'name'      => 4
			),
			array(
				'id_option' => 5,
				'name'      => 5
			),
			array(
				'id_option' => 6,
				'name'      => 6
			)
		);
		$opt_target = array(
			array(
				'id_option' => '_blank',
				'name'      => $this->l('New Window')
			),
			array(
				'id_option' => '_self',
				'name'      => $this->l('Same Window')
			),
			array(
				'id_option' => '_windowopen',
				'name'      => $this->l('Popup window')
			)
		);

		$this->fields_form[0]['form'] = array(
			'tinymce' => true,
			'legend'  => array(
				'title' => $this->l('General Settings'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'     => 'text',
					'label'    => $this->l('Module Title'),
					'lang'     => true,
					'hint'   => $this->l('Display title of module.'),
					'name'     => 'title_module',
					'class'    => 'fixed-width-xl'
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Active Module Title'),
					'name'   => 'display_title_module',
					'hint'   => $this->l('Allow show/hide title of module.'),
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
					'type'   => 'switch',
					'label'  => $this->l('Active Module'),
					'hint'   => $this->l('Enable/Disable Module.'),
					'name'   => 'active',
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
					'hint'  => $this->l('A class name to be applied to the CSS class of the module.
					This allows for individual module styling.'),
					'class' => 'fixed-width-xl'
				),
				
				array(
					'type'    => 'select',
					'label'   => $this->l('Select Hook'),
					'hint'   => $this->l('Display content module in Hook'),
					'name'    => 'hook',
					'options' => array(
						'query' => $hooks,
						'id'    => 'key',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Column [on Large Screens]'),
					'name'    => 'nb_column1',
					'hint'    => $this->l('For devices have screen width from 1200px to greater.'),
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Column [on Medium Screens]'),
					'name'    => 'nb_column2',
					'hint'    => $this->l('For devices have screen width from 768px up to 1199px.'),
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Column [on Small Screens]'),
					'name'    => 'nb_column3',
					'hint'    => $this->l('For devices have screen width from 480px up to 767px.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Column [on Extra Small Screens]'),
					'name'    => 'nb_column4',
					'hint'    => $this->l('For devices have screen width less than or equal 479px.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Target Link'),
					'name'    => 'target',
					'hint'    => $this->l('The Type shows when you click on the link.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_target,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Select Type Show For Module'),
					'name'    => 'show_loadmore_slider',
					'hint'    => $this->l('Select Type Show For Module is LoadMore or Slider.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'loadmore',
								'name'      => $this->l('Load More')
							),
							array(
								'id_option' => 'slider',
								'name'      => $this->l('Slider')
							)
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
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

		$this->fields_form[1]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Source Settings '),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				$this->descFormHtml ('Settings for General'),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select type of tabs'),
					'hint'    => $this->l('Display type of tabs show for module.'),
					'name'    => 'filter_type',
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'categories',
								'name'      => $this->l('Categories')
							),
							array(
								'id_option' => 'field',
								'name'      => $this->l('Field Products')
							)
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type' => 'categories',
					'label' => 'Select Categories',
					'name' => 'catids',
					'tree' => array(
						'id' => 'id_category',
						'use_checkbox' => true,
						'use_search'  => true,
						'name' => 'catids',
						'selected_categories' => $this->getFormValuesCat(),
						'root_category'       => Context::getContext()->shop->getCategory(),
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Products Limition'),
					'name'  => 'count_number',
					'hint'  => $this->l('Define the number of products to be displayed in this block.'),
					'class' => 'fixed-width-xl'
				),
				$this->descFormHtml ('Settings for Categories'),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Category Preload'),
					'hint'    => $this->l('This Category will be active in preload'),
					'name'    => 'category_preload',
					'class'   => 'fixed-width-xxl',
					'height'  => '300px',
					'options' => array(
						'query' => $catopt,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Product Field to Order By'),
					'name'    => 'products_ordering',
					'hint'    => $this->l('Select field you would like Products.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_product',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'sales',
								'name'      => $this->l('Best Sellers')
							),
							array(
								'id_option' => 'date_add',
								'name'      => $this->l('New Arrials')
							),
							array(
								'id_option' => 'price',
								'name'      => $this->l('Hot Products')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Ordering Direction'),
					'name'    => 'ordering_direction',
					'hint'    => $this->l('Select the direction you would like Products.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'DESC',
								'name'      => $this->l('Descending')
							),
							array(
								'id_option' => 'ASC',
								'name'      => $this->l('Ascending')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				$this->descFormHtml ('Settings For Field Products'),
				array(
					'type'     => 'select',
					'lang'     => true,
					'label'    => $this->l('Select Field to Order By'),
					'name'     => 'field_select[]',
					'hint'     => $this->l('Choose the order by for product.'),
					'class'    => 'fixed-width-xxl',
					'height'   => '500px',
					'multiple' => 'multiple',
					'options'  => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_product',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'sales',
								'name'      => $this->l('Best Sellers')
							),
							array(
								'id_option' => 'date_add',
								'name'      => $this->l('New Arrials')
							),
							array(
								'id_option' => 'price',
								'name'      => $this->l('Hot Products')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Field Preload'),
					'name'    => 'field_preload',
					'hint'    => $this->l('Product Field to Order By.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_product',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'sales',
								'name'      => $this->l('Best Sellers')
							),
							array(
								'id_option' => 'date_add',
								'name'      => $this->l('New Arrials')
							),
							array(
								'id_option' => 'price',
								'name'      => $this->l('Hot Products')
							),
							
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Field Ordering Direction'),
					'name'    => 'field_direction',
					'hint'    => $this->l('Select the direction you would like Products.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'DESC',
								'name'      => $this->l('Descending')
							),
							array(
								'id_option' => 'ASC',
								'name'      => $this->l('Ascending')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),

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

		$this->fields_form[2]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Tabs Settings '),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'    => 'switch',
					'label'   => $this->l('Display Tab All'),
					'name'    => 'display_tab_all',
					'hint'    => $this->l('Allow to show/hide tab all'),
					'is_bool' => true,
					'values'  => array(
						array(
							'id'    => 'avatar_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'avatar_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'    => 'switch',
					'label'   => $this->l('Display Category Image'),
					'name'    => 'display_icon',
					'hint'    => $this->l('Allow to show/hide image of categories'),
					'is_bool' => true,
					'values'  => array(
						array(
							'id'    => 'avatar_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'avatar_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Size image (W x H)'),
					'hint'    => $this->l('Select size image you would like Category.'),
					'name'    => 'cat_image_size',
					'options' => array(
						'query' => $image_cat_types,
						'id'    => 'name',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Categories Order By'),
					'hint'  => $this->l('Categories Order By'),
					'name'    => 'cat_field_ordering',
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_category',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'rand',
								'name'      => $this->l('Random')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Categories Ordering Direction'),
					'name'    => 'cat_field_direction',
					'hint'    => $this->l('Select the direction you would like Categories to be ordered by.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'ASC',
								'name'      => $this->l('Ascending')
							),
							array(
								'id_option' => 'DESC',
								'name'      => $this->l('Descending')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				
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

		$this->fields_form[3]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Product Settings '),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'    => 'select',
					'label'   => $this->l('Size image (W x H)'),
					'hint'    => $this->l('Select image size you would like Product.'),
					'name'    => 'image_size',
					'options' => array(
						'query' => $image_pro_types,
						'id'    => 'name',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'switch',
					'label'   => $this->l('Display Name'),
					'name'    => 'display_name',
					'hint'    => $this->l('Allow to show/hide name of product'),
					'is_bool' => true,
					'values'  => array(
						array(
							'id'    => 'avatar_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'avatar_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Name Maxlength'),
					'name'  => 'name_maxlength',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('The max length of title can be showed. Choose 0 for showing full title.')
				),
				array(
					'type'    => 'switch',
					'label'   => $this->l('Display Description'),
					'name'    => 'display_description',
					'hint'    => $this->l('Allow to show/hide description of product'),
					'is_bool' => true,
					'values'  => array(
						array(
							'id'    => 'avatar_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'avatar_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Description Maxlength'),
					'name'  => 'description_maxlength',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('The max length of description can be showed. Choose 0 for showing full description.')
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Price'),
					'name'   => 'display_price',
					'hint'   => $this->l('Allow to show/hide Price of product'),
					'values' => array(
						array(
							'id'    => 'price_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'price_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Add to Cart'),
					'name'   => 'display_addtocart',
					'hint'   => $this->l('Allow to show/hide button Addtocart of product'),
					'values' => array(
						array(
							'id'    => 'addcart_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'addcart_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Add to Wishlist'),
					'name'   => 'display_wishlist',
					'hint'   => $this->l('Allow to show/hide button Wishlist of product'),
					'values' => array(
						array(
							'id'    => 'on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Add to Compare'),
					'name'   => 'display_compare',
					'hint'   => $this->l('Allow to show/hide button Compare of product'),
					'values' => array(
						array(
							'id'    => 'on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				
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

		$this->fields_form[4]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Effect Settings'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'   => 'text',
					'label'  => $this->l('Speed'),
					'name'   => 'duration',
					'class'  => 'fixed-width-xl',
					'hint'   => $this->l('Speed of module. Larger = Slower.'),
					'suffix' => 'ms',
				),
				array(
					'type'   => 'text',
					'label'  => $this->l('Interval'),
					'name'   => 'interval',
					'class'  => 'fixed-width-xl',
					'hint'   => 'Speed of Timer. Larger = Slower.',
					'suffix' => 'ms',
				),

				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Effect'),
					'name'    => 'effect',
					'hint'    => $this->l('Choose the effect for the module here.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'slideLeft',
								'name'      => $this->l('Slide Left')
							),
							array(
								'id_option' => 'slideRight',
								'name'      => $this->l('Slide Right')
							),
							array(
								'id_option' => 'zoomOut',
								'name'      => $this->l('Zoom Out')
							),
							array(
								'id_option' => 'zoomIn',
								'name'      => $this->l('Zoom In')
							),
							array(
								'id_option' => 'flip',
								'name'      => $this->l('Flip')
							),
							array(
								'id_option' => 'flipInX',
								'name'      => $this->l('Fip in Vertical')
							),
							array(
								'id_option' => 'flipInY',
								'name'      => $this->l('Flip in Horizontal')
							),
							array(
								'id_option' => 'starwars',
								'name'      => $this->l('Star Wars')
							),
							array(
								'id_option' => 'bounceIn',
								'name'      => $this->l('Bounce In')
							),
							array(
								'id_option' => 'fadeIn',
								'name'      => $this->l('Fade In')
							),
							array(
								'id_option' => 'pageTop',
								'name'      => $this->l('Page Top')
							)
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				$this->descFormHtml ('Settings For Layout Slider'),
				
				array(
					'type'  => 'text',
					'label' => $this->l('Select Step'),
					'name'  => 'slideBy',
					'class' => 'fixed-width-xl',
					'hint'  => 'Navigation slide by x. page string can be set to slide by page.',
				),
				
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Loop'),
					'name'   => 'loop',
					'hint'   => $this->l('Infinity loop. Duplicate last and first items to get loop illusion.'),
					'values' => array(
						array(
							'id'    => 'lop_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'lop_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				
				
				array(
					'type'   => 'switch',
					'label'  => $this->l('Auto Play'),
					'name'   => 'autoplay',
					'hint'   => $this->l('Allow to on/off auto play for slider'),
					'values' => array(
						array(
							'id'    => 'auto_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'auto_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				
				array(
					'type'   => 'switch',
					'label'  => $this->l('Pause On Hover'),
					'name'   => 'autoplayHoverPause',
					'hint'   => $this->l('Pause on mouse hover'),
					'values' => array(
						array(
							'id'    => 'pause_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'pause_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				
				array(
					'type'   => 'switch',
					'label'  => $this->l('Show Button Next/Prev'),
					'name'   => 'nav',
					'hint'   => $this->l('Allow to show/hide navigation for slider'),
					'values' => array(
						array(
							'id'    => 'nav_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'nav_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				
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
		$helper->name_controller = 'aztabs';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite ('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules');
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
			'save'          => array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
			),
			'back'          => array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules'),
				'desc' => $this->l('Back to list')
			),
			'save-and-stay' => array(
				'title' => $this->l('Save then add another value'),
				'name'  => 'submitAdd'.$this->table.'AndStay',
				'type'  => 'submit',
				'class' => 'btn btn-default pull-right',
				'icon'  => 'process-icon-save'
			)
		);

		$id_aztabs = Tools::getValue ('id_aztabs');
		if (Tools::isSubmit ('id_aztabs') && $id_aztabs)
		{
			$aztabs = new azTabsClass((int)$id_aztabs);
			$this->fields_form[0]['form']['input'][] = array(
				'type' => 'hidden',
				'name' => 'id_aztabs'
			);
			$params = unserialize($aztabs->params);
			$helper->fields_value['id_aztabs'] = (int)Tools::getValue ('id_aztabs',
				$aztabs->id_aztabs);
		}
		else
		{
			$aztabs = new azTabsClass();
			$params = array();
		}

		foreach (Language::getLanguages (false) as $lang)
		{
			$aztabs_title_module = $aztabs->title_module[(int)$lang['id_lang']];
			$title_module_lang = 'title_module_'.(int)$lang['id_lang'];
			$helper->fields_value['title_module'][(int)$lang['id_lang']] = Tools::getValue($title_module_lang, $aztabs_title_module);
		}
		//for general options
		$helper->fields_value['display_title_module'] = (int)Tools::getValue ('display_title_module',
			isset( $params['display_title_module'] )?$params['display_title_module']:1);
		$helper->fields_value['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx',
			isset( $params['moduleclass_sfx'] )?$params['moduleclass_sfx']:'');
		$helper->fields_value['hook'] = (string)Tools::getValue ('hook', $aztabs->hook);
		$helper->fields_value['active'] = (int)Tools::getValue ('active', $aztabs->active);
		$helper->fields_value['nb_column1'] = (int)Tools::getValue ('nb_column1', isset( $params['nb_column1'] )?$params['nb_column1']:6);
		$helper->fields_value['nb_column2'] = (int)Tools::getValue ('nb_column2', isset( $params['nb_column2'] )?$params['nb_column2']:4);
		$helper->fields_value['nb_column3'] = (int)Tools::getValue ('nb_column3', isset( $params['nb_column3'] )?$params['nb_column3']:2);
		$helper->fields_value['nb_column4'] = (int)Tools::getValue ('nb_column5', isset( $params['nb_column4'] )?$params['nb_column4']:1);
		$helper->fields_value['target'] = (string)Tools::getValue ('target', isset( $params['target'] )?$params['target']:'_self');
		$helper->fields_value['show_loadmore_slider'] = (string)Tools::getValue ('show_loadmore_slider',
			isset( $params['show_loadmore_slider'] )?$params['show_loadmore_slider']:'loadmore');
		//for source options
		$helper->fields_value['filter_type'] = (string)Tools::getValue ('filter_type',
			isset( $params['filter_type'] )?$params['filter_type']:'categories');
		if ($this->getCatSelect(true) != null && isset($params['catids']))
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 5);
			else
				$catids = $params['catids'];
		}
		else
			$catids = false;
		if (!is_array($catids))
			$catids = explode(',', $catids);
		$helper->fields_value['catids[]'] = $catids;
		$helper->fields_value['count_number'] = (int)Tools::getValue ('count_number',
			isset( $params['count_number'] )?$params['count_number']:8);
			//for category
		$helper->fields_value['category_preload'] = Tools::getValue ('category_preload',
			isset( $params['category_preload'] )?$params['category_preload']:false);
		$helper->fields_value['products_ordering'] = (string)Tools::getValue ('products_ordering',
			( isset( $params['products_ordering'] ) )?$params['products_ordering']:'name');
		$helper->fields_value['ordering_direction'] = (string)Tools::getValue ('ordering_direction',
			( isset( $params['ordering_direction'] ) )?$params['ordering_direction']:'DESC');
			// for field
		$helper->fields_value['field_select[]'] = Tools::getValue ('field_select',
			( isset( $params['field_select'] ) && $params['field_select'] !== false )?explode (',', $params['field_select']):false);
		$helper->fields_value['field_preload'] = (string)Tools::getValue ('field_preload',
			isset( $params['field_preload'] )?$params['field_preload']:'name');
		$helper->fields_value['field_direction'] = (string)Tools::getValue ('field_direction',
			isset( $params['field_direction'] )?$params['field_direction']:'ASC');
		//for categories options
		$helper->fields_value['display_tab_all'] = (int)Tools::getValue ('display_tab_all',
			isset( $params['display_tab_all'] )?$params['display_tab_all']:1);
		$helper->fields_value['cat_name_maxlength'] = (int)Tools::getValue ('cat_name_maxlength',
			isset( $params['cat_name_maxlength'] )?$params['cat_name_maxlength']:0);
		$helper->fields_value['cat_field_ordering'] = (string)Tools::getValue ('cat_field_ordering',
			isset( $params['cat_field_ordering'] )?$params['cat_field_ordering']:'name');
		$helper->fields_value['cat_field_direction'] = (string)Tools::getValue ('cat_field_direction',
			isset( $params['cat_field_direction'] )?$params['cat_field_direction']:'ASC');
		$helper->fields_value['display_icon'] = (int)Tools::getValue ('display_icon',
			isset( $params['display_icon'] )?$params['display_icon']:1);
		$helper->fields_value['cat_image_size'] = (string)Tools::getValue ('cat_image_size',
			isset( $params['cat_image_size'] )?$params['cat_image_size']:'');
		//for product options
		$helper->fields_value['image_size'] = (string)Tools::getValue ('image_size',
			( isset( $params['image_size'] ) )?$params['image_size']:'');
		$helper->fields_value['display_name'] = (int)Tools::getValue ('display_name',
			isset( $params['display_name'] )?$params['display_name']:1);
		$helper->fields_value['name_maxlength'] = (int)Tools::getValue ('name_maxlength',
			isset( $params['name_maxlength'] )?$params['name_maxlength']:25);
		$helper->fields_value['display_description'] = (int)Tools::getValue ('display_description',
			isset( $params['display_description'] )?$params['display_description']:0);
		$helper->fields_value['description_maxlength'] = (int)Tools::getValue ('description_maxlength',
			isset( $params['description_maxlength'] )?$params['description_maxlength']:100);
		$helper->fields_value['display_price'] = (int)Tools::getValue ('display_price',
			isset( $params['display_price'] )?$params['display_price']:1);
		$helper->fields_value['display_addtocart'] = (int)Tools::getValue ('display_addtocart',
			isset( $params['display_addtocart'] )?$params['display_addtocart']:1);
		$helper->fields_value['display_wishlist'] = (int)Tools::getValue ('display_wishlist',
			isset( $params['display_wishlist'] )?$params['display_wishlist']:0);
		$helper->fields_value['display_compare'] = (int)Tools::getValue ('display_compare',
			isset( $params['display_compare'] )?$params['display_compare']:0);
		$helper->fields_value['display_detail'] = (int)Tools::getValue ('display_detail',
			isset( $params['display_detail'] )?$params['display_detail']:1);
		//for effect options
		$helper->fields_value['duration'] = (int)Tools::getValue ('duration', isset( $params['duration'] )?$params['duration']:500);
		$helper->fields_value['interval'] = (int)Tools::getValue ('interval', isset( $params['interval'] )?$params['interval']:1500);
		$helper->fields_value['effect'] = (string)Tools::getValue ('effect', isset( $params['effect'] )?$params['effect']:'flip');
		//for layout slider
		$helper->fields_value['center'] = (int)Tools::getValue ('center', isset( $params['center'] )?$params['center']:0);
		$helper->fields_value['nav'] = (int)Tools::getValue ('nav', isset( $params['nav'] )?$params['nav']:1);
		$helper->fields_value['loop'] = (int)Tools::getValue ('loop', isset( $params['loop'] )?$params['loop']:1);
		$helper->fields_value['margin'] = (int)Tools::getValue ('margin',
			isset( $params['margin'] )?$params['margin']:0);
		$helper->fields_value['slideBy'] = (int)Tools::getValue ('slideBy',
			isset( $params['slideBy'] )?$params['slideBy']:1);
		$helper->fields_value['autoplay'] = (int)Tools::getValue ('autoplay', isset( $params['autoplay'] )?$params['autoplay']:1);
		$helper->fields_value['autoplayTimeout'] = (int)Tools::getValue ('autoplayTimeout',
			isset( $params['autoplayTimeout'] )?$params['autoplayTimeout']:1000);
		$helper->fields_value['autoplayHoverPause'] = (int)Tools::getValue ('autoplayHoverPause',
			isset( $params['autoplayHoverPause'] )?$params['autoplayHoverPause']:1);
		$helper->fields_value['autoplaySpeed'] = (int)Tools::getValue ('autoplaySpeed',
			isset( $params['autoplaySpeed'] )?$params['autoplaySpeed']:1500);
		$helper->fields_value['navSpeed'] = (int)Tools::getValue ('navSpeed', isset( $params['navSpeed'] )?$params['navSpeed']:1500);
		$helper->fields_value['smartSpeed'] = (int)Tools::getValue ('smartSpeed', isset( $params['smartSpeed'] )?$params['smartSpeed']:1500);
		$helper->fields_value['startPosition'] = (int)Tools::getValue ('startPosition', isset( $params['startPosition'] )?$params['startPosition']:0);
		$helper->fields_value['mouseDrag'] = (int)Tools::getValue ('mouseDrag', isset( $params['mouseDrag'] )?$params['mouseDrag']:1);
		$helper->fields_value['touchDrag'] = (int)Tools::getValue ('touchDrag', isset( $params['touchDrag'] )?$params['touchDrag']:1);
		$helper->fields_value['pullDrag'] = (int)Tools::getValue ('pullDrag', isset( $params['pullDrag'] )?$params['pullDrag']:1);
		//for addvace options
		$this->html .= $helper->generateForm ($this->fields_form);
	}

	private function getFormValuesCat()
	{
		$id_aztabs = Tools::getValue ('id_aztabs');
		if (Tools::isSubmit ('id_aztabs') && $id_aztabs)
		{
			$aztabs = new azTabsClass((int)$id_aztabs);
			$params = unserialize($aztabs->params);
		}
		else
		{
			$aztabs = new azTabsClass();
			$params = array();
		}
		if ($this->getCatSelect(true) != null && isset($params['catids']) && $params['catids'])
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 5);
			else
				$catids = $params['catids'];
			$catids = (!empty($catids) && is_string($catids)) ? explode(',', $catids) : $catids;
			$catids = Tools::getValue ('catids', $catids);
			$catids1 = array();
			foreach ($catids as $cat)
				$catids1[] = (int)$cat;
		}
		else
			$catids1 = array();
		return $catids1;
	}

	private function getCategoriesInfor($catids, $params)
	{
		!is_array ($catids) && settype ($catids, 'array');
		if (empty( $catids ))
			return;
		$context = Context::getContext ();
		$id_lang = (int)$context->language->id;
		$cat_root = '';
		foreach ($catids as $cat)
		{
			$category = new Category($cat);
			if ($category->isRootCategoryForAShop())
			{
				$cat_root .= $cat;
				break;
			}
		}
		$categories = Category::getCategoryInformations ($catids, $id_lang);
		if (empty( $categories ))
			return;
		$list = array();
		foreach ($categories as $category)
		{
			$category_image_url = $this->context->link->getCatImageLink (
				$category['link_rewrite'],
			$category['id_category']);
			$category['image'] = $category_image_url;
			$category['count'] = $this->countProduct ($category['id_category'], $params);
			$category['link'] = $this->context->link->getCategoryLink ($category['id_category'], $category['link_rewrite']);
			$category['_target'] = $this->parseTarget ($params['target']);
			$category['name'] = $this->truncate ($category['name'], $params['cat_name_maxlength']);
			$list[] = $category;
		}
		$cat_order_by = $params['cat_field_ordering'];
		$cat_ordering = $params['cat_field_direction'];
		if ($cat_order_by != null)
		{
			switch ($cat_order_by)
			{
				default:
				case 'name':
					if ($cat_ordering == 'ASC')
						usort ($list, create_function ('$a, $b', 'return strnatcasecmp( $a["name"], $b["name"]);'));
					else
						usort ($list, create_function ('$a, $b', 'return strnatcasecmp( $b["name"], $a["name"]);'));
					break;
				case 'id_category':
					if ($cat_ordering == 'ASC')
						usort ($list, create_function ('$a, $b', 'return $a["id_category"] > $b["id_category"];'));
					else
						usort ($list, create_function ('$a, $b', 'return $a["id_category"] < $b["id_category"];'));
					break;
				case 'rand':
					shuffle ($list);
					break;
			}
		}

		return $list;
	}

	public function getProductInfor($params, $catids, $count_product = false, $product_filter = null)
	{
		if ($catids == '*')
			$catids = $this->getCatIds ($params);
		!is_array ($catids) && settype ($catids, 'array');
		$products = $this->getProducts ($catids, $params, $count_product, $product_filter);
		if (empty( $products ))
			return;
		$list = array();
		foreach ($products as $product)
		{
			$obj = new Product(( $product['id_product'] ), false, $this->context->language->id);
			$images = $obj->getImages ($this->context->language->id);
			$images_pro = array();
			if (!empty( $images ))
			{
				foreach ($images as $image)
					$images_pro[] = $obj->id.'-'.$image['id_image'];
			}
			$product['title'] = $this->truncate ($product['name'], $params['name_maxlength']);
			$product['desc'] = $this->cleanText ($product['description']);
			$product['desc'] = $this->trimEncode ($product['desc']) != ''?$product['desc']:$this->cleanText ($product['description_short']);
			$product['desc'] = $this->truncate ($product['desc'], $params['description_maxlength']);
			$product['_images'] = $images_pro;
			$product['_target'] = $this->parseTarget ($params['target']);
			$list[] = $product;
		}
		return $list;
	}

	public function getCatIds($params)
	{
		$catids = ( isset( $params['catids'] ) && $params['catids'] != '' )?explode (',', $params['catids']):'';
		if ($this->getCatSelect(true) != null && isset($params['catids']))
			{
				if ($params['catids'] == 'all'){
					$catids = array_slice($this->getCatSelect(true), 0, 5);
				}
				else{
					$catids = $params['catids'];
					$catids = explode(',', $catids);
				}
			}
		else
			$catids = false;
		if ($catids == '')
			return;
		return $catids;
	}

	public function getList($params)
	{
		$type_filter = $params['filter_type'];
		if ($this->getCatSelect(true) != null && isset($params['catids']))
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 5);
			else
				$catids = $this->getCatIds($params);
		}
		$list = array();

		switch ($type_filter)
		{
			case 'categories':
				if ($catids == '*')
					$catids = $this->getCatIds ($params);
				!is_array ($catids) && settype ($catids, 'array');
				if (empty( $catids ))
					return;
				$cats = $this->getCategoriesInfor ($catids, $params);

				if (empty( $cats ))
					return;
				if ($params['display_tab_all'])
				{
					$all = array();
					$all['id_category'] = '*';
					$all['count'] = $this->countProduct ($catids, $params);
					$all['name'] = $this->l('All');
					array_unshift ($cats, $all);
				}
				$catidpreload = $params['category_preload'];
				if (!in_array ($catidpreload, $catids))
					$catidpreload = array_shift ($catids);

				$selected = false;

				foreach ($cats as $cat)
				{
					if (isset( $cat['sel'] ))
						unset( $cat['sel'] );
					if ($cat['count'] > 0)
					{
						if ($cat['id_category'] == $catidpreload)
						{
							$cat['sel'] = 'sel';
							$cat['child'] = $this->getProductInfor ($params, $catidpreload);
							$selected = true;
						}
						$list[$cat['id_category']] = $cat;
					}
				}

				// first tab is active
				if (!$selected)
				{
					foreach ($cats as $cat)
					{
						if ($cat['count'] > 0)
						{
							$cat['sel'] = 'sel';
							$cat['child'] = $this->getProductInfor ($params, $cat->id);
							$list[$cat['id_category']] = $cat;
							break;
						}
					}
				}
				break;

			case 'field':
				$filters = explode (',', $params['field_select']);
				$products = array();
				$filter_preload = $params['field_preload'];
				if (empty( $filters ))
					return;
				if (!in_array ($filter_preload, $filters))
					$filter_preload = $filters[0];
				foreach ($filters as $filter)
				{
					$product = array();
					$product['count'] = $this->countProduct ($catids, $params);
					$product['id_category'] = $filter;
					$product['name'] = $this->getLabel ($filter);
					array_unshift ($products, $product);
				}

				foreach ($products as $product)
				{
					if ($product['count'] > 0)
					{
						if ($product['id_category'] == $filter_preload)
						{
							$product['sel'] = 'sel';
							$product['child'] = $this->getProductInfor ($params, $catids, false, $filter_preload);
						}
						$list[$product['id_category']] = $product;
					}
				}
				break;
		}
		ini_set ('xdebug.var_display_max_depth', 10);
		if (empty( $list ))
			return;
		return $list;
	}

	private function countProduct($catids, $params)
	{
		!is_array ($catids) && settype ($catids, 'array');
		$count_product = $this->getProducts ($catids, $params, true, null);
		return $count_product;
	}

	public function getProducts($id_category = false, $params, $count_product = false, $product_filter = null)
	{
		$context = Context::getContext ();
		$id_lang = (int)$context->language->id;
		if (!$product_filter)
		{
			$order_by = $params['products_ordering'];
			$order_way = $params['ordering_direction'];
		}
		else
		{
			$order_by = $product_filter;
			$order_way = $params['field_direction'];
		}

		if (empty( $id_category ))
			return;
		if ($id_category == '*')
			$id_category = $this->getCatIds ($params);
		else
		{
			$child_category_products = 'exclude';
			$level_depth = 9999;
			$id_category = ( $child_category_products == 'include' )?$this->getChildenCategories ($id_category,
				$level_depth, true):$id_category;
		}
		$start = Tools::getValue ('ajax_reslisting_start');
		$limit = (int)$params['count_number'];
		$only_active = true;
		$number_days_new_product = 9999;
		if ($number_days_new_product == 0)
			$number_days_new_product = -1;
		$front = true;
		if (!in_array ($context->controller->controller_type, array( 'front', 'modulefront' )))
			$front = false;

		if (!Validate::isOrderBy ($order_by) || !Validate::isOrderWay ($order_way))
			die ( Tools::displayError () );
		if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd')
			$order_by_prefix = 'p';
		else if ($order_by == 'name')
			$order_by_prefix = 'pl';

		if (strpos ($order_by, '.') > 0)
		{
			$order_by = explode ('.', $order_by);
			$order_by_prefix = $order_by[0];
			$order_by = $order_by[1];
		}

		if ($order_by == 'sales' || $order_by == 'rand')
			$order_by_prefix = '';
		$sql = 'SELECT DISTINCT  p.`id_product`, p.*, product_shop.*, pl.* , m.`name` AS manufacturer_name, s.`name` AS supplier_name,
				MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
				  MAX(image_shop.`id_image`) id_image,  il.`legend`,
				   ps.`quantity` AS sales, cl.`link_rewrite` AS category,
				    IFNULL(stock.quantity,0) as quantity,
				     IFNULL(pa.minimal_quantity, p.minimal_quantity) as minimal_quantity,
				      stock.out_of_stock, product_shop.`date_add` > "'
			.date ('Y-m-d', strtotime ('-'.( $number_days_new_product?(int)$number_days_new_product:20 ).' DAY')).'" as new, product_shop.`on_sale`
				FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation ('product', 'p').'
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` '.Shop::addSqlRestrictionOnLang ('pl').')
				LEFT JOIN `'._DB_PREFIX_.'product_sale` ps ON (p.`id_product` = ps.`id_product` '.Shop::addSqlAssociation ('product_sale', 'ps').')
				LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product`)
				'.Shop::addSqlAssociation ('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
				'.Product::sqlStock ('p', 'product_attribute_shop', false, $context->shop).'
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
				ON cl.`id_category` = product_shop.`id_category_default`
				AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang ('cl').'
				LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation ('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
				LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)'.
			( $id_category?' LEFT JOIN `'._DB_PREFIX_.'category_product` c ON (c.`id_product` = p.`id_product`)':'' ).'
				WHERE pl.`id_lang` = '.(int)$id_lang.
			( $id_category?' AND c.`id_category` IN ('.implode (',', $id_category).')':'' ).
			( $front?' AND product_shop.`visibility` IN ("both", "catalog")':'' ).
			( $only_active?' AND product_shop.`active` = 1':'' ).'
				GROUP BY  p.`id_product`
				ORDER BY '.( isset( $order_by_prefix )?( ( $order_by_prefix != '' )?pSQL ($order_by_prefix).'.':'' ):'' )
			.( $order_by == 'rand'?' rand() ':'`'.pSQL ($order_by).'`' ).pSQL ($order_way);
		if (!$count_product)
			$sql .= ( $limit > 0?' LIMIT '.(int)$start.','.(int)$limit:'' );
		$rq = Db::getInstance (_PS_USE_SQL_SLAVE_)->executeS ($sql);
		if ($count_product)
			return count ($rq);
		if ($order_by == 'price')
			Tools::orderbyPrice ($rq, $order_way);
		$products_ids = array();
		foreach ($rq as $row)
			$products_ids[] = $row['id_product'];

		Product::cacheFrontFeatures ($products_ids, $id_lang);
		return Product::getProductsProperties ((int)$id_lang, $rq);
	}

	private function getChildenCategories($catids, $levels, $withparent = true)
	{
		!is_array ($catids) && settype ($catids, 'array');
		if (!empty ( $catids ))
		{
			$additional_catids = array();
			foreach ($catids as $catid)
			{
				$categ = new Category($catid);
				$parent_level = $categ->calcLevelDepth ();
				$items = $this->getSubCategories ($catid);
				if (!empty( $items ))
				{
					foreach ($items as $category)
					{
						$condition = ( $category['level_depth'] - $parent_level ) <= $levels;
						if ($condition)
						{
							if ($withparent)
								$additional_catids[] = (int)$category['id_category'];
							else
								if ($category['id_category'] !== $catid)
									$additional_catids[] = (int)$category['id_category'];
						}
					}
				}
			}
			$catids = array_unique ($additional_catids);
		}

		return $catids;
	}

	private function getSubCategories($parent_id = null, $id_lang = false, $active = true, $sql_sort = '', $sql_limit = '')
	{
		$sql_groups_where = '';
		$sql_groups_join = '';
		if (Group::isFeatureActive ())
		{
			$sql_groups_join = 'LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)';
			$groups = FrontController::getCurrentCustomerGroups ();
			$sql_groups_where = 'AND cg.`id_group` '.( count ($groups)?'IN ('.implode (',', $groups).')':'='.(int)Group::getCurrent ()->id );
		}
		$result = Db::getInstance (_PS_USE_SQL_SLAVE_)->executeS ('
		SELECT c.*,  cl.`id_lang`, cl.`name`, cl.`description`, cl.`link_rewrite`, cl.`meta_title`, cl.`meta_keywords`, cl.`meta_description`
		FROM `'._DB_PREFIX_.'category` c
		'.Shop::addSqlAssociation ('category', 'c').'
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.(int)$id_lang.' '
			.Shop::addSqlRestrictionOnLang ('cl').')
		'.$sql_groups_join.'
		'.( isset( $parent_id )?'RIGHT JOIN `'._DB_PREFIX_.'category` c2 ON c2.`id_category` = '
				.(int)$parent_id.' AND c.`nleft` >= c2.`nleft` AND c.`nright` <= c2.`nright`':'' ).'
		WHERE 1
		'.( $active?'AND c.`active` = 1':'' ).'
		'.( $id_lang?'AND `id_lang` = '.(int)$id_lang:'' ).'
		'.$sql_groups_where.'
		GROUP BY c.`id_category`
		'.( $sql_sort != ''?$sql_sort:'ORDER BY `level_depth` ASC, category_shop.`position` ASC' ).'
		'.( $sql_limit != ''?$sql_limit:'' ).'');

		return $result;
	}

	public function getLabel($order)
	{
		if (empty( $order ))
			return;
		switch ($order)
		{
			case 'name':
				return $this->l('Name');
			case 'id_product':
				return $this->l('ID Product');
			case 'sales':
				return $this->l('Best Sellers');
			case 'date_add':
				return $this->l('New Arrials');
			case 'price':
				return $this->l('Hot Products');
		}
	}

	private function getItemInHook($hook_name)
	{
		$list = array();
		$this->context = Context::getContext ();
		$id_shop = $this->context->shop->id;
		$id_hook = Hook::getIdByName ($hook_name);
		if ($id_hook)
		{
			$results = Db::getInstance ()->ExecuteS ('
			SELECT b.`id_aztabs`
			FROM `'._DB_PREFIX_.'aztabs` b
			LEFT JOIN `'._DB_PREFIX_.'aztabs_shop` bs ON (b.`id_aztabs` = bs.`id_aztabs`)
			WHERE bs.`active` = 1 AND (bs.`id_shop` = '.$id_shop.') AND b.`hook` = '.( $id_hook ).'
			ORDER BY b.`ordering`');
			$language_site = '';
			foreach (Language::getLanguages(false) as $lang)
			{
				if ($lang['id_lang'] == $this->context->language->id)
				{
					if ($lang['is_rtl'] == 1)
						$language_site = 'true';
					else
						$language_site = 'false';
				}
			}
			foreach ($results as $row)
			{
				$temp = new azTabsClass($row['id_aztabs']);
				$temp->params = unserialize($temp->params);
				$temp->products = $this->getList ($temp->params);
				$temp->language_site = $language_site;
				$list[] = $temp;
			}
		}
		if (empty( $list ))
			return;
		return $list;
	}

	public function hookHeader()
	{
		if (isset( $this->context->controller->php_self ) && $this->context->controller->php_self == 'index')
			$this->context->controller->addCSS (_THEME_CSS_DIR_.'product_list.css');

		$this->context->controller->addCSS ($this->_path.'views/css/aztabs.css', 'all');

		if (!defined ('OWL_CAROUSEL'))
		{
			$this->context->controller->addJS ($this->_path.'views/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}

		return $this->display (__FILE__, 'header.tpl');
	}

	

	public function hookDisplayTab()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('aztabs_displayTab');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayTab');
			$smarty->assign (array(
				'list' => $list,
				'hook_name' => 'displayTab'
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
		
	}
	
	public function hookDisplayTab2()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('aztabs_displayTab2');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayTab2');
			$smarty->assign (array(
				'list' => $list,
				'hook_name' => 'displayTab2'
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
		
	}
	
	public function hookDisplayTab3()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('aztabs_displayTab3');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayTab3');
			$smarty->assign (array(
				'list' => $list,
				'hook_name' => 'displayTab3'
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
		
	}
	
	public function hookDisplayTab4()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('aztabs_displayTab4');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayTab4');
			$smarty->assign (array(
				'list' => $list,
				'hook_name' => 'displayTab4'
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
		
	}
	
	public function hookDisplayTab5()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('aztabs_displayTab5');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayTab5');
			$smarty->assign (array(
				'list' => $list,
				'hook_name' => 'displayTab5'
			));
		}
		return $this->display (__FILE__, 'default.tpl', $smarty_cache_id);
		
	}

	public function ajaxCall()
	{
		if (Tools::getValue ('is_ajax_tabs') == 1)
		{
			$smarty = $this->context->smarty;
			$id_aztabs = Tools::getValue ('tabs_moduleid');
			$aztabs = new azTabsClass($id_aztabs);
			$params = unserialize($aztabs->params);
			if ($id_aztabs == $aztabs->id_aztabs)
			{
				$k = Tools::getValue ('ajax_reslisting_start');
				$hookname = (string) Tools::getValue('hook_name');
				$id_category = Tools::getValue ('categoryid');
				if ($params['filter_type'] == 'categories')
					$child_items = $this->getProductInfor ($params, $id_category, false, null);
				else
					$child_items = $this->getProductInfor ($params, '*', false, $id_category);
				$result = new stdClass();
				$conditon = '';
				if ($params['show_loadmore_slider'] == 'slider')
					$conditon = true;
				$smarty->assign (array(
					'kk'           => $k,
					'child_items'  => $child_items,
					'items_params' => $params,
					'condition'    => $conditon
				));
				
				$buffer = $this->display (__FILE__, 'default_items.tpl');
					
					
					
				$result->items_markup = preg_replace (
					array(
						'/ {2,}/',
						'/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
					),
					array(
						' ',
						''
					),
					$buffer
				);

				die( Tools::jsonEncode ($result) );
			}
		}
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
					opacity: 0.8,
					cursor: "move",
					handle: ".dragGroup",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
							$.ajax({
								type: "POST",
								dataType: "json",
								data:order,
								url:"'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'
			.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'",
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
		$html .= '<style type="text/css">#gird_items .ui-sortable-helper{display:table!important;}
		#gird_items .ui-sortable-helper td{ background-color:#00aff0!important;color:#FFF;}</style>';
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
			sprintf($this->l('You can only edit this module from the shop(s) context: %s'), $shop_contextualized_name).
			'</p>';
		else
			return '<p class="alert alert-danger">'.
			sprintf($this->l('You cannot add modules from a "All Shops" or a "Group Shop" context')).
			'</p>';
	}

	private function getShopAssociationError($id_module)
	{
		return '<p class="alert alert-danger">'.
		sprintf($this->l('Unable to get module shop association information (id_module: %d)'), (int)$id_module).
		'</p>';
	}

	private function getCurrentShopInfoMsg()
	{
		$shop_info = null;

		if (Shop::isFeatureActive())
		{
			if (Shop::getContext() == Shop::CONTEXT_SHOP)
				$shop_info = sprintf($this->l('The modifications will be applied to shop: %s'),
					$this->context->shop->name);
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
		INSERT IGNORE INTO `'._DB_PREFIX_.'aztabs_shop` (`id_aztabs`, `id_shop`)
		SELECT `id_aztabs`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'aztabs_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}

	public function cleanText($text)
	{
		$text = strip_tags ($text, '<a><b><blockquote><code><del><dd><dl><dt><em><h1><h2><h3><i><kbd><p><pre><s><sup><strong><strike><br><hr>');
		$text = trim ($text);
		return $text;
	}

	public function trimEncode($text)
	{
		$str = strip_tags ($text);
		$str = preg_replace ('/\s(?=\s)/', '', $str);
		$str = preg_replace ('/[\n\r\t]/', '', $str);
		$str = str_replace (' ', '', $str);
		$str = trim ($str, "\xC2\xA0\n");
		return $str;
	}

	/**
	 * Parse and build target attribute for links.
	 * @param string $value (_self, _blank, _windowopen, _modal)
	 * _blank    Opens the linked document in a new window or tab
	 * _self    Opens the linked document in the same frame as it was clicked (this is default)
	 * _parent    Opens the linked document in the parent frame
	 * _top    Opens the linked document in the full body of the window
	 * _windowopen  Opens the linked document in a Window
	 * _modal        Opens the linked document in a Modal Window
	 */
	public function parseTarget($type = '_self')
	{
		$target = '';
		switch ($type)
		{
			default:
			case '_self':
				break;
			case '_blank':
			case '_parent':
			case '_top':
				$target = 'target="'.$type.'"';
				break;
			case '_windowopen':
				$string1 = "onclick=\"window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,
				menubar=no,scrollbars=yes,";
				$string2 = "resizable=yes,false');return false;\"";
				$target = $string1.$string2;
				break;
			case '_modal':
				// user process
				break;
		}
		return $target;
	}

	/**
	 * Truncate string by $length
	 * @param string $string
	 * @param int $length
	 * @param string $etc
	 * @return string
	 */
	public function truncate($string, $length, $etc = '...')
	{
		return defined ('MB_OVERLOAD_STRING')?$this->mbsptruncate ($string, $length, $etc):$this->sptruncate ($string, $length, $etc);
	}

	/**
	 * Truncate string if it's size over $length
	 * @param string $string
	 * @param int $length
	 * @param string $etc
	 * @return string
	 */
	private static function sptruncate($string, $length, $etc = '...')
	{
		if ($length > 0 && $length < Tools::strlen ($string))
		{
			$buffer = '';
			$buffer_length = 0;
			$parts = preg_split ('/(<[^>]*>)/', $string, - 1, PREG_SPLIT_DELIM_CAPTURE);
			$self_closing_tag = preg_split (',', 'area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed');
			$open = array();
			foreach ($parts as $s)
			{
				if (false === strpos ($s, '<'))
				{
					$s_length = Tools::strlen ($s);
					if ($buffer_length + $s_length < $length)
					{
						$buffer .= $s;
						$buffer_length += $s_length;
					}
					else if ($buffer_length + $s_length == $length)
					{
						if (!empty( $etc ))
							$buffer .= ( $s[$s_length - 1] == ' ' )?$etc:" $etc";
						break;
					}
					else
					{
						$words = preg_split ('/([^\s]*)/', $s, - 1, PREG_SPLIT_DELIM_CAPTURE);
						$space_end = false;
						foreach ($words as $w)
						{
							if ($w_length = Tools::strlen ($w))
							{
								if ($buffer_length + $w_length < $length)
								{
									$buffer .= $w;
									$buffer_length += $w_length;
									$space_end = ( trim ($w) == '' );
								}
								else
								{
									if (!empty( $etc ))
										$more = $space_end?$etc:" $etc";
									$buffer .= $more;
									$buffer_length += Tools::strlen ($more);
									break;
								}
							}
						}
						break;
					}
				}
				else
				{
					preg_match ('/^<([\/]?\s?)([a-zA-Z0-9]+)\s?[^>]*>$/', $s, $m);
					//$tagclose = isset($m[1]) && trim($m[1])=='/';
					if (empty( $m[1] ) && isset( $m[2] ) && !in_array ($m[2], $self_closing_tag))
						array_push ($open, $m[2]);
					else
						if (trim ($m[1]) == '/')
							$tag = array_pop ($open);
					$buffer .= $s;
				}
			}
			// close tag openned.
			if (count ($open) > 0)
			{
				$tag = array_pop ($open);
				$buffer .= "</$tag>";
			}

			return $buffer;
		}
		return $string;
	}

	/**
	 * Truncate mutibyte string if it's size over $length
	 * @param string $string
	 * @param int $length
	 * @param string $etc
	 * @return string
	 */
	private function mbsptruncate($string, $length, $etc = '...')
	{
		$encoding = mb_detect_encoding ($string);
		if ($length > 0 && $length < mb_strlen ($string, $encoding))
		{
			$buffer = '';
			$buffer_length = 0;
			$parts = preg_split ('/(<[^>]*>)/', $string, - 1, PREG_SPLIT_DELIM_CAPTURE);
			$self_closing_tag = explode (', ', 'area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed');
			$open = array();
			foreach ($parts as $s)
			{
				if (false === mb_strpos ($s, '<'))
				{
					$s_length = mb_strlen ($s, $encoding);
					if ($buffer_length + $s_length < $length)
					{
						$buffer .= $s;
						$buffer_length += $s_length;
					}
					else if ($buffer_length + $s_length == $length)
					{
						if (!empty( $etc ))
							$buffer .= ( $s[$s_length - 1] == ' ' )?$etc:" $etc";
						break;
					}
					else
					{
						$words = preg_split ('/([^\s]*)/', $s, - 1, PREG_SPLIT_DELIM_CAPTURE);
						$space_end = false;
						foreach ($words as $w)
						{
							if ($w_length = mb_strlen ($w, $encoding))
							{
								if ($buffer_length + $w_length < $length)
								{
									$buffer .= $w;
									$buffer_length += $w_length;
									$space_end = ( trim ($w) == '' );
								}
								else
								{
									if (!empty( $etc ))
									{
										$more = $space_end?$etc:" $etc";
										$buffer .= $more;
										$buffer_length += mb_strlen ($more);
									}
									break;
								}
							}
						}
						break;
					}
				}
				else
				{
					preg_match ('/^<([\/]?\s?)([a-zA-Z0-9]+)\s?[^>]*>$/', $s, $m);
					if (empty( $m[1] ) && isset( $m[2] ) && !in_array ($m[2], $self_closing_tag))
						array_push ($open, $m[2]);
					else if (trim ($m[1]) == '/')
						$tag = array_pop ($open);
					$buffer .= $s;
				}
			}
			$count_open = count ($open);
			if ($count_open > 0)
			{
				$tag = array_pop ($open);
				$buffer .= "</$tag>";
			}
			return $buffer;
		}
		return $string;
	}
}
