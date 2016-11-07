<?php
/**
 * package   AZ Manufacturer
 *
 * @version 1.0.0
 * @author    AZTemplates http://www.AZTemplates.com
 * @copyright (c) 2016 AZTemplates Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;

include_once ( dirname (__FILE__).'/azManufacturerClass.php' );

class azManufacturer extends Module
{
	protected $categories = array();
	protected $error = false;
	private $html;
	private $default_hook = array('displayManufacturer');

	public function __construct()
	{
		$this->name = 'azmanufacturer';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'AZ Templates';
		$this->secure_key = Tools::encrypt ($this->name);
		$this->bootstrap = true;
		parent::__construct ();
		$this->displayName = $this->l('AZ Manufacturer');
		$this->description = $this->l('Display products on manufacture slider.');
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
		$azmanufacturer = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azmanufacturer`')
			&& Db::getInstance ()->Execute ('
			CREATE TABLE '._DB_PREFIX_.'azmanufacturer (
				`id_azmanufacturer` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`hook` int(10) unsigned,
				`params` text NOT NULL DEFAULT \'\' ,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				`ordering` int(10) unsigned NOT NULL,
				PRIMARY KEY (`id_azmanufacturer`)) ENGINE=InnoDB default CHARSET=utf8');
		$azmanufacturer_shop = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azmanufacturer_shop`')
			&& Db::getInstance ()->Execute ('
				CREATE TABLE '._DB_PREFIX_.'azmanufacturer_shop (
				`id_azmanufacturer` int(10) unsigned NOT NULL,
				`id_shop` int(10) unsigned NOT NULL,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				 PRIMARY KEY (`id_azmanufacturer`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
		$azmanufacturer_lang = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azmanufacturer_lang`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'azmanufacturer_lang (
				`id_azmanufacturer` int(10) unsigned NOT NULL,
				`id_lang` int(10) unsigned NOT NULL,
				`title_module` varchar(255) NOT NULL DEFAULT \'\',
				PRIMARY KEY (`id_azmanufacturer`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
		if (!$azmanufacturer || !$azmanufacturer_shop || !$azmanufacturer_lang)
			return false;
		$this->installSamples();
		return true;
	}

	public function uninstall()
	{
		if (parent::uninstall () == false)
			return false;
		if (!Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azmanufacturer`')
			|| !Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azmanufacturer_shop`')
			|| !Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azmanufacturer_lang`'))
			return false;
		$this->clearCacheItemForHook ();
		return true;
	}

	public function installSamples()
	{
		$image_manu_types = ImageType::getImagesTypes ('manufacturers');
		$manu_type = array_shift($image_manu_types);

		$datas = array(
			array(
				'id_azmanufacturer' => 1,
				'title_module' => 'Manufacturers',
				'display_title_module' => 0,
				'active' => 1,
				'moduleclass_sfx' => 'manufacturers',
				'hook' => Hook::getIdByName('displayManufacturer'),
				'nb_column1' => 5,
				'nb_column2' => 4,
				'nb_column3' => 3,
				'nb_column4' => 2,
				'target' => '_blank',
				
				'manuid' => 'all',
				'manu_image_size' => 'none' ,
				
				'auto_play' => 0,
				'display_control' => 1,
				'step' => 1,
				'speed' => 200,
				'interval' => 200,
				
			)
		);

		$return = true;
		foreach ($datas as $i => $data)
		{
			$azmanufacturer = new azManufacturerClass();
			$azmanufacturer->hook = Hook::getIdByName('displayManufacturer');
			$azmanufacturer->active = $data['active'];
			$azmanufacturer->ordering = $i;
			$azmanufacturer->params = serialize($data);
			foreach (Language::getLanguages(false) as $lang)
				$azmanufacturer->title_module[$lang['id_lang']] = $data['title_module'];
			$return &= $azmanufacturer->add();
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
				&& $this->moduleExists((int)Tools::getValue('id_azmanufacturer'))) || Tools::isSubmit ('saveItem'))
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
				$associated_shop_ids = azManufacturerClass::getAssociatedIdsShop((int)Tools::getValue('id_azmanufacturer'));
				$context_shop_id = (int)Shop::getContextShopID();
				if ($associated_shop_ids === false)
					$this->html .= $this->getShopAssociationError((int)Tools::getValue('id_azmanufacturer'));
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
			
			if (Tools::isSubmit('id_azmanufacturer'))
			{
				if (!Validate::isInt(Tools::getValue('id_azmanufacturer'))
					&& !$this->moduleExists(Tools::getValue('id_azmanufacturer')))
					$errors[] = $this->l('Invalid module ID');
			}
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('title_module_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
			}
			
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('title_module_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title module is not set.');
			if (Tools::strlen(Tools::getValue('moduleclass_sfx')) > 255)
				$errors[] = $this->l('The Module Class Suffix  is too long.');


			if (!is_numeric (Tools::getValue('step')) || floor (Tools::getValue('step')) < 0)
				$errors[] = $this->l('Invalid Step');

			if (!is_numeric (Tools::getValue('speed')) || floor (Tools::getValue('speed')) < 0)
				$errors[] = $this->l('Invalid Speed');

			if (!is_numeric (Tools::getValue('interval')) || floor (Tools::getValue('interval')) < 0)
				$errors[] = $this->l('Invalid Interval');
				
		}
		
		elseif (Tools::isSubmit('id_azmanufacturer') && (!Validate::isInt(Tools::getValue('id_azmanufacturer'))
				|| !$this->moduleExists((int)Tools::getValue('id_azmanufacturer'))))
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
			if (Tools::getValue('id_azmanufacturer'))
			{
				$manufacturer = new azManufacturerClass((int)Tools::getValue ('id_azmanufacturer'));
				if (!Validate::isLoadedObject($manufacturer))
				{
					$this->html .= $this->displayError($this->l('Invalid slide ID'));
					return false;
				}
			}
			else
				$manufacturer = new azManufacturerClass();
			$manufacturer = new azManufacturerClass(Tools::getValue ('id_azmanufacturer'));
			$next_ps = $this->getNextPosition();
			$manufacturer->ordering = (!empty($manufacturer->ordering)) ? (int)$manufacturer->ordering : $next_ps;
			$manufacturer->active = (Tools::getValue('active')) ? (int)Tools::getValue('active') : 0;
			$manufacturer->hook = (string)Tools::getValue('hook');
			// genereal settings
			$tmp_data = array();
			$id_azmanufacturer = (int)Tools::getValue ('id_azmanufacturer');
			$id_azmanufacturer = $id_azmanufacturer ? $id_azmanufacturer : $manufacturer->getHigherModuleID();
			$tmp_data['id_azmanufacturer'] = $id_azmanufacturer;
			$tmp_data['display_title_module'] = Tools::getValue ('display_title_module');
			$tmp_data['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx', '');
			$tmp_data['active'] = Tools::getValue ('active', 1);
			$tmp_data['hook'] = Tools::getValue ('hook', 'displayHome');
			for ($i = 1; $i < 5; $i ++)
				$tmp_data['nb_column'.$i] = Tools::getValue ('nb_column'.$i);
			$tmp_data['target'] = Tools::getValue ('target', '_blank');
			$tmp_data['display_control'] = Tools::getValue ('display_control');
			$tmp_data['control_type'] = Tools::getValue ('control_type');
			
			// source settings
			$manuid = Tools::getValue ('manuid');
			$manuid = ( is_array ($manuid) && !empty( $manuid ) )?implode (',', $manuid):false;
			$tmp_data['manuid'] = $manuid;
			$tmp_data['manu_image_size'] = Tools::getValue ('manu_image_size');
			// effect settings
			$tmp_data['start_slide'] = Tools::getValue ('start_slide');
			$tmp_data['step'] = Tools::getValue ('step');
			$tmp_data['speed'] = Tools::getValue ('speed');
			$tmp_data['interval'] = Tools::getValue ('interval');
			$tmp_data['auto_play'] = Tools::getValue ('auto_play');
			
			$tmp_data['effect'] = Tools::getValue ('effect');
			

			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
				$manufacturer->title_module[$language['id_lang']] = Tools::getValue('title_module_'.$language['id_lang']);
			$manufacturer->params = serialize($tmp_data);
			$get_id = Tools::getValue ('id_azmanufacturer');
			($get_id && $this->moduleExists($get_id) )? $manufacturer->update() : $manufacturer->add ();
			$this->clearCacheItemForHook ();
			if (Tools::isSubmit ('saveAndStay'))
			{
				$id_azmanufacturer = Tools::getValue ('id_azmanufacturer')?
					(int)Tools::getValue ('id_azmanufacturer'):(int)$slide->getHigherModuleID ();

				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azmanufacturer='
					.$id_azmanufacturer.'&updateItemConfirmation');
			}
			else
				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&saveItemConfirmation');
		}
		elseif (Tools::isSubmit ('changeStatusItem') && Tools::getValue ('id_azmanufacturer'))
		{
			$manufacturer = new azManufacturerClass((int)Tools::getValue ('id_azmanufacturer'));
			if ($manufacturer->active == 0)
				$manufacturer->active = 1;
			else
				$manufacturer->active = 0;
			$manufacturer->update();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
				.'&token='.Tools::getAdminTokenLite ('AdminModules'));
		}
		elseif (Tools::isSubmit ('deleteItem') && Tools::getValue ('id_azmanufacturer'))
		{
			$manufacturer = new azManufacturerClass(Tools::getValue ('id_azmanufacturer'));
			$manufacturer->delete ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.
			'&token='.Tools::getAdminTokenLite ('AdminModules').'&deleteItemConfirmation');
		}
		elseif (Tools::isSubmit ('duplicateItem') && Tools::getValue ('id_azmanufacturer'))
		{
			$manufacturer = new azManufacturerClass(Tools::getValue ('id_azmanufacturer'));
			foreach (Language::getLanguages (false) as $lang)
				$manufacturer->title_module[(int)$lang['id_lang']] = $manufacturer->title_module[(int)$lang['id_lang']].$this->l(' (Copy)');
			$manufacturer->duplicate ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.
												'&token='.Tools::getAdminTokenLite ('AdminModules').'&duplicateItemConfirmation');
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

	public function moduleExists($id_module)
	{
		$req = 'SELECT cs.`id_azmanufacturer`
				FROM `'._DB_PREFIX_.'azmanufacturer` cs
				WHERE cs.`id_azmanufacturer` = '.(int)$id_module;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
		return ($row);
	}
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(cs.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'azmanufacturer` cs, `'._DB_PREFIX_.'azmanufacturer_shop` css
			WHERE css.`id_azmanufacturer` = cs.`id_azmanufacturer`
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
			SELECT b.`id_azmanufacturer`, b.`hook`, b.`ordering`, bs.`active`, bl.`title_module`
			FROM `'._DB_PREFIX_.'azmanufacturer` b
			LEFT JOIN `'._DB_PREFIX_.'azmanufacturer_shop` bs ON (b.`id_azmanufacturer` = bs.`id_azmanufacturer`)
			LEFT JOIN `'._DB_PREFIX_.'azmanufacturer_lang` bl ON (b.`id_azmanufacturer` = bl.`id_azmanufacturer`'
			.( $id_shop?'AND bs.`id_shop` = '.$id_shop:' ' ).')
			WHERE bl.`id_lang` = '.(int)$id_lang.( $id_shop?' AND bs.`id_shop` = '.$id_shop:' ' ).'
			ORDER BY b.`ordering`'))
			return false;
		return $result;
	}

	private function getHookTitle($id_hook, $name = false)
	{
		if (!$result = Db::getInstance()->getRow('SELECT `name`,`title` FROM `'._DB_PREFIX_.'hook` WHERE `id_hook` = '.(int)$id_hook))
			return false;
		return (($result['title'] != '' && $name) ? $result['title'] : $result['name']);
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
					$associated_shop_ids = azManufacturerClass::getAssociatedIdsShop((int)$mod['id_azmanufacturer']);
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
				<th class=" left">'.$this->l('Module Hook').'</th>
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
				<tr id="item_'.$mod['id_azmanufacturer'].'" class=" '.( $irow ++ % 2?' ':'' ).'">
					<td class=" 	" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azmanufacturer='
					.$mod['id_azmanufacturer'].'\'">'
					.$mod['id_azmanufacturer'].'</td>
					<td class=" dragHandle"><div class="dragGroup"><div class="positions">'.$mod['ordering']
					.'</div></div></td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_azmanufacturer='.$mod['id_azmanufacturer'].'\'">'
					.$mod['title_module'].' '
					.($mod['is_shared'] ? '<span class="label color_field"
				style="background-color:#108510;color:white;margin-top:5px;">'.$this->l('Shared').'</span>' : '').'</td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_azmanufacturer='.$mod['id_azmanufacturer'].'\'">'
					.( Validate::isInt ($mod['hook'])?$this->getHookTitle ($mod['hook']):'' ).'</td>
					<td class="  "> <a href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&changeStatusItem&id_azmanufacturer='
					.$mod['id_azmanufacturer'].'&status='
					.$mod['active'].'&hook='.$mod['hook'].'">'
					.( $mod['active']?'<i class="icon-check"></i>':'<i class="icon-remove"></i>' ).'</a> </td>
					<td class="text-right">
						<div class="btn-group-action">
							<div class="btn-group pull-right">
								<a class="btn btn-default" href="'.$currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azmanufacturer='
					.$mod['id_azmanufacturer'].'">
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
					.Tools::getAdminTokenLite ('AdminModules').'&duplicateItem&id_azmanufacturer='
					.$mod['id_azmanufacturer'].'">
											<i class="icon-copy"></i> '.$this->l('Duplicate').'
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a title ="'.$this->l('Delete')
					.'" onclick="return confirm(\''.$this->l('Are you sure?',
						__CLASS__, true, false).'\');" href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&deleteItem&id_azmanufacturer='
					.$mod['id_azmanufacturer'].'">
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
		$groups = null, $use_shop_restriction = true, $sql_filter = '', $sql_sort = '', $sql_limit = '')
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

	public function getManuSelect()
	{
		$manufacturers = Manufacturer::getManufacturers (false, (int)Context::getContext ()->language->id);
		$tmps0 = array();
		$tmps1 = array();
		if (!empty( $manufacturers ))
		{
			foreach ($manufacturers as $manufacturer)
			{
				$tmps0['id_option'] = $manufacturer['id_manufacturer'];
				$tmps0['name'] = $manufacturer['name'];
				$tmps1[] = $tmps0;
			}
		}
		$arr = array();
		foreach ($tmps1 as $item)
			$arr[] = (int)$item['id_option'];
		return $arr;
	}

	public function getManuIds($params)
	{
		$manuid = ( isset( $params['manuid'] ) && $params['manuid'] != '' )?explode (',', $params['manuid']):'';
		if ($manuid == '')
			return;
		return $manuid;
	}

	public function renderForm()
	{
		$image_manu_types = ImageType::getImagesTypes ('manufacturers');
		array_push ($image_manu_types, array( 'name' => 'none' ));
		$default_lang = (int)Configuration::get ('PS_LANG_DEFAULT');
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));

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

		$manufacturers = Manufacturer::getManufacturers (false, (int)Context::getContext ()->language->id);
		$tmps0 = array();
		$tmps1 = array();
		if (!empty( $manufacturers ))
		{
			foreach ($manufacturers as $manufacturer)
			{
				$tmps0['id_option'] = $manufacturer['id_manufacturer'];
				$tmps0['name'] = $manufacturer['name'];
				$tmps1[] = $tmps0;
			}
		}

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
					'name'     => 'title_module',
					'hint'     => $this->l('Title of Module.'),
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
					'name'   => 'active',
					'hint'   => $this->l('Allow show/hide module.'),
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
					'label'   => $this->l('Select Module Hook'),
					'name'    => 'hook',
					'hint'    => $this->l('Display module content in Hook.'),
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
				'title' => $this->l('Source Settings'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'     => 'select',
					'lang'     => true,
					'label'    => $this->l('Select Manufacturer'),
					'name'     => 'manuid[]',
					//'id'       => 'manuid',
					'class'    => 'fixed-width-xxl',
					'multiple' => 'multiple',
					'options'  => array(
						'query' => $tmps1,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Size image (W x H)'),
					'name'    => 'manu_image_size',
					'options' => array(
						'query' => $image_manu_types,
						'id'    => 'name',
						'name'  => 'name'
					)
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

		$this->fields_form[2]['form'] = array(
			'legend' => array(
				'title' => $this->l('Effect Settings'),
				'icon'  => 'icon-cogs'
			),
			'input'  => array(
				
				array(
					'type'    => 'switch',
					'label'   => $this->l('Auto Play'),
					'name'    => 'auto_play',
					'is_bool' => true,
					'hint'    => 'Auto Play of Slider.',
					'values'  => array(
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
					),
				),
				
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Navigation'),
					'name'   => 'display_control',
					'hint'   => 'Allow to show/hide control',
					'class'  => 'fixed-width-xl',
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
					),
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Step'),
					'name'  => 'step',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('Step Item product  when slider.')
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Speed'),
					'name'  => 'speed',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('Speed of slider. Larger = Slower.')
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Interval'),
					'name'  => 'interval',
					'class' => 'fixed-width-xl',
					'hint'  => 'Speed of Timer. Larger = Slower.'
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
		$helper->name_controller = 'azmanufacturer';
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
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
														'&token='.Tools::getAdminTokenLite ('AdminModules')
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
		$id_azmanufacturer = Tools::getValue ('id_azmanufacturer');
		if (Tools::isSubmit ('id_azmanufacturer') && $id_azmanufacturer)
		{
			$manufacturer = new azManufacturerClass((int)$id_azmanufacturer);
			$this->fields_form[0]['form']['input'][] = array(
				'type' => 'hidden',
				'name' => 'id_azmanufacturer'
			);
			$params = unserialize($manufacturer->params);
			$helper->fields_value['id_azmanufacturer'] = (int)Tools::getValue ('id_azmanufacturer',
				$manufacturer->id_azmanufacturer);
		}
		else
		{
			$manufacturer = new azManufacturerClass();
			$params = array();
		}
		foreach (Language::getLanguages (false) as $lang)
		{
			$manufacturer_title_module = $manufacturer->title_module[(int)$lang['id_lang']];
			$title_module_lang = 'title_module_'.(int)$lang['id_lang'];
			$helper->fields_value['title_module'][(int)$lang['id_lang']] = Tools::getValue($title_module_lang, $manufacturer_title_module);
		}
		$display_title_module = isset( $params['display_title_module'] ) ? $params['display_title_module']:1;
		$helper->fields_value['display_title_module'] = Tools::getValue('display_title_module', $display_title_module);
		$moduleclass_sfx = isset( $params['moduleclass_sfx'] ) ? $params['moduleclass_sfx']:'';
		$helper->fields_value['moduleclass_sfx'] = Tools::getValue('moduleclass_sfx', $moduleclass_sfx);
		$helper->fields_value['active'] = Tools::getValue('active', $manufacturer->active);
		$helper->fields_value['hook'] = Tools::getValue('hook', $manufacturer->hook);
		$helper->fields_value['nb_column1'] = Tools::getValue('nb_column1', isset( $params['nb_column1'] )?$params['nb_column1']:6);
		$helper->fields_value['nb_column2'] = Tools::getValue('nb_column2', isset( $params['nb_column2'] )?$params['nb_column2']:4);
		$helper->fields_value['nb_column3'] = Tools::getValue('nb_column3', isset( $params['nb_column3'] )?$params['nb_column3']:2);
		$helper->fields_value['nb_column4'] = Tools::getValue('nb_column5', isset( $params['nb_column4'] )?$params['nb_column4']:1);
		$helper->fields_value['target'] = Tools::getValue('target', isset( $params['target'] )?$params['target']:'_self');
		$helper->fields_value['display_control'] = Tools::getValue('display_control',
			isset( $params['display_control'] )?$params['display_control']:1);
		$helper->fields_value['control_type'] = Tools::getValue('control_type',
			isset( $params['control_type'] )?$params['control_type']:'style1');
		
		if ($this->getManuSelect() != null && isset($params['manuid']))
		{
			if ($params['manuid'] == 'all')
				$manuid = array_slice($this->getManuSelect(), 0, 5);
			else
				$manuid = Tools::getValue ('manuid',
					( isset( $params['manuid'] ) && $params['manuid'] !== false )?explode (',', $params['manuid']):false);
		}
		else
			$manuid = false;
		if (isset($manuid) && !is_array($manuid))
			$manuid = explode(',', $manuid);
		$helper->fields_value['manuid[]'] = $manuid;
		$helper->fields_value['manu_image_size'] = Tools::getValue('manu_image_size',
			(isset( $params['manu_image_size'] ) )?$params['manu_image_size']:'none');
		$helper->fields_value['start_slide'] = Tools::getValue ('start_slide', isset( $params['start_slide'] )?$params['start_slide']:1);
		$helper->fields_value['step'] = Tools::getValue ('step', isset( $params['step'] )?$params['step']:1);
		$helper->fields_value['speed'] = Tools::getValue ('speed', isset( $params['speed'] )?$params['speed']:1000);
		$helper->fields_value['interval'] = Tools::getValue ('interval', isset( $params['interval'] )?$params['interval']:2000);
		$helper->fields_value['auto_play'] = Tools::getValue ('auto', isset( $params['auto_play'] )?$params['auto_play']:1);
		$helper->fields_value['effect'] = Tools::getValue ('effect', isset( $params['effect'] )?$params['effect']:'fallrotate');
		
		$this->html .= $helper->generateForm ($this->fields_form);
	}

	private function getData($params)
	{
		if ($this->getManuSelect() != null && isset($params['manuid']))
		{
			if ($params['manuid'] == 'all')
				$m_ids = array_slice($this->getManuSelect(), 0, 5);
			else
				$m_ids = $this->getManuIds($params);
		}
			if (empty( $m_ids ))
			return;
		$id_lang = (int)$this->context->language->id;
		$manufacturers = array();

		foreach ($m_ids as $item)
		{
			if (!$item)
				continue;
			$id = $item;
			if (empty($item))
				return;
			$manufacturer = new Manufacturer((int)$id, (int)$id_lang);
			if (empty($manufacturer))
				return;
			if (Validate::isLoadedObject ($manufacturer))
			{
				$manufacturers[$item]['id_manufacturer'] = $item;
				$manufacturers[$item]['name'] = $manufacturer->name;
				$manufacturers[$item]['link_rewrite'] = $manufacturer->link_rewrite;
				$manufacturers[$item]['_target'] = $this->parseTarget ($params['target']);
			}
		}

		if (!$manufacturers)
			return;
		return $manufacturers;
	}

	protected function getCacheId($name = null)
	{
		if ($name === null)
			$name = 'azmanufacturer';
		return parent::getCacheId ($name.'|'.date ('Ymd'));
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
			SELECT b.`id_azmanufacturer`
			FROM `'._DB_PREFIX_.'azmanufacturer` b
			LEFT JOIN `'._DB_PREFIX_.'azmanufacturer_shop` bs ON (b.`id_azmanufacturer` = bs.`id_azmanufacturer`)
			WHERE bs.`active` = 1 AND (bs.`id_shop` = '.$id_shop.') AND b.`hook` = '.( $id_hook ).'
			ORDER BY b.`ordering`');

			foreach ($results as $row)
			{
				$temp = new azManufacturerClass($row['id_azmanufacturer']);
				$temp->params = unserialize($temp->params);
				$temp->products = $this->getData ($temp->params);
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
		$this->context->controller->addCSS ($this->_path.'views/css/azmanufacturer.css', 'all');
		return $this->display (__FILE__, 'header.tpl');
	}

	

	public function hookDisplayManufacturer()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('azmanufacturer_displayManufacturer');
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displayManufacturer');
			if (empty( $list))
				return;
			$smarty->assign (array(
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
		INSERT IGNORE INTO `'._DB_PREFIX_.'azmanufacturer_shop` (`id_azmanufacturer`, `id_shop`)
		SELECT `id_azmanufacturer`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'azmanufacturer_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}

	

	/**
	 * Parse and build target attribute for links.
	 * @param string $value (_self, _blank, _windowopen, _modal)
	 * _blank    Opens the linked document in a new window or tab
	 * _self    Opens the linked document in the same frame as it was clicked (this is default)
	 * _parent    Opens the linked document in the parent frame
	 * _top    Opens the linked document in the full body of the window
	 * _windowopen  Opens the linked document in a Window
	 * _modal   Opens the linked document in a Modal Window
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
				$string1 = "onclick=\"window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,";
				$string2 = "resizable=yes,false');return false;\"";
				$target = $string1.$string2;
				break;
			case '_modal':
				// user process
				break;
		}

		return $target;
	}
}
