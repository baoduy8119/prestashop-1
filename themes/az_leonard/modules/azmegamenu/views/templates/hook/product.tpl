{if !empty($products)}
{assign var='itempage' value=5}
{assign var='count' value=0}
<div class="block_content dropdown-menu">
	{$spproduct=array_chunk($products,$itempage)}
		{foreach from=$spproduct item=products name=mypLoop}
			<ul class="product_lists grid">
				{foreach from=$products item=product name=products}
							<li class="product_block  {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if}">
								<div class="product-container" itemscope itemtype="http://schema.org/Product">
									<div class="left-block">
										<div class="product-image-container">
											<!--   Slider Images Product   -->
											
											<a class="product-image" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
												<img class="img_1" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}"  alt="{$product.name|escape:html:'UTF-8'}" />
												{hook h="displaySecondImage" id_product=$product.id_product link_rewrite=$product.link_rewrite}
											</a>
											
											<div class="label-box">
												{if isset($product.new) && $product.new == 1}
													<span class="new-box">{l s='New'}</span>
												{/if}
												
												{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
													<span class="sale-box">{l s='Sale'}</span>
													{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="sale-box">{l s='Sale'}</span>
												{/if}
											</div>
										</div>
									</div>
										
									<div class="right-block">
										<h5 itemprop="name" class="product-name" >
											{if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}
											<a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url" >
												{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}
											</a>
										</h5>
										
										
										<!--Product Prices-->
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
										
										<!--  Show average rating stars  -->
										{hook h='displayProductListReviews' product=$product}
									</div>
								</div>
							</li>
				{/foreach}
			</ul>	
		{/foreach}
</div>
{/if}