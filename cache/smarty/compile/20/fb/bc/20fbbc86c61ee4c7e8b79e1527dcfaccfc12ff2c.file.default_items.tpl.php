<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:16
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\aztabs\default_items.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18664581dd02495e481-13171818%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20fbbc86c61ee4c7e8b79e1527dcfaccfc12ff2c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default_items.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18664581dd02495e481-13171818',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items_params' => 0,
    'items' => 0,
    'child_items' => 0,
    'kk' => 0,
    'count' => 0,
    'nb_rows' => 0,
    'product' => 0,
    'link' => 0,
    'src' => 0,
    'PS_CATALOG_MODE' => 0,
    'quick_view' => 0,
    'comparator_max_item' => 0,
    'add_prod_display' => 0,
    'restricted_country_mode' => 0,
    'static_token' => 0,
    'paginationId' => 0,
    'compared_products' => 0,
    'priceDisplay' => 0,
    'currency' => 0,
    'count_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd024b91c91_18376588',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd024b91c91_18376588')) {function content_581dd024b91c91_18376588($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.counter.php';
?>
<?php if (!isset($_smarty_tpl->tpl_vars['items_params']->value)) {?>
    <?php $_smarty_tpl->tpl_vars["items_params"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params, null, 0);?>
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['child_items']->value)) {?>
    <?php if (!isset($_smarty_tpl->tpl_vars['kk']->value)) {?>
        <?php $_smarty_tpl->tpl_vars["kk"] = new Smarty_variable("0", null, 0);?>
    <?php }?>
    <?php echo smarty_function_counter(array('start'=>$_smarty_tpl->tpl_vars['kk']->value,'skip'=>1,'print'=>false,'name'=>'count','assign'=>"count"),$_smarty_tpl);?>

	<?php $_smarty_tpl->tpl_vars["count_item"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['child_items']->value), null, 0);?>
	<?php $_smarty_tpl->tpl_vars["nb_rows"] = new Smarty_variable(1, null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
        <?php echo smarty_function_counter(array('name'=>'count'),$_smarty_tpl);?>

		<?php if ($_smarty_tpl->tpl_vars['count']->value%$_smarty_tpl->tpl_vars['nb_rows']->value==1||$_smarty_tpl->tpl_vars['nb_rows']->value==1) {?>
			<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        <?php }?>
			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
						<?php if ($_smarty_tpl->tpl_vars['product']->value['id_image']) {?>
							<a class="product-image" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" <?php echo $_smarty_tpl->tpl_vars['product']->value['_target'];?>
  title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" >
								<?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],$_smarty_tpl->tpl_vars['items_params']->value['image_size']), ENT_QUOTES, 'UTF-8', true);?>
<?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image']), ENT_QUOTES, 'UTF-8', true);?>
<?php $_tmp6=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["src"] = new Smarty_variable($_smarty_tpl->tpl_vars['items_params']->value['image_size']!='none' ? $_tmp5 : $_tmp6, null, 0);?>
								<img class="img_1" src="<?php echo $_smarty_tpl->tpl_vars['src']->value;?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
"/>
								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displaySecondImage",'id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product'],'link_rewrite'=>$_smarty_tpl->tpl_vars['product']->value['link_rewrite']),$_smarty_tpl);?>

							</a>
						<?php }?>
						
						
						<div class="label-box">
							<?php if (isset($_smarty_tpl->tpl_vars['product']->value['new'])&&$_smarty_tpl->tpl_vars['product']->value['new']==1) {?>
								<span class="new-box"><?php echo smartyTranslate(array('s'=>'New','mod'=>'aztabs'),$_smarty_tpl);?>
</span>
							<?php }?>
							
							<?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale'])&&$_smarty_tpl->tpl_vars['product']->value['on_sale']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
								<span class="sale-box"><?php echo smartyTranslate(array('s'=>'Sale','mod'=>'aztabs'),$_smarty_tpl);?>
</span>
								<?php } elseif (isset($_smarty_tpl->tpl_vars['product']->value['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['reduction']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?><span class="sale-box">-<?php echo $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*htmlspecialchars(100, ENT_QUOTES, 'UTF-8', true);?>
%</span>
							<?php }?>
						</div>
						
						<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_addtocart']||$_smarty_tpl->tpl_vars['items_params']->value['display_wishlist']||$_smarty_tpl->tpl_vars['items_params']->value['display_compare']) {?>
							<div class="button-container">
								<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_wishlist']) {?>
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListFunctionalButtons','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

								<?php }?>
								
								<!--   Enable quick view   -->
								<?php if (isset($_smarty_tpl->tpl_vars['quick_view']->value)&&$_smarty_tpl->tpl_vars['quick_view']->value) {?>
									<a class="quick-view" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Quick View','mod'=>'aztabs'),$_smarty_tpl);?>
" data-rel="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
										<i class="fa fa-search"></i>
									</a>
								<?php }?>
								
								<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_compare']&&isset($_smarty_tpl->tpl_vars['comparator_max_item']->value)&&$_smarty_tpl->tpl_vars['comparator_max_item']->value) {?>
										<a class="add_to_compare" title="<?php echo smartyTranslate(array('s'=>'Add to compare','mod'=>'aztabs'),$_smarty_tpl);?>
"
										   href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
										   data-id-product="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
"><i class="fa fa-exchange"></i></a>
								<?php }?>
								</div>
								
								<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_addtocart']) {?>
									<?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==0||(isset($_smarty_tpl->tpl_vars['add_prod_display']->value)&&($_smarty_tpl->tpl_vars['add_prod_display']->value==1)))&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
										<?php if ((!isset($_smarty_tpl->tpl_vars['product']->value['customization_required'])||!$_smarty_tpl->tpl_vars['product']->value['customization_required'])&&($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)) {?>
										<div class="button-cart">
											<?php if (isset($_smarty_tpl->tpl_vars['static_token']->value)) {?>
												<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp7=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add=1&amp;id_product=".$_tmp7."&amp;token=".((string)$_smarty_tpl->tpl_vars['static_token']->value),false), ENT_QUOTES, 'UTF-8', true);?>
"
												   rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'aztabs'),$_smarty_tpl);?>
"
												   data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
													<span><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'aztabs'),$_smarty_tpl);?>
</span>
												</a>
											<?php } else { ?>
												<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,'add=1&amp;id_product={$product.id_product|intval}',false), ENT_QUOTES, 'UTF-8', true);?>
"
												   rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'aztabs'),$_smarty_tpl);?>
"
												   data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
													<span><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'aztabs'),$_smarty_tpl);?>
</span>
												</a>
											<?php }?>
										<?php } else { ?>
											<span class="button ajax_add_to_cart_button btn btn-default cart_button disabled">
												<span><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'aztabs'),$_smarty_tpl);?>
</span>
											</span>
										<?php }?>
										</div>
									<?php }?>
								<?php }?>
							
						<?php }?>
						
					</div>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductDeliveryTime",'product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"weight"),$_smarty_tpl);?>

				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
					<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_name']==1) {?>
						<h5 itemprop="name" class="product-name">
							<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
							   title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" <?php echo $_smarty_tpl->tpl_vars['product']->value['_target'];?>
  >
								<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['title'], ENT_QUOTES, 'UTF-8', true);?>

							</a>
						</h5>
					<?php }?>
					
					<!--  Show average rating stars  -->
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

					
					<!--   Show category description   -->
					 <?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_description']) {?>
							<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['product']->value['desc']);?>

					<?php }?>
					
					<!--Product Prices-->
					<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_price']) {?>
						<?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value&&((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price'])||(isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order'])))) {?>
							<?php if (!isset($_smarty_tpl->tpl_vars['paginationId']->value)||$_smarty_tpl->tpl_vars['paginationId']->value=='') {?>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>htmlspecialchars('min_item', ENT_QUOTES, 'UTF-8', true))); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('min_item', ENT_QUOTES, 'UTF-8', true)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Please select at least one product','js'=>1,'mod'=>'aztabs'),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('min_item', ENT_QUOTES, 'UTF-8', true)), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>htmlspecialchars('max_item', ENT_QUOTES, 'UTF-8', true))); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('max_item', ENT_QUOTES, 'UTF-8', true)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'You cannot add more than %d product(s) to the product comparison','sprintf'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value,'js'=>1,'mod'=>'aztabs'),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>htmlspecialchars('max_item', ENT_QUOTES, 'UTF-8', true)), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('comparator_max_item'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value),$_smarty_tpl);?>

								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('comparedProductsIds'=>$_smarty_tpl->tpl_vars['compared_products']->value),$_smarty_tpl);?>

							<?php }?>
							<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
								<?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) {?>
									
									<?php if (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']&&isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']>0) {?>
										<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl);?>

										<span class="old-price product-price">
											<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>

										</span>
										<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product'],'type'=>"old_price"),$_smarty_tpl);?>

										<!--<?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction_type']=='percentage') {?>
											<span class="price-percent-reduction">-<?php echo $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*htmlspecialchars(100, ENT_QUOTES, 'UTF-8', true);?>
 %</span>
										<?php }?>-->
									<?php }?>
									<span itemprop="price" class="price product-price">
										<?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?>
									</span>
									<meta itemprop="priceCurrency"
										  content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->iso_code, ENT_QUOTES, 'UTF-8', true);?>
"/>
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"price"),$_smarty_tpl);?>

									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl);?>

								<?php }?>
							</div>
						<?php }?>
					<?php }?>
					
					<?php if ($_smarty_tpl->tpl_vars['items_params']->value['display_detail']) {?>
						<a class="button lnk_view btn btn-default"
						   href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" <?php echo $_smarty_tpl->tpl_vars['product']->value['_target'];?>

						   title="<?php echo smartyTranslate(array('s'=>'View','mod'=>'aztabs'),$_smarty_tpl);?>
">
							<span><?php if ((isset($_smarty_tpl->tpl_vars['product']->value['customization_required'])&&$_smarty_tpl->tpl_vars['product']->value['customization_required'])) {?><?php echo smartyTranslate(array('s'=>'Customize','mod'=>'aztabs'),$_smarty_tpl);?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'More','mod'=>'aztabs'),$_smarty_tpl);?>
<?php }?></span>
						</a>
					<?php }?>
				</div>
				
			</div>
            
        <?php if ($_smarty_tpl->tpl_vars['count']->value%$_smarty_tpl->tpl_vars['nb_rows']->value==0||$_smarty_tpl->tpl_vars['count']->value==$_smarty_tpl->tpl_vars['count_item']->value) {?>
			</div>
			<!-- End item-->
		<?php }?>
        
        
    <?php } ?>
<?php }?>

<?php }} ?>
