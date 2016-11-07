<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:15
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\azmegamenu\views\templates\hook\azmegamenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15387581dd023cca515-35766781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da8fc1dcbb6fd2bb64623d007a8d597e3f5807d3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azmegamenu\\views\\templates\\hook\\azmegamenu.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15387581dd023cca515-35766781',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'azmegamenu' => 0,
    'azmegamenu_style' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd023cdda48_44357800',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd023cdda48_44357800')) {function content_581dd023cdda48_44357800($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['azmegamenu']->value!='') {?>
	<div class="az_megamenu">
		<nav class="navbar" role="navigation">
			<div class="navbar-button">
				<button type="button" id="show-megamenu" data-toggle="collapse" data-target="#az_megamenu_wrap" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="az_megamenu_wrap" class="<?php echo $_smarty_tpl->tpl_vars['azmegamenu_style']->value;?>
 az_megamenu_wrap clearfix">
				<span id="remove-megamenu" class="fa fa-remove"></span>
				<span class="label-menu"><?php echo smartyTranslate(array('s'=>'Menu','mod'=>'azmegamenu'),$_smarty_tpl);?>
</span>
				<div class="az_megamenu_inner">
					<div class="home">
						<a href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
"><?php echo smartyTranslate(array('s'=>'Home','mod'=>'azmegamenu'),$_smarty_tpl);?>
</a>
						
					</div>
					<?php echo $_smarty_tpl->tpl_vars['azmegamenu']->value;?>

				</div>
				
			</div>
		</nav>	
	</div>	
<?php }?>
<script type="text/javascript">

	$(document).ready(function() {
		
		$("#az_megamenu_wrap  li.parent  .grower").click(function(){
			if($(this).hasClass('close'))
				$(this).addClass('open').removeClass('close');
			else
				$(this).addClass('close').removeClass('open');
				
			$('.dropdown-menu',$(this).parent()).first().toggle(300);
		});
		
		$("#az_megamenu_wrap  .home  .grower").click(function(){
			if($(this).hasClass('close'))
				$(this).addClass('open').removeClass('close');
			else
				$(this).addClass('close').removeClass('open');
				
			$('.dropdown-menu',$(this).parent()).first().toggle(300);
		});
		
		var wd_width = $(window).width();
		var wd_height = $(window).height();
		if(wd_width > 992)
			offtogglemegamenu();
			
		$(window).resize(function() {
			var sp_width = $( window ).width();
			if(sp_width > 992)
				offtogglemegamenu();
		});
		
	});

	$('#show-megamenu').click(function() {
		if($('.az_megamenu_wrap').hasClass('active-menu'))
			$('.az_megamenu_wrap').removeClass('active-menu');
		else
			$('.az_megamenu_wrap').addClass('active-menu');
        return false;
    });
	$('#remove-megamenu').click(function() {
        $('.az_megamenu_wrap').removeClass('active-menu');
        return false;
    });
	
	
	function offtogglemegamenu()
	{
		$('#az_megamenu_wrap li.parent .dropdown-menu').css('display','');	
		$('#az_megamenu_wrap').removeClass('active-menu');
		$("#az_megamenu_wrap  li.parent  .grower").removeClass('open').addClass('close');
		
		$('#az_megamenu_wrap .home .dropdown-menu').css('display','');	
		$('#az_megamenu_wrap').removeClass('active-menu');
		$("#az_megamenu_wrap .home  .grower").removeClass('open').addClass('close');	
	}
	
	
</script><?php }} ?>
