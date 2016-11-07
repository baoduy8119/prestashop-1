<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class CartController  extends CartControllerCore
{
	
	public function displayAjax()
	{
		if ($this->errors)
			$this->ajaxDie(Tools::jsonEncode(array('hasError' => true, 'errors' => $this->errors)));
		if ($this->ajax_refresh)
			$this->ajaxDie(Tools::jsonEncode(array('refresh' => true)));

		// write cookie if can't on destruct
		$this->context->cookie->write();

		if (Tools::getIsset('summary'))
		{
			$result = array();
			if (Configuration::get('PS_ORDER_PROCESS_TYPE') == 1)
			{
				$groups = (Validate::isLoadedObject($this->context->customer)) ? $this->context->customer->getGroups() : array(1);
				if ($this->context->cart->id_address_delivery)
					$deliveryAddress = new Address($this->context->cart->id_address_delivery);
				$id_country = (isset($deliveryAddress) && $deliveryAddress->id) ? (int)$deliveryAddress->id_country : (int)Tools::getCountry();

				Cart::addExtraCarriers($result);
			}
			$result['summary'] = $this->context->cart->getSummaryDetails(null, true);
			$result['customizedDatas'] = Product::getAllCustomizedDatas($this->context->cart->id, null, true);
			$result['HOOK_SHOPPING_CART'] = Hook::exec('displayShoppingCartFooter', $result['summary']);
			$result['HOOK_SHOPPING_CART_EXTRA'] = Hook::exec('displayShoppingCart', $result['summary']);

			foreach ($result['summary']['products'] as $key => &$product)
			{
				$product['quantity_without_customization'] = $product['quantity'];
				if ($result['customizedDatas'] && isset($result['customizedDatas'][(int)$product['id_product']][(int)$product['id_product_attribute']]))
				{
					foreach ($result['customizedDatas'][(int)$product['id_product']][(int)$product['id_product_attribute']] as $addresses)
						foreach ($addresses as $customization)
							$product['quantity_without_customization'] -= (int)$customization['quantity'];
				}
				$product['price_without_quantity_discount'] = Product::getPriceStatic(
					$product['id_product'],
					!Product::getTaxCalculationMethod(),
					$product['id_product_attribute'],
					6,
					null,
					false,
					false
				);

				if ($product['reduction_type'] == 'amount')
				{
					$reduction = (float)$product['price_wt'] - (float)$product['price_without_quantity_discount'];
					$product['reduction_formatted'] = Tools::displayPrice($reduction);
				}
			}
			if ($result['customizedDatas'])
				Product::addCustomizationPrice($result['summary']['products'], $result['customizedDatas']);

			Hook::exec('actionCartListOverride', array('summary' => $result, 'json' => &$json));
			$this->ajaxDie(Tools::jsonEncode(array_merge($result, (array)Tools::jsonDecode($json, true))));

		}
		// @todo create a hook
		elseif (file_exists(_PS_MODULE_DIR_.'/azblockcart/blockcart-ajax.php'))
			require_once(_PS_MODULE_DIR_.'/azblockcart/blockcart-ajax.php');
	}
}
