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
<div class="pagenotfound-wrap">
	<div class="pagenotfound-content">
		<div class="img_404">
			<img src="{$base_dir}themes/az_leonard/img/404/404.png" alt="#" />
		</div>
		<h1 class="titleFont">OPPS! THIS PAGE COULD NOT BE FOUND!</h1>
		<form action="{$link->getPageLink('search')|escape:'html':'UTF-8'}" method="post" class="std">
			<fieldset>
				<div>
					<input id="search_query" name="search_query" type="text" class="form-control grey" placeholder="What were you looking for ?" />
					<button type="submit" name="Submit" value="OK" class="btn btn-default button button-small"><span><i class="fa fa-search"></i></span></button>
				</div>
			</fieldset>
		</form>
		<p>Sorry bit the page you are looking for does not exist, have been removed or name changed</p>
		<a class="backtohome" href="{$base_dir}" title="{l s='Home'}">{l s='Back to homepage'}</a>
	</div>
</div>
