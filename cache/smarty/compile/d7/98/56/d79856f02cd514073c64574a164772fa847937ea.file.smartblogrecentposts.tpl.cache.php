<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 09:44:00
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\smartblogrecentposts\views\templates\front\smartblogrecentposts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22845581f41b0922a74-16255370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd79856f02cd514073c64574a164772fa847937ea' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\smartblogrecentposts\\views\\templates\\front\\smartblogrecentposts.tpl',
      1 => 1478348057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22845581f41b0922a74-16255370',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'posts' => 0,
    'post' => 0,
    'options' => 0,
    'modules_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f41b0967ff1_26224531',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f41b0967ff1_26224531')) {function content_581f41b0967ff1_26224531($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\modifier.date_format.php';
?><?php if (isset($_smarty_tpl->tpl_vars['posts']->value)&&!empty($_smarty_tpl->tpl_vars['posts']->value)) {?>
<div id="recent_article_smart_blog_block_left"  class="block blogModule boxPlain">
   <h3 class="title_block"><?php echo smartyTranslate(array('s'=>'Recent posts','mod'=>'smartblogrecentposts'),$_smarty_tpl);?>
</h3>
   <div class="block_content">
      <ul class="recentArticles">
        <?php  $_smarty_tpl->tpl_vars["post"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["post"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["post"]->key => $_smarty_tpl->tpl_vars["post"]->value) {
$_smarty_tpl->tpl_vars["post"]->_loop = true;
?>
             <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
             <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id_smart_blog_post'];?>
             <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
             <li>
                 <a class="image" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
">
                     <img alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
/smartblog/images/<?php echo $_smarty_tpl->tpl_vars['post']->value['post_img'];?>
-home-small.jpg">
                 </a>
                 <a class="title"  title="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value['meta_title'],30,'');?>
</a>
				<!--<span class="info"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['created'],"%b, %d, %Y");?>
</span>-->
			  
				 
             </li>
         <?php } ?>
            </ul>
   </div>
</div>
<?php }?><?php }} ?>
