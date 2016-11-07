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
{if !isset($content_only) || !$content_only}
					</div><!-- #center_column -->
					</div><!-- .row -->
				</div><!-- #columns -->
				
				
				
					
					{if isset($AZ_contentOption)}
						{include file="$tpl_dir./$AZ_contentOption.tpl"}
					{else}
						{include file="$tpl_dir./content-v1.tpl"}
					{/if}
					
				
				
				
				
			</div><!-- .columns-container -->
			{if isset($HOOK_FOOTER)}
				<!-- Footer -->
				<div class="footer-container">
					<div class="container">
						<footer class="footer">
							<div class="row">
								{$HOOK_FOOTER}
							</div>
							
						</footer>
					</div>
					
					
					<div id="footerBottom">
						<div class="container">
							<div class="row">
								<div class="col-sm-7">
									{if isset($copyRight_txt)}<div class="copyright">{$copyRight_txt}</div>{/if}
								</div>
								<div class="col-sm-5">
									{hook h="displayFooterPayment"}	
								</div>
							</div>							
								
						</div>
						
					</div>
					
				</div><!-- #footer -->
			{/if}
		</div><!-- #page -->
		
		{capture name="rightbar_spbarcart"} {hook h='displayAnywhere' mod='spbarcart' caller='spbarcart'}  {/capture}
		{capture name="rightbar_spcompare"} {hook h='displayAnywhere' mod='spcompare' caller='spcompare'}{/capture}
		
		{assign var="rightbar_i" value=0}
		{if trim($smarty.capture.rightbar_spbarcart)}{assign var="rightbar_i" value=$rightbar_i+1}{/if}
		{if trim($smarty.capture.rightbar_spcompare)}{assign var="rightbar_i" value=$rightbar_i+1}{/if}
		
		<!--BackToTop-->
		<a id="az_backtotop" class="backtotop" href="#" title="{l s='Back to top'}"><i class="fa fa-arrow-up"></i></a>
		
{/if}

	{if !$content_only}
		{if $AZ_liveEditor}
			{include file="$tpl_dir./az_liveeditor.tpl"}
		{/if}
	{/if}
	
	{include file="$tpl_dir./global.tpl"}
	
	</body>
	{if $AZ_animationScroll}
		<script src="{$js_dir}az_lib/jquery.anijs-min.js" type="text/javascript"></script>
		<script src="{$js_dir}az_lib/jquery.anijs-helper-scrollreveal-min.js" type="text/javascript"></script>
	{/if}
</html>