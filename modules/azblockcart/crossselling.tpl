{*
* 2016 AZTemplates
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@AZTemplates.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade AZTemplates to newer
* versions in the future. If you wish to customize AZTemplates for your
* needs please refer to http://www.AZTemplates.com for more information.
*
*  @author AZTemplates SA <contact@AZTemplates.com>
*  @copyright  2016 AZTemplates SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of AZTemplates SA
*}
{if isset($orderProducts) && count($orderProducts) > 0}
	<h2>{l s='Customers who bought this product also bought:' mod='azblockcart'}</h2>
	<a id="blockcart_scroll_left" class="blockcart_scroll_left{if count($orderProducts) < 5} hidden{/if}" title="{l s='Previous' mod='azblockcart'}" rel="nofollow">{l s='Previous' mod='azblockcart'}</a>
	<div id="blockcart_list">
		<ul {if count($orderProducts) > 4}style="width: {math equation="width * nbImages" width=58 nbImages=$orderProducts|@count}px"{/if}>
			{foreach from=$orderProducts item='orderProduct' name=orderProduct}
			<li>
				<a href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}" class="lnk_img"><img src="{$orderProduct.image}" alt="{$orderProduct.name|htmlspecialchars}" /></a>
				<p class="product_name"><a href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">{$orderProduct.name|truncate:15:'...'|escape:'html':'UTF-8'}</a></p>
				{if $orderProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
					<span class="price_display">
						<span class="price">{convertPrice price=$orderProduct.displayed_price}</span>
					</span>
				{else}
					<br />
				{/if}
				<!-- <a title="{l s='View' mod='blockcart'}" href="{$orderProduct.link}" class="button_small">{l s='View' mod='azblockcart'}</a><br /> -->
			</li>
			{/foreach}
		</ul>
	</div>
	<a id="blockcart_scroll_right" class="blockcart_scroll_right{if count($orderProducts) < 5} hidden{/if}" title="{l s='Next' mod='azblockcart'}" rel="nofollow">{l s='Next' mod='azblockcart'}</a>
{/if}