<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 09:44:00
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\smartblogcategories\views\templates\front\smartblogcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23188581f41b05d55c9-79744766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92dd4a7620e11b25decb2d7b08e6c84d51c158f6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\smartblogcategories\\views\\templates\\front\\smartblogcategories.tpl',
      1 => 1478348057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23188581f41b05d55c9-79744766',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f41b06212b9_76705417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f41b06212b9_76705417')) {function content_581f41b06212b9_76705417($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['categories']->value)&&!empty($_smarty_tpl->tpl_vars['categories']->value)) {?>
<div id="category_blog_block_left"  class="block blogModule boxPlain">
  <h3 class="title_block"> <span><?php echo smartyTranslate(array('s'=>'Blog Categories','mod'=>'smartblogcategories'),$_smarty_tpl);?>
</span></h3>
   <div class="block_content list-block">
         <ul class="list-link">
	<?php  $_smarty_tpl->tpl_vars["category"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["category"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["category"]->key => $_smarty_tpl->tpl_vars["category"]->value) {
$_smarty_tpl->tpl_vars["category"]->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
            <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_category'] = $_smarty_tpl->tpl_vars['category']->value['id_smart_blog_category'];?>
            <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['category']->value['link_rewrite'];?>
                <li>
                    <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_category',$_smarty_tpl->tpl_vars['options']->value);?>
"> <?php echo $_smarty_tpl->tpl_vars['category']->value['meta_title'];?>
</a>
                </li>
	<?php } ?>
        </ul>
   </div>
</div>
<?php }?><?php }} ?>
