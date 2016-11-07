<?php /*%%SmartyHeaderCode:12392581f28e9f240c4-18585751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bc3a5239a6110ed551f25e1e9815fed5af2ea89' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\modules\\azhomeslider\\views\\templates\\hook\\azhomeslider.tpl',
      1 => 1478348059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12392581f28e9f240c4-18585751',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58200ad9738714_11372142',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58200ad9738714_11372142')) {function content_58200ad9738714_11372142($_smarty_tpl) {?><!-- AZ HomeSlider -->
    		<div id="az_homeslider1" class="az_homeslider ">
							 <div class="az_homeslider-inner az_homeslider-inner-1">
								
												
										<div class="item ">
						<a href="#" title="#">
							<img class="responsive" src="http://localhost/prestashop/modules/azhomeslider/images/sample-1.jpg"  alt="#" />
						</a>
													<div class="azhomeslider-description"><div class="container">
										<div class="desc-inner desc1">
										<h2 class="titleFont">Fashion</h2>
										<h3>Women</h3>
										<p>SALE UP TO 50% ALL PRODUCTS</p>
										<a href="#" class="learnmore">Learn More</a></div>
										</div></div>
											</div>	
													
												
										<div class="item ">
						<a href="#" title="#">
							<img class="responsive" src="http://localhost/prestashop/modules/azhomeslider/images/sample-2.jpg"  alt="#" />
						</a>
													<div class="azhomeslider-description"><div class="container">
											<div class="desc-inner desc2">
											<h2 class="titleFont">Fashion</h2>
											<h3>Women</h3>
											<p>SALE UP TO 50% ALL PRODUCTS</p>
											<a href="#" class="learnmore">Learn More</a></div>
											</div></div>
											</div>	
													
												
										<div class="item ">
						<a href="#" title="#">
							<img class="responsive" src="http://localhost/prestashop/modules/azhomeslider/images/sample-3.jpg"  alt="#" />
						</a>
													<div class="azhomeslider-description"><div class="container">
											<div class="desc-inner desc3">
											<h2 class="titleFont">Fashion</h2>
											<h3>Women</h3>
											<p>SALE UP TO 50% ALL PRODUCTS</p>
											<a href="#" class="learnmore">Learn More</a></div>
											</div></div>
											</div>	
												</div>
		</div>
				<script type="text/javascript">
				$(".az_homeslider-inner-1").owlCarousel({
						animateOut: 'fadeOut',
						animateIn: 'fadeIn',
						autoplay: false,
						autoplayTimeout: 2000,
						autoplaySpeed: 2000,
						smartSpeed: 500,
						autoplayHoverPause: true,
						startPosition: 0,
						mouseDrag: true,
						touchDrag: true,
						pullDrag: true,
						dots: 1,
						autoWidth: false,
						dotClass: "owl-dot",
						dotsClass: "owl-dots",
						nav: true,
						loop: true,
						navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
						navClass: ["owl-prev", "owl-next"],
						responsive:{
							0:{
							  items:1 // In this configuration 1 is enabled from 0px up to 479px screen size 
							},
						}
				});
		</script>
				
	<!-- /AZ HomeSlider -->
<?php }} ?>
