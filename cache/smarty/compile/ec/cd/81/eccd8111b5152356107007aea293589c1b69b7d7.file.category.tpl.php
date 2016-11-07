<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 23:05:51
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13906581ffd9fa7c509-75792440%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eccd8111b5152356107007aea293589c1b69b7d7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\category.tpl',
      1 => 1478348052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13906581ffd9fa7c509-75792440',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'scenes' => 0,
    'description_short' => 0,
    'link' => 0,
    'categoryNameComplement' => 0,
    'AZ_subCat' => 0,
    'subcategories' => 0,
    'AZ_subCatColumns' => 0,
    'subcategory' => 0,
    'img_cat_dir' => 0,
    'AZ_subCatTitle' => 0,
    'AZ_subCatDes' => 0,
    'products' => 0,
    'AZ_productDes' => 0,
    'AZ_productColor' => 0,
    'AZ_productStock' => 0,
    'AZ_productTitle' => 0,
    'AZ_quickView' => 0,
    'AZ_productCatRating' => 0,
    'hiddenProductDes' => 0,
    'hiddenProductColor' => 0,
    'hiddenProductStock' => 0,
    'hiddenProductTitle' => 0,
    'hiddenQuickView' => 0,
    'hiddenrating' => 0,
    'AZ_productColumns' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581ffd9fbea6e6_67035190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581ffd9fbea6e6_67035190')) {function content_581ffd9fbea6e6_67035190($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['category']->value)) {?>
	<?php if ($_smarty_tpl->tpl_vars['category']->value->id&&$_smarty_tpl->tpl_vars['category']->value->active) {?>
    	<?php if ($_smarty_tpl->tpl_vars['scenes']->value||$_smarty_tpl->tpl_vars['category']->value->description||$_smarty_tpl->tpl_vars['category']->value->id_image) {?>
			<div class="content_scene_cat">
            	 <?php if ($_smarty_tpl->tpl_vars['scenes']->value) {?>
                 	<div class="content_scene">
                        <!-- Scenes -->
                        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./scenes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('scenes'=>$_smarty_tpl->tpl_vars['scenes']->value), 0);?>

                        <?php if ($_smarty_tpl->tpl_vars['category']->value->description) {?>
                            <div class="cat_desc rte">
                            <?php if (Tools::strlen($_smarty_tpl->tpl_vars['category']->value->description)>350) {?>
                                <div id="category_description_short"><?php echo $_smarty_tpl->tpl_vars['description_short']->value;?>
</div>
                                <div id="category_description_full" class="unvisible"><?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>
</div>
                                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['category']->value->id_category,$_smarty_tpl->tpl_vars['category']->value->link_rewrite), ENT_QUOTES, 'UTF-8', true);?>
" class="lnk_more"><?php echo smartyTranslate(array('s'=>'More'),$_smarty_tpl);?>
</a>
                            <?php } else { ?>
                                <div><?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>
</div>
                            <?php }?>
                            </div>
                        <?php }?>
                    </div>
				<?php } else { ?>
                    <!-- Category image -->  
					<?php if ($_smarty_tpl->tpl_vars['category']->value->id_image) {?>
						<div class="category-image">
							<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['category']->value->link_rewrite,$_smarty_tpl->tpl_vars['category']->value->id_image,'category_default'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
						</div> 
                    <?php }?>
                     
						<?php if ($_smarty_tpl->tpl_vars['category']->value->description) {?>
							
                            <div class="content_scene">
								<!--<h1 class="category-name">
									<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
<?php if (isset($_smarty_tpl->tpl_vars['categoryNameComplement']->value)) {?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryNameComplement']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?>
								</h1>-->
								<?php if (Tools::strlen($_smarty_tpl->tpl_vars['category']->value->description)>350) {?>
									<div id="category_description_short" class="rte"><?php echo $_smarty_tpl->tpl_vars['description_short']->value;?>
</div>
									<div id="category_description_full" class="unvisible rte"><?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>
</div>
									<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['category']->value->id_category,$_smarty_tpl->tpl_vars['category']->value->link_rewrite), ENT_QUOTES, 'UTF-8', true);?>
" class="lnk_more"><?php echo smartyTranslate(array('s'=>'More'),$_smarty_tpl);?>
</a>
								<?php } else { ?>
									<div class="rte"><?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>
</div>
								<?php }?>
                            </div>
                        <?php }?>
               
                  <?php }?>
            </div>
		<?php }?>

		
		<!-- Subcategories -->
		
		<?php if (isset($_smarty_tpl->tpl_vars['AZ_subCat']->value)&&$_smarty_tpl->tpl_vars['AZ_subCat']->value==1) {?>
			<div id="subcategories">
				<h3 class="subcategory-heading titleFont"><?php echo smartyTranslate(array('s'=>'Subcategories'),$_smarty_tpl);?>
</h3>
				
				<div class="row">
				
				<?php if (isset($_smarty_tpl->tpl_vars['subcategories']->value)) {?>	
				<?php  $_smarty_tpl->tpl_vars['subcategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subcategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subcategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->key => $_smarty_tpl->tpl_vars['subcategory']->value) {
$_smarty_tpl->tpl_vars['subcategory']->_loop = true;
?>
					<div class="<?php if (isset($_smarty_tpl->tpl_vars['AZ_subCatColumns']->value)) {?> col-md-<?php echo 12/$_smarty_tpl->tpl_vars['AZ_subCatColumns']->value;?>
  <?php } else { ?> col-md-12 <?php }?> col-xs-6">
						<div class="subcategories-box">
							<div class="subcategory-image">
								<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subcategory']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" class="img">
								<?php if ($_smarty_tpl->tpl_vars['subcategory']->value['id_image']) {?>
									<img class="replace-2x" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite'],$_smarty_tpl->tpl_vars['subcategory']->value['id_image']);?>
" alt="" />
								<?php } else { ?>
									<img class="replace-2x" src="<?php echo $_smarty_tpl->tpl_vars['img_cat_dir']->value;?>
default-medium_default.jpg" alt=""  />
								<?php }?>
								</a>
							</div>
							
							<?php if ($_smarty_tpl->tpl_vars['AZ_subCatTitle']->value) {?>
							<h4 class="subcategory-name">
								<a  href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['subcategory']->value['name'],25,'...'), ENT_QUOTES, 'UTF-8', true),350);?>

								</a>
							</h4>
							<?php }?>
							
							<?php if ($_smarty_tpl->tpl_vars['AZ_subCatDes']->value) {?>
								<div class="subcategory-desc"><?php echo $_smarty_tpl->tpl_vars['subcategory']->value['description'];?>
</div>
							<?php }?>
						</div>
					</div>
				<?php } ?>
				<?php }?>
				</div>
				
			</div>
		<?php }?>
		
		
		<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
			<div class="content_sortPagiBar_top">
					<?php echo $_smarty_tpl->getSubTemplate ("./nbr-product-page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<?php echo $_smarty_tpl->getSubTemplate ("./product-sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<?php echo $_smarty_tpl->getSubTemplate ("./category-view-type.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			</div>
			
			
			<?php if ($_smarty_tpl->tpl_vars['AZ_productDes']->value==0) {?>				<?php $_smarty_tpl->tpl_vars['hiddenProductDes'] = new Smarty_variable('hidden-des', null, 0);?>      <?php } else { ?>  <?php $_smarty_tpl->tpl_vars['hiddenProductDes'] = new Smarty_variable('', null, 0);?><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['AZ_productColor']->value==0) {?>	<?php $_smarty_tpl->tpl_vars['hiddenProductColor'] = new Smarty_variable('hidden-color', null, 0);?> <?php } else { ?> <?php $_smarty_tpl->tpl_vars['hiddenProductColor'] = new Smarty_variable('', null, 0);?><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['AZ_productStock']->value==0) {?>		<?php $_smarty_tpl->tpl_vars['hiddenProductStock'] = new Smarty_variable('hidden-stock', null, 0);?> 	<?php } else { ?> <?php $_smarty_tpl->tpl_vars['hiddenProductStock'] = new Smarty_variable('', null, 0);?><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['AZ_productTitle']->value==0) {?>			<?php $_smarty_tpl->tpl_vars['hiddenProductTitle'] = new Smarty_variable('hidden-title', null, 0);?> 			<?php } else { ?> <?php $_smarty_tpl->tpl_vars['hiddenProductTitle'] = new Smarty_variable('', null, 0);?> <?php }?>
			<?php if ($_smarty_tpl->tpl_vars['AZ_quickView']->value==0) {?>					<?php $_smarty_tpl->tpl_vars['hiddenQuickView'] = new Smarty_variable('hidden-quickview', null, 0);?> 		<?php } else { ?> <?php $_smarty_tpl->tpl_vars['hiddenQuickView'] = new Smarty_variable('', null, 0);?><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['AZ_productCatRating']->value==0) {?>		<?php $_smarty_tpl->tpl_vars['hiddenrating'] = new Smarty_variable('hidden-rating', null, 0);?> 				<?php } else { ?> <?php $_smarty_tpl->tpl_vars['hiddenrating'] = new Smarty_variable('', null, 0);?><?php }?>
				
			<div class="content_product_list <?php echo $_smarty_tpl->tpl_vars['hiddenProductDes']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['hiddenProductColor']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['hiddenProductStock']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['hiddenProductTitle']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['hiddenQuickView']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['hiddenrating']->value;?>
"  data-class="<?php if (isset($_smarty_tpl->tpl_vars['AZ_productColumns']->value)) {?> col-lg-<?php echo 12/$_smarty_tpl->tpl_vars['AZ_productColumns']->value;?>
 col-md-4 col-sm-6 col-xs-6 <?php } else { ?> col-md-3 col-sm-6 col-xs-6 <?php }?>">
			    <?php echo $_smarty_tpl->getSubTemplate ("./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['products']->value), 0);?>

            </div>
            
			 
			<div class="content_sortPagiBar_bottom">
				<?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('paginationId'=>'bottom'), 0);?>

			</div>
		<?php } else { ?>
            <h1><?php echo smartyTranslate(array('s'=>'There are no products in this category!'),$_smarty_tpl);?>
</h1>
        <?php }?>
		
		
	<?php } elseif ($_smarty_tpl->tpl_vars['category']->value->id) {?>
		<p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'This category is currently unavailable.'),$_smarty_tpl);?>
</p>
	<?php }?>
<?php }?>
<?php }} ?>
