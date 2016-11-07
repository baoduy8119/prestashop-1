{*
 * package   SP Search Pro
 *
 * @version 1.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}


 
{capture name=path}{l s='Search' mod='spsearchpro'}{/capture}
<h1
{if isset($instant_search) && $instant_search}id="instant_search_results"{/if}
class="page-heading {if !isset($instant_search) || (isset($instant_search) && !$instant_search)} product-listing{/if}">
    {l s='Search' mod='spsearchpro'}&nbsp;
    {if $nbProducts > 0}
        <span class="lighter">
            "{if isset($search_query) && $search_query}{$search_query|escape:'html':'UTF-8'}{elseif $search_tag}{$search_tag|escape:'html':'UTF-8'}{elseif $ref}{$ref|escape:'html':'UTF-8'}{/if}"
        </span>
    {/if}

    {if isset($instant_search) && $instant_search}
        <a href="#" class="close">
            {l s='Return to the previous page' mod='spsearchpro'}
        </a>
    {else}
        <span class="heading-counter">
            {if $nbProducts == 1}{l s='%d result has been found.' sprintf=$nbProducts|intval mod='spsearchpro'}{else}{l s='%d results have been found.' sprintf=$nbProducts|intval mod='spsearchpro'}{/if}
        </span>
    {/if}
</h1>
{include file="$tpl_dir./errors.tpl"}
{if !$nbProducts}
	<p class="alert alert-warning">
		{if isset($search_query) && $search_query}
			{l s='No results were found for your search' mod='spsearchpro'}&nbsp;"{if isset($search_query)}{$search_query|escape:'html':'UTF-8'}{/if}"
		{elseif isset($search_tag) && $search_tag}
			{l s='No results were found for your search' mod='spsearchpro'}&nbsp;"{$search_tag|escape:'html':'UTF-8'}"
		{else}
			{l s='Please enter a search keyword' mod='spsearchpro'}
		{/if}
	</p>
{else}
	{if isset($instant_search) && $instant_search}
        <p class="alert alert-info">
            {if $nbProducts == 1}{l s='%d result has been found.' sprintf=$nbProducts|intval mod='spsearchpro'}{else}{l s='%d results have been found.' sprintf=$nbProducts|intval mod='spsearchpro'}{/if}
        </p>
    {/if}
    <div class="content_sortPagiBar_top">
			{include file="./category-view-type.tpl"}
			{include file="./product-sort.tpl"}
			{include file="./nbr-product-page.tpl"}
			{include file="./pagination.tpl"}
			
	</div>
	
	{include file="$tpl_dir./product-list.tpl" products=$search_products}
	
    <div class="content_sortPagiBar_bottom">
		{include file="./category-view-type.tpl"}
			{include file="./product-sort.tpl"}
			{include file="./nbr-product-page.tpl"}
			{include file="./pagination.tpl" paginationId='bottom'}
	</div>
{/if}