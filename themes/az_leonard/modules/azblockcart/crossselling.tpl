{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if isset($orderProducts) && count($orderProducts) > 0}
	<div class="crossseling-content">
		<h2>{l s='Customers who bought this product also bought:' mod='spblockcart'}</h2>
		<div id="blockcart_list">
			<ul id="blockcart_caroucel">
				{foreach from=$orderProducts item='orderProduct' name=orderProduct}
					<li>
						<div class="cart-info">
							{hook h='displayProductListReviews' product=$orderProducts}
							{if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}
							
							<div class="product-name">
								<a class="cart_block_product_name" href="{$link->getProductLink($product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute)|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">{$product.name|truncate:200:'...'|escape:'html':'UTF-8'}</a>
							</div>
							
							<span class="quantity-formated"><span class="quantity">{$product.cart_quantity}</span></span>
							
							<span class="price">
								{if !isset($product.is_gift) || !$product.is_gift}
									{if $priceDisplay == $smarty.const.PS_TAX_EXC}{displayWtPrice p="`$product.total`"}{else}{displayWtPrice p="`$product.total_wt`"}{/if}
								{else}
									{l s='Free!' mod='spblockcart'}
								{/if}
							</span>
							<!--{if isset($product.attributes_small)}
								<div class="product-atributes">
									<a href="{$link->getProductLink($product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='spblockcart'}">{$product.attributes_small}</a>
								</div>
							{/if}-->
							
							
							
						</div>
						<span class="remove_link">
							{if !isset($customizedDatas.$productId.$productAttributeId) && (!isset($product.is_gift) || !$product.is_gift)}
								<a class="ajax_cart_block_remove_link" href="{$link->getPageLink('cart', true, NULL, 'delete=1&amp;id_product={$product.id_product}&amp;ipa={$product.id_product_attribute}&amp;id_address_delivery={$product.id_address_delivery}&amp;token={$static_token}', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='remove this product from my cart' mod='spblockcart'}">&nbsp;</a>
							{/if}
						</span>
						{if $orderProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
							<span class="price_display">
								<span class="price">{convertPrice price=$orderProduct.displayed_price}</span>
							</span>
						{/if}
					</li>
				{/foreach}
			</ul>
		</div>
	</div>
{/if}