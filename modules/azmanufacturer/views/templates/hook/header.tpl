{*
 * package   AZ Manufacturer
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.magentech.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}


{strip}
    {addJsDefL name=min_item|escape:'html':'UTF-8'}{l s='Please select at least one product' js=1 mod='azmanufacturer'}{/addJsDefL}
    {addJsDefL name=max_item|escape:'html':'UTF-8'}{l s='You cannot add more than %d product(s) to the product comparison' mod='azmanufacturer' sprintf=$comparator_max_item js=1}{/addJsDefL}
    {addJsDef comparator_max_item=$comparator_max_item}
    {addJsDef comparedProductsIds=$compared_products}
{/strip}