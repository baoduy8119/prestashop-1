{*
 * package   AZ Search Block
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.aztemplates.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}

<!--AZ Search Block-->
{if isset($list) && !empty($list)}
    {if isset($list) && !empty($list)}
        {foreach from=$list item=items}

            {$_list = $items->products}

            {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
            {assign var="tag_id" value="az_searchblock_{$items->id_azsearchblock}"}
            <div class="az_searchblock {$moduleclass_sfx|escape:'html':'UTF-8'}">
                {if $items->params.display_title_module}
                    <h3 class="az_titleModule">
                        {$items->title_module[$cookie->id_lang]|escape:'html':'UTF-8'}
                    </h3>
                {/if}

                {assign var="orderby" value=$items->params.products_ordering}
                {assign var="orderway" value=$items->params.ordering_direction}
                {assign var="instant_s" value=$items->params.instant_search}
                {assign var="ajax_s" value=$items->params.ajax_search}
                {assign var="id_module" value="{$items->id_azsearchblock}"}
                {if isset($search_query)}
                    {assign var="search_query_value" value="{$search_query}"}
                {else}
                    {assign var="search_query_value" value=""}
                {/if}
				
				{if $items->params.display_box_select}
                    {assign var="display_box_select" value=" show-box"}
                {else}
                    {assign var="display_box_select" value=" hidden-box"}
                {/if}
				
				
                {$products = $items->products}

				<div class="icon-search">
					<i class="fa fa-search"></i>
				</div>
                
                <div class="az_searchblock-container azsb-preload">
						<form class="azsb_searchform {$display_box_select|escape:'html':'UTF-8'}"  method="get" action="{$link->getModuleLink('azsearchblock','catesearch')|addslashes}">
							<div>
							<input type="hidden" name="fc" value="module"/>
							<input type="hidden" name="module" value="azsearchblock"/>
							<input type="hidden" name="controller" value="catesearch"/>
							<input type="hidden" name="orderby" value="{$orderby|escape:'html':'UTF-8'}"/>
							<input type="hidden" name="orderway" value="{$orderway|escape:'html':'UTF-8'}"/>
							{counter start=0 skip=1 print=false name=count assign="count"}
							{foreach $products as $key => $cat}
								{counter name=count}
								{if $count == 1}
									<input type="hidden" name="cat_id" value="{$cat.id_option|escape:'html':'UTF-8'}">
								{/if}
							{/foreach}
							
							
								
								
									<div class="azsb_selector_cat">
										<select class="azsb_cat">
											{counter start=0 skip=1 print=false name=count2 assign="count2"}
											{foreach $products as $key => $pro}
												{counter name=count2}
												<option value="{$pro.id_option}">
													{if $count2 == 1}
														{l s=' All Categories' mod='azsearchblock'}
													{else}
														{$pro.name|escape:'html':'UTF-8'}
													{/if}
												</option>
											{/foreach}
										</select>
									</div>
								
								<div class="inputblock">
									<div class="inputtext">
										<input class="azsb_query" type="text" name="search_query"
										   value="{$search_query_value|escape:'html':'UTF-8'|stripslashes}"
										   placeholder="{l s='Enter your keyword here' mod='azsearchblock'}"/>
									</div>

									<button value="{l s='Search' mod='azsearchblock'}" class="azsb_button" type="submit" name="azsb_submitsearch">
										<i class="fa fa-search"></i>
									</button>
									<input value="{$n|escape:'html':'UTF-8'}" type="hidden" name="n"/>
								</div>
								
							
							
							
							</div>
						</form>
	
                    
                </div>

                {include file="./default_js.tpl"}
            </div>
        {/foreach}
    {else}
        {l s='Has no content to show! In Module AZ Search Block' mod='azsearchblock'}
    {/if}
{/if}

<script type="text/javascript">
// <![CDATA[
	$(document).ready(function($){
		$(".azsb_searchform").addClass('show-form');
		$(".icon-search").click(function(){
			$(this).toggleClass("active").next().slideToggle("medium");
			
		});
	});
// ]]>
</script>

<!--/AZ Search Block-->