{*
* 2016 AZTemplates
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
* Do not edit or add to this file if you wish to upgrade AZTemplates to newer
* versions in the future. If you wish to customize AZTemplates for your
* needs please refer to http://www.AZTemplates.com for more information.
*
*  @author AZTemplates SA <contact@AZTemplates.com>
*  @copyright  2016 AZTemplates SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of AZTemplates SA
*}
<!-- MODULE Block cart -->

<div class="blockcart clearfix">
<div class="shopping_cart clearfix{if $PS_CATALOG_MODE} header_user_catalog{/if}">

		<a href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='View my shopping cart' mod='azblockcart'}" rel="nofollow">
			<span class="icon"><i class="fa fa-shopping-cart"></i></span>
			<span class="cart_text">
				<span class="ajax_cart_quantity">{$cart_qties}</span>
				<span class="ajax_cart_quantity_text">{l s='Item(s):' mod='azblockcart'}</span>
				<span class="ajax_cart_total">
					{convertPrice price=$cart->getOrderTotal(true)}
				</span>
			</span>
 			
			{if $ajax_allowed && isset($blockcart_top) && !$blockcart_top}
				<span class="block_cart_expand{if !isset($colapseExpandStatus) || (isset($colapseExpandStatus) && $colapseExpandStatus eq 'expanded')} unvisible{/if}">&nbsp;</span>
				<span class="block_cart_collapse{if isset($colapseExpandStatus) && $colapseExpandStatus eq 'collapsed'} unvisible{/if}">&nbsp;</span>
			{/if}
		</a>
		{if !$PS_CATALOG_MODE}
			<div class="cart_block block exclusive">
				<div class="block_content">
					<!-- block list of products -->
					<div class="cart_block_list{if isset($blockcart_top) && !$blockcart_top}{if isset($colapseExpandStatus) && $colapseExpandStatus eq 'expanded' || !$ajax_allowed || !isset($colapseExpandStatus)} expanded{else} collapsed unvisible{/if}{/if}">
						{if $products}
							<p class="recent_items">{l s='Recent Add Item(s)' mod='azblockcart'}</p>
						{/if}	
							<dl class="products {($products) ? '' : 'hide'}">
							{if $products}
								{foreach from=$products item='product' name='myLoop'}
									{assign var='productId' value=$product.id_product}
									{assign var='productAttributeId' value=$product.id_product_attribute}
									<dt data-id="cart_block_product_{$product.id_product}_{if $product.id_product_attribute}{$product.id_product_attribute}{else}0{/if}_{if $product.id_address_delivery}{$product.id_address_delivery}{else}0{/if}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
										<a class="cart-images" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'cart_default')}" alt="{$product.name|escape:'html':'UTF-8'}" /></a>

										<div class="cart-info">
											
											<div class="product-name">
												<a class="cart_block_product_name" href="{$link->getProductLink($product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute)|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">{$product.name|truncate:200:'...'|escape:'html':'UTF-8'}</a>
											</div>
											
											
											{hook h='displayProductListReviews' product=$product}
											{if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}
											
											
											<span class="price">
												{if !isset($product.is_gift) || !$product.is_gift}
													{if $priceDisplay == $smarty.const.PS_TAX_EXC}{displayWtPrice p="`$product.total`"}{else}{displayWtPrice p="`$product.total_wt`"}{/if}
												{else}
													{l s='Free!' mod='azblockcart'}
												{/if}
											</span>
											
											<span class="quantity-formated">{l s='Qty:' mod='azblockcart'}<span class="quantity">{$product.cart_quantity}</span></span>
											<!--{if isset($product.attributes_small)}
												<div class="product-atributes">
													<a href="{$link->getProductLink($product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='azblockcart'}">{$product.attributes_small}</a>
												</div>
											{/if}-->
											
										</div>
										<span class="remove_link">
											{if !isset($customizedDatas.$productId.$productAttributeId) && (!isset($product.is_gift) || !$product.is_gift)}
												<a class="ajax_cart_block_remove_link" href="{$link->getPageLink('cart', true, NULL, 'delete=1&amp;id_product={$product.id_product}&amp;ipa={$product.id_product_attribute}&amp;id_address_delivery={$product.id_address_delivery}&amp;token={$static_token}', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='remove this product from my cart' mod='azblockcart'}">&nbsp;</a>
											{/if}
										</span>
									</dt>
									{if isset($product.attributes_small)}
										<dd data-id="cart_block_combination_of_{$product.id_product}{if $product.id_product_attribute}_{$product.id_product_attribute}{/if}_{$product.id_address_delivery|intval}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
									{/if}
									<!-- Customizable datas -->
									{if isset($customizedDatas.$productId.$productAttributeId[$product.id_address_delivery])}
										{if !isset($product.attributes_small)}
											<dd data-id="cart_block_combination_of_{$product.id_product}_{if $product.id_product_attribute}{$product.id_product_attribute}{else}0{/if}_{if $product.id_address_delivery}{$product.id_address_delivery}{else}0{/if}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
										{/if}
										<ul class="cart_block_customizations" data-id="customization_{$productId}_{$productAttributeId}">
											{foreach from=$customizedDatas.$productId.$productAttributeId[$product.id_address_delivery] key='id_customization' item='customization' name='customizations'}
												<li name="customization">
													<div data-id="deleteCustomizableProduct_{$id_customization|intval}_{$product.id_product|intval}_{$product.id_product_attribute|intval}_{$product.id_address_delivery|intval}" class="deleteCustomizableProduct">
														<a class="ajax_cart_block_remove_link" href="{$link->getPageLink("cart", true, NULL, "delete=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_customization={$id_customization}&amp;token={$static_token}", true)|escape:"html":"UTF-8"}" rel="nofollow">&nbsp;</a>
													</div>
													{if isset($customization.datas.$CUSTOMIZE_TEXTFIELD.0)}
														{$customization.datas.$CUSTOMIZE_TEXTFIELD.0.value|replace:"<br />":" "|truncate:28:'...'|escape:'html':'UTF-8'}
													{else}
														{l s='Customization #%d:' sprintf=$id_customization|intval mod='azblockcart'}
													{/if}
												</li>
											{/foreach}
										</ul>
										{if !isset($product.attributes_small)}</dd>{/if}
									{/if}
									{if isset($product.attributes_small)}</dd>{/if}
								{/foreach}
							{/if}
							</dl>
						
						<p class="cart_block_no_products{if $products} unvisible{/if}">
							{l s='No products' mod='azblockcart'}
						</p>
						{if $discounts|@count > 0}
							<table class="vouchers"{if $discounts|@count == 0} style="display:none;"{/if}>
								{foreach from=$discounts item=discount}
									{if $discount.value_real > 0}
										<tr class="bloc_cart_voucher" data-id="bloc_cart_voucher_{$discount.id_discount}">
											<td class="quantity">1x</td>
											<td class="name" title="{$discount.description}">
												{$discount.name|truncate:18:'...'|escape:'html':'UTF-8'}
											</td>
											<td class="price">
												-{if $priceDisplay == 1}{convertPrice price=$discount.value_tax_exc}{else}{convertPrice price=$discount.value_real}{/if}
											</td>
											<td class="delete">
												{if strlen($discount.code)}
													<a class="delete_voucher" href="{$link->getPageLink("$order_process", true)}?deleteDiscount={$discount.id_discount}" title="{l s='Delete' mod='azblockcart'}" rel="nofollow">
														<i class="icon-remove-sign"></i>
													</a>
												{/if}
											</td>
										</tr>
									{/if}
								{/foreach}
							</table>
						{/if}
						<div class="cart-prices">
							<!--<div class="cart-prices-line first-line">
								<span class="price_text">
									{l s='Shipping :' mod='azblockcart'}
								</span>
								<span class="price cart_block_shipping_cost ajax_cart_shipping_cost">
									{if $shipping_cost_float == 0}
										{l s='Free shipping!' mod='azblockcart'}
									{else}
										{$shipping_cost}
									{/if}
								</span>
								
							</div>
							{if $show_wrapping}
								<div class="cart-prices-line">
									<span class="price_text">
										{l s='Wrapping' mod='azblockcart'}
									</span>
									{assign var='cart_flag' value='Cart::ONLY_WRAPPING'|constant}
									<span class="price cart_block_wrapping_cost">
										{if $priceDisplay == 1}
											{convertPrice price=$cart->getOrderTotal(false, $cart_flag)}{else}{convertPrice price=$cart->getOrderTotal(true, $cart_flag)}
										{/if}
									</span>
									
							   </div>
							{/if}
							{if $show_tax && isset($tax_cost)}
								<div class="cart-prices-line">
									<span class="price cart_block_tax_cost ajax_cart_tax_cost">{$tax_cost}</span>
									<span>{l s='Tax' mod='azblockcart'}</span>
								</div>
							{/if}
							
							{if $use_taxes && $display_tax_label == 1 && $show_tax}
								<p>
								{if $priceDisplay == 0}
									{l s='Prices are tax included' mod='azblockcart'}
								{elseif $priceDisplay == 1}
									{l s='Prices are tax excluded' mod='azblockcart'}
								{/if}
								</p>
							{/if}
						</div>-->
						
						<div class="price-total">
							<span class="price_text">{l s='Total :' mod='azblockcart'} </span>
							<span class="price cart_block_total ajax_block_cart_total">
								{if $cart_qties > 0}
									{if $priceDisplay == 1}
										{assign var='blockcart_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
										{convertPrice price=$cart->getOrderTotal(false, $blockcart_cart_flag)}
									{else}
										{assign var='blockcart_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
										{convertPrice price=$cart->getOrderTotal(true, $blockcart_cart_flag)}
									{/if}
								{else}
									{l s='$ 0.00' mod='azblockcart'}
								{/if}
							</span>
						</div>
						<div class="buttons">
							<a id="button_order_cart" class="btn btn-default button button-small" href="{$link->getPageLink("$order_process", true)|escape:"html":"UTF-8"}" title="{l s='Check out' mod='azblockcart'}" rel="nofollow">
								{l s='View cart' mod='azblockcart'}
							</a>
							<a id="button_goto_cart" class="btn btn-default button button-small" href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='View my shopping cart' mod='azblockcart'}" rel="nofollow">
								{l s='Checkout' mod='azblockcart'}
							</a>
						</div>
					</div>
				</div>
			</div><!-- .cart_block -->
		{/if}
	

</div>
</div>
</div>
{counter name=active_overlay assign=active_overlay}
{if !$PS_CATALOG_MODE}
	<div id="layer_cart" class="layer_box">
		<div class="layer_inner_box">
			<div class="layer_product clearfix mar_b10">
				<span class="cross" title="{l s='Close window' mod='azblockcart'}"></span>
				<div class="product-image-container layer_cart_img">
				</div>
				<div class="layer_product_info">
					<h3 id="layer_cart_product_title" class="product-name"></h3>
					<span id="layer_cart_product_attributes"></span>
					<div id="layer_cart_product_quantity_wrap" class="hidden">
						<span class="layer_cart_label">{l s='Quantity' mod='azblockcart'}</span>
						<span id="layer_cart_product_quantity"></span>
					</div>
					<div id="layer_cart_product_price_wrap " class="hidden">
						<span class="layer_cart_label">{l s='Total' mod='azblockcart'}</span>
						<span id="layer_cart_product_price"></span>
					</div>
				</div>
			</div>
			
			<div id="pro_added_success" class="alert alert-success">{l s='Product successfully added to your shopping cart' mod='azblockcart'}</div>
			<div class="layer_details">
				<div class="layer_cart_row">
					<!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
					<span class="ajax_cart_product_txt_s {if $cart_qties < 2} unvisible{/if}">
						{l s='There are [1]%d[/1] items in your cart.' mod='azblockcart' sprintf=[$cart_qties] tags=['<span class="ajax_cart_quantity">']}
					</span>
					<!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
					<span class="ajax_cart_product_txt {if $cart_qties > 1} unvisible{/if}">
						{l s='There is 1 item in your cart.' mod='azblockcart'}
					</span>
				</div>
	
				<div id="layer_cart_ajax_block_products_total" class="layer_cart_row hidden">
					<span class="layer_cart_label">
						{l s='Total products' mod='azblockcart'}
						{if $priceDisplay == 1}
							{l s='(tax excl.)' mod='azblockcart'}
						{else}
							{l s='(tax incl.)' mod='azblockcart'}
						{/if}
					</span>
					<span class="ajax_block_products_total">
						{if $cart_qties > 0}
							{convertPrice price=$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS)}
						{/if}
					</span>
				</div>
	
				{if $show_wrapping}
					<div id="layer_cart_cart_block_wrapping_cost" class="layer_cart_row hidden">
						<span class="layer_cart_label">
							{l s='Wrapping' mod='azblockcart'}
							{if $priceDisplay == 1}
								{l s='(tax excl.)' mod='azblockcart'}
							{else}
								{l s='(tax incl.)' mod='azblockcart'}
							{/if}
						</span>
						<span class="price cart_block_wrapping_cost">
							{if $priceDisplay == 1}
								{convertPrice price=$cart->getOrderTotal(false, Cart::ONLY_WRAPPING)}
							{else}
								{convertPrice price=$cart->getOrderTotal(true, Cart::ONLY_WRAPPING)}
							{/if}
						</span>
					</div>
				{/if}
				<div id="layer_cart_ajax_cart_shipping_cost" class="layer_cart_row hidden">
					<span class="layer_cart_label">
						{l s='Total shipping' mod='azblockcart'}&nbsp;{l s='(tax excl.)' mod='azblockcart'}
					</span>
					<span class="ajax_cart_shipping_cost">
						{if $shipping_cost_float == 0}
							{l s='Free shipping!' mod='azblockcart'}
						{else}
							{$shipping_cost}
						{/if}
					</span>
				</div>
				{if $show_tax && isset($tax_cost)}
					<div id="layer_cart_ajax_cart_tax_cost" class="layer_cart_row hidden">
						<span class="layer_cart_label">{l s='Tax' mod='azblockcart'}</span>
						<span class="price cart_block_tax_cost ajax_cart_tax_cost">{$tax_cost}</span>
					</div>
				{/if}
				<div id="layer_cart_ajax_block_cart_total" class="layer_cart_row">	
					<span class="layer_cart_label">
						{l s='Total' mod='azblockcart'}
						{if $priceDisplay == 1}
							{l s='(tax excl.)' mod='azblockcart'}
						{else}
							{l s='(tax incl.)' mod='azblockcart'}
						{/if}
					</span>
					<span class="ajax_block_cart_total price">
						{if $cart_qties > 0}
							{if $priceDisplay == 1}
								{convertPrice price=$cart->getOrderTotal(false)}
							{else}
								{convertPrice price=$cart->getOrderTotal(true)}
							{/if}
						{/if}
					</span>
				</div>
				<div class="button-container clearfix">	
					<span class="continue button pull-left" title="{l s='Continue shopping' mod='azblockcart'}">
						{l s='Continue shopping' mod='azblockcart'}
					</span>
					<a class="button pull-right" href="{$link->getPageLink("$order_process", true)|escape:"html":"UTF-8"}" title="{l s='Proceed to checkout' mod='azblockcart'}" rel="nofollow">
						{l s='Proceed to checkout' mod='azblockcart'}
					</a>	
				</div>
			</div>
		</div>
		<div class="crossseling"></div>
	</div> <!-- #layer_cart -->
	<div class="layer_cart_overlay"></div>
{/if}
{strip}
{addJsDef CUSTOMIZE_TEXTFIELD=$CUSTOMIZE_TEXTFIELD}
{addJsDef img_dir=$img_dir|escape:'quotes':'UTF-8'}
{addJsDef generated_date=$smarty.now|intval}
{addJsDef ajax_allowed=$ajax_allowed|boolval}

{addJsDefL name=customizationIdMessage}{l s='Customization #' mod='azblockcart' js=1}{/addJsDefL}
{addJsDefL name=removingLinkText}{l s='remove this product from my cart' mod='azblockcart' js=1}{/addJsDefL}
{addJsDefL name=freeShippingTranslation}{l s='Free shipping!' mod='azblockcart' js=1}{/addJsDefL}
{addJsDefL name=freeProductTranslation}{l s='Free!' mod='azblockcart' js=1}{/addJsDefL}
{addJsDefL name=delete_txt}{l s='Delete' mod='azblockcart' js=1}{/addJsDefL}
{/strip}
<!-- /MODULE Block cart -->