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
{if count($categoryProducts) > 0 && $categoryProducts !== false}
<section class="blockproductscategory block col-sm-12 ">
	<h3 class="title_block titleFont">{l s='Related Products' mod='productscategory'}</h3>
	<div id="productscategory_list" class="clearfix">
		<ul class="related-product product_list grid owl-carousel clearfix">
		 {foreach from=$categoryProducts item='categoryProduct' name=categoryProduct}
			<li class="product-box item">
				<div class="product-container">
					
					<div class="left-block">
					
						<div class="product-image-container">
							<!--   Slider Images Product   -->
							
							<div class="product-image">
								<img class="img_1" src="{$link->getImageLink($categoryProduct.link_rewrite, $categoryProduct.id_image, 'home_default')}"  alt="{$categoryProduct.name|escape:html:'UTF-8'}" />
								{hook h="displaySecondImage" id_product=$categoryProduct.id_product link_rewrite=$categoryProduct.link_rewrite}
							</div>
							
							{if isset($categoryProduct.new) && $categoryProduct.new == 1 || isset($categoryProduct.on_sale) && $categoryProduct.on_sale && isset($categoryProduct.show_price) && $categoryProduct.show_price && !$PS_CATALOG_MODE}
								<div class="label-box">
									{if isset($categoryProduct.new) && $categoryProduct.new == 1}
										<span class="new-box">{l s='New' mod='productscategory'}</span>
									{/if}
									
									{if isset($categoryProduct.on_sale) && $categoryProduct.on_sale && isset($categoryProduct.show_price) && $categoryProduct.show_price && !$PS_CATALOG_MODE}
										<span class="sale-box">{l s='Sale' mod='productscategory'}</span>
										{elseif isset($categoryProduct.reduction) && $categoryProduct.reduction && isset($categoryProduct.show_price) && $categoryProduct.show_price && !$PS_CATALOG_MODE}<span class="sale-box">{l s='Sale' mod='productscategory'}</span>
									{/if}
								</div>
							{/if}
							
							<!--Product Buttons-->
							<div class="button-container">
								
								
								{hook h='displayProductListFunctionalButtons' product=$categoryProduct}
								
								{if isset($comparator_max_item) && $comparator_max_item}
									
									<a class="add_to_compare" href="{$categoryProduct.link|escape:'html':'UTF-8'}"  title="{l s='Add to compare' mod='productscategory'}" data-id-product="{$categoryProduct.id_product}">
										<i class="fa fa-exchange"></i>
									</a>
								
								{/if}
								
								<!--   Enable quick view   -->
								<a class="quick-view" href="{$categoryProduct.link|escape:'html':'UTF-8'}" title="{l s='Quick View' mod='productscategory'}" data-rel="{$categoryProduct.link|escape:'html':'UTF-8'}">
									<i class="fa fa-search"></i>
								</a>
								
								
								</div>
								{if ($categoryProduct.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $categoryProduct.available_for_order && !isset($restricted_country_mode) && $categoryProduct.minimal_quantity <= 1 && $categoryProduct.customizable != 2 && !$PS_CATALOG_MODE}
									{if (!isset($categoryProduct.customization_required) || !$categoryProduct.customization_required) && ($categoryProduct.allow_oosp || $categoryProduct.quantity > 0)}
									<div class="button-cart">
										{if isset($static_token)}
											<a class=" cart_button ajax_add_to_cart_button" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$categoryProduct.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow"  title="{l s='Add to cart' mod='productscategory'}" data-id-product="{$categoryProduct.id_product|intval}">
												<span>{l s='Add to cart' mod='productscategory'}</span>
											</a>
										{else}
											<a class=" cart_button ajax_add_to_cart_button" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$categoryProduct.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='productscategory'}" data-id-product="{$categoryProduct.id_product|intval}">
												<span>{l s='Add to cart' mod='productscategory'}</span>
											</a>
										{/if}
									{else}
										<span class=" cart_button ajax_add_to_cart_button disabled" title="{l s='Add to cart' mod='productscategory'}">
											<span>{l s='Add to cart' mod='productscategory'}</span>
										</span>
									{/if}
									</div>
								{/if}
								
								
							
							
						</div>
						{hook h="displayProductDeliveryTime" product=$categoryProduct}
						{hook h="displayProductPriceBlock" product=$categoryProduct type="weight"}
					</div>
					
					<div class="right-block">
						
						
						
						<!--Product Name-->
						<h5 class="product-name">
							<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)|escape:'html':'UTF-8'}" title="{$categoryProduct.name|htmlspecialchars}">{$categoryProduct.name|truncate:54:'...'|escape:'html':'UTF-8'}</a>
						</h5>
						
						<!--  Show average rating stars  -->
						{hook h='displayProductListReviews' product=$categoryProduct}
						
						<!--Product Prices-->
						{if (!$PS_CATALOG_MODE AND ((isset($categoryProduct.show_price) && $categoryProduct.show_price) || (isset($categoryProduct.available_for_order) && $categoryProduct.available_for_order)))}
						<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price-box">
							{if isset($categoryProduct.show_price) && $categoryProduct.show_price && !isset($restricted_country_mode)}
								
								{if isset($categoryProduct.specific_prices) && $categoryProduct.specific_prices && isset($categoryProduct.specific_prices.reduction) && $categoryProduct.specific_prices.reduction > 0}
									{hook h="displayProductPriceBlock" product=$categoryProduct type="old_price"}
									<span class="old-price product-price">
										{displayWtPrice p=$categoryProduct.price_without_reduction}
									</span>
									{hook h="displayProductPriceBlock" id_product=$categoryProduct.id_product type="old_price"}
									<!--{if $categoryProduct.specific_prices.reduction_type == 'percentage'}
										<span class="price-percent-reduction">-{$categoryProduct.specific_prices.reduction * 100}%</span>
									{/if}-->
								{/if}
								<span itemprop="price" class="price product-price">
									{if !$priceDisplay}{convertPrice price=$categoryProduct.price}{else}{convertPrice price=$categoryProduct.price_tax_exc}{/if}
								</span>
								<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
								{hook h="displayProductPriceBlock" product=$categoryProduct type="price"}
								{hook h="displayProductPriceBlock" product=$categoryProduct type="unit_price"}
							{/if}
						</div>
						{/if}
					</div>
					
					
			</li>
		{/foreach}

		</ul>
	</div>
</section>
{/if}

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.related-product').owlCarousel({
			pagination: false,
			center: false,
			nav: true,
			loop: true,
			margin: 0,
			navText: [ '<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				768:{
					items:3
				},
				992:{
					items:4
				},
				1200:{
					items:4
				}
			}
		});
	});
</script>