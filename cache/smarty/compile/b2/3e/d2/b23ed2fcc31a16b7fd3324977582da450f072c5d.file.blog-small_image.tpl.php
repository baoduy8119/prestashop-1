<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 09:44:01
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\smartblog\blog-small_image.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25219581f41b10ca9f4-56201432%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b23ed2fcc31a16b7fd3324977582da450f072c5d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\smartblog\\blog-small_image.tpl',
      1 => 1478348057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25219581f41b10ca9f4-56201432',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'postcategory' => 0,
    'post' => 0,
    'options' => 0,
    'smartshownoimg' => 0,
    'modules_dir' => 0,
    'smartshowauthor' => 0,
    'smartshowauthorstyle' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f41b11b6682_41520811',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f41b11b6682_41520811')) {function content_581f41b11b6682_41520811($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\modifier.date_format.php';
?>
<div class="smartblogcat-inner small_image">
	<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['postcategory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
		<div itemtype="#" itemscope="" class="sdsarticleCat clearfix">
			<div id="smartblogpost-<?php echo $_smarty_tpl->tpl_vars['post']->value['id_post'];?>
">
			<div class="articleContent clearfix">
			<?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
									<?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id_post'];?> 
									<?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
				  <a itemprop="url" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" class="imageFeaturedLink" href='<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
'>
							<?php $_smarty_tpl->tpl_vars["activeimgincat"] = new Smarty_variable('0', null, 0);?>
							<?php $_smarty_tpl->tpl_vars['activeimgincat'] = new Smarty_variable($_smarty_tpl->tpl_vars['smartshownoimg']->value, null, 0);?> 
							
					  <img itemprop="image" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
/smartblog/images/<?php echo $_smarty_tpl->tpl_vars['post']->value['post_img'];?>
-home-default.jpg" class="imageFeatured">
							
				  </a>
				  
				 
				   <div class="sdsarticleHeader">
						<div class="date_create">
							<span class="d"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['created'],"%d");?>
</span>
							<span class="m"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['created'],"%b");?>
</span>
						 </div>
						 <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
											<?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id_post'];?> 
											<?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
											<div class="sdstitle_block"><a title="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value['meta_title'],20,'');?>
</a></div>
							 <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
										<?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id_post'];?>
										<?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
							   <?php $_smarty_tpl->tpl_vars["catlink"] = new Smarty_variable(null, null, 0);?>
											<?php $_smarty_tpl->createLocalArrayVariable('catlink', null, 0);
$_smarty_tpl->tpl_vars['catlink']->value['id_category'] = $_smarty_tpl->tpl_vars['post']->value['id_category'];?>
											<?php $_smarty_tpl->createLocalArrayVariable('catlink', null, 0);
$_smarty_tpl->tpl_vars['catlink']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['cat_link_rewrite'];?>
						
						 <div class="sdsarticle-info">
							<span itemprop="author" class="author"><?php echo smartyTranslate(array('s'=>'By','mod'=>'smartblog'),$_smarty_tpl);?>
 <?php if ($_smarty_tpl->tpl_vars['smartshowauthor']->value==1) {?> <?php if ($_smarty_tpl->tpl_vars['smartshowauthorstyle']->value!=0) {?><?php echo $_smarty_tpl->tpl_vars['post']->value['firstname'];?>
<?php echo $_smarty_tpl->tpl_vars['post']->value['lastname'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['post']->value['lastname'];?>
<?php echo $_smarty_tpl->tpl_vars['post']->value['firstname'];?>
<?php }?></span><?php }?>
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
							<span class="comment"> <a title="<?php echo $_smarty_tpl->tpl_vars['post']->value['totalcomment'];?>
 Comments" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
#articleComments">
								<?php if ($_smarty_tpl->tpl_vars['post']->value['totalcomment']>1) {?>
									 <?php echo smartyTranslate(array('s'=>'Comments:','mod'=>'smartblog'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['totalcomment'];?>

								<?php } else { ?>
									 <?php echo smartyTranslate(array('s'=>'Comment:','mod'=>'smartblog'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['totalcomment'];?>

								<?php }?>
							</a></span>
						</div>
					</div>
					
					<!--<div class="date_added"><?php echo $_smarty_tpl->tpl_vars['post']->value['created'];?>
 </div>-->
					<div class="sdsarticle-des">
						  <span itemprop="description"><div id="lipsum">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value['short_description'],340,'');?>
</div></span>
					</div>
					<a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
" class="more"><?php echo smartyTranslate(array('s'=>'Read more','mod'=>'smartblog'),$_smarty_tpl);?>
 <i class="fa fa-long-arrow-right"></i></a>	 
					
			</div>
			   
		   </div>
		</div>
	<?php } ?>
</div><?php }} ?>
