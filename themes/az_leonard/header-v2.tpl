<header id="header" class="header_v2">
	<div class="header-mobile clearfix">
		{hook h="displayTopNav2"}
	</div>
	<div class="header-pc">
		<div class="container">
			<div class="row">
				<div id="header-logo" class="col-md-2 col-sm-4">
					<a class="logo" href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
						<img  src="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
					</a>
				</div>
				<div id="header-menu" class="no-background col-md-8 col-sm-6">
					{hook h="displayMenu"}
				</div>
				<div id="header-cart" class="col-md-2 col-sm-2">
					{include file="$tpl_dir./button-header.tpl"}
					{hook h="displayCart"}
					{hook h="displaySearch"}
					{if $is_logged}
						<a class="account-mobile" href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log out' mod='spblockuserinfo'}">
							<i class="fa fa-user"></i>
						</a>
					{else}
						<a class="account-mobile" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' mod='spblockuserinfo'}">
							<i class="fa fa-user"></i>
						</a>
					{/if}
				</div>
			</div>
		</div>
	</div>
</header>

{if $page_name == 'index'}
	{assign var='displayHomeSlider1' value={hook h='displayHomeSlider1'}}
	{if $displayHomeSlider1}
		<div class="slider-container">
			{hook h="displayHomeSlider1"}
		</div>
	{/if}
{/if}
