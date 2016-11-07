{*
 * package   AZ Manufacturer
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.magentech.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}

<!-- AZ Manufacturer -->
{if isset($list) && !empty($list)}
    {foreach from=$list item=items}
        {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
        <div class="az_module {$moduleclass_sfx|escape:'html':'UTF-8'}">
            
            {assign var="params" value=$items->params}

            {$_list = $items->products}
            {if isset($_list) && $_list}


                {math equation='rand()' assign='rand'}
                {assign var='randid' value="now"|strtotime|cat:$rand}
                {assign var="tag_id" value="az_manufacturer_{$items->id_azmanufacturer}_{$randid}"}
                {assign var="interval" value=($params.auto_play == 1)?$params.interval:0}
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="az_manufacturer">
					 {if $items->params.display_title_module}
						<h3 class="az_titleModule">
							{$items->title_module[$cookie->id_lang]|escape:'html':'UTF-8'}
						</h3>
					{/if}

                    {assign var="class_respl" value="preset01-"|cat:$params.nb_column1|cat:' preset02-'|cat:$params.nb_column2|cat:' preset03-'|cat:$params.nb_column3|cat:' preset04-'|cat:$params.nb_column4}
                    <div class="owl-carousel az_manufacturer-inner">
						{foreach from=$_list item=manufacturer name=manufacturer_lists}
							{assign var="myfile" value="img/m/{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}.jpg"}
							{if file_exists($myfile)}
								{if $params.manu_image_size == 'none'}
									{assign var="src" value="{$img_manu_dir}{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}.jpg"}
								{else}
									{assign var="src" value="{$img_manu_dir}{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}-{$params.manu_image_size}.jpg"}
								{/if}
								<div class="item">
									<div class="item-inner">
										{if $smarty.foreach.manufacturer_lists.iteration <= 20}
												<a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'html':'UTF-8'}" {$manufacturer._target}
												   title="{$manufacturer.name|escape:'html':'UTF-8'}">
													<img src="{$src|escape:'html':'UTF-8'}"
														 class="logo_manufacturer"
														 title="{$manufacturer.name|escape:'html':'UTF-8'}"
														 alt="{$manufacturer.name|escape:'html':'UTF-8'}"/>
												</a>
										{/if}
									</div>
								</div>
							{/if}
						{/foreach}
                    </div>
                </div>
				
				{assign var="nav" value=($items->params.display_control == '1')?'true':'false'}			
				{assign var="autoplay" value=($items->params.auto_play == '1')?'true':'false'}
				
                <script type="text/javascript">
				jQuery('.az_manufacturer-inner').owlCarousel({
					loop: true,
					autoplay: {$autoplay},
					nav: {$nav},
					navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
					slideBy: {$items->params.step},
					autoplayTimeout: {$items->params.interval},
					smartSpeed: {$items->params.speed},
					responsive: {
						0:{
							items:1
						},
						480:{
							items:{$items->params.nb_column4}
						},
						768:{
							items:{$items->params.nb_column3}
						},
						992:{
							items:{$items->params.nb_column2}
						},
						1200:{
							items:{$items->params.nb_column1}
						}
					}				   
				});
			</script>
            {else}
                {l s='Has no content to show!' mod='azmanufacturer'}
            {/if}

        </div>
    {/foreach}
{/if}
<!-- / AZ Manufacturer -->