{*
 * @package AZ Templates
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 20146 AZ Templates. All Rights Reserved.
 * @author AZ Templates http://www.aztemplates.com
 *}

{strip}
    {addJsDefL name=min_item|escape:'html':'UTF-8'}{l s='Please select at least one product' js=1 mod='azstaticsblock'}{/addJsDefL}
    {addJsDefL name=max_item|escape:'html':'UTF-8'}{l s='You cannot add more than %d product(s) to the product comparison' sprintf=$comparator_max_item js=1 mod='azstaticsblock'}{/addJsDefL}
    {addJsDef comparator_max_item=$comparator_max_item}
    {addJsDef comparedProductsIds=$compared_products}
{/strip}

<script type="text/javascript">
    //<![CDATA[
    var listdeal = [];
    //]]>
</script>