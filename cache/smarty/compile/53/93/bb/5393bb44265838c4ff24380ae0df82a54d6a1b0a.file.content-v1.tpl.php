<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:22:04
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\content-v1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29227581dceec342113-42306430%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5393bb44265838c4ff24380ae0df82a54d6a1b0a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\content-v1.tpl',
      1 => 1478348052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29227581dceec342113-42306430',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'displayStatic2' => 0,
    'displayStatic3' => 0,
    'displayTab' => 0,
    'displayTab2' => 0,
    'displayHomeNews' => 0,
    'displayStatic4' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dceec3a2d22_01478897',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dceec3a2d22_01478897')) {function content_581dceec3a2d22_01478897($_smarty_tpl) {?>
	
<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
	
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayStatic2'),$_smarty_tpl);?>
<?php $_tmp9=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayStatic2'] = new Smarty_variable($_tmp9, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['displayStatic2']->value) {?>
	<div class="columns-content1 clearfix">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayStatic2"),$_smarty_tpl);?>

		</div>
	</div>
	<?php }?>
	
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayStatic3'),$_smarty_tpl);?>
<?php $_tmp10=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayStatic3'] = new Smarty_variable($_tmp10, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['displayStatic3']->value) {?>
	<div class="columns-content2 clearfix">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayStatic3"),$_smarty_tpl);?>

		</div>
	</div>
	<?php }?>
	
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayTab'),$_smarty_tpl);?>
<?php $_tmp11=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayTab'] = new Smarty_variable($_tmp11, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['displayTab']->value) {?>
	<div class="columns-content3 clearfix">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayTab"),$_smarty_tpl);?>

		</div>
	</div>
	<?php }?>
	
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayTab2'),$_smarty_tpl);?>
<?php $_tmp12=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayTab2'] = new Smarty_variable($_tmp12, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['displayTab2']->value) {?>
	<div class="columns-content4 clearfix">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayTab2"),$_smarty_tpl);?>

		</div>
	</div>
	<?php }?>
	

	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeNews'),$_smarty_tpl);?>
<?php $_tmp13=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayHomeNews'] = new Smarty_variable($_tmp13, null, 0);?>
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayStatic4'),$_smarty_tpl);?>
<?php $_tmp14=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayStatic4'] = new Smarty_variable($_tmp14, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['displayHomeNews']->value||$_smarty_tpl->tpl_vars['displayStatic4']->value) {?>
	<div class="columns-content5 clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayHomeNews"),$_smarty_tpl);?>

				</div>
				<div class="col-md-4 col-sm-4">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayStatic4"),$_smarty_tpl);?>

				</div>
			</div>
		</div>
	</div>
	<?php }?>	
	
<?php }?>

	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayManufacturer'),$_smarty_tpl);?>
<?php $_tmp15=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayManufacturer'] = new Smarty_variable($_tmp15, null, 0);?>
	<?php if ('displayManufacturer') {?>
	<div class="columns-content6 clearfix">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayManufacturer"),$_smarty_tpl);?>

		</div>
	</div>
	<?php }?>
	
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayNewLetter'),$_smarty_tpl);?>
<?php $_tmp16=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayNewLetter'] = new Smarty_variable($_tmp16, null, 0);?>
	<?php if ('displayNewLetter') {?>
	<div class="columns-content7 clearfix">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayNewLetter"),$_smarty_tpl);?>

		</div>
	</div>
	<?php }?><?php }} ?>
