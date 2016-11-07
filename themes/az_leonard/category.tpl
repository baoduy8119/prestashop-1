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

{include file="$tpl_dir./errors.tpl"}
{if isset($category)}
	{if $category->id AND $category->active}
    	{if $scenes || $category->description || $category->id_image}
			<div class="content_scene_cat">
            	 {if $scenes}
                 	<div class="content_scene">
                        <!-- Scenes -->
                        {include file="$tpl_dir./scenes.tpl" scenes=$scenes}
                        {if $category->description}
                            <div class="cat_desc rte">
                            {if Tools::strlen($category->description) > 350}
                                <div id="category_description_short">{$description_short}</div>
                                <div id="category_description_full" class="unvisible">{$category->description}</div>
                                <a href="{$link->getCategoryLink($category->id_category, $category->link_rewrite)|escape:'html':'UTF-8'}" class="lnk_more">{l s='More'}</a>
                            {else}
                                <div>{$category->description}</div>
                            {/if}
                            </div>
                        {/if}
                    </div>
				{else}
                    <!-- Category image -->  
					{if $category->id_image}
						<div class="category-image">
							<img src="{$link->getCatImageLink($category->link_rewrite, $category->id_image, 'category_default')|escape:'html':'UTF-8'}" alt="{$category->name|escape:'html':'UTF-8'}" />
						</div> 
                    {/if}
                     
						{if $category->description}
							
                            <div class="content_scene">
								<!--<h1 class="category-name">
									{strip}
										{$category->name|escape:'html':'UTF-8'}
										{if isset($categoryNameComplement)}
											{$categoryNameComplement|escape:'html':'UTF-8'}
										{/if}
									{/strip}
								</h1>-->
								{if Tools::strlen($category->description) > 350}
									<div id="category_description_short" class="rte">{$description_short}</div>
									<div id="category_description_full" class="unvisible rte">{$category->description}</div>
									<a href="{$link->getCategoryLink($category->id_category, $category->link_rewrite)|escape:'html':'UTF-8'}" class="lnk_more">{l s='More'}</a>
								{else}
									<div class="rte">{$category->description}</div>
								{/if}
                            </div>
                        {/if}
               
                  {/if}
            </div>
		{/if}

		
		<!-- Subcategories -->
		
		{if isset($AZ_subCat) && $AZ_subCat == 1}
			<div id="subcategories">
				<h3 class="subcategory-heading titleFont">{l s='Subcategories'}</h3>
				
				<div class="row">
				
				{if isset($subcategories)}	
				{foreach from=$subcategories item=subcategory}
					<div class="{if isset($AZ_subCatColumns)} col-md-{12/$AZ_subCatColumns}  {else} col-md-12 {/if} col-xs-6">
						<div class="subcategories-box">
							<div class="subcategory-image">
								<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="img">
								{if $subcategory.id_image}
									<img class="replace-2x" src="{$link->getCatImageLink($subcategory.link_rewrite, $subcategory.id_image)}" alt="" />
								{else}
									<img class="replace-2x" src="{$img_cat_dir}default-medium_default.jpg" alt=""  />
								{/if}
								</a>
							</div>
							
							{if $AZ_subCatTitle}
							<h4 class="subcategory-name">
								<a  href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}">
									{$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'|truncate:350}
								</a>
							</h4>
							{/if}
							
							{if $AZ_subCatDes}
								<div class="subcategory-desc">{$subcategory.description}</div>
							{/if}
						</div>
					</div>
				{/foreach}
				{/if}
				</div>
				
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
				{include file="./pagination.tpl" paginationId='bottom'}
			</div>
		{else}
            <h1>{l s='There are no products in this category!'}</h1>
        {/if}
		
		
	{elseif $category->id}
		<p class="alert alert-warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}
