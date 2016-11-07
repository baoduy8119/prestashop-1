{*
 * @package AZ Tabs
 * @version 1.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author AZ Templates http://www.aztemplates.com
 *}

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
                        {literal}
                            $(this).css({"opacity": "1", "filter": "alpha(opacity = 100)"});
                            break;
                            {/literal}
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

                                {if $condition}
                                CreateProSlider($(".aztabs-items-inner", _items_active));
                                {/if}
                            }
                        },
                        dataType: "json"
                    });
                } else {
                    {if $condition == false}
                    $(".aztabs-item", $items_content).removeAttr("style").addClass("new-aztabs-item").css("opacity", 0);
                    showAnimateItems(_items_active);
                    {/if}

                    {if $condition}
                    var owl = $(".aztabs-items-inner", _items_active);
                    owl = owl.data("owlCarousel");
                    if (typeof owl === "undefined") {
                    } else {
                        owl.onResize();
                    }
                    {/if}
                }
            });

            function updateStatus($el) {
                $(".aztabs-loadmore-btn", $el).removeClass("loading");
                var countitem = $(".aztabs-item", $el).length;
                {literal}
                $(".aztabs-image-loading", $el).css({display: "none"});
                {/literal}
                $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_start", countitem);
                var rl_total = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_total");
                var rl_load = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_load");
                var rl_allready = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_allready");

                if (countitem >= rl_total) {
                    $(".aztabs-loadmore-btn", $el).addClass("loaded");
                    {literal}
                    $(".aztabs-image-loading", $el).css({display: "none"});
                    {/literal}
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
                    {literal}
                    $(".aztabs-image-loading", $this).css({display: "inline-block"});
                    {/literal}
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
                                {literal}
                                $(".aztabs-image-loading", $this).css({display: "none"});
                                {/literal}
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);
                            }
                        }, dataType: "json"
                    });
                }
                return false;
            });

            {if $condition}

            if ($(".aztabs-items-inner", $element).parent().hasClass("aztabs-items-selected")) {
                var items_active = $(".aztabs-tab.tab-sel", $element).attr("data-active-content");
                var _items_active = $(items_active, $element);
                CreateProSlider($(".aztabs-items-inner", _items_active));
            }

            function CreateProSlider($items_inner) {
                $items_inner.owlCarousel({
                    center: {$center|escape:'html':'UTF-8'},
                    nav: {$nav|escape:'html':'UTF-8'},
                    loop: {$loop|escape:'html':'UTF-8'},
                    margin: {$margin|escape:'html':'UTF-8'},
                    slideBy: {$slideBy|escape:'html':'UTF-8'},
                    autoplay: {$autoplay|escape:'html':'UTF-8'},
                    autoplayHoverPause: {$autoplayHoverPause|escape:'html':'UTF-8'},
                    autoplayTimeout: {$autoplayTimeout|escape:'html':'UTF-8'},
                    autoplaySpeed: {$autoplaySpeed|escape:'html':'UTF-8'},
                    navSpeed: {$navSpeed|escape:'html':'UTF-8'},
                    smartSpeed: {$smartSpeed|escape:'html':'UTF-8'},
                    startPosition: {$startPosition|escape:'html':'UTF-8'},
                    mouseDrag: {$mouseDrag|escape:'html':'UTF-8'},
                    touchDrag:{$touchDrag|escape:'html':'UTF-8'},
                    pullDrag:{$pullDrag|escape:'html':'UTF-8'},
                    dots: false,
                    autoWidth: false,
                    navClass: ["owl-prev", "owl-next"],
                    navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
                    {*rtl: {$language_site},*}
                    responsive: {
						0: {literal}{{/literal}items:1 {literal}}{/literal},
                        480: {literal}{{/literal}items:{$items->params.nb_column4|escape:'html':'UTF-8'} {literal}}{/literal},
                        768: {literal}{{/literal}items:{$items->params.nb_column3|escape:'html':'UTF-8'}{literal}}{/literal},
                        992: {literal}{{/literal}items:{$items->params.nb_column2|escape:'html':'UTF-8'}{literal}}{/literal},
                        1200: {literal}{{/literal}items: {$items->params.nb_column1|escape:'html':'UTF-8'}{literal}}{/literal}
                    }
                });
            }
            {/if}

        })("#{$tag_id|escape:'html':'UTF-8'}");
    });
    //]]>
</script>