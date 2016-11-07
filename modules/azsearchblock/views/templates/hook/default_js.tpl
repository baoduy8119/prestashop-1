{*
 * package   AZ Search Block
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.aztemplates.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}
<script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function ($) {
        ;
        (function (element) {
            var $element = $(element);

            var _timer = 0;
            $(window).on('load', function () {
                setTimeout(function () {
                    $element.removeClass('azsb-preload');
                }, 1000);
            });

            $('.azsb_selector_cat .azsb_cat', $element).on('click',function(){
                var value_select = $('select[class=azsb_cat]', $element).val();
                $('input[name="cat_id"]').attr('value', value_select);
            });

            // ------------begin schreiben function load ajax ------------- //
            var $input = $('.azsb_query', $element);

            loadajax_ein();
            function loadajax_ein() {
                    if ({$ajax_s|escape:'html':'UTF-8'}) {
                        $input.autocomplete(
                                '{$link->getModuleLink('azsearchblock','catesearch')|addslashes}',
                                {
                                    minChars: 3,
                                    max: 10,
                                    width: 500,
                                    selectFirst: false,
                                    scroll: false,
                                    dataType: "json",
                                    formatItem: function (data, i, max, value, term) {
                                        return value;
                                    },
                                    parse: function (data) {
                                        {literal}
                                        var mytab = [];
                                        for (var i = 0; i < data.length; i++)
                                            mytab[mytab.length] = {data: data[i], value: data[i].cname + ' > ' + data[i].pname};
                                        return mytab;
                                        {/literal}
                                    },
                                    extraParams: {
                                        ajaxSearch: {$ajax_s|escape:'html':'UTF-8'},
                                        id_lang: {$cookie->id_lang|escape:'html':'UTF-8'},
                                        azsb_module_id: "{$id_module|escape:'html':'UTF-8'}",
                                        cat_id: $('select[class=azsb_cat]', $element).val(),
                                        orderby: '{$items->params.products_ordering|escape:'html':'UTF-8'}',
                                        orderway: '{$items->params.ordering_direction|escape:'html':'UTF-8'}',
                                        n: '{$n|escape:'html':'UTF-8'}'
                                    }
                                })
                                .result(function (event, data, formatted) {
                                    {literal}
                                    $input.val(data.pname);
                                    {/literal}
                                    document.location.href = data.product_link;
                                });
                    }
            }

            $('.azsb_cat', $element).on('change', function () {
                $(".ac_results").remove();
                var $input = $('.azsb_query', $element);
                if ({$ajax_s|escape:'html':'UTF-8'}) {
                    $input.trigger('unautocomplete');
                    $input.autocomplete(
                            '{$link->getModuleLink('azsearchblock','catesearch')|addslashes}',
                            {
                                minChars: 3,
                                max: 10,
                                width: 500,
                                selectFirst: false,
                                scroll: false,
                                dataType: "json",
                                formatItem: function (data, i, max, value, term) {
                                    return value;
                                },
                                parse: function (data) {
                                    {literal}
                                    var mytab = [];
                                    for (var i = 0; i < data.length; i++)
                                        mytab[mytab.length] = {data: data[i], value: data[i].cname + ' > ' + data[i].pname};
                                    return mytab;
                                    {/literal}
                                },
                                extraParams: {
                                    ajaxSearch: {$ajax_s|escape:'html':'UTF-8'},
                                    id_lang: {$cookie->id_lang|escape:'html':'UTF-8'},
                                    azsb_module_id: "{$id_module|escape:'html':'UTF-8'}",
                                    cat_id: $('select[class=azsb_cat]', $element).val(),
                                    orderby: '{$items->params.products_ordering|escape:'html':'UTF-8'}',
                                    orderway: '{$items->params.ordering_direction|escape:'html':'UTF-8'}',
                                    n: '{$n|escape:'html':'UTF-8'}'
                                }
                            })
                            .result(function (event, data, formatted) {
                                {literal}
                                $input.val(data.pname);
                                {/literal}
                                document.location.href = data.product_link;
                            });
                }
            });

            // -------end schreiben function load ajax -------------------- //

            // =====begin instal_search begin 4 characters one more======= //
            if ({$instant_s|escape:'html':'UTF-8'}) {
                function tryToCloseInstantSearch() {
                    var $oldCenterColumn = $('#old_center_column');
                    if ($oldCenterColumn.length > 0) {
                        $('#center_column').remove();
                        $oldCenterColumn.attr('id', 'center_column').show();
                        return false;
                    }
                }

                instantSearchQueries = [];
                function stopInstantSearchQueries() {
                    for (var i = 0; i < instantSearchQueries.length; i++) {
                        instantSearchQueries[i].abort();
                    }
                    instantSearchQueries = [];
                }

                $input.on('keyup', function () {
                    if ($(this).val().length > 3) {
                        stopInstantSearchQueries();
                        instantSearchQuery = $.ajax({
                            url: baseDir + 'modules/azsearchblock/azsearchblock_ajax.php',
                            data: {
                                instantSearch: {$instant_s|escape:'html':'UTF-8'},
                                id_lang: {$cookie->id_lang|escape:'html':'UTF-8'},
                                q: $(this).val(),
                                azsb_module_id: "{$id_module|escape:'html':'UTF-8'}",
                                cat_id: $('select[class=azsb_cat]', $element).val(),
                                orderby: '{$items->params.products_ordering|escape:'html':'UTF-8'}',
                                orderway: '{$items->params.ordering_direction|escape:'html':'UTF-8'}',
                                n: '{$n|escape:'html':'UTF-8'}'
                            },
                            dataType: 'html',
                            type: 'POST',
                            headers: {literal}{"cache-control": "no-cache"}{/literal},
                            async: true,
                            cache: false,
                            success: function (data) {
                                if ($input.val().length > 0) {
                                    tryToCloseInstantSearch();
                                    $('#center_column').attr('id', 'old_center_column');
                                    $('#old_center_column').after('<div id="center_column" class="' + $('#old_center_column').attr('class') + '">' + data + '</div>').hide();
                                    $('.sortPagiBar.instant_search').css('display', 'none');
                                    // Button override
                                    ajaxCart.overrideButtonsInThePage();
                                    $("#instant_search_results a.close").on('click', function () {
                                        $input.val('');
                                        return tryToCloseInstantSearch();
                                    });
                                    return false;
                                }
                                else
                                    tryToCloseInstantSearch();
                            }
                        });
                        instantSearchQueries.push(instantSearchQuery);
                    }
                    else
                        tryToCloseInstantSearch();
                });
            }
            // =====end instal_search begin 4 characters one more ======== //

            $(window).on('resize', function(){
                if($(window).width() < 480){
                    $('.azsb_cat option:first-child', $element).html('{l s='All Categories' mod='azsearchblock'}');
                }else{
                    $('.azsb_cat option:first-child', $element).html('{l s='All Categories' mod='azsearchblock'}');
                }
            });

        })('#{$tag_id|escape:'html':'UTF-8'}');
    });
    //]]>
</script>