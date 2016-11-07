<?php
/*
* 2016 AZ Templates
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@AZTemplates.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade AZ Templates to newer
* versions in the future. If you wish to customize AZ Templates for your
* needs please refer to http://www.AZTemplates.com for more information.
*
*  @author AZ Templates SA <contact@AZTemplates.com>
*  @copyright  2007-2014 AZ Templates SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of AZ Templates SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class azBlockCurrencies extends Module
{
	public function __construct()
	{
		$this->name = 'azblockcurrencies';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'AZ Templates';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('AZ Currency Block');
		$this->description = $this->l('Adds a block allowing customers to choose their preferred shopping currency.');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}

	public function install()
	{
		return parent::install() && $this->registerHook('displayTopNav') && $this->registerHook('displayHeader');
	}

	protected function _prepareHook($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return false;

		if (!Currency::isMultiCurrencyActivated())
			return false;

		$this->smarty->assign('blockcurrencies_sign', $this->context->currency->sign);
	
		return true;
	}

	/**
	* Returns module content for header
	*
	* @param array $params Parameters
	* @return string Content
	*/
	public function hookDisplayTopNav($params)
	{
		if ($this->_prepareHook($params))
			return $this->display(__FILE__, 'azblockcurrencies.tpl');
	}

	public function hookDisplayHeader($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return;
		$this->context->controller->addCSS(($this->_path).'css/azblockcurrencies.css', 'all');
	}
}


