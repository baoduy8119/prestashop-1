<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:16
         compiled from "C:\xampp\htdocs\prestashop\modules\azhomeslider\views\templates\hook\azhomeslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31478581dd0242761e0-20281112%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '31478581dd0242761e0-20281112',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'azhomeslider_slides' => 0,
    'id_azhomeslider_groups' => 0,
    'params' => 0,
    'title_slider' => 0,
    'rand' => 0,
    'randid' => 0,
    'slide' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd0244020f4_71020895',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd0244020f4_71020895')) {function content_581dd0244020f4_71020895($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.math.php';
?>
<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
<!-- AZ HomeSlider -->
    <?php if (isset($_smarty_tpl->tpl_vars['azhomeslider_slides']->value)) {?>
		<div id="az_homeslider<?php echo $_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value;?>
" class="az_homeslider <?php if (isset($_smarty_tpl->tpl_vars['params']->value['moduleclass_sfx'])&&$_smarty_tpl->tpl_vars['params']->value['moduleclass_sfx']) {?><?php echo $_smarty_tpl->tpl_vars['params']->value['moduleclass_sfx'];?>
<?php }?>">
		<?php if (isset($_smarty_tpl->tpl_vars['params']->value['display_title_module'])&&$_smarty_tpl->tpl_vars['params']->value['display_title_module']) {?>
			<h3 class="az_titleModule"><?php echo $_smarty_tpl->tpl_vars['title_slider']->value;?>
</h4>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['azhomeslider_slides']->value[0])&&isset($_smarty_tpl->tpl_vars['azhomeslider_slides']->value[0]['sizes'][1])) {?><?php $_smarty_tpl->_capture_stack[0][] = array('height', null, null); ob_start(); ?><?php echo $_smarty_tpl->tpl_vars['azhomeslider_slides']->value[0]['sizes'][1];?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php }?>
			 <div class="az_homeslider-inner az_homeslider-inner-<?php echo $_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value;?>
">
				<?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['azhomeslider_slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
?>
				<?php echo smarty_function_math(array('equation'=>'rand()','assign'=>'rand'),$_smarty_tpl);?>

				<?php $_smarty_tpl->tpl_vars['randid'] = new Smarty_variable((strtotime("now")).($_smarty_tpl->tpl_vars['rand']->value), null, 0);?>
				<?php $_smarty_tpl->tpl_vars["tag_id"] = new Smarty_variable("sp_extra_slider_".((string)$_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value)."_".((string)$_smarty_tpl->tpl_vars['randid']->value), null, 0);?>				
					<?php if ($_smarty_tpl->tpl_vars['slide']->value['active']) {?>
					<div class="item ">
						<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
">
							<img class="responsive" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)@constant('_MODULE_DIR_'))."azhomeslider/images/".((string)mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')));?>
"  alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
						</a>
						<?php if (isset($_smarty_tpl->tpl_vars['slide']->value['description'])&&trim($_smarty_tpl->tpl_vars['slide']->value['description'])!='') {?>
							<div class="azhomeslider-description"><?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>
</div>
						<?php }?>
					</div>	
					<?php }?>
				<?php } ?>
			</div>
		</div>
		<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value) {?>
		<script type="text/javascript">
				$(".az_homeslider-inner-<?php echo $_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value;?>
").owlCarousel({
						animateOut: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value['animateOut'], ENT_QUOTES, 'UTF-8', true);?>
',
						animateIn: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value['animateIn'], ENT_QUOTES, 'UTF-8', true);?>
',
						autoplay: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['autoplay'])&&$_smarty_tpl->tpl_vars['params']->value['autoplay']==1 ? 'true' : 'false';?>
,
						autoplayTimeout: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value['autoplay_timeout'], ENT_QUOTES, 'UTF-8', true);?>
,
						autoplaySpeed: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value['autoplaySpeed'], ENT_QUOTES, 'UTF-8', true);?>
,
						smartSpeed: 500,
						autoplayHoverPause: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['autoplayHoverPause'])&&$_smarty_tpl->tpl_vars['params']->value['autoplayHoverPause']==1 ? 'true' : 'false';?>
,
						startPosition: 0,
						mouseDrag: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['mouseDrag'])&&$_smarty_tpl->tpl_vars['params']->value['mouseDrag']==1 ? 'true' : 'false';?>
,
						touchDrag: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['touchDrag'])&&$_smarty_tpl->tpl_vars['params']->value['touchDrag']==1 ? 'true' : 'false';?>
,
						pullDrag: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['pullDrag'])&&$_smarty_tpl->tpl_vars['params']->value['pullDrag']==1 ? 'true' : 'false';?>
,
						dots: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value['dots'], ENT_QUOTES, 'UTF-8', true);?>
,
						autoWidth: false,
						dotClass: "owl-dot",
						dotsClass: "owl-dots",
						nav: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['nav'])&&$_smarty_tpl->tpl_vars['params']->value['nav']==1 ? 'true' : 'false';?>
,
						loop: <?php echo isset($_smarty_tpl->tpl_vars['params']->value['loop'])&&$_smarty_tpl->tpl_vars['params']->value['loop']==1 ? 'true' : 'false';?>
,
						navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
						navClass: ["owl-prev", "owl-next"],
						responsive:{
							0:{
							  items:1 // In this configuration 1 is enabled from 0px up to 479px screen size 
							},
						}
				});
		</script>
		<?php }?>		
	<?php }?>
<!-- /AZ HomeSlider -->
<?php }?><?php }} ?>
