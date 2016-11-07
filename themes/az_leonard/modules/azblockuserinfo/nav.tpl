<!-- AZ User Info  -->

<div id="user_infoblock-top" class="header_user_info">
	<ul class="userinfo-block_ul">
		<li class="account">
			<a href="{$link->getPageLink('my-account', true)|escape:'html'}" title="{l s='My Account' mod='azblockuserinfo'}" rel="nofollow">
				{l s='My Account' mod='azblockuserinfo'}
			</a>
		</li>
		
		<li class="wishlist">
			<a href="{$link->getModuleLink('blockwishlist', 'mywishlist')}" title="{l s='My Wishlist' mod='azblockuserinfo'}" >
				{l s='My Wishlist' mod='azblockuserinfo'}
			</a>
		</li>
		
		<!--<li class="compare">
			<a href="index.php?controller=products-comparison" title="{l s='Compare' mod='azblockuserinfo'}" >
				{l s='Compare' mod='azblockuserinfo'}
			</a>
		</li>-->
		
		<li class="checkout">
			<a href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='Checkout' mod='azblockuserinfo'}" rel="nofollow">
				{l s='Checkout' mod='azblockuserinfo'}
			</a>
		</li>
		
		{if $is_logged}
			<li class="logout"> 
				<a href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log out' mod='azblockuserinfo'}">
					{l s='Logout' mod='azblockuserinfo'} 
				</a>
			</li>
		{else}
			<li class="login">
				<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' mod='azblockuserinfo'}">
					{l s='Login' mod='azblockuserinfo'}
				</a>
			</li>
		{/if}
	</ul>
</div>

<!-- /AZ User Info -->
