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
	
	
	{assign var='displayStatic5' value={hook h='displayStatic5'}}
	{if $displayStatic5}
	<div class="columns-content11 clearfix">
		<div class="container">
			{hook h="displayStatic5"}
		</div>
	</div>
	{/if}
	
	{assign var='displayTab4' value={hook h='displayTab4'}}
	{if $displayTab4}
	<div class="columns-content12 clearfix">
		<div class="container">
			{hook h="displayTab4"}
		</div>
	</div>
	{/if}
	
	{assign var='displayStatic3' value={hook h='displayStatic3'}}
	{assign var='displayCountdownTimer' value={hook h='displayCountdownTimer'}}
	{if $displayStatic3 || $displayCountdownTimer}
	<div class="columns-content13 clearfix">
		<div class="container">
			{hook h="displayCountdownTimer"}
			{hook h="displayStatic3"}
		</div>
	</div>
	{/if}
	
	{assign var='displayHomeNews' value={hook h='displayHomeNews'}}
	{if $displayHomeNews}
	<div class="columns-content4 clearfix">
		<div class="container">
			{hook h="displayHomeNews"}
		</div>
	</div>
	{/if}
	
	
	
	{assign var='displayManufacturer' value={hook h='displayManufacturer'}}
	{if displayManufacturer}
	<div class="columns-content6 clearfix">
		<div class="container">
			{hook h="displayManufacturer"}
		</div>
	</div>
	{/if}