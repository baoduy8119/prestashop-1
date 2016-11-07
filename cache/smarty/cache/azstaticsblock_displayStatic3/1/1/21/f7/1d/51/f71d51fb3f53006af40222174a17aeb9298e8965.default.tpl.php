<?php /*%%SmartyHeaderCode:18256581f28e8323f54-95628863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f71d51fb3f53006af40222174a17aeb9298e8965' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azstaticsblock\\default.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18256581f28e8323f54-95628863',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58200ada1c8060_70550869',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58200ada1c8060_70550869')) {function content_58200ada1c8060_70550869($_smarty_tpl) {?>
<!-- AZ Statics Block -->
                    
                        <div class="az_staticsBlock ">
                         
                               <div class="az_promotion">
								<div class="row">
								<div class="col-sm-4">
								<div class="item item1">
								<div class="icon"><span>Icon1</span></div>
								<div class="text">
								<p>Satisfaction</p>
								<p>100% GUARANTEED</p>
								</div>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="item item2">
								<div class="icon"><span>Icon2</span></div>
								<div class="text">
								<p>Free shipping</p>
								<p>ON ORDERS OVER $99</p>
								</div>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="item item3">
								<div class="icon"><span>Icon3</span></div>
								<div class="text">
								<p>14 Day</p>
								<p>EASY RETURN</p>
								<p></p>
								</div>
								</div>
								</div>
								</div>
								</div>
                    </div>
    <!-- /AZ Statics Block -->

<script>// <![CDATA[
jQuery(document).ready(function($) {
		$('.az_ttnm').owlCarousel({
			pagination: false,
			center: false,
			nav: false,
			dots: true,
			loop: true,
			margin: 0,
			navText: [ '<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
	});
// ]]></script>
	<?php }} ?>
