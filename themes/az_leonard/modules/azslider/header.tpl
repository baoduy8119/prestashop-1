{*
 * @package AZ Templates
 * @version 1.0.0
 * @copyright (c) 2016 AZ Templates. (http://www.aztemplates.com)
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *}
 
{strip}
    {addJsDefL name=min_item}{l s='Please select at least one product' js=1}{/addJsDefL}
    {addJsDefL name=max_item}{l s='You cannot add more than %d product(s) to the product comparison' sprintf=$comparator_max_item js=1}{/addJsDefL}
    {addJsDef comparator_max_item=$comparator_max_item}
    {addJsDef comparedProductsIds=$compared_products}
{/strip}

<script type="text/javascript">
//<![CDATA[
	var listdeal = [];
//]]>
</script>