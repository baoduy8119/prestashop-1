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

{capture name=path}{l s='Price drop'}{/capture}

<h1 class="page-heading product-listing">{l s='Price drop'}</h1>

{if $products}
	<div class="content_sortPagiBar_top">
			{include file="./category-view-type.tpl"}
			{include file="./product-sort.tpl"}
			{include file="./nbr-product-page.tpl"}
	</div>
			
	{*define Hidden element of product*}
	{if $SP_catProductDes == 0}				{assign var='hiddenProductDes' value='hide-productdes'}      {else}  {assign var='hiddenProductDes' value=''}{/if}
	{if $SP_categoryShowColorOptions == 0}	{assign var='hiddenShowColorOptions' value='hide-coloroption'} {else} {assign var='hiddenShowColorOptions' value=''}{/if}
	{if $SP_categoryShowStockInfo == 0}		{assign var='hiddenShowStockInfo' value='hide-stockinfo'} 	{else} {assign var='hiddenShowStockInfo' value=''}{/if}
	{if $SP_catProductTitle == 0}			{assign var='hiddenProductTitle' value='hide-title'} 			{else} {assign var='hiddenProductTitle' value=''} {/if}
	{if $SP_quickView == 0}					{assign var='hiddenQuickView' value='hide-quickview'} 		{else} {assign var='hiddenQuickView' value=''}{/if}
	{if $SP_categoryShowAvgRating == 0}		{assign var='hiddenrating' value='hide-rating'} 				{else} {assign var='hiddenrating' value=''}{/if}
		
	<div class="content_product_list {$hiddenProductDes} {$hiddenShowColorOptions} {$hiddenShowStockInfo} {$hiddenProductTitle} {$hiddenQuickView} {$hiddenrating}"  data-class="{if isset($SP_gridProduct)} col-lg-{12/$SP_gridProduct} col-md-4 col-sm-6 col-xs-6 {else} col-md-3 col-sm-6 col-xs-6 {/if}">
		{include file="./product-list.tpl" products=$products}
	</div>

	<div class="content_sortPagiBar_bottom">
		{include file="./pagination.tpl" paginationId='bottom'}
	</div>
	{else}
	<p class="alert alert-warning">{l s='No price drop'}</p>
{/if}
