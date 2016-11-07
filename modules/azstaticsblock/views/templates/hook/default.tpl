{*
 * @package AZ StaticsBlock
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @author AZ Templates http://www.magentech.com
 *}

<!-- AZ Statics Block -->
{if isset($list) && !empty($list)}
    {foreach from=$list item=item}
        {assign var="moduleclass_sfx" value=( isset( $item->params.moduleclass_sfx ) ) ?  $item->params.moduleclass_sfx : ''}
        {math equation='rand()' assign='rand'}
        {assign var='randid' value="now"|strtotime|cat:$rand}
        {assign var="uniqued" value="az_staticsblock_{$item->id_azstaticsblock}_{$randid}"}
        <div class="moduletable  {$uniqued|escape:'html':'UTF-8'}
		{$moduleclass_sfx|escape:'html':'UTF-8'} col-xs-6 spcustom_html"
                style="padding: 0 30px;">
            {if isset($item->params.display_title_module) && $item->params.display_title_module && !empty($item->title_module[$cookie->id_lang])}
                <h3>
                    {$item->title_module[$cookie->id_lang]|escape:'html':'UTF-8'}
                </h3>
            {/if}
             
            {if isset($item->content[$cookie->id_lang]) && !empty($item->content[$cookie->id_lang])}
                <div>
                   {$item->content[$cookie->id_lang]}
                </div>
            {/if}
        </div>
    {/foreach}
{/if}
<!-- /AZ Statics Block -->