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

<!-- MODULE Block contact infos -->
<section id="block_contact_infos" class="az_boxFooter col-md-4 col-sm-12" >
	
	<div class="logo_footer"></div>
	<ul class="list-contact">
		{if $blockcontactinfos_company != ''}
			<li class="address">
				<label class="icon"><i class="fa fa-map-marker"></i></label>
				<span>{if $blockcontactinfos_address != ''}{$blockcontactinfos_address|escape:'html':'UTF-8'}{/if}</span>
			</li>
		{/if}
		
		{if $blockcontactinfos_phone != ''}
			<li class="phone">
				<label class="icon"><i class="fa fa-phone"></i></label>
				<span>{$blockcontactinfos_phone|escape:'html':'UTF-8'}</span>
			</li>
		{/if}
		
		{if $blockcontactinfos_email != ''}
			<li class="email">
				<label class="icon"><i class="fa fa-envelope"></i></label>
				{mailto address=$blockcontactinfos_email|escape:'html':'UTF-8' encode="hex"}
			</li>
		{/if}
	</ul>
	
</section>
<!-- /MODULE Block contact infos -->
