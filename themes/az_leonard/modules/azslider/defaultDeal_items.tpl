{*
 * @package AZ Slider
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @author AZ Templates http://www.aztemplates.com
 *}
{foreach $_list as $product}
	<div class="azslider-item">
		<div class="product-container" itemscope itemtype="http://schema.org/Product">
			<div class="row">
				
				
				<div class="col-sm-4 col-sm-push-8">
					<div class="left-block">
						<div class="product-image-container">
							{if $product.id_image}
								<a class="product-image" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
									{assign var="src" value=($items->params.image_size != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items->params.image_size)|escape:'html'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html'}}
									<img class="img_1" src="{$src}" alt="{$product.legend|escape:html:'UTF-8'}"/>
									{hook h="displaySecondImage" id_product=$product.id_product link_rewrite=$product.link_rewrite}
								</a>
							{/if}
							
							<div class="label-box">
								{if $items->params.show_new == 1 && isset($product.new) && $product.new == 1}
									<span class="new-box">{l s='New' mod='azslider'}</span>
								{/if}
								
								{if $items->params.show_sale == 1 && isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
									<span class="sale-box">{l s='Sale' mod='azslider'}</span>
									{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="sale-box">-{$product.specific_prices.reduction * 100|escape:'html':'UTF-8'}%</span>
								{/if}
							</div>
							
							
						
						</div>
					</div>
				</div>
				
				
				
				<div class="col-sm-7 col-sm-pull-4">
					<div class="right-block">
			
						{if $items->params.show_name}
							<h5 itemprop="name" class="product-name titleFont">
								<a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" {$product._target}>
									{$product.title|escape:'html':'UTF-8'}
								</a>
							</h5>
						{/if}
						
						{if $items->params.show_reviews}
							{hook h='displayProductListReviews' product=$product}
						{/if}
						
						{if $items->params.show_description}
								{$product.desc}
						{/if}
															
						{if $items->params.show_price}
							{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
							<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price-box">
								{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
									<span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
									</span>
									<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
									{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
										{hook h="displayProductPriceBlock" product=$product type="old_price"}
										<span class="old-price product-price">
											{displayWtPrice p=$product.price_without_reduction}
										</span>
										{hook h="displayProductPriceBlock" id_product=$product.id_product type="old_price"}
										<!--{if $product.specific_prices.reduction_type == 'percentage'}
											<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
										{/if}-->
									{/if}
									{hook h="displayProductPriceBlock" product=$product type="price"}
									{hook h="displayProductPriceBlock" product=$product type="unit_price"}
								{/if}
							</div>
							{/if}
						{/if}
						
						
						{if $items->params.specific_only && isset($product.specialPrice)}
							<div class="product_time_{$product.id_product}" id="countdown_time"></div>	
							<script type="text/javascript">
							//<![CDATA[
								listdeal.push('product_time_{$product.id_product}&&||&&{$product.specialPrice|date_format:"%Y/%m/%d %H:%M:%S"}') ;
							//]]>
							</script>											
						{/if}
						
						{if $items->params.show_addtocart || $items->params.show_wishlist || $items->params.show_compare}
								<div class="button-container">
									{if $items->params.show_wishlist}
										{hook h='displayProductListFunctionalButtons' product=$product}
									{/if}
									
									{if isset($quick_view) && $quick_view}
										<a class="quick-view" href="{$product.link|escape:'html':'UTF-8'}" title="{l s='Quick view' mod='azslider'}" data-rel="{$product.link|escape:'html':'UTF-8'}">
											<i class="fa fa-search"></i>
										</a>
									{/if}
									
									{if $items->params.show_compare && isset($comparator_max_item) && $comparator_max_item}
										<a class="add_to_compare" href="{$product.link|escape:'html':'UTF-8'}"  title="{l s='Add to Compare' mod='azslider'}" data-id-product="{$product.id_product}">
											<i class="fa fa-exchange"></i>
										</a>
									{/if}
									
									{if $items->params.show_addtocart}
										{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
											{if (!isset($product.customization_required) || !$product.customization_required) && ($product.allow_oosp || $product.quantity > 0)}
												{if isset($static_token)}
													<a class="cart_button ajax_add_to_cart_button" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow"  title="{l s='Add to cart'}" data-id-product="{$product.id_product|intval}">
														<span>{l s='Add to cart' mod='azslider'}</span>
													</a>
												{else}
													<a class=" cart_button ajax_add_to_cart_button" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart'}"  data-id-product="{$product.id_product|intval}">
														<span>{l s='Add to cart' mod='azslider'}</span>
													</a>
												{/if}
											{else}
												
												<span class=" cart_button ajax_add_to_cart_button"  title="{l s='Add to cart'}">
													<span>{l s='Add to cart' mod='azslider'}</span>
												</span>
											{/if}
										{/if}
									{/if}
									
								</div>
							{/if}
						
						<a href="#" class="showall">{l s='Show all' mod='azslider'}</a>
					</div>		
				</div>
			</div>
		</div>
	</div>
{/foreach}
