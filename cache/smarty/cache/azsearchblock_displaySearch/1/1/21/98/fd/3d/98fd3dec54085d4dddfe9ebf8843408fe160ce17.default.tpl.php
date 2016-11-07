<?php /*%%SmartyHeaderCode:10586581f28e9447bf2-59076444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98fd3dec54085d4dddfe9ebf8843408fe160ce17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azsearchblock\\default.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
    '7b521b7ae183b50d17c0a2867c496672fbddb248' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azsearchblock\\default_js.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10586581f28e9447bf2-59076444',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58200ad90bd328_70950683',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58200ad90bd328_70950683')) {function content_58200ad90bd328_70950683($_smarty_tpl) {?>
<!--AZ Search Block-->
            
            
                                    <div class="az_searchblock ">
                
                                                                                                                                    				
				                                    				
				
                
				<div class="icon-search">
					<i class="fa fa-search"></i>
				</div>
                
                <div class="az_searchblock-container azsb-preload">
						<form class="azsb_searchform  hidden-box"  method="get" action="http://localhost/prestashop/module/azsearchblock/catesearch">
							<div>
							<input type="hidden" name="fc" value="module"/>
							<input type="hidden" name="module" value="azsearchblock"/>
							<input type="hidden" name="controller" value="catesearch"/>
							<input type="hidden" name="orderby" value="name"/>
							<input type="hidden" name="orderway" value="ASC"/>
							
															
																	<input type="hidden" name="cat_id" value="2,3,4,5,7,8,9,10,11">
																							
																							
																							
																							
																							
																							
																							
																							
																							
																						
							
								
								
									<div class="azsb_selector_cat">
										<select class="azsb_cat">
											
																							
												<option value="2,3,4,5,7,8,9,10,11">
																											 All Categories
																									</option>
																							
												<option value="2">
																											Home
																									</option>
																							
												<option value="3">
																											Women
																									</option>
																							
												<option value="4">
																											Tops
																									</option>
																							
												<option value="5">
																											T-shirts
																									</option>
																							
												<option value="7">
																											Blouses
																									</option>
																							
												<option value="8">
																											Dresses
																									</option>
																							
												<option value="9">
																											Casual Dresses
																									</option>
																							
												<option value="10">
																											Evening Dresses
																									</option>
																							
												<option value="11">
																											Summer Dresses
																									</option>
																					</select>
									</div>
								
								<div class="inputblock">
									<div class="inputtext">
										<input class="azsb_query" type="text" name="search_query"
										   value=""
										   placeholder="Enter your keyword here"/>
									</div>

									<button value="Search" class="azsb_button" type="submit" name="azsb_submitsearch">
										<i class="fa fa-search"></i>
									</button>
									<input value="12" type="hidden" name="n"/>
								</div>
								
							
							
							
							</div>
						</form>
	
                    
                </div>

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
                    if (1) {
                        $input.autocomplete(
                                'http://localhost/prestashop/module/azsearchblock/catesearch',
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
                                        ajaxSearch: 1,
                                        id_lang: 1,
                                        azsb_module_id: "1",
                                        cat_id: $('select[class=azsb_cat]', $element).val(),
                                        orderby: 'name',
                                        orderway: 'ASC',
                                        n: '12'
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
                if (1) {
                    $input.trigger('unautocomplete');
                    $input.autocomplete(
                            'http://localhost/prestashop/module/azsearchblock/catesearch',
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
                                    ajaxSearch: 1,
                                    id_lang: 1,
                                    azsb_module_id: "1",
                                    cat_id: $('select[class=azsb_cat]', $element).val(),
                                    orderby: 'name',
                                    orderway: 'ASC',
                                    n: '12'
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
            if (1) {
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
                                instantSearch: 1,
                                id_lang: 1,
                                q: $(this).val(),
                                azsb_module_id: "1",
                                cat_id: $('select[class=azsb_cat]', $element).val(),
                                orderby: 'name',
                                orderway: 'ASC',
                                n: '12'
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
                    $('.azsb_cat option:first-child', $element).html('All Categories');
                }else{
                    $('.azsb_cat option:first-child', $element).html('All Categories');
                }
            });

        })('#az_searchblock_1');
    });
    //]]>
</script>
            </div>
            
<script type="text/javascript">
// <![CDATA[
	$(document).ready(function($){
		$(".azsb_searchform").addClass('show-form');
		$(".icon-search").click(function(){
			$(this).toggleClass("active").next().slideToggle("medium");
			
		});
	});
// ]]>
</script>

<!--/AZ Search Block--><?php }} ?>
