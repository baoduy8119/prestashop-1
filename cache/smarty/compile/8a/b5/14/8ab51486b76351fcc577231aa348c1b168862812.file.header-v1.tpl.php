<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:22:04
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\header-v1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7324581dceec2493c4-96282328%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ab51486b76351fcc577231aa348c1b168862812' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\header-v1.tpl',
      1 => 1478348053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7324581dceec2493c4-96282328',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir' => 0,
    'shop_name' => 0,
    'logo_url' => 0,
    'logo_image_width' => 0,
    'logo_image_height' => 0,
    'page_name' => 0,
    'displayHomeSlider1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dceec28aa94_19472209',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dceec28aa94_19472209')) {function content_581dceec28aa94_19472209($_smarty_tpl) {?><header id="header" class="header_v1">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-5">
					<div class="ht-left">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayTopNav"),$_smarty_tpl);?>

						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayStatic1"),$_smarty_tpl);?>

					</div>
				</div>
				
				<div class="col-md-6 col-sm-7">
					<div class="ht-right">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayUserinfo"),$_smarty_tpl);?>

					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="header-midle">
		<div class="container">
			<div id="header-logo">
				<a class="logo" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true);?>
">
					<img  src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if (isset($_smarty_tpl->tpl_vars['logo_image_width']->value)&&$_smarty_tpl->tpl_vars['logo_image_width']->value) {?> width="<?php echo $_smarty_tpl->tpl_vars['logo_image_width']->value;?>
"<?php }?><?php if (isset($_smarty_tpl->tpl_vars['logo_image_height']->value)&&$_smarty_tpl->tpl_vars['logo_image_height']->value) {?> height="<?php echo $_smarty_tpl->tpl_vars['logo_image_height']->value;?>
"<?php }?>/>
				</a>
			</div>
				
			<div id="header-cart">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayCart"),$_smarty_tpl);?>

			</div>
		</div>
	</div>
	
	<div id="header-menu">
		<div class="container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayMenu"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displaySearch"),$_smarty_tpl);?>

		</div>
	</div>
	
</header>

<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
	<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeSlider1'),$_smarty_tpl);?>
<?php $_tmp8=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['displayHomeSlider1'] = new Smarty_variable($_tmp8, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['displayHomeSlider1']->value) {?>
		<div class="slider-container">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayHomeSlider1"),$_smarty_tpl);?>

		</div>
	<?php }?>
<?php }?>
<?php }} ?>
