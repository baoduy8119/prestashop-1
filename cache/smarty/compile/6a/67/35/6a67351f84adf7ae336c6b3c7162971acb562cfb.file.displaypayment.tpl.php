<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:17
         compiled from "C:\xampp\htdocs\prestashop\modules\azthemeconfigurator\views\templates\hook\displaypayment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6367581dd02556fc72-70039256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a67351f84adf7ae336c6b3c7162971acb562cfb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\modules\\azthemeconfigurator\\views\\templates\\hook\\displaypayment.tpl',
      1 => 1478348061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6367581dd02556fc72-70039256',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'paymentImage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd0255738a9_09140122',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd0255738a9_09140122')) {function content_581dd0255738a9_09140122($_smarty_tpl) {?><div class="footer-payment">
<img src="<?php echo $_smarty_tpl->tpl_vars['paymentImage']->value;?>
" alt="payment logos" >
</div>
<?php }} ?>
