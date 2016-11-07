{*
* 2016 AZ Templates
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@zikathemes.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade AZ Templates to newer
* versions in the future. If you wish to customize AZ Templates for your
* needs please refer to http://www.zikathemes.com for more information.
*
*  @author AZ Templates <contact@zikathemes.com>
*  @copyright  2016 AZ Templates
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of AZ Templates
*}
<!-- AZ Block Newsletter -->
<div id="newsletter_block_popup">

		<div class="block_content clearfix">
			<div class="close"></div>
			<div class="content-inner">
				<h3 class="title titleFont">{l s='Newsletter' mod='azblocknewsletter'}</h3>
				<div class="banner"></div>
				<p class="title titleFont">
					{l s='Sign up for out newsletter 
					to receive special offers.' mod='azblocknewsletter'}
				</p>
				<form action="{$link->getPageLink('index')|escape:'html':'UTF-8'}" method="post" id="newsletter-validate-detail-popup">
					<div class="form-group{if isset($msg) && $msg } {if $nw_error}form-error{else}form-ok{/if}{/if}" >
						<input class="inputNew grey newsletter-input" size="80" id="newsletter-inputpopup" type="text" name="email"  placeholder="{if isset($msg) && $msg}{$msg}{elseif isset($value) && $value}{$value}{else}{l s='Email' mod='azblocknewsletter'}{/if}" />
						<button type="submit" name="submitNewsletter" class="btn btn-default button button-small">
							<i class="fa fa-long-arrow-right"></i>
						</button>
						<input type="hidden" name="action" value="0" />
					</div>
				</form>
				<div class="msg">
					<input type="checkbox" class="ckmsg"/>
					<label class="check_lable">Don't show again</label>
				</div>
				
			</div>
		</div>

</div>
<!-- /AZ Block Newsletter-->
{strip}
{if isset($msg) && $msg}
{addJsDef msg_newsl=$msg|@addcslashes:'\''}
{/if}
{if isset($nw_error)}
{addJsDef nw_error=$nw_error}
{/if}
{addJsDefL name=placeholder_blocknewsletter}{l s='Your Email' mod='blocknewsletter' js=1}{/addJsDefL}
{if isset($msg) && $msg}
	{addJsDefL name=alert_blocknewsletter}{l s='Newsletter : %1$s' sprintf=$msg js=1 mod="blocknewsletter"}{/addJsDefL}
{/if}
{/strip}

<script type="text/javascript">
// <![CDATA[
	 $(document).ready(function($){
		$(".close").click(function(){
			$('#newsletter_block_popup').fadeOut('medium');
		});
	  
		$('.ckmsg').off('click').on('click', function(e){
			var  c = 'checked', isChecked = $("input.ckmsg").is(":" + c);
			var _checked = $("input.ckmsg:checked").length;
			var options = {};
			options.expires = 1; 
			if (_checked) {
				$.cookie('az_newsletter',1, options);
			}else{
				$.cookie('az_newsletter',null);
			}
		});
	  
		$('.check_lable').off('click').on('click', function(e){
			e.preventDefault();
			var  c = 'checked', isChecked = $("input.ckmsg").is(":" + c);
			isChecked ?  $("input.ckmsg").attr('checked', false) : $("input.ckmsg").attr('checked', true);
			var _checked = $("input.ckmsg:checked").length;
			_checked ?  $('.msg  span').addClass('checked') :  $('.msg  span').removeClass('checked', 'checked');
			var options = {};
				options.expires = 1; 
			if (_checked) {
				$.cookie('az_newsletter',1, options);
			}else{
				$.cookie('az_newsletter',null);
			}
		});
	 });
// ]]>
</script>