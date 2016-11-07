{*
 * package   SP Search Pro
 *
 * @version 1.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}


 
{capture name=path}{l s='Search' mod='azsearchblock'}{/capture}
<h1
{if isset($instant_search) && $instant_search}id="instant_search_results"{/if}
class="page-heading {if !isset($instant_search) || (isset($instant_search) && !$instant_search)} product-listing{/if}">
    {l s='Search' mod='azsearchblock'}&nbsp;
    {if $nbProducts > 0}
        <span class="lighter">
            "{if isset($search_query) && $search_query}{$search_query|escape:'html':'UTF-8'}{elseif $search_tag}{$search_tag|escape:'html':'UTF-8'}{elseif $ref}{$ref|escape:'html':'UTF-8'}{/if}"
        </span>
    {/if}

    {if isset($instant_search) && $instant_search}
        <a href="#" class="close">
            {l s='Return to the previous page' mod='azsearchblock'}
        </a>
    {else}
        <span class="heading-counter">
            {if $nbProducts == 1}{l s='%d result has been found.' sprintf=$nbProducts|intval mod='azsearchblock'}{else}{l s='%d results have been found.' sprintf=$nbProducts|intval mod='azsearchblock'}{/if}
        </span>
    {/if}
</h1>
{include file="$tpl_dir./errors.tpl"}
{if !$nbProducts}
	<p class="alert alert-warning">
		{if isset($search_query) && $search_query}
			{l s='No results were found for your search' mod='azsearchblock'}&nbsp;"{if isset($search_query)}{$search_query|escape:'html':'UTF-8'}{/if}"
		{elseif isset($search_tag) && $search_tag}
			{l s='No results were found for your search' mod='azsearchblock'}&nbsp;"{$search_tag|escape:'html':'UTF-8'}"
		{else}
			{l s='Please enter a search keyword' mod='azsearchblock'}
		{/if}
	</p>
{else}
	{if isset($instant_search) && $instant_search}
        <p class="alert alert-info">
            {if $nbProducts == 1}{l s='%d result has been found.' sprintf=$nbProducts|intval mod='azsearchblock'}{else}{l s='%d results have been found.' sprintf=$nbProducts|intval mod='azsearchblock'}{/if}
        </p>
    {/if}
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
	
	<div class="content_product_list {$hiddenProductDes} {$hiddenShowColorOptions} {$hiddenShowStockInfo} {$hiddenProductTitle} {$hiddenQuickView} {$hiddenrating}"  data-class="{if isset($SP_gridProduct)} col-lg-{12/$SP_gridProduct} col-md-6 col-sm-6 col-xs-6 {else} col-md-3 col-sm-6 col-xs-6 {/if}">
		{include file="$tpl_dir./product-list.tpl" products=$search_products}
	</div>
	
    <div class="content_sortPagiBar_bottom">
		{include file="./pagination.tpl" paginationId='bottom'}
	</div>
{/if}