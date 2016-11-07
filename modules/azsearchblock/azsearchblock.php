<?php
/**
 * package   AZ Search Block
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.aztemplates.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;
include_once ( dirname (__FILE__).'/AzSearchBlockClass.php' );

class AzSearchBlock extends Module
{
	protected $ajax_search;
	protected $instant_search;

	protected $categories = array();
	protected $error = false;
	private $html;
	private $default_hook = array('displaySearch');
	public function __construct()
	{
		$this->name = 'azsearchblock';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'AZ Templates';
		$this->secure_key = Tools::encrypt ($this->name);
		$this->bootstrap = true;
		parent::__construct ();
		$this->displayName = $this->l('AZ Search Block');
		$this->description = $this->l('Adds a search field to your website.');
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
		$azsearchblock = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azsearchblock`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'azsearchblock (
				`id_azsearchblock` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`hook` int(10) unsigned,
				`params` text NOT NULL DEFAULT \'\' ,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				`ordering` int(10) unsigned NOT NULL,
				PRIMARY KEY (`id_azsearchblock`)) ENGINE=InnoDB default CHARSET=utf8');
		$azsearchblock_shop = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azsearchblock_shop`')
			&& Db::getInstance ()->Execute ('
				CREATE TABLE '._DB_PREFIX_.'azsearchblock_shop (
				`id_azsearchblock` int(10) unsigned NOT NULL,
				`id_shop` int(10) unsigned NOT NULL,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				 PRIMARY KEY (`id_azsearchblock`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
		$azsearchblock_lang = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'azsearchblock_lang`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'azsearchblock_lang (
				`id_azsearchblock` int(10) unsigned NOT NULL,
				`id_lang` int(10) unsigned NOT NULL,
				`title_module` varchar(255) NOT NULL DEFAULT \'\',
				PRIMARY KEY (`id_azsearchblock`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
		if (!$azsearchblock || !$azsearchblock_shop || !$azsearchblock_lang)
			return false;
		$this->installSamples();
		
		$this->_createTab();
		return true;
	}

	public function uninstall()
	{
		if (parent::uninstall () == false)
			return false;
		if (!Db::getInstance ()->Execute ('DROP TABLE `'._DB_PREFIX_.'azsearchblock`')
			|| !Db::getInstance ()->Execute ('DROP TABLE `'._DB_PREFIX_.'azsearchblock_shop`')
			|| !Db::getInstance ()->Execute ('DROP TABLE `'._DB_PREFIX_.'azsearchblock_lang`'))
			return false;
			$this->clearCacheItemForHook ();
			$this->_deleteTab() ;
		return true;
	}

	public function installSamples()
	{
		$datas = array(
			array(
				'id_azsearchblock' => 1,
				'title_module' => 'AZ Search Block',
				'display_title_module' => 0,
				'moduleclass_sfx' => '',
				'instant_search' => 1,
				'ajax_search' => 1,
				'active' => 1,
				'hook' => Hook::getIdByName('displaySearch'),
				'target' => '_self',
				'display_box_select' => 0,
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				'display_category_all' => 1,
				'cat_field_ordering' => 'name',
				'cat_field_direction' => 'ASC',
			)
		);

		$return = true;
		foreach ($datas as $i => $data)
		{
			$azsearchblock = new AzSearchBlockClass();
			$azsearchblock->hook = Hook::getIdByName('displaySearch');
			$azsearchblock->active = $data['active'];
			$azsearchblock->ordering = $i;
			$azsearchblock->params = serialize($data);
			foreach (Language::getLanguages(false) as $lang)
				$azsearchblock->title_module[$lang['id_lang']] = $data['title_module'];
			$return &= $azsearchblock->add();
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
				&& $this->moduleExists((int)Tools::getValue('id_azsearchblock'))) || Tools::isSubmit ('saveItem'))
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
				$associated_shop_ids = AzSearchBlockClass::getAssociatedIdsShop((int)Tools::getValue('id_azsearchblock'));
				$context_shop_id = (int)Shop::getContextShopID();
				if ($associated_shop_ids === false)
					$this->html .= $this->getShopAssociationError((int)Tools::getValue('id_azsearchblock'));
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

			if (Tools::isSubmit('id_azsearchblock'))
			{
				if (!Validate::isInt(Tools::getValue('id_azsearchblock'))
					&& !$this->moduleExists(Tools::getValue('id_azsearchblock')))
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
		}
		elseif (Tools::isSubmit('id_azsearchblock') && (!Validate::isInt(Tools::getValue('id_azsearchblock'))
				|| !$this->moduleExists((int)Tools::getValue('id_azsearchblock'))))
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
			if (Tools::getValue('id_azsearchblock'))
			{
				$searchblock = new AzSearchBlockClass((int)Tools::getValue ('id_azsearchblock'));
				if (!Validate::isLoadedObject($searchblock))
				{
					$this->html .= $this->displayError($this->l('Invalid slide ID'));
					return false;
				}
			}
			else
				$searchblock = new AzSearchBlockClass();
			$next_ps = $this->getNextPosition();
			$searchblock->ordering = (!empty($searchblock->ordering)) ? (int)$searchblock->ordering : $next_ps;
			$searchblock->active = (Tools::getValue('active')) ? (int)Tools::getValue('active') : 0;
			$searchblock->hook	= (int)Tools::getValue('hook');

			$tmp_data = array();
			$id_azsearchblock = (int)Tools::getValue ('id_azsearchblock');
			$id_azsearchblock = $id_azsearchblock ? $id_azsearchblock : $searchblock->getHigherModuleID();
			$tmp_data['id_azsearchblock'] = $id_azsearchblock;
			// general options
			$id_azsearchblock = (int)Tools::getValue ('id_azsearchblock');
			$id_azsearchblock = $id_azsearchblock ? $id_azsearchblock : (int)$searchblock->getHigherID ();
			$tmp_data['id_azsearchblock'] = (int)$id_azsearchblock;
			$tmp_data['display_title_module'] = (int)Tools::getValue ('display_title_module');
			$tmp_data['moduleclass_sfx'] = (string)Tools::getValue ('moduleclass_sfx');
			$tmp_data['instant_search'] = (int)Tools::getValue ('instant_search');
			$tmp_data['ajax_search'] = (int)Tools::getValue ('ajax_search');
			$tmp_data['active'] = (int)Tools::getValue ('active');
			$tmp_data['hook'] = (int)Tools::getValue ('hook');
			$tmp_data['target'] = (string)Tools::getValue ('target');
			$tmp_data['display_box_select'] = (int)Tools::getValue ('display_box_select');
			// source option
			$tmp_data['products_ordering'] = (string)Tools::getValue ('products_ordering');
			$tmp_data['ordering_direction'] = (string)Tools::getValue ('ordering_direction');
			// tab options
			$tmp_data['display_category_all'] = (int)Tools::getValue ('display_category_all');
			$tmp_data['cat_field_ordering'] = (string)Tools::getValue ('cat_field_ordering');
			$tmp_data['cat_field_direction'] = (string)Tools::getValue ('cat_field_direction');

			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
				$searchblock->title_module[$language['id_lang']] = Tools::getValue('title_module_'.$language['id_lang']);
			$searchblock->params = serialize($tmp_data);
			$get_id = Tools::getValue ('id_azsearchblock');
			($get_id && $this->moduleExists($get_id))? $searchblock->update() : $searchblock->add ();
			$this->clearCacheItemForHook ();
				if (Tools::isSubmit ('saveAndStay'))
				{
					$id_azsearchblock = Tools::getValue ('id_azsearchblock')?
						(int)Tools::getValue ('id_azsearchblock'):(int)$searchblock->getHigherModuleID ();
					Tools::redirectAdmin ($currentIndex.'&configure='
						.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azsearchblock='
						.$id_azsearchblock.'&updateItemConfirmation');
				}
				else
					Tools::redirectAdmin ($currentIndex.'&configure='
						.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&saveItemConfirmation');
		}
		elseif (Tools::isSubmit ('changeStatusItem') && (int)Tools::getValue ('id_azsearchblock'))
		{
			$searchblock = new AzSearchBlockClass((int)Tools::getValue ('id_azsearchblock'));
			if ($searchblock->active == 0)
				$searchblock->active = 1;
			else
				$searchblock->active = 0;
			$searchblock->update();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
				.'&token='.Tools::getAdminTokenLite ('AdminModules'));
		}
		elseif (Tools::isSubmit ('deleteItem') && (int)Tools::getValue ('id_azsearchblock'))
		{
			$searchblock = new AzSearchBlockClass(Tools::getValue ('id_azsearchblock'));
			$searchblock->delete ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
				.'&deleteItemConfirmation');
		}
		elseif (Tools::isSubmit ('duplicateItem') && (int)Tools::getValue ('id_azsearchblock'))
		{
			$searchblock = new AzSearchBlockClass(Tools::getValue ('id_azsearchblock'));
			foreach (Language::getLanguages (false) as $lang)
				$searchblock->title_module[(int)$lang['id_lang']] = $searchblock->title_module[(int)$lang['id_lang']]
					.$this->l(' (Copy)');
			$searchblock->duplicate ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='
				.Tools::getAdminTokenLite ('AdminModules')
				.'&duplicateItemConfirmation');
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

	public function moduleExists($id_module)
	{
		$req = 'SELECT cs.`id_azsearchblock`
				FROM `'._DB_PREFIX_.'azsearchblock` cs
				WHERE cs.`id_azsearchblock` = '.(int)$id_module;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
		return ($row);
	}
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(cs.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'azsearchblock` cs, `'._DB_PREFIX_.'azsearchblock_shop` css
			WHERE css.`id_azsearchblock` = cs.`id_azsearchblock`
			AND css.`id_shop` = '.(int)$this->context->shop->id
		);
		return (++$row['next_position']);
	}

	private function getFormValuesCat()
	{
		$id_azsearchblock = Tools::getValue ('id_azsearchblock');
		if (Tools::isSubmit ('id_azsearchblock') && $id_azsearchblock)
		{
			$searchblock = new AzSearchBlockClass((int)$id_azsearchblock);
			$params = unserialize($searchblock->params);
		}
		else
		{
			$searchblock = new AzSearchBlockClass();
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
		}
		else
			$catids = array();
		return $catids;
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
		INSERT IGNORE INTO `'._DB_PREFIX_.'azsearchblock_shop` (`id_azsearchblock`, `id_shop`)
		SELECT `id_azsearchblock`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'azsearchblock_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}

	private function getHookName($id_hook)
	{
		if (!$result = Db::getInstance ()->getRow ('SELECT `name`,`title` FROM `'._DB_PREFIX_.'hook`
		WHERE `id_hook` = '.( $id_hook )))
			return false;
		return $result['name'];
	}

	private function getGridItems()
	{
		$this->context = Context::getContext ();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		$sql = '
			SELECT b.`id_azsearchblock`, b.`hook`, b.`ordering`, bs.`active`, bl.`title_module`
			FROM `'._DB_PREFIX_.'azsearchblock` b
			LEFT JOIN `'._DB_PREFIX_.'azsearchblock_shop` bs ON (b.`id_azsearchblock` = bs.`id_azsearchblock`)
			LEFT JOIN `'._DB_PREFIX_.'azsearchblock_lang` bl ON (b.`id_azsearchblock` = bl.`id_azsearchblock`'
			.( $id_shop?'AND bs.`id_shop` = '.$id_shop:' ' ).')
			WHERE bl.`id_lang` = '.(int)$id_lang.( $id_shop?' AND bs.`id_shop` = '.$id_shop:' ' ).'
			ORDER BY b.`ordering`';
		$result = Db::getInstance ()->ExecuteS ($sql);
		if (!$result)
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
					$associated_shop_ids = AzSearchBlockClass::getAssociatedIdsShop((int)$mod['id_azsearchblock']);
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
				<tr id="item_'.$mod['id_azsearchblock'].'" class=" '.( $irow ++ % 2?' ':'' ).'">
					<td class=" 	" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azsearchblock='
					.$mod['id_azsearchblock'].'\'">'
					.$mod['id_azsearchblock'].'</td>
					<td class=" dragHandle"><div class="dragGroup"><div class="positions">'.$mod['ordering']
					.'</div></div></td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_azsearchblock='.$mod['id_azsearchblock'].'\'">'
					.$mod['title_module'].' '
					.($mod['is_shared'] ? '<span class="label color_field"
				style="background-color:#108510;color:white;margin-top:5px;">'.$this->l('Shared').'</span>' : '').'</td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_azsearchblock='.$mod['id_azsearchblock'].'\'">'
					.( Validate::isInt ($mod['hook'])?$this->getHookTitle ($mod['hook']):'' ).'</td>
					<td class="  "> <a href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&changeStatusItem&id_azsearchblock='
					.$mod['id_azsearchblock'].'&status='
					.$mod['active'].'&hook='.$mod['hook'].'">'
					.( $mod['active']?'<i class="icon-check"></i>':'<i class="icon-remove"></i>' ).'</a> </td>
					<td class="text-right">
						<div class="btn-group-action">
							<div class="btn-group pull-right">
								<a class="btn btn-default" href="'.$currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_azsearchblock='
					.$mod['id_azsearchblock'].'">
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
					.Tools::getAdminTokenLite ('AdminModules').'&duplicateItem&id_azsearchblock='
					.$mod['id_azsearchblock'].'">
											<i class="icon-copy"></i> '.$this->l('Duplicate').'
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a title ="'.$this->l('Delete')
					.'" onclick="return confirm(\''.$this->l('Are you sure?',
						__CLASS__, true, false).'\');" href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&deleteItem&id_azsearchblock='
					.$mod['id_azsearchblock'].'">
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
			$this->categories[$category['id_category']] = str_repeat('', $category['level_depth'] * 1)
				.Tools::stripslashes($category['name']);
			if (isset($category['children']) && !empty($category['children']))
			{
				$current = $category['id_category'];
				$this->generateCategoriesOption($category['children'], $current, $id_selected);
			}
		}
	}

	private function descFormHtml($text = null)
	{
		return array(
			'type'         => 'html',
			'name'         => 'description',
			'html_content' => '<div style="color:#666;font-weight:bold;text-transform:uppercase;
			border-bottom:solid 1px #666;padding-bottom:5px;width:250px;"><i class="icon-star"></i>  '.$text.'</div>',
		);
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
				'.($sql_sort != '' ? $sql_sort : ' ORDER BY c.`level_depth` ASC').'
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

	public function getCatSelect($default = false)
	{
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));

		$catopt = array();
		if (!empty( $this->categories ))
		{
			foreach ($this->categories as $key => $cat)
			{	if ($default)
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
		return $catopt;
	}

	public function renderForm()
	{
		$hooks = $this->getHookList ();
		$this->fields_form[0]['form'] = array(
			'tinymce' => true,
			'legend'  => array(
				'title' => $this->l('General Settings'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'   => 'switch',
					'label'  => $this->l('Active Module'),
					'hint'   => $this->l('Allow show/hide module.'),
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
					'hint'  => $this->l('A suffix to be applied to the CSS class of the module. This allows for individual module styling.'),
					'class' => 'fixed-width-xl'
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Module Hook'),
					'hint'    => $this->l('Content of module will be display in Hook selected'),
					'name'    => 'hook',
					'options' => array(
						'query' => $hooks,
						'id'    => 'key',
						'name'  => 'name'
					)
				),
				array(
					'type'     => 'text',
					'label'    => $this->l('Module Title'),
					'hint'     => $this->l('Display title of module.'),
					'lang'     => true,
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
					'label'  => $this->l('Instant search'),
					'hint'   => $this->l('Enable instant search for your visitors?
								With instant search, the results will appear immediately as the user writes a query.'),
					'name'   => 'instant_search',
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
					'label'  => $this->l('Ajax search '),
					'hint'   => $this->l('Enable ajax search for your visitors.
							With ajax search, the first 10 products matching the user query will appear in real time below the input field.
							And begin 4 characters or more'),
					'name'   => 'ajax_search',
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
				$this->descFormHtml ('Settings for Products'),
				array(
					'type'     => 'select',
					'lang'     => true,
					'label'    => $this->l('Product Order By '),
					'name'     => 'products_ordering',
					'hint'     => $this->l('Choose the position for showing products.'),
					'class'    => 'fixed-width-xl',
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
								'id_option' => 'date_add',
								'name'      => $this->l('Date Add')
							),
							array(
								'id_option' => 'price',
								'name'      => $this->l('Price')
							),
							array(
								'id_option' => 'sell',
								'name'      => $this->l('Sell')
							)
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
								'id_option' => 'desc',
								'name'      => $this->l('Descending')
							),
							array(
								'id_option' => 'asc',
								'name'      => $this->l('Ascending')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				$this->descFormHtml ('Settings for Categories'),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Category All '),
					'name'   => 'display_category_all',
					'hint'   => $this->l('Allow show/hide category all of module.'),
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
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Categories Order By'),
					'name'    => 'cat_field_ordering',
					'hint'    => $this->l('Categories Order By'),
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
								'id_option' => 'desc',
								'name'      => $this->l('Descending')
							),
							array(
								'id_option' => 'asc',
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

		

		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'azsearchblock';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite ('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='
			.Tools::getAdminTokenLite ('AdminModules');
		$default_lang = (int)Configuration::get ('PS_LANG_DEFAULT');
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

		$id_azsearchblock = (int)Tools::getValue ('id_azsearchblock');
		if (Tools::isSubmit ('id_azsearchblock') && $id_azsearchblock)
		{
			$searchblock = new AzSearchBlockClass((int)$id_azsearchblock);
			$this->fields_form[0]['form']['input'][] = array(
				'type' => 'hidden',
				'name' => 'id_azsearchblock'
			);
			$params = unserialize($searchblock->params);
		$helper->fields_value['id_azsearchblock'] = (int)Tools::getValue ('id_azsearchblock', $searchblock->id_azsearchblock);
		}
		else
		{
			$searchblock = new AzSearchBlockClass();
			$params = array();
		}

		foreach (Language::getLanguages (false) as $lang)
		{
			$title_module_lang = 'title_module_'.(int)$lang['id_lang'];
			$helper->fields_value['title_module'][(int)$lang['id_lang']] = (string)Tools::getValue($title_module_lang,
				$searchblock->title_module[(int)$lang['id_lang']]);
		}
		// general options
		$helper->fields_value['display_title_module'] = Tools::getValue ('display_title_module',
			isset( $params['display_title_module'] )?$params['display_title_module']:1);
		$helper->fields_value['moduleclass_sfx'] = (string)Tools::getValue ('moduleclass_sfx',
			isset( $params['moduleclass_sfx'] )?$params['moduleclass_sfx']:'');
		$helper->fields_value['instant_search'] = Tools::getValue ('instant_search',
			isset( $params['instant_search'] )?$params['instant_search']:0);
		$helper->fields_value['ajax_search'] = Tools::getValue ('ajax_search',
			isset( $params['ajax_search'] )?$params['ajax_search']:1);
		$helper->fields_value['hook'] = Tools::getValue ('hook', $searchblock->hook);
		$helper->fields_value['active'] = Tools::getValue ('active', $searchblock->active);
		$helper->fields_value['target'] = (string)Tools::getValue ('target', isset( $params['target'] )?$params['target']:'_self');
		$helper->fields_value['display_box_select'] = Tools::getValue ('display_box_select',
			isset( $params['display_box_select'] )?$params['display_box_select']:0);
		// source options
		$helper->fields_value['products_ordering'] = (string)Tools::getValue ('products_ordering',
			( isset($params['products_ordering'])) ? $params['products_ordering']:'name');
		$helper->fields_value['ordering_direction'] = (string)Tools::getValue ('ordering_direction',
			( isset($params['ordering_direction'])) ? $params['ordering_direction']:'DESC');
		// tab category
		$helper->fields_value['display_category_all'] = (int)Tools::getValue ('display_category_all',
			isset( $params['display_category_all']) ? $params['display_category_all']:1);
		$helper->fields_value['cat_field_ordering'] = (string)Tools::getValue ('cat_field_ordering',
			( isset($params['cat_field_ordering'])) ? $params['cat_field_ordering']:'name');
		$helper->fields_value['cat_field_direction'] = (string)Tools::getValue ('cat_field_direction',
			( isset($params['cat_field_direction'])) ? $params['cat_field_direction']:'DESC');
		$this->html .= $helper->generateForm ($this->fields_form);
	}

	public function getCategoriesInfor($catids, $params)
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
			if ($category['id_category'] == $cat_root)
				$category['link'] = $this->context->link->getPageLink('index');
			else
				$category['link'] = $this->context->link->getCategoryLink ($category['id_category'], $category['link_rewrite']);
			$category_image_url = $this->context->link->getCatImageLink (
				$category['link_rewrite'],
				$category['id_category']);
			$category['image'] = $category_image_url;
			$category['count'] = $this->countProduct ($category['id_category'], $params);
			$category['_target'] = $this->parseTarget ($params['target']);
			$category['name'] = $this->truncate ($category['name'], $params['cat_name_maxlength']);
			$category['_description'] = $this->getDescriptionCategory($category['id_category'], $id_lang);
			$category['description'] = $this->truncate($category['_description'], $params['cat_desc_max_characs']);
			$products = $this->getProductInfor($params, $category['id_category'], false);
			$category['total_item_cate'] = $this->countProduct($category['id_category'], $params);
			if ($products != null)
			{
				$category['child'] = $products;
				$list[$category['id_category']] = $category;
			}
		}

		$cat_order_by = $params['cat_field_ordering'];
		$cat_ordering = $params['cat_field_direction'];
		if ($cat_order_by != null)
		{
			switch ($cat_order_by)
			{
				default:
				case 'name':
					if ($cat_ordering == 'asc')
						usort ($list, create_function ('$a, $b', 'return strnatcasecmp( $a["name"], $b["name"]);'));
					else
						usort ($list, create_function ('$a, $b', 'return strnatcasecmp( $b["name"], $a["name"]);'));
					break;
				case 'id_category':
					if ($cat_ordering == 'asc')
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

	private function getDescriptionCategory($id_category, $id_lang)
	{
		$sql = '
			SELECT c.description
			FROM `'._DB_PREFIX_.'category_lang` c
			WHERE c.`id_category` = '.$id_category.' AND c.`id_lang` = '.$id_lang.';
		';
		$rq = Db::getInstance (_PS_USE_SQL_SLAVE_)->executeS ($sql);
		$_list = array();
		foreach ($rq as $cat)
			$_list[] = $cat['description'];
		$list = implode ('', $_list);
		return $list;
	}

	public function getProductInfor($params, $catids, $count_product = false)
	{
		!is_array ($catids) && settype ($catids, 'array');
		$products = $this->getProducts ($catids, $params, $count_product);
		if (empty( $products ))
			return;
		$list = array();
		foreach ($products as $product)
		{
			$obj = new Product(( $product['id_product'] ), false, $this->context->language->id);
			$images = $obj->getImages ($this->context->language->id);
			$images_product = array();
			if (!empty( $images ))
			{
				foreach ($images as $image)
					$images_product[] = $obj->id.'-'.$image['id_image'];
			}
			$product['title'] = $this->truncate ($product['name'], $params['name_maxlength']);
			$product['desc'] = $this->cleanText ($product['description']);
			$product['desc'] = $this->trimEncode ($product['desc']) != ''?$product['desc']:$this->cleanText ($product['description_short']);
			$product['desc'] = $this->truncate ($product['desc'], $params['description_maxlength']);
			$product['_images'] = $images_product;
			$product['_target'] = $this->parseTarget ($params['target']);
			$list[] = $product;
		}
		return $list;
	}

	public function getCatIds($params)
	{
		$catids = ( isset( $params['catids'] ) && $params['catids'] != '' )?explode (',', $params['catids']):'';

		if ($catids == '')
			return;
		return $catids;
	}

	public function getList($params)
	{
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));
		$list1 = $this->getCatSelect();
		$list = array();
		foreach ($list1 as $ca)
		{
			if ($ca['id_option'] != 1)
				$list[$ca['id_option']] = $ca;
		}
		if (empty($list)) return;
		$cat_all_array = array();
		foreach ($list as $item)
			$cat_all_array[] = $item['id_option'];
		$cat_all_string = implode(',', $cat_all_array);
		// add tab all
		if ($params['display_category_all'] == 1)
		{
			$all = array();
			$all['id_option'] = $cat_all_string;
			$all['name'] = '';
			array_unshift ($list, $all);
		}
		return $list;
	}

	private function countProduct($catids, $params)
	{
		!is_array ($catids) && settype ($catids, 'array');
		$count_product = $this->getProducts ($catids, $params, true, false);
		return $count_product;
	}

	public function getProducts($id_category = false, $params, $count_product = false)
	{
		$context = Context::getContext ();
		$id_lang = (int)$context->language->id;

		$order_by = $params['products_ordering'];
		$order_way = $params['ordering_direction'];

		if (empty( $id_category ))
			return;

		$child_category_products = 1;
		$level_depth = 999;
		$id_category = $child_category_products?$this->getChildenCategories ($id_category, $level_depth, true, $params):$id_category;
		$start = 0;

		$limit = 99;
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
		else if ($order_by == 'position')
			$order_by_prefix = 'c';

		if (strpos ($order_by, '.') > 0)
		{
			$order_by = explode ('.', $order_by);
			$order_by_prefix = $order_by[0];
			$order_by = $order_by[1];
		}

		if ($order_by == 'sell' || $order_by == 'rand')
			$order_by_prefix = '';
		$sql = 'SELECT DISTINCT  p.`id_product`, p.*, product_shop.*, pl.* , m.`name` AS manufacturer_name, s.`name` AS supplier_name,
				MAX(product_attribute_shop.id_product_attribute) id_product_attribute,  MAX(image_shop.`id_image`) id_image,
				  il.`legend`, ps.`quantity` AS sell, cl.`link_rewrite` AS category,
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
		// echo $sql;die;
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

	private function getItemInHook($hook_name)
	{
		$list = array();
		$this->context = Context::getContext ();
		$id_shop = $this->context->shop->id;
		$id_hook = Hook::getIdByName ($hook_name);
		if ($id_hook)
		{
			$results = Db::getInstance ()->ExecuteS ('SELECT b.`id_azsearchblock` FROM `'._DB_PREFIX_.'azsearchblock` b
			LEFT JOIN `'._DB_PREFIX_.'azsearchblock_shop` bs ON (b.`id_azsearchblock` = bs.`id_azsearchblock`)
			WHERE bs.`active` = 1 AND (bs.id_shop = '.$id_shop.') AND b.`hook` = '.$id_hook.' ORDER BY b.`ordering`');
			foreach ($results as $row)
			{
				$temp = new AzSearchBlockClass($row['id_azsearchblock']);
				$temp->params = unserialize($temp->params);
				$temp->products = $this->getList ($temp->params);
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
		$this->context->controller->addCSS ($this->_path.'views/css/azsearchblock.css', 'all');
		$this->context->controller->addCSS (_THEME_CSS_DIR_.'product_list.css');
		if (!defined ('JS_AUTO_COMPLETE'))
		{
			$this->context->controller->addJS ($this->_path.'views/js/jquery.autocomplete.js');
			define( 'JS_AUTO_COMPLETE', 1 );
		}

		return $this->display (__FILE__, 'header.tpl');
	}

	

	public function hookDisplaySearch()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('azsearchblock_displaySearch');
		$n = abs((Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
		if (!$this->isCached ('default.tpl', $smarty_cache_id))
		{
			$list = $this->getItemInHook ('displaySearch');
			$smarty->assign (array(
				'list' => $list,
				'n' => $n
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

	public function cleanText($text)
	{
		$text = strip_tags ($text, '<a><b><blockquote><code><del><dd><dl><dt><em><h1><h2><h3><i><kbd><p><pre><s>
		<sup><strong><strike><br><hr>');
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
	
	/* ------------------------------------------------------------- */
    /*  CREATE THE TAB MENU
    /* ------------------------------------------------------------- */
    private function _createTab()
    {
        $response = true;

        // First check for parent tab
        $parentTabID = Tab::getIdFromClassName('AdminSP');

        if ($parentTabID) {
            $parentTab = new Tab($parentTabID);
        }
        else {
            $parentTab = new Tab();
            $parentTab->active = 1;
            $parentTab->name = array();
            $parentTab->class_name = "AdminSP";
            foreach (Language::getLanguages() as $lang) {
                $parentTab->name[$lang['id_lang']] = "MagenTech";
            }
            $parentTab->id_parent = 0;
            $parentTab->module = $this->name;
            $response &= $parentTab->add();
        }

        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = "AdminSPSearchPro";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = "SP Search Pro";
        }
        $tab->id_parent = $parentTab->id;
        $tab->module = $this->name;
        $response &= $tab->add();

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TAB MENU
    /* ------------------------------------------------------------- */
    private function _deleteTab()
    {
        $id_tab = Tab::getIdFromClassName('AdminSPSearchPro');
        $parentTabID = Tab::getIdFromClassName('AdminSP');

        $tab = new Tab($id_tab);
        $tab->delete();

        // Get the number of tabs inside our parent tab
        // If there is no tabs, remove the parent
        $tabCount = Tab::getNbTabs($parentTabID);
        if ($tabCount == 0) {
            $parentTab = new Tab($parentTabID);
            $parentTab->delete();
        }

        return true;
    }
}
