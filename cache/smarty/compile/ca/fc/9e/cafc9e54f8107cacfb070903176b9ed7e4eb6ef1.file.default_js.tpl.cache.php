<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 07:58:19
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\aztabs\default_js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6523581f28eb84b1e0-57242219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cafc9e54f8107cacfb070903176b9ed7e4eb6ef1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default_js.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6523581f28eb84b1e0-57242219',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'condition' => 0,
    'center' => 0,
    'nav' => 0,
    'loop' => 0,
    'margin' => 0,
    'slideBy' => 0,
    'autoplay' => 0,
    'autoplayHoverPause' => 0,
    'autoplayTimeout' => 0,
    'autoplaySpeed' => 0,
    'navSpeed' => 0,
    'smartSpeed' => 0,
    'startPosition' => 0,
    'mouseDrag' => 0,
    'touchDrag' => 0,
    'pullDrag' => 0,
    'items' => 0,
    'tag_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f28eb990a90_30132946',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f28eb990a90_30132946')) {function content_581f28eb990a90_30132946($_smarty_tpl) {?>

<script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function ($) {
        ;
        (function (element) {
            var $element = $(element),
                    $tab = $(".aztabs-tab", $element),
                    $tab_label = $(".aztabs-tab-label", $tab),
                    $tabs = $(".aztabs-tabs", $element),
                    ajax_url = baseDir + "modules/aztabs/aztabs_ajax.php",
                    effect = $tabs.parents(".aztabs-tabs-container").attr("data-effec"),
                    delay = $tabs.parents(".aztabs-tabs-container").attr("data-delay"),
                    duration = $tabs.parents(".aztabs-tabs-container").attr("data-duration"),
                    rl_moduleid = $tabs.parents(".aztabs-tabs-container").attr("data-modid"),
					hook_name = $tabs.parents(".aztabs-tabs-container").attr("data-hookname"),
                    $items_content = $(".aztabs-items", $element),
                    $items_inner = $(".aztabs-items-inner", $items_content),
                    $items_first_active = $(".aztabs-items-selected", $element),
                    $load_more = $(".aztabs-loadmore", $element),
                    $btn_loadmore = $(".aztabs-loadmore-btn", $load_more),
                    $select_box = $(".aztabs-selectbox", $element),
                    $tab_label_select = $(".aztabs-tab-selected", $element);

            enableSelectBoxes();
            function enableSelectBoxes() {
                $tab_wrap = $(".aztabs-tabs-wrap", $element),
                        $tab_label_select.html($(".aztabs-tab", $element).filter(".tab-sel").children(".aztabs-tab-label").html());
                if ($(window).innerWidth() <= 479) {
                    $tab_wrap.addClass("aztabs-selectbox");
                } else {
                    $tab_wrap.removeClass("aztabs-selectbox");
                }
            }

            $("span.aztabs-tab-selected, span.aztabs-tab-arrow", $element).click(function () {
                if ($(".aztabs-tabs", $element).hasClass("aztabs-open")) {
                    $(".aztabs-tabs", $element).removeClass("aztabs-open");
                } else {
                    $(".aztabs-tabs", $element).addClass("aztabs-open");
                }
            });

            $(window).resize(function () {
                if ($(window).innerWidth() <= 479) {
                    $(".aztabs-tabs-wrap", $element).addClass("aztabs-selectbox");
                } else {
                    $(".aztabs-tabs-wrap", $element).removeClass("aztabs-selectbox");
                }
            });

            function showAnimateItems(el) {
                var $_items = $(".new-aztabs-item", el), nub = 0;
                $(".aztabs-loadmore-btn", el).fadeOut("fast");
                $_items.each(function (i) {
                    nub++;
                    switch (effect) {
                        case "none" :
                        
                            $(this).css({"opacity": "1", "filter": "alpha(opacity = 100)"});
                            break;
                            
                        default:
                            animatesItems($(this), nub * delay, i, el);
                    }
                    if (i == $_items.length - 1) {
                        $(".aztabs-loadmore-btn", el).fadeIn(delay);
                    }
                    $(this).removeClass("new-aztabs-item");
                });
            }

            function animatesItems($this, fdelay, i, el) {
                var $_items = $(".aztabs-item", el);
                $this.attr("style",
                        "-webkit-animation:" + effect + " " + duration + "ms;"
                        + "-moz-animation:" + effect + " " + duration + "ms;"
                        + "-o-animation:" + effect + " " + duration + "ms;"
                        + "-moz-animation-delay:" + fdelay + "ms;"
                        + "-webkit-animation-delay:" + fdelay + "ms;"
                        + "-o-animation-delay:" + fdelay + "ms;"
                        + "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({
                            opacity: 1,
                            filter: "alpha(opacity = 100)"
                        }, {
                            delay: 100
                        });
                if (i == ($_items.length - 1)) {
                    $(".aztabs-items-inner").addClass("play");
                }
            }

            showAnimateItems($items_first_active);
            $tab.on("click.tab", function () {
                var $this = $(this);
                if ($this.hasClass("tab-sel")) return false;
                if ($this.parents(".aztabs-tabs").hasClass("aztabs-open")) {
                    $this.parents(".aztabs-tabs").removeClass("aztabs-open");
                }
                $tab.removeClass("tab-sel");
                $this.addClass("tab-sel");
                var items_active = $this.attr("data-active-content");
                var _items_active = $(items_active, $element);

                $items_content.removeClass("aztabs-items-selected");
                _items_active.addClass("aztabs-items-selected");
                $tab_label_select.html($tab.filter(".tab-sel").children(".aztabs-tab-label").html());
                var $loading = $(".aztabs-loading", _items_active);
                var loaded = _items_active.hasClass("aztabs-items-loaded");
                if (!loaded && !_items_active.hasClass("aztabs-process")) {
                    _items_active.addClass("aztabs-process");
                    var category_id = $this.attr("data-category-id");
                    $loading.show();
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: {
                            tabs_moduleid: rl_moduleid,
                            is_ajax_tabs: 1,
                            ajax_reslisting_start: 0,
                            categoryid: category_id,
							hook_name: hook_name
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(".aztabs-items-inner", _items_active).html(data.items_markup);
                                _items_active.addClass("aztabs-items-loaded").removeClass("aztabs-process");
                                $loading.remove();
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);

                                <?php if ($_smarty_tpl->tpl_vars['condition']->value) {?>
                                CreateProSlider($(".aztabs-items-inner", _items_active));
                                <?php }?>
                            }
                        },
                        dataType: "json"
                    });
                } else {
                    <?php if ($_smarty_tpl->tpl_vars['condition']->value==false) {?>
                    $(".aztabs-item", $items_content).removeAttr("style").addClass("new-aztabs-item").css("opacity", 0);
                    showAnimateItems(_items_active);
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['condition']->value) {?>
                    var owl = $(".aztabs-items-inner", _items_active);
                    owl = owl.data("owlCarousel");
                    if (typeof owl === "undefined") {
                    } else {
                        owl.onResize();
                    }
                    <?php }?>
                }
            });

            function updateStatus($el) {
                $(".aztabs-loadmore-btn", $el).removeClass("loading");
                var countitem = $(".aztabs-item", $el).length;
                
                $(".aztabs-image-loading", $el).css({display: "none"});
                
                $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_start", countitem);
                var rl_total = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_total");
                var rl_load = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_load");
                var rl_allready = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_allready");

                if (countitem >= rl_total) {
                    $(".aztabs-loadmore-btn", $el).addClass("loaded");
                    
                    $(".aztabs-image-loading", $el).css({display: "none"});
                    
                    $(".aztabs-loadmore-btn", $el).attr("data-label", rl_allready);
                    $(".aztabs-loadmore-btn", $el).removeClass("loading");
                }
            }

            $btn_loadmore.on("click.loadmore", function () {
                var $this = $(this);
                if ($this.hasClass("loaded") || $this.hasClass("loading")) {
                    return false;
                } else {
                    $this.addClass("loading");
                    
                    $(".aztabs-image-loading", $this).css({display: "inline-block"});
                    
                    var rl_start = $this.parent().attr("data-rl_start"),
                            rl_moduleid = $this.parent().attr("data-modid"),
							lt_hook_name = $this.parent().attr("data-hookname"),
                            rl_ajaxurl = baseDir + "modules/aztabs/aztabs_ajax.php",
                            effect = $this.parent().attr("data-effect"),
                            category_id = $this.parent().attr("data-categoryid"),
                            items_active = $this.parent().attr("data-active-content");
                    var _items_active = $(items_active, $element);

                    $.ajax({
                        type: "POST",
                        url: rl_ajaxurl,
                        data: {
                            tabs_moduleid: rl_moduleid,
                            is_ajax_tabs: 1,
                            ajax_reslisting_start: rl_start,
                            categoryid: category_id,
							hook_name: lt_hook_name
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(data.items_markup).insertAfter($(".aztabs-item", _items_active).nextAll().last());
                                
                                $(".aztabs-image-loading", $this).css({display: "none"});
                                
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);
                            }
                        }, dataType: "json"
                    });
                }
                return false;
            });

            <?php if ($_smarty_tpl->tpl_vars['condition']->value) {?>

            if ($(".aztabs-items-inner", $element).parent().hasClass("aztabs-items-selected")) {
                var items_active = $(".aztabs-tab.tab-sel", $element).attr("data-active-content");
                var _items_active = $(items_active, $element);
                CreateProSlider($(".aztabs-items-inner", _items_active));
            }

            function CreateProSlider($items_inner) {
                $items_inner.owlCarousel({
                    center: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['center']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    nav: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['nav']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    loop: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['loop']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    margin: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['margin']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    slideBy: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slideBy']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    autoplay: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['autoplay']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    autoplayHoverPause: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['autoplayHoverPause']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    autoplayTimeout: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['autoplayTimeout']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    autoplaySpeed: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['autoplaySpeed']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    navSpeed: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['navSpeed']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    smartSpeed: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['smartSpeed']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    startPosition: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['startPosition']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    mouseDrag: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mouseDrag']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    touchDrag:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['touchDrag']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    pullDrag:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pullDrag']->value, ENT_QUOTES, 'UTF-8', true);?>
,
                    dots: false,
                    autoWidth: false,
                    navClass: ["owl-prev", "owl-next"],
                    navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
                    
                    responsive: {
						0: {items:1 },
                        480: {items:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['nb_column4'], ENT_QUOTES, 'UTF-8', true);?>
 },
                        768: {items:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['nb_column3'], ENT_QUOTES, 'UTF-8', true);?>
},
                        992: {items:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['nb_column2'], ENT_QUOTES, 'UTF-8', true);?>
},
                        1200: {items: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['nb_column1'], ENT_QUOTES, 'UTF-8', true);?>
}
                    }
                });
            }
            <?php }?>

        })("#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag_id']->value, ENT_QUOTES, 'UTF-8', true);?>
");
    });
    //]]>
</script><?php }} ?>
