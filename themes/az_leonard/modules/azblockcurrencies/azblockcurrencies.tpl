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

<!-- AZ Block Currencies -->
{if count($currencies) > 1}
	<div id="currencies-block">
		<form id="setCurrency" action="{$request_uri}" method="post">
			<div class="current">
				<input type="hidden" name="id_currency" id="id_currency" value=""/>
				<input type="hidden" name="SubmitCurrency" value="" />
				{foreach from=$currencies key=k item=f_currency}
					{if $cookie->id_currency == $f_currency.id_currency}<span>{$f_currency.iso_code}</span>{/if}
				{/foreach}
			</div>
			<ul id="first-currencies2" class="currencies_ul toogle_content">
				{foreach from=$currencies key=k item=f_currency}
					{if $cookie->id_currency == $f_currency.id_currency}
						<li class="selected">
							<span>
								{$f_currency.name}
							</span>
						</li>
						{else}
						<li>
							<a href="javascript:setCurrency({$f_currency.id_currency});" rel="nofollow" title="{$f_currency.name}">
								{$f_currency.name}
							</a>
						</li>
					{/if}
					
				{/foreach}
			</ul>
		</form>
	</div>
{/if}
<!-- /AZ Block Currencies -->