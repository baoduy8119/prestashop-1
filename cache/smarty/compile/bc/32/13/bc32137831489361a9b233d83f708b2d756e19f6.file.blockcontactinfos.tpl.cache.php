<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 07:58:15
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\blockcontactinfos\blockcontactinfos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14611581f28e7b86a67-57255225%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc32137831489361a9b233d83f708b2d756e19f6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\blockcontactinfos\\blockcontactinfos.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14611581f28e7b86a67-57255225',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blockcontactinfos_company' => 0,
    'blockcontactinfos_address' => 0,
    'blockcontactinfos_phone' => 0,
    'blockcontactinfos_email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f28e7bea057_65079607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f28e7bea057_65079607')) {function content_581f28e7bea057_65079607($_smarty_tpl) {?><?php if (!is_callable('smarty_function_mailto')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.mailto.php';
?>

<!-- MODULE Block contact infos -->
<section id="block_contact_infos" class="az_boxFooter col-md-4 col-sm-12" >
	
	<div class="logo_footer"></div>
	<ul class="list-contact">
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value!='') {?>
			<li class="address">
				<label class="icon"><i class="fa fa-map-marker"></i></label>
				<span><?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value!='') {?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?></span>
			</li>
		<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value!='') {?>
			<li class="phone">
				<label class="icon"><i class="fa fa-phone"></i></label>
				<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
			</li>
		<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value!='') {?>
			<li class="email">
				<label class="icon"><i class="fa fa-envelope"></i></label>
				<?php echo smarty_function_mailto(array('address'=>htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value, ENT_QUOTES, 'UTF-8', true),'encode'=>"hex"),$_smarty_tpl);?>

			</li>
		<?php }?>
	</ul>
	
</section>
<!-- /MODULE Block contact infos -->
<?php }} ?>
