<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 10:29:23
         compiled from "C:\xampp\htdocs\prestashop\modules\azhomeslider\views\templates\hook\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28054581decc3bd21c4-06209462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0c1712613f94fc84e3609548d9c1f1351f0c013' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\modules\\azhomeslider\\views\\templates\\hook\\list.tpl',
      1 => 1478348059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28054581decc3bd21c4-06209462',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'id_azhomeslider_groups' => 0,
    'slides' => 0,
    'slide' => 0,
    'image_baseurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581decc3c4e7e5_26492112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581decc3c4e7e5_26492112')) {function content_581decc3c4e7e5_26492112($_smarty_tpl) {?>
<div class="panel"><h3><i class="icon-list-ul"></i> <?php echo smartyTranslate(array('s'=>'Slides list','mod'=>'azhomeslider'),$_smarty_tpl);?>

	<span class="panel-heading-action">
		<a id="desc-product-new" class="list-toolbar-btn" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminModules');?>
&configure=azhomeslider&addSlide=1&id_azhomeslider_groups=<?php echo $_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value;?>
">
			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="<?php echo smartyTranslate(array('s'=>'Add new','mod'=>'azhomeslider'),$_smarty_tpl);?>
" data-html="true">
				<i class="process-icon-new "></i>
			</span>
		</a>
	</span>
	</h3>
	<div id="slidesContent">
		<div id="slides">
			<?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
?>
				<div id="slides_<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_slide'];?>
" class="panel">
					<div class="row">
						<div class="col-lg-1">
							<span><i class="icon-arrows "></i></span>
						</div>
						<div class="col-md-3">
							<img src="<?php echo $_smarty_tpl->tpl_vars['image_baseurl']->value;?>
<?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
" class="img-thumbnail" />
						</div>
						<div class="col-md-8">
							<h4 class="pull-left">
								#<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_slide'];?>
 - <?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>

								<?php if ($_smarty_tpl->tpl_vars['slide']->value['is_shared']) {?>
									<div>
										<span class="label color_field pull-left" style="background-color:#108510;color:white;margin-top:5px;">
											<?php echo smartyTranslate(array('s'=>'Shared slide','mod'=>'azhomeslider'),$_smarty_tpl);?>

										</span>
									</div>
								<?php }?>
							</h4>
							<div class="btn-group-action pull-right">
								<?php echo $_smarty_tpl->tpl_vars['slide']->value['status'];?>


								<a class="btn btn-default"
									href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminModules');?>
&configure=azhomeslider&id_slide=<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_slide'];?>
&id_azhomeslider_groups=<?php echo $_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value;?>
">
									<i class="icon-edit"></i>
									<?php echo smartyTranslate(array('s'=>'Edit','mod'=>'azhomeslider'),$_smarty_tpl);?>

								</a>
								<a class="btn btn-default"
									href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminModules');?>
&configure=azhomeslider&delete_id_slide=<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_slide'];?>
&id_azhomeslider_groups=<?php echo $_smarty_tpl->tpl_vars['id_azhomeslider_groups']->value;?>
">
									<i class="icon-trash"></i>
									<?php echo smartyTranslate(array('s'=>'Delete','mod'=>'azhomeslider'),$_smarty_tpl);?>

								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php }} ?>
