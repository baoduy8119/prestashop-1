<!-- AZ User Info  -->
{if $logged}
<div class="header_user_info">
	<a href="{$link->getPageLink('my-account', true)|escape:'html'}" title="{l s='View my customer account' mod='azblockuserinfo'}" class="account" rel="nofollow"><span>{$cookie->customer_firstname} {$cookie->customer_lastname}</span></a>
</div>
{/if}
<div class="header_user_info">
	{if $logged}
		<a class="logout" href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html'}" rel="nofollow" title="{l s='Log me out' mod='blockuserinfo'}">{l s='Sign out' mod='azblockuserinfo'}</a>
	{else}
		<a class="login" href="{$link->getPageLink('my-account', true)|escape:'html'}" rel="nofollow" title="{l s='Log in to your customer account' mod='blockuserinfo'}">{l s='Sign in' mod='azblockuserinfo'}</a>
	{/if}
</div>
<!-- /AZ User Info  -->
