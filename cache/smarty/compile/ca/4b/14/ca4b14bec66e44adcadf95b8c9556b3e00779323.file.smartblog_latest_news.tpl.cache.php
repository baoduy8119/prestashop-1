<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 07:58:20
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\smartbloghomelatestnews\smartblog_latest_news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21079581f28ecaeba04-22108095%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca4b14bec66e44adcadf95b8c9556b3e00779323' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\smartbloghomelatestnews\\smartblog_latest_news.tpl',
      1 => 1478348057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21079581f28ecaeba04-22108095',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'view_data' => 0,
    'post' => 0,
    'i' => 0,
    'options' => 0,
    'modules_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f28ecc00bd5_42645255',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f28ecc00bd5_42645255')) {function content_581f28ecc00bd5_42645255($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\modifier.date_format.php';
?><div class="block az_lastesthomenews">
    <h3 class="title_block titleFont"><?php echo smartyTranslate(array('s'=>'Lastest blogs','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
</h3>
    <ul class="post_list row">
        <?php if (isset($_smarty_tpl->tpl_vars['view_data']->value)&&!empty($_smarty_tpl->tpl_vars['view_data']->value)) {?>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['view_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
               
                    <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
                    <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id'];?>
                    <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
                    <li class="post post_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
 col-md-12 col-sm-6">
						<div class="post-inner">
							
							<div class="post_image">
								 
								 <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><img alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" class="feat_img" src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
smartblog/images/<?php echo $_smarty_tpl->tpl_vars['post']->value['post_img'];?>
-home-default.jpg"></a>
							</div>
							
							<div class="post_content">
								<div class="post_header">
									 <div class="date_create">
										<span class="d"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['date_added'],"%d");?>
</span>
										<span class="m"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['date_added'],"%b");?>
</span>
									 </div>
									 <div class="post_title"><a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value['title'],25,''), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a></div>
									 <div class="post_info">
									<span itemprop="author" class="author"><?php echo smartyTranslate(array('s'=>'By','mod'=>'smartblog'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['firstname'];?>
<?php echo $_smarty_tpl->tpl_vars['post']->value['lastname'];?>
</span>
									<!--<span class="viewed"><i class="fa fa-eye"></i> 
										<?php if ($_smarty_tpl->tpl_vars['post']->value['viewed']>1) {?>
											<?php echo $_smarty_tpl->tpl_vars['post']->value['viewed'];?>
 <?php echo smartyTranslate(array('s'=>'Views','mod'=>'smartblog'),$_smarty_tpl);?>

										<?php } else { ?>
											<?php echo $_smarty_tpl->tpl_vars['post']->value['viewed'];?>
 <?php echo smartyTranslate(array('s'=>'View','mod'=>'smartblog'),$_smarty_tpl);?>

										<?php }?>
									</span>-->
									<span class="sep"></span>
									<span class="comment"> <a title="<?php echo $_smarty_tpl->tpl_vars['post']->value['countcomment'];?>
 Comments" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
#articleComments">
										<?php if ($_smarty_tpl->tpl_vars['post']->value['countcomment']>1) {?>
											 <?php echo smartyTranslate(array('s'=>'Comments:','mod'=>'smartblog'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['countcomment'];?>

										<?php } else { ?>
											 <?php echo smartyTranslate(array('s'=>'Comment:','mod'=>'smartblog'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['countcomment'];?>

										<?php }?>
									</a></span>
								</div>
								</div>
								<div class="post_desc">
									<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value['short_description'],150,''), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

								</div>
								<a class="readmore" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo smartyTranslate(array('s'=>'Read more','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
 <i class="fa fa-long-arrow-right"></i></a>
							</div>
						</div>
                        
                        
                    </li>
                
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
            <?php } ?>
        <?php }?>
     </ul>
</div><?php }} ?>
