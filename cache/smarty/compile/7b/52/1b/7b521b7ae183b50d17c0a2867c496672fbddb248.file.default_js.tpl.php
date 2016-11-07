<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:16
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\azsearchblock\default_js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31633581dd024051ac3-02818894%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b521b7ae183b50d17c0a2867c496672fbddb248' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azsearchblock\\default_js.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31633581dd024051ac3-02818894',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajax_s' => 0,
    'link' => 0,
    'cookie' => 0,
    'id_module' => 0,
    'items' => 0,
    'n' => 0,
    'instant_s' => 0,
    'tag_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd0240f9c18_45579604',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd0240f9c18_45579604')) {function content_581dd0240f9c18_45579604($_smarty_tpl) {?>
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
                    if (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_s']->value, ENT_QUOTES, 'UTF-8', true);?>
) {
                        $input.autocomplete(
                                '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('azsearchblock','catesearch'));?>
',
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
                                        
                                        var mytab = [];
                                        for (var i = 0; i < data.length; i++)
                                            mytab[mytab.length] = {data: data[i], value: data[i].cname + ' > ' + data[i].pname};
                                        return mytab;
                                        
                                    },
                                    extraParams: {
                                        ajaxSearch: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_s']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                                        id_lang: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cookie']->value->id_lang, ENT_QUOTES, 'UTF-8', true);?>
,
                                        azsb_module_id: "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_module']->value, ENT_QUOTES, 'UTF-8', true);?>
",
                                        cat_id: $('select[class=azsb_cat]', $element).val(),
                                        orderby: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['products_ordering'], ENT_QUOTES, 'UTF-8', true);?>
',
                                        orderway: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['ordering_direction'], ENT_QUOTES, 'UTF-8', true);?>
',
                                        n: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['n']->value, ENT_QUOTES, 'UTF-8', true);?>
'
                                    }
                                })
                                .result(function (event, data, formatted) {
                                    
                                    $input.val(data.pname);
                                    
                                    document.location.href = data.product_link;
                                });
                    }
            }

            $('.azsb_cat', $element).on('change', function () {
                $(".ac_results").remove();
                var $input = $('.azsb_query', $element);
                if (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_s']->value, ENT_QUOTES, 'UTF-8', true);?>
) {
                    $input.trigger('unautocomplete');
                    $input.autocomplete(
                            '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('azsearchblock','catesearch'));?>
',
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
                                    
                                    var mytab = [];
                                    for (var i = 0; i < data.length; i++)
                                        mytab[mytab.length] = {data: data[i], value: data[i].cname + ' > ' + data[i].pname};
                                    return mytab;
                                    
                                },
                                extraParams: {
                                    ajaxSearch: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_s']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                                    id_lang: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cookie']->value->id_lang, ENT_QUOTES, 'UTF-8', true);?>
,
                                    azsb_module_id: "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_module']->value, ENT_QUOTES, 'UTF-8', true);?>
",
                                    cat_id: $('select[class=azsb_cat]', $element).val(),
                                    orderby: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['products_ordering'], ENT_QUOTES, 'UTF-8', true);?>
',
                                    orderway: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['ordering_direction'], ENT_QUOTES, 'UTF-8', true);?>
',
                                    n: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['n']->value, ENT_QUOTES, 'UTF-8', true);?>
'
                                }
                            })
                            .result(function (event, data, formatted) {
                                
                                $input.val(data.pname);
                                
                                document.location.href = data.product_link;
                            });
                }
            });

            // -------end schreiben function load ajax -------------------- //

            // =====begin instal_search begin 4 characters one more======= //
            if (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instant_s']->value, ENT_QUOTES, 'UTF-8', true);?>
) {
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
                                instantSearch: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instant_s']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                                id_lang: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cookie']->value->id_lang, ENT_QUOTES, 'UTF-8', true);?>
,
                                q: $(this).val(),
                                azsb_module_id: "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_module']->value, ENT_QUOTES, 'UTF-8', true);?>
",
                                cat_id: $('select[class=azsb_cat]', $element).val(),
                                orderby: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['products_ordering'], ENT_QUOTES, 'UTF-8', true);?>
',
                                orderway: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['ordering_direction'], ENT_QUOTES, 'UTF-8', true);?>
',
                                n: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['n']->value, ENT_QUOTES, 'UTF-8', true);?>
'
                            },
                            dataType: 'html',
                            type: 'POST',
                            headers: {"cache-control": "no-cache"},
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
                    $('.azsb_cat option:first-child', $element).html('<?php echo smartyTranslate(array('s'=>'All Categories','mod'=>'azsearchblock'),$_smarty_tpl);?>
');
                }else{
                    $('.azsb_cat option:first-child', $element).html('<?php echo smartyTranslate(array('s'=>'All Categories','mod'=>'azsearchblock'),$_smarty_tpl);?>
');
                }
            });

        })('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag_id']->value, ENT_QUOTES, 'UTF-8', true);?>
');
    });
    //]]>
</script><?php }} ?>
