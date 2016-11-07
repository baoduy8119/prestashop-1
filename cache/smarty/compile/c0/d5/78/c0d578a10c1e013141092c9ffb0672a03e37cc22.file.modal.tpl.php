<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:12:30
         compiled from "C:\xampp\htdocs\prestashop\admin045zu0dbq\themes\default\template\helpers\modules_list\modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14237581dccaed424e9-60398697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0d578a10c1e013141092c9ffb0672a03e37cc22' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\admin045zu0dbq\\themes\\default\\template\\helpers\\modules_list\\modal.tpl',
      1 => 1476940184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14237581dccaed424e9-60398697',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dccaed46447_63609025',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dccaed46447_63609025')) {function content_581dccaed46447_63609025($_smarty_tpl) {?><div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules and Services'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<?php }} ?>
