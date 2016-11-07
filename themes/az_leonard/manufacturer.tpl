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


{include file="$tpl_dir./errors.tpl"}

{if !isset($errors) OR !sizeof($errors)}
	<h1 class="page-heading product-listing">
		{l s='List of products by manufacturer'}&nbsp;{$manufacturer->name|escape:'html':'UTF-8'}
	</h1>
	{if !empty($manufacturer->description) || !empty($manufacturer->short_description)}
		<div class="description_box rte">
			{if !empty($manufacturer->short_description)}
				<div class="short_desc">
					{$manufacturer->short_description}
				</div>
				<div class="hide_desc">
					{$manufacturer->description}
				</div>
				{if !empty($manufacturer->description)}
					<a href="#" class="lnk_more" onclick="$(this).prev().slideDown('slow'); $(this).hide();$(this).prev().prev().hide(); return false;">
						{l s='More'}
					</a>
				{/if}
			{else}
				<div>
					{$manufacturer->description}
				</div>
			{/if}
		</div>
	{/if}

	{if $products}
		<div class="content_sortPagiBar_top">
				{include file="./nbr-product-page.tpl"}
				{include file="./product-sort.tpl"}
				{include file="./category-view-type.tpl"}
		</div>
		
		{*define Hidden element of product*}
		{if $AZ_productDes == 0}				{assign var='hiddenProductDes' value='hidden-des'}      {else}  {assign var='hiddenProductDes' value=''}{/if}
		{if $AZ_productColor == 0}	{assign var='hiddenProductColor' value='hidden-color'} {else} {assign var='hiddenProductColor' value=''}{/if}
		{if $AZ_productStock == 0}		{assign var='hiddenProductStock' value='hidden-stock'} 	{else} {assign var='hiddenProductStock' value=''}{/if}
		{if $AZ_productTitle == 0}			{assign var='hiddenProductTitle' value='hidden-title'} 			{else} {assign var='hiddenProductTitle' value=''} {/if}
		{if $AZ_quickView == 0}					{assign var='hiddenQuickView' value='hidden-quickview'} 		{else} {assign var='hiddenQuickView' value=''}{/if}
		{if $AZ_productCatRating == 0}		{assign var='hiddenrating' value='hidden-rating'} 				{else} {assign var='hiddenrating' value=''}{/if}
			
		<div class="content_product_list {$hiddenProductDes} {$hiddenProductColor} {$hiddenProductStock} {$hiddenProductTitle} {$hiddenQuickView} {$hiddenrating}"  data-class="{if isset($AZ_productColumns)} col-lg-{12/$AZ_productColumns} col-md-4 col-sm-6 col-xs-6 {else} col-md-3 col-sm-6 col-xs-6 {/if}">
			{include file="./product-list.tpl" products=$products}
		</div>
		
		 
		<div class="content_sortPagiBar_bottom">
			{include file="./pagination.tpl" no_follow=1 paginationId='bottom'}
		</div>
	{else}
		<p class="alert alert-warning">{l s='No products for this manufacturer.'}</p>
	{/if}
{/if}
