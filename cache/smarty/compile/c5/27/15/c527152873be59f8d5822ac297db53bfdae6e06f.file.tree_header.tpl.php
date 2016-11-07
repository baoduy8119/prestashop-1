<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 10:27:34
         compiled from "C:\xampp\htdocs\prestashop\admin045zu0dbq\themes\default\template\helpers\tree\tree_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21612581dec561f0618-30450501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c527152873be59f8d5822ac297db53bfdae6e06f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\admin045zu0dbq\\themes\\default\\template\\helpers\\tree\\tree_header.tpl',
      1 => 1476940184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21612581dec561f0618-30450501',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'toolbar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dec56200a81_20789433',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dec56200a81_20789433')) {function content_581dec56200a81_20789433($_smarty_tpl) {?>
<div class="tree-panel-heading-controls clearfix">
	<?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?><i class="icon-tag"></i>&nbsp;<?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['title']->value),$_smarty_tpl);?>
<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['toolbar']->value)) {?><?php echo $_smarty_tpl->tpl_vars['toolbar']->value;?>
<?php }?>
</div><?php }} ?>
