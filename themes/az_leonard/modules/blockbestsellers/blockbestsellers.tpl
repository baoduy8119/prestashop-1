{*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2015 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- MODULE Block best sellers -->
<div id="best-sellers_block_right" class="block products_block">
	<h3 class="title_block">
    	<span>{l s='Best sellers' mod='blockbestsellers'}</span>
    </h3>
	<div class="block_content products-block">
	{if $best_sellers && $best_sellers|@count > 0}
		 <ul class="products">
			{foreach from=$best_sellers item=product name=myLoop}
			<li class="clearfix">
				<a href="{$product.link|escape:'html'}" title="{$product.legend|escape:'html':'UTF-8'}" class="products-block-image">
					<img class="img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_default')|escape:'html'}" alt="{$product.legend|escape:'html':'UTF-8'}" />
				</a>
				<div class="product-content">
                	<h5 class="product-name">
                    	<a  href="{$product.link|escape:'html'}" title="{$product.legend|escape:'html':'UTF-8'}">
                            {$product.name|strip_tags:'UTF-8'|escape:'html':'UTF-8'}
                        </a>
                    </h5>
					
					
					{hook h='displayProductListReviews' product=$product}
                    
					<!--<p class="product-description">{$product.description_short|strip_tags:'UTF-8'|truncate:75:'...'}</p>-->
                    {if !$PS_CATALOG_MODE}
                        <div class="price-box">
                            <span class="price">{$product.price}</span>
                            {hook h="displayProductPriceBlock" product=$product type="price"}
                        </div>
                    {/if}
					
                </div>
			</li>
		{/foreach}
		</ul>
		<!--<div class="lnk">
        	<a href="{$link->getPageLink('best-sales')|escape:'html'}" title="{l s='All best sellers' mod='blockbestsellers'}"  class="btn btn-default button button-small"><span>{l s='All best sellers' mod='blockbestsellers'}<i class="fa fa-chevron-right right"></i></span></a>
        </div>-->
	{else}
		<p>{l s='No best sellers at this time' mod='blockbestsellers'}</p>
	{/if}
	</div>
</div>
<!-- /MODULE Block best sellers -->