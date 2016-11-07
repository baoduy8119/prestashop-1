{*
 * @package AZ Templates
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 20146 AZ Templates. All Rights Reserved.
 * @author AZ Templates http://www.aztemplates.com
 *}

<!-- AZ Statics Block -->
{if isset($list) && !empty($list)}
    {foreach from=$list item=item}
        {assign var="moduleclass_sfx" value=( isset( $item->params.moduleclass_sfx ) ) ?  $item->params.moduleclass_sfx : ''}
        {math equation='rand()' assign='rand'}
        {assign var='randid' value="now"|strtotime|cat:$rand}
        {assign var="uniqued" value="az_staticsblock_{$item->id_azstaticsblock}_{$randid}"}
        <div class="az_staticsBlock {$moduleclass_sfx|escape:'html':'UTF-8'}">
            {if isset($item->params.display_title_module) && $item->params.display_title_module && !empty($item->title_module[$cookie->id_lang])}
                <h3 class="az_titleModule">
                    {$item->title_module[$cookie->id_lang]|escape:'html':'UTF-8'}
                </h3>
            {/if}
             
            {if isset($item->content[$cookie->id_lang]) && !empty($item->content[$cookie->id_lang])}
                   {$item->content[$cookie->id_lang]}
            {/if}
        </div>
    {/foreach}
{/if}
<!-- /AZ Statics Block -->

{if $item->id_azstaticsblock == 4}
<script>// <![CDATA[
jQuery(document).ready(function($) {
		$('.az_ttnm').owlCarousel({
			pagination: false,
			center: false,
			nav: false,
			dots: true,
			loop: true,
			margin: 0,
			navText: [ '<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
	});
// ]]></script>
	{/if}