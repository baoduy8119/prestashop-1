{*
 * @package AZ Tabs
 * @version 1.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author AZ Templates http://www.aztemplates.com
 *}

<!-- AZ Tabs -->
{if isset($list) && !empty($list)}
    {if isset($list) && !empty($list)}
        {foreach from=$list item=items}
            {$_list = $items->products}
            {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
            <div class="az_module {$moduleclass_sfx|escape:'html':'UTF-8'}">
                {if isset($items->title_module[$cookie->id_lang]) && $items->params.display_title_module}
                    <div class="az_titleModule">
                        {$items->title_module[$cookie->id_lang]|escape:'html':'UTF-8'}
                    </div>
                {/if}

                {math equation='rand()' assign='rand'}
                {assign var='randid' value="now"|strtotime|cat:$rand}
                {assign var="tag_id" value="az_tabs_{$items->id_aztabs}_{$randid}"}
                {assign var="class_ltabs" value="ltabs01-"|cat:$items->params.nb_column1|cat:' ltabs02-'|cat:$items->params.nb_column2|cat:' ltabs03-'|cat:$items->params.nb_column3|cat:' ltabs04-'|cat:$items->params.nb_column4}
                {*//effect*}
                {assign var="center" value=($items->params.center == 1)?'true':'false'}
                {assign var="nav" value=($items->params.nav == 1)?'true':'false'}
                {assign var="loop" value=($items->params.loop == 1)?'true':'false'}
                {assign var="margin" value=($items->params.margin >= 0)?$items->params.margin:5}
                {assign var="slideBy" value=($items->params.slideBy >= 0)?$items->params.slideBy:1}
                {assign var="autoplay" value=($items->params.autoplay == 1)?'true':'false'}
                {assign var="autoplayTimeout" value=($items->params.autoplayTimeout > 0)?$items->params.autoplayTimeout:2000}
                {assign var="autoplayHoverPause" value=($items->params.autoplayHoverPause == 1)?'true':'false'}
                {assign var="autoplaySpeed" value=($items->params.autoplaySpeed >0)?$items->params.autoplaySpeed:2000}
                {assign var="navSpeed" value=($items->params.navSpeed >0)?$items->params.navSpeed:2000}
                {assign var="smartSpeed" value=($items->params.smartSpeed > 0)?$items->params.smartSpeed:2000}
                {assign var="startPosition" value=($items->params.startPosition >= 0)?$items->params.startPosition:0}
                {assign var="mouseDrag" value=($items->params.mouseDrag == 1)?'true':'false'}
                {assign var="touchDrag" value=($items->params.touchDrag == 1)?'true':'false'}
                {assign var="pullDrag" value=($items->params.pullDrag == 1)?'true':'false'}
                {assign var="condition" value=($items->params.show_loadmore_slider == 'slider')?true:false}
                {assign var="effect_show" value=($condition == true)?'':$items->params.effect}
                {assign var="class_condition" value=($condition == true)?'show-slider':'show-loadmore'}
                {assign var="language_site" value=($items->language_site == 'true')?'true':'false'}
                {*//effect*}
                
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="az_tabs first-load">
                    <div class="aztabs-wrap">
                        <!--Begin Tabs-->
                        <div class="aztabs-tabs-container"
                             data-delay="{$items->params.interval|escape:'html':'UTF-8'}"
                             data-duration="{$items->params.duration|escape:'html':'UTF-8'}"
                             data-effect="{$items->params.effect|escape:'html':'UTF-8'}"
                             data-ajaxurl="{$base_dir|escape:'html':'UTF-8'}"
                             data-modid="{$items->id_aztabs|escape:'html':'UTF-8'}"
							 data-hookname="{$hook_name}">
                            {include file="./default_tabs.tpl"}
                        </div>
                        <!-- End Tabs-->

                        <!--Begin aztabs-items-container-->
                        <div class="aztabs-items-container product_list grid row {$class_condition|escape:'html':'UTF-8'}">
                            {foreach $_list as $item}
                                {assign var="child_items" value=(isset($item['child']))?$item['child']:''}
                                {assign var="cls_animate" value=$items->params.effect}
                                {assign var="cls" value=(isset($item['sel']) && $item['sel'] == 'sel')?' aztabs-items-selected aztabs-items-loaded':''}
                                {assign var="cls2" value=($item['id_category'] == "*")?' items-category-all':' items-category-'|cat:$item['id_category']}
                                <div class="aztabs-items {$cls|escape:'html':'UTF-8'} {$cls2|escape:'html':'UTF-8'}">
                                    <div class="aztabs-items-inner {$class_ltabs|escape:'html':'UTF-8'} {$cls_animate|escape:'html':'UTF-8'}">
                                        {if !empty($child_items)}
                                            {include file="./default_items.tpl"}
                                        {else}
                                            <div class="aztabs-loading"></div>
                                        {/if}
                                    </div>

                                    {if $items->params.show_loadmore_slider == 'loadmore'}
                                    {assign var="classloaded" value=($items->params.count_number >= $item['count'] || $items->params.count_number == 0)?'loaded':'' }
                                    {assign var="classloaded_2" value=($classloaded)?'All Ready':'Show All'}
                                    {assign var="id_caterogy" value=($item['id_category'] == '*')?'all':$item['id_category']}
                                    <div class="load-clear"></div>
                                    <div class="aztabs-loadmore"
                                         data-active-content=".items-category-{$id_caterogy|escape:'html':'UTF-8'}"
                                         data-categoryid="{$item['id_category']|escape:'html':'UTF-8'}"
                                         data-rl_start="{$items->params.count_number|escape:'html':'UTF-8'}"
                                         data-rl_total="{$item['count']|escape:'html':'UTF-8'}"
                                         data-rl_allready="All Ready"
                                         data-ajaxurl="{$base_dir|escape:'html':'UTF-8'}"
                                         data-modid="{$items->id_aztabs|escape:'html':'UTF-8'}"
                                         data-rl_load="{$items->params.count_number|escape:'html':'UTF-8'}"
										 data-hookname="{$hook_name}">
                                        <div class="aztabs-loadmore-btn {$classloaded|escape:'html':'UTF-8'}"
                                             data-label="{$classloaded_2|escape:'html':'UTF-8'}">
                                            <span class="aztabs-image-loading"></span>
                                        </div>
                                    </div>
                                    {/if}
                                </div>
                            {/foreach}
                        </div>
                    </div>
                    <!--End aztabs-wrap-->
                </div>

                {include file="./default_js.tpl"}

            </div>
        {/foreach}
    {else}
        {l s='Has no content to show! In Module aztabs' mod='aztabs'}
    {/if}
{/if}
<!-- End AZ Tabs -->




