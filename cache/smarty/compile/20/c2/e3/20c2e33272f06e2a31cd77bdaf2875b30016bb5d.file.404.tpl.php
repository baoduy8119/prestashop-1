<?php /* Smarty version Smarty-3.1.19, created on 2016-11-07 03:26:57
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9758203ad19a7626-21719365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20c2e33272f06e2a31cd77bdaf2875b30016bb5d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\404.tpl',
      1 => 1478348052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9758203ad19a7626-21719365',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58203ad1a75ed2_03976130',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58203ad1a75ed2_03976130')) {function content_58203ad1a75ed2_03976130($_smarty_tpl) {?>
<div class="pagenotfound-wrap">
	<div class="pagenotfound-content">
		<div class="img_404">
			<img src="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
themes/az_leonard/img/404/404.png" alt="#" />
		</div>
		<h1 class="titleFont">OPPS! THIS PAGE COULD NOT BE FOUND!</h1>
		<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8', true);?>
" method="post" class="std">
			<fieldset>
				<div>
					<input id="search_query" name="search_query" type="text" class="form-control grey" placeholder="What were you looking for ?" />
					<button type="submit" name="Submit" value="OK" class="btn btn-default button button-small"><span><i class="fa fa-search"></i></span></button>
				</div>
			</fieldset>
		</form>
		<p>Sorry bit the page you are looking for does not exist, have been removed or name changed</p>
		<a class="backtohome" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Back to homepage'),$_smarty_tpl);?>
</a>
	</div>
</div>
<?php }} ?>
