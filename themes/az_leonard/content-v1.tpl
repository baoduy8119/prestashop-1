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
	
{if $page_name == 'index'}
	
	{assign var='displayStatic2' value={hook h='displayStatic2'}}
	{if $displayStatic2}
	<div class="columns-content1 clearfix">
		<div class="container">
			{hook h="displayStatic2"}
		</div>
	</div>
	{/if}
	
	{assign var='displayStatic3' value={hook h='displayStatic3'}}
	{if $displayStatic3}
	<div class="columns-content2 clearfix">
		<div class="container">
			{hook h="displayStatic3"}
		</div>
	</div>
	{/if}
	
	{assign var='displayTab' value={hook h='displayTab'}}
	{if $displayTab}
	<div class="columns-content3 clearfix">
		<div class="container">
			{hook h="displayTab"}
		</div>
	</div>
	{/if}
	
	{assign var='displayTab2' value={hook h='displayTab2'}}
	{if $displayTab2}
	<div class="columns-content4 clearfix">
		<div class="container">
			{hook h="displayTab2"}
		</div>
	</div>
	{/if}
	

	{assign var='displayHomeNews' value={hook h='displayHomeNews'}}
	{assign var='displayStatic4' value={hook h='displayStatic4'}}
	{if $displayHomeNews || $displayStatic4}
	<div class="columns-content5 clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					{hook h="displayHomeNews"}
				</div>
				<div class="col-md-4 col-sm-4">
					{hook h="displayStatic4"}
				</div>
			</div>
		</div>
	</div>
	{/if}	
	
{/if}

	{assign var='displayManufacturer' value={hook h='displayManufacturer'}}
	{if displayManufacturer}
	<div class="columns-content6 clearfix">
		<div class="container">
			{hook h="displayManufacturer"}
		</div>
	</div>
	{/if}
	
	{assign var='displayNewLetter' value={hook h='displayNewLetter'}}
	{if displayNewLetter}
	<div class="columns-content7 clearfix">
		<div class="container">
			{hook h="displayNewLetter"}
		</div>
	</div>
	{/if}