<header id="header" class="header_v1">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-5">
					<div class="ht-left">
						{hook h="displayTopNav"}
						{hook h="displayStatic1"}
					</div>
				</div>
				
				<div class="col-md-6 col-sm-7">
					<div class="ht-right">
						{hook h="displayUserinfo"}
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="header-midle">
		<div class="container">
			<div id="header-logo">
				<a class="logo" href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
					<img  src="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
				</a>
			</div>
				
			<div id="header-cart">
				{hook h="displayCart"}
			</div>
		</div>
	</div>
	
	<div id="header-menu">
		<div class="container">
			{hook h="displayMenu"}
			{hook h="displaySearch"}
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
