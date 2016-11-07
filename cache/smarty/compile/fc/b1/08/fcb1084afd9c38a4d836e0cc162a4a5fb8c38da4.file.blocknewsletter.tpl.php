<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:17
         compiled from "C:\xampp\htdocs\prestashop\modules\azblocknewsletter\views\templates\hook\blocknewsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11134581dd025501fc7-99609337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcb1084afd9c38a4d836e0cc162a4a5fb8c38da4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\modules\\azblocknewsletter\\views\\templates\\hook\\blocknewsletter.tpl',
      1 => 1478348058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11134581dd025501fc7-99609337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'msg' => 0,
    'nw_error' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd025558e22_44988140',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd025558e22_44988140')) {function content_581dd025558e22_44988140($_smarty_tpl) {?>
<!-- AZ Block Newsletter -->
<div id="newsletter_block_home" class="block">
	<div class="block_content clearfix">
		<div class="row">
			<div class="col-sm-6">
				<div class="text"><span class="titleFont"><?php echo smartyTranslate(array('s'=>'SIGN FOR OUT MONTHLY','mod'=>'azblocknewsletter'),$_smarty_tpl);?>
</span> <?php echo smartyTranslate(array('s'=>'NEWSLETTER','mod'=>'azblocknewsletter'),$_smarty_tpl);?>
</div>
			</div>
			<div class="col-sm-6">
				<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index'), ENT_QUOTES, 'UTF-8', true);?>
" method="post">
					<div class="form-group<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value) {?> <?php if ($_smarty_tpl->tpl_vars['nw_error']->value) {?>form-error<?php } else { ?>form-ok<?php }?><?php }?>" >
						<input class="inputNew grey newsletter-input" size="80" id="newsletter-input" type="text" name="email"  placeholder="<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value) {?><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
<?php } elseif (isset($_smarty_tpl->tpl_vars['value']->value)&&$_smarty_tpl->tpl_vars['value']->value) {?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'Email','mod'=>'azblocknewsletter'),$_smarty_tpl);?>
<?php }?>" />
						<button type="submit"  name="submitNewsletter" class="buttonNew btn btn-default button button-small">
							<?php echo smartyTranslate(array('s'=>'subscribe','mod'=>'azblocknewsletter'),$_smarty_tpl);?>

						</button>
						<input type="hidden" name="action" value="0" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /AZ Block Newsletter -->
<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value) {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('msg_newsl'=>addcslashes($_smarty_tpl->tpl_vars['msg']->value,'\'')),$_smarty_tpl);?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['nw_error']->value)) {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('nw_error'=>$_smarty_tpl->tpl_vars['nw_error']->value),$_smarty_tpl);?>
<?php }?><?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'placeholder_blocknewsletter')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'placeholder_blocknewsletter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Your Email','mod'=>'azblocknewsletter','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'placeholder_blocknewsletter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value) {?><?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'alert_blocknewsletter')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'alert_blocknewsletter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Newsletter : %1$s','sprintf'=>$_smarty_tpl->tpl_vars['msg']->value,'js'=>1,'mod'=>"azblocknewsletter"),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'alert_blocknewsletter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><?php }} ?>
