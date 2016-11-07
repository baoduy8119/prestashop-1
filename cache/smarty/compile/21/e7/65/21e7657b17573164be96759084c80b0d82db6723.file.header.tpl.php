<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:13
         compiled from "C:\xampp\htdocs\prestashop\modules\azmanufacturer\views\templates\hook\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18465581dd021e886b1-97450629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21e7657b17573164be96759084c80b0d82db6723' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\modules\\azmanufacturer\\views\\templates\\hook\\header.tpl',
      1 => 1478348059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18465581dd021e886b1-97450629',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'comparator_max_item' => 0,
    'compared_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd021ef2995_79789191',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd021ef2995_79789191')) {function content_581dd021ef2995_79789191($_smarty_tpl) {?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>htmlspecialchars('min_item', ENT_QUOTES, 'UTF-8', true))); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('min_item', ENT_QUOTES, 'UTF-8', true)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Please select at least one product','js'=>1,'mod'=>'azmanufacturer'),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('min_item', ENT_QUOTES, 'UTF-8', true)), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>htmlspecialchars('max_item', ENT_QUOTES, 'UTF-8', true))); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('max_item', ENT_QUOTES, 'UTF-8', true)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'You cannot add more than %d product(s) to the product comparison','mod'=>'azmanufacturer','sprintf'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value,'js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('max_item', ENT_QUOTES, 'UTF-8', true)), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('comparator_max_item'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('comparedProductsIds'=>$_smarty_tpl->tpl_vars['compared_products']->value),$_smarty_tpl);?>
<?php }} ?>
