{*
*  @author Magentech <contact@magentech.com>
*  @copyright  2015 Magentech
*}
<!DOCTYPE HTML>

<html lang="{$lang_iso}">
	<head>
		<meta charset="utf-8" />
		<title>{$meta_title|escape:'html':'UTF-8'}</title>
		
		{if isset($meta_description) AND $meta_description}
			<meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />
		{/if}
		
		{if isset($meta_keywords) AND $meta_keywords}
			<meta name="keywords" content="{$meta_keywords|escape:'html':'UTF-8'}" />
		{/if}
		
		{* General meta tags *}
		<meta charset="utf-8" />
        <meta name="generator" content="PrestaShop" />
		<meta name="format-detection" content="telephone=no">
		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
		{* End - General meta tags *}
		
		{* Enable responsive layout *}
		{if ($AZ_responsive)}
		 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		{/if}
		{* End - Enable responsive layout *}
		
		{* Apple mobile specific meta tags *}
		
		<meta name="apple-mobile-web-app-capable" content="YES" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        {* End -  Apple mobile specific meta tags *}
		
		{if isset($css_files)}
			<link href="{$css_dir}fonts/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
			{foreach from=$css_files key=css_uri item=media}
				<link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}" />
			{/foreach}
		
		{/if}
		

		
		
		
		{if isset($js_defer) && !$js_defer && isset($js_files) && isset($js_def)}
			{$js_def}
			{foreach from=$js_files item=js_uri}
				<script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
			{/foreach}
	
		{/if}
		
		
		
		{$HOOK_HEADER}
		
		{* IE9 specific styles - lovely, isn't it? *}
        <!--[if IE 9]> <link rel="stylesheet" href="{$css_dir}ie9.css" type="text/css" media="all" /><![endif]-->
		<!--[if IE 11]> <link rel="stylesheet" href="{$css_dir}ie9.css" type="text/css" media="all" /><![endif]-->
        {* End - IE specific styles *}
		
		
		<!-- ADD RTL CLASSS -->
		{$is_rtl = false}
		{foreach from=$languages key=k item=language name="languages"}
			{if $language.iso_code == $lang_iso}
				{if $language.is_rtl == 1}
					{$is_rtl = true}
				{/if}
			{/if}
		{/foreach}
		
		
	</head>
	
	{if $AZ_patternOption }  {assign var='classBody_pattern' value="pattern`$AZ_patternOption`"} {/if} 
	{if $AZ_layoutOption }  {assign var='classBody_layoutOption' value="`$AZ_layoutOption`"} {/if} 
	
	<body{if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if}   itemscope itemtype="http://schema.org/WebPage" class=" {if ($AZ_contentOption == 'content-v1')} layout1 {/if} {if ($AZ_contentOption == 'content-v2')} layout2 {/if} {if ($AZ_contentOption == 'content-v3')} layout3 {/if}{if ($is_rtl)} rtl{/if} {if isset($page_name)}{$page_name|escape:'html':'UTF-8'}{/if}  {if isset($content_only) && $content_only} content_only{/if} lang_{$lang_iso} {$classBody_pattern} {$classBody_layoutOption} ">
	
	{if !isset($content_only) || !$content_only}
	
		{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'} <span class="bold">{$geolocation_country|escape:'html':'UTF-8'}</span></p>
			</div>
		{/if}
		
		
		
		<div id="wrapper" >
			 <!-- Header -->
			 <div class="header-container">
				{if isset($AZ_headerOption)}
					{include file="$tpl_dir./$AZ_headerOption.tpl"}
				{else}
					{include file="$tpl_dir./header-v1.tpl"}
				{/if}
			 </div>
			 <!-- End of Header -->
			 
			
			
			
			
			<!-- Breadcrumb Column -->
			{if $page_name !='index' && $page_name !='pagenotfound'}
				 <div class="breadcrumb-container">
					<div class="container">
						{include file="$tpl_dir./breadcrumb.tpl"}
					</div>
				</div>
			{/if}
			<!-- End Breadcrumb Column -->
			
			<!-- Columns -->
			<div class="columns-container">
				<div id="columns" class="container">
					<div class="row">
						
						{if ($AZ_sidebar !== "none") && !in_array($page_name,array(index,product,pagenotfound)) && $page_name !='products-comparison' && !$hide_left_column}
							 {if (isset($HOOK_LEFT_COLUMN) && $HOOK_LEFT_COLUMN|trim)}
								{if ($AZ_sidebar == "left")}
									{$sidebarClasses='sidebar-left'}
									{$centerColumnClasses='col-sm-8 col-md-9 col-lg-9'}
								{elseif ($AZ_sidebar == "right")}
									{$sidebarClasses='col-sm-push-8 col-md-push-9 col-lg-push-9 sidebar-right'}
									{$centerColumnClasses='col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3'}
								{/if}
								
								 <!-- Sidebar -->
								<div id="sidebar" class="column  col-lg-3 col-md-3 col-sm-4 {$sidebarClasses}">
									{$HOOK_LEFT_COLUMN}
								</div>
								 <!-- End of Sidebar -->
							 {/if}
							 {else}
								{$centerColumnClasses='col-sm-12'}
						{/if}
					
					
						
						
						<!-- Center Column -->
						<div id="center_column" class="column {$centerColumnClasses}">
							
							
	{/if}