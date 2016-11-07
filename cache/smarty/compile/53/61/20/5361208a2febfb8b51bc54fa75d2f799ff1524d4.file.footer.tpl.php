<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:22:04
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10874581dceec2c9510-59381374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5361208a2febfb8b51bc54fa75d2f799ff1524d4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\footer.tpl',
      1 => 1478348053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10874581dceec2c9510-59381374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'AZ_contentOption' => 0,
    'HOOK_FOOTER' => 0,
    'copyRight_txt' => 0,
    'rightbar_i' => 0,
    'AZ_liveEditor' => 0,
    'AZ_animationScroll' => 0,
    'js_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dceec331270_59286725',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dceec331270_59286725')) {function content_581dceec331270_59286725($_smarty_tpl) {?>
<?php if (!isset($_smarty_tpl->tpl_vars['content_only']->value)||!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					</div><!-- .row -->
				</div><!-- #columns -->
				
				
				
					
					<?php if (isset($_smarty_tpl->tpl_vars['AZ_contentOption']->value)) {?>
						<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./".((string)$_smarty_tpl->tpl_vars['AZ_contentOption']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./content-v1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<?php }?>
					
				
				
				
				
			</div><!-- .columns-container -->
			<?php if (isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value)) {?>
				<!-- Footer -->
				<div class="footer-container">
					<div class="container">
						<footer class="footer">
							<div class="row">
								<?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

							</div>
							
						</footer>
					</div>
					
					
					<div id="footerBottom">
						<div class="container">
							
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayFooterPayment"),$_smarty_tpl);?>
	
							
							<?php if (isset($_smarty_tpl->tpl_vars['copyRight_txt']->value)) {?><div class="copyright"><?php echo $_smarty_tpl->tpl_vars['copyRight_txt']->value;?>
</div><?php }?>
							<div class="powered">Powered by AZ Templates</div>
								
						</div>
						
					</div>
					
				</div><!-- #footer -->
			<?php }?>
		</div><!-- #page -->
		
		<?php $_smarty_tpl->_capture_stack[0][] = array("rightbar_spbarcart", null, null); ob_start(); ?> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayAnywhere','mod'=>'spbarcart','caller'=>'spbarcart'),$_smarty_tpl);?>
  <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
		<?php $_smarty_tpl->_capture_stack[0][] = array("rightbar_spcompare", null, null); ob_start(); ?> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayAnywhere','mod'=>'spcompare','caller'=>'spcompare'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
		
		<?php $_smarty_tpl->tpl_vars["rightbar_i"] = new Smarty_variable(0, null, 0);?>
		<?php if (trim(Smarty::$_smarty_vars['capture']['rightbar_spbarcart'])) {?><?php $_smarty_tpl->tpl_vars["rightbar_i"] = new Smarty_variable($_smarty_tpl->tpl_vars['rightbar_i']->value+1, null, 0);?><?php }?>
		<?php if (trim(Smarty::$_smarty_vars['capture']['rightbar_spcompare'])) {?><?php $_smarty_tpl->tpl_vars["rightbar_i"] = new Smarty_variable($_smarty_tpl->tpl_vars['rightbar_i']->value+1, null, 0);?><?php }?>
		
		<!--BackToTop-->
		<a id="az_backtotop" class="backtotop" href="#" title="<?php echo smartyTranslate(array('s'=>'Back to top'),$_smarty_tpl);?>
"><i class="fa fa-arrow-up"></i></a>
		
<?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['content_only']->value) {?>
		<?php if ($_smarty_tpl->tpl_vars['AZ_liveEditor']->value) {?>
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./az_liveeditor.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php }?>
	<?php }?>
	
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	
	</body>
	<?php if ($_smarty_tpl->tpl_vars['AZ_animationScroll']->value) {?>
		<script src="<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
az_lib/jquery.anijs-min.js" type="text/javascript"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
az_lib/jquery.anijs-helper-scrollreveal-min.js" type="text/javascript"></script>
	<?php }?>
</html><?php }} ?>
