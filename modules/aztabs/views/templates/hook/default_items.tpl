{*
 * @package AZ Tabs
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @author MagenTech http://www.magentech.com
 *}
{if !isset($items_params)}
    {assign var="items_params" value=$items->params}
{/if}

{if !empty($child_items)}
    {if !isset($kk)}
        {assign var="kk" value="0"}
    {/if}
    {counter start=$kk skip=1 print=false name=count assign="count"}
	{assign var="count_item" value=count($child_items)}
	{assign var="nb_rows" value=2}
    {foreach $child_items as $product}
        {counter name=count}
		{if $count % $nb_rows == 1 || $nb_rows == 1}
			<div class="aztabs-item ajax_block_product">
        {/if}
			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						{assign var='displayAllImage' value={hook h='displayAllImage'}}
						{if $product.id_image}
							{if $displayAllImage}
								<div class="list-primg owl-carousel">
									<div class="item">
										<a class="product-image" href="{$product.link|escape:'html':'UTF-8'}" {$product._target}  title="{$product.name|escape:'html':'UTF-8'}" >
											{assign var="src" value=($items_params['image_size'] != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items_params['image_size'])|escape:'html':'UTF-8'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html':'UTF-8'}}
											<img class="img_1" src="{$src}" alt="{$product.legend|escape:'html':'UTF-8'}"/>
										</a>
									</div>
									{hook h="displayAllImage" id_product=$product.id_product link_rewrite=$product.link_rewrite}
								</div>
								{else}
								<a class="product-image" href="{$product.link|escape:'html':'UTF-8'}" {$product._target}  title="{$product.name|escape:'html':'UTF-8'}" >
									{assign var="src" value=($items_params['image_size'] != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items_params['image_size'])|escape:'html':'UTF-8'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html':'UTF-8'}}
									<img class="img_1" src="{$src}" alt="{$product.legend|escape:'html':'UTF-8'}"/>
									{hook h="displaySecondImage" id_product=$product.id_product link_rewrite=$product.link_rewrite}
								</a>
							{/if}
						{/if}
						
						
						<div class="label-box">
							{if isset($product.new) && $product.new == 1}
								<span class="new-box">{l s='New' mod='aztabs'}</span>
							{/if}
							
							{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
								<span class="sale-box">{l s='Sale' mod='aztabs'}</span>
								{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="sale-box">-{$product.specific_prices.reduction * 100|escape:'html':'UTF-8'}%</span>
							{/if}
						</div>
						
						{if $items_params.display_addtocart || $items_params.display_wishlist || $items_params.display_compare}
							<div class="button-container">
								{if $items_params.display_wishlist}
									{hook h='displayProductListFunctionalButtons' product=$product}
								{/if}
								
								<!--   Enable quick view   -->
								{if isset($quick_view) && $quick_view}
									<a class="quick-view" href="{$product.link|escape:'html':'UTF-8'}" title="{l s='Quick View' mod='aztabs'}" data-rel="{$product.link|escape:'html':'UTF-8'}">
										<i class="fa fa-search"></i>
									</a>
								{/if}
								
								{if $items_params.display_compare && isset($comparator_max_item) && $comparator_max_item}
										<a class="add_to_compare" title="{l s='Add to compare' mod='aztabs'}"
										   href="{$product.link|escape:'html':'UTF-8'}"
										   data-id-product="{$product.id_product|escape:'html':'UTF-8'}"><i class="fa fa-exchange"></i></a>
								{/if}
								
								{if $items_params.display_addtocart}
									{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
										{if (!isset($product.customization_required) || !$product.customization_required) && ($product.allow_oosp || $product.quantity > 0)}
											{if isset($static_token)}
												<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}"
												   rel="nofollow" title="{l s='Add to cart' mod='aztabs'}"
												   data-id-product="{$product.id_product|intval}">
													<span>{l s='Add to cart' mod='aztabs'}</span>
												</a>
											{else}
												<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}"
												   rel="nofollow" title="{l s='Add to cart' mod='aztabs'}"
												   data-id-product="{$product.id_product|intval}">
													<span>{l s='Add to cart' mod='aztabs'}</span>
												</a>
											{/if}
										{else}
											<span class="button ajax_add_to_cart_button btn btn-default cart_button disabled">
												<span>{l s='Add to cart' mod='aztabs'}</span>
											</span>
										{/if}
									{/if}
								{/if}
							</div>
						{/if}
						
					</div>
					{hook h="displayProductDeliveryTime" product=$product}
					{hook h="displayProductPriceBlock" product=$product type="weight"}
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
					{if $items_params.display_name == 1}
						<h5 itemprop="name" class="product-name">
							<a href="{$product.link|escape:'html':'UTF-8'}"
							   title="{$product.name|escape:'html':'UTF-8'}" {$product._target}  >
								{$product.title|escape:'html':'UTF-8'}
							</a>
						</h5>
					{/if}
					
					<!--  Show average rating stars  -->
					{hook h='displayProductListReviews' product=$product}
					
					<!--   Show category description   -->
					 {if $items_params.display_description}
							{$product.desc|escape:'quotes':'UTF-8'}
					{/if}
					
					<!--Product Prices-->
					{if $items_params.display_price}
						{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
							{if !isset($paginationId) || $paginationId == ''}
								{addJsDefL name=min_item|escape:'html':'UTF-8'}{l s='Please select at least one product' js=1  mod='aztabs'}{/addJsDefL}
								{addJsDefL name=max_item|escape:'html':'UTF-8'}{l s='You cannot add more than %d product(s) to the product comparison' sprintf=$comparator_max_item js=1 mod='aztabs'}{/addJsDefL}
								{addJsDef comparator_max_item=$comparator_max_item}
								{addJsDef comparedProductsIds=$compared_products}
							{/if}
							<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
								{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
									<span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
									</span>
									<meta itemprop="priceCurrency"
										  content="{$currency->iso_code|escape:'html':'UTF-8'}"/>
									{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
										{hook h="displayProductPriceBlock" product=$product type="old_price"}
										<span class="old-price product-price">
											{displayWtPrice p=$product.price_without_reduction}
										</span>
										{hook h="displayProductPriceBlock" id_product=$product.id_product type="old_price"}
										<!--{if $product.specific_prices.reduction_type == 'percentage'}
											<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100|escape:'html':'UTF-8'} %</span>
										{/if}-->
									{/if}
									{hook h="displayProductPriceBlock" product=$product type="price"}
									{hook h="displayProductPriceBlock" product=$product type="unit_price"}
								{/if}
							</div>
						{/if}
					{/if}
					
					{if $items_params.display_detail}
						<a class="button lnk_view btn btn-default"
						   href="{$product.link|escape:'html':'UTF-8'}" {$product._target}
						   title="{l s='View' mod='aztabs'}">
							<span>{if (isset($product.customization_required) && $product.customization_required)}{l s='Customize' mod='aztabs'}{else}{l s='More' mod='aztabs'}{/if}</span>
						</a>
					{/if}
				</div>
				
			</div>
            
        {if $count % $nb_rows == 0 || $count == $count_item}
			</div>
			<!-- End item-->
		{/if}
        
        
    {/foreach}
{/if}

