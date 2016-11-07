<?php /*%%SmartyHeaderCode:30303581f28eb13bcf6-88626115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4a2084416132408de9eb554422d14cbb2d75ccc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
    '8bf7617068a38b22e9103e82f2e681ff4a046269' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default_tabs.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
    '20fbbc86c61ee4c7e8b79e1527dcfaccfc12ff2c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default_items.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
    'cafc9e54f8107cacfb070903176b9ed7e4eb6ef1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default_js.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30303581f28eb13bcf6-88626115',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58200adb48ca16_57266477',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58200adb48ca16_57266477')) {function content_58200adb48ca16_57266477($_smarty_tpl) {?>
<!-- AZ Tabs -->
                                                <div class="az_module new_products">
                                    <div class="az_titleModule titleFont">
                        <span>New Products</span>
                    </div>
                
                
                                                                
                                                                                                                                                                                                                                                                                                                                
                
                <div id="az_tabs_2_147849493924697" class="az_tabs first-load">
                    <div class="aztabs-wrap">
                        <!--Begin Tabs-->
                        <div class="aztabs-tabs-container"
                             data-delay="800"
                             data-duration="200"
                             data-effect="zoomOut"
                             data-ajaxurl="http://localhost/prestashop/"
                             data-modid="2"
							 data-hookname="displayTab2">
                            <div class="aztabs-tabs-wrap">
    <span class="aztabs-tab-selected"></span>
    <span class="aztabs-tab-arrow">&#9660;</span>
    <ul class="aztabs-tabs cf">
                                                                        <li class="aztabs-tab   tab-all"
                    data-category-id="*"
                    data-active-content=".items-category-all">
                                        <span class="aztabs-tab-label">
                        All
					</span>
                </li>
                                                                                    <li class="aztabs-tab   tab-sel tab-loaded "
                    data-category-id="2"
                    data-active-content=".items-category-2">
                                        <span class="aztabs-tab-label">
                        Home
					</span>
                </li>
                                                                                    <li class="aztabs-tab  "
                    data-category-id="3"
                    data-active-content=".items-category-3">
                                        <span class="aztabs-tab-label">
                        Women
					</span>
                </li>
                                                                                    <li class="aztabs-tab  "
                    data-category-id="4"
                    data-active-content=".items-category-4">
                                        <span class="aztabs-tab-label">
                        Tops
					</span>
                </li>
                                                                                    <li class="aztabs-tab  "
                    data-category-id="5"
                    data-active-content=".items-category-5">
                                        <span class="aztabs-tab-label">
                        T-shirts
					</span>
                </li>
                                                                                    <li class="aztabs-tab  "
                    data-category-id="7"
                    data-active-content=".items-category-7">
                                        <span class="aztabs-tab-label">
                        Blouses
					</span>
                </li>
                        </ul>
</div>

                        </div>
                        <!-- End Tabs-->

                        <!--Begin aztabs-items-container-->
                        <div class="aztabs-items-container product_list grid row show-slider">
                                                                                                                                                                                            <div class="aztabs-items   items-category-all">
                                    <div class="aztabs-items-inner zoomOut">
                                                                                    <div class="aztabs-loading"></div>
                                                                            </div>

                                                                    </div>
                                                                                                                                                                                            <div class="aztabs-items  aztabs-items-selected aztabs-items-loaded  items-category-2">
                                    <div class="aztabs-items-inner zoomOut">
                                                                                        
                    
		            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/tshirts/1-faded-short-sleeves-tshirt.html"   title="Faded Short Sleeves T-shirt" >
																<img class="img_1" src="http://localhost/prestashop/1-home_default/faded-short-sleeves-tshirt.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/tshirts/1-faded-short-sleeves-tshirt.html" title="Quick View" data-rel="http://localhost/prestashop/tshirts/1-faded-short-sleeves-tshirt.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/tshirts/1-faded-short-sleeves-tshirt.html"
										   data-id-product="1"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=1&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="1">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/tshirts/1-faded-short-sleeves-tshirt.html"
							   title="Faded Short Sleeves T-shirt"   >
								Faded Short Sleeves T-shirt
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																		<span itemprop="price" class="price product-price">
										$16.51									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/blouses/2-blouse.html"   title="Blouse" >
																<img class="img_1" src="http://localhost/prestashop/7-home_default/blouse.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/blouses/2-blouse.html" title="Quick View" data-rel="http://localhost/prestashop/blouses/2-blouse.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/blouses/2-blouse.html"
										   data-id-product="2"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=2&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="2">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/blouses/2-blouse.html"
							   title="Blouse"   >
								Blouse
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																		<span itemprop="price" class="price product-price">
										$27.00									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/casual-dresses/3-printed-dress.html"   title="Printed Dress" >
																<img class="img_1" src="http://localhost/prestashop/8-home_default/printed-dress.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/casual-dresses/3-printed-dress.html" title="Quick View" data-rel="http://localhost/prestashop/casual-dresses/3-printed-dress.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/casual-dresses/3-printed-dress.html"
										   data-id-product="3"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=3&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="3">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/casual-dresses/3-printed-dress.html"
							   title="Printed Dress"   >
								Printed Dress
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																		<span itemprop="price" class="price product-price">
										$26.00									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/evening-dresses/4-printed-dress.html"   title="Printed Dress" >
																<img class="img_1" src="http://localhost/prestashop/10-home_default/printed-dress.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/evening-dresses/4-printed-dress.html" title="Quick View" data-rel="http://localhost/prestashop/evening-dresses/4-printed-dress.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/evening-dresses/4-printed-dress.html"
										   data-id-product="4"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=4&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="4">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/evening-dresses/4-printed-dress.html"
							   title="Printed Dress"   >
								Printed Dress
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																		<span itemprop="price" class="price product-price">
										$50.99									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/summer-dresses/5-printed-summer-dress.html"   title="Printed Summer Dress" >
																<img class="img_1" src="http://localhost/prestashop/12-home_default/printed-summer-dress.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
							<span class="sale-box">-5%</span>
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/summer-dresses/5-printed-summer-dress.html" title="Quick View" data-rel="http://localhost/prestashop/summer-dresses/5-printed-summer-dress.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/summer-dresses/5-printed-summer-dress.html"
										   data-id-product="5"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=5&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="5">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/summer-dresses/5-printed-summer-dress.html"
							   title="Printed Summer Dress"   >
								Printed Summer Dress
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																			
										<span class="old-price product-price">
											$30.51
										</span>
										
										<!--											<span class="price-percent-reduction">-5 %</span>
										-->
																		<span itemprop="price" class="price product-price">
										$28.98									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/summer-dresses/6-printed-summer-dress.html"   title="Printed Summer Dress" >
																<img class="img_1" src="http://localhost/prestashop/16-home_default/printed-summer-dress.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/summer-dresses/6-printed-summer-dress.html" title="Quick View" data-rel="http://localhost/prestashop/summer-dresses/6-printed-summer-dress.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/summer-dresses/6-printed-summer-dress.html"
										   data-id-product="6"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=6&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="6">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/summer-dresses/6-printed-summer-dress.html"
							   title="Printed Summer Dress"   >
								Printed Summer Dress
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																		<span itemprop="price" class="price product-price">
										$30.50									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
            
					<div class="aztabs-item ajax_block_product" data-anijs="if: scroll, on: window, do: flipInY animated, before: scrollReveal">
        			<div class="product-container" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						
													<a class="product-image" href="http://localhost/prestashop/summer-dresses/7-printed-chiffon-dress.html"   title="Printed Chiffon Dress" >
																<img class="img_1" src="http://localhost/prestashop/20-home_default/printed-chiffon-dress.jpg" alt=""/>
								
							</a>
												
						
						<div class="label-box">
															<span class="new-box">New</span>
														
							<span class="sale-box">-20%</span>
													</div>
						
													<div class="button-container">
																	
																
								<!--   Enable quick view   -->
																	<a class="quick-view" href="http://localhost/prestashop/summer-dresses/7-printed-chiffon-dress.html" title="Quick View" data-rel="http://localhost/prestashop/summer-dresses/7-printed-chiffon-dress.html">
										<i class="fa fa-search"></i>
									</a>
																
																		<a class="add_to_compare" title="Add to compare"
										   href="http://localhost/prestashop/summer-dresses/7-printed-chiffon-dress.html"
										   data-id-product="7"><i class="fa fa-exchange"></i></a>
																</div>
								
																																					<div class="button-cart">
																							<a class="button ajax_add_to_cart_button btn btn-default cart_button"
												   href="http://localhost/prestashop/cart?add=1&amp;id_product=7&amp;token=7ce1b0bf85534188244fceb6d0ddda23"
												   rel="nofollow" title="Add to cart"
												   data-id-product="7">
													<span>Add to cart</span>
												</a>
																															</div>
																								
												
					</div>
					
					
				</div>
				
				<div class="right-block">
					<!--  Show Product title  -->
											<h5 itemprop="name" class="product-name">
							<a href="http://localhost/prestashop/summer-dresses/7-printed-chiffon-dress.html"
							   title="Printed Chiffon Dress"   >
								Printed Chiffon Dress
							</a>
						</h5>
										
					<!--  Show average rating stars  -->
					
					
					<!--   Show category description   -->
					 					
					<!--Product Prices-->
																										
								
								
								
														<div itemprop="offers" itemscope
								 itemtype="http://schema.org/Offer" class="price-box">
																	
																			
										<span class="old-price product-price">
											$20.50
										</span>
										
										<!--											<span class="price-percent-reduction">-20 %</span>
										-->
																		<span itemprop="price" class="price product-price">
										$16.40									</span>
									<meta itemprop="priceCurrency"
										  content="USD"/>
									
									
															</div>
																
									</div>
				
			</div>
            
        			</div>
			<!-- End item-->
		        
        
    

                                                                            </div>

                                                                    </div>
                                                                                                                                                                                            <div class="aztabs-items   items-category-3">
                                    <div class="aztabs-items-inner zoomOut">
                                                                                    <div class="aztabs-loading"></div>
                                                                            </div>

                                                                    </div>
                                                                                                                                                                                            <div class="aztabs-items   items-category-4">
                                    <div class="aztabs-items-inner zoomOut">
                                                                                    <div class="aztabs-loading"></div>
                                                                            </div>

                                                                    </div>
                                                                                                                                                                                            <div class="aztabs-items   items-category-5">
                                    <div class="aztabs-items-inner zoomOut">
                                                                                    <div class="aztabs-loading"></div>
                                                                            </div>

                                                                    </div>
                                                                                                                                                                                            <div class="aztabs-items   items-category-7">
                                    <div class="aztabs-items-inner zoomOut">
                                                                                    <div class="aztabs-loading"></div>
                                                                            </div>

                                                                    </div>
                                                    </div>
                    </div>
                    <!--End aztabs-wrap-->
                </div>

                
<script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function ($) {
        ;
        (function (element) {
            var $element = $(element),
                    $tab = $(".aztabs-tab", $element),
                    $tab_label = $(".aztabs-tab-label", $tab),
                    $tabs = $(".aztabs-tabs", $element),
                    ajax_url = baseDir + "modules/aztabs/aztabs_ajax.php",
                    effect = $tabs.parents(".aztabs-tabs-container").attr("data-effec"),
                    delay = $tabs.parents(".aztabs-tabs-container").attr("data-delay"),
                    duration = $tabs.parents(".aztabs-tabs-container").attr("data-duration"),
                    rl_moduleid = $tabs.parents(".aztabs-tabs-container").attr("data-modid"),
					hook_name = $tabs.parents(".aztabs-tabs-container").attr("data-hookname"),
                    $items_content = $(".aztabs-items", $element),
                    $items_inner = $(".aztabs-items-inner", $items_content),
                    $items_first_active = $(".aztabs-items-selected", $element),
                    $load_more = $(".aztabs-loadmore", $element),
                    $btn_loadmore = $(".aztabs-loadmore-btn", $load_more),
                    $select_box = $(".aztabs-selectbox", $element),
                    $tab_label_select = $(".aztabs-tab-selected", $element);

            enableSelectBoxes();
            function enableSelectBoxes() {
                $tab_wrap = $(".aztabs-tabs-wrap", $element),
                        $tab_label_select.html($(".aztabs-tab", $element).filter(".tab-sel").children(".aztabs-tab-label").html());
                if ($(window).innerWidth() <= 479) {
                    $tab_wrap.addClass("aztabs-selectbox");
                } else {
                    $tab_wrap.removeClass("aztabs-selectbox");
                }
            }

            $("span.aztabs-tab-selected, span.aztabs-tab-arrow", $element).click(function () {
                if ($(".aztabs-tabs", $element).hasClass("aztabs-open")) {
                    $(".aztabs-tabs", $element).removeClass("aztabs-open");
                } else {
                    $(".aztabs-tabs", $element).addClass("aztabs-open");
                }
            });

            $(window).resize(function () {
                if ($(window).innerWidth() <= 479) {
                    $(".aztabs-tabs-wrap", $element).addClass("aztabs-selectbox");
                } else {
                    $(".aztabs-tabs-wrap", $element).removeClass("aztabs-selectbox");
                }
            });

            function showAnimateItems(el) {
                var $_items = $(".new-aztabs-item", el), nub = 0;
                $(".aztabs-loadmore-btn", el).fadeOut("fast");
                $_items.each(function (i) {
                    nub++;
                    switch (effect) {
                        case "none" :
                        
                            $(this).css({"opacity": "1", "filter": "alpha(opacity = 100)"});
                            break;
                            
                        default:
                            animatesItems($(this), nub * delay, i, el);
                    }
                    if (i == $_items.length - 1) {
                        $(".aztabs-loadmore-btn", el).fadeIn(delay);
                    }
                    $(this).removeClass("new-aztabs-item");
                });
            }

            function animatesItems($this, fdelay, i, el) {
                var $_items = $(".aztabs-item", el);
                $this.attr("style",
                        "-webkit-animation:" + effect + " " + duration + "ms;"
                        + "-moz-animation:" + effect + " " + duration + "ms;"
                        + "-o-animation:" + effect + " " + duration + "ms;"
                        + "-moz-animation-delay:" + fdelay + "ms;"
                        + "-webkit-animation-delay:" + fdelay + "ms;"
                        + "-o-animation-delay:" + fdelay + "ms;"
                        + "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({
                            opacity: 1,
                            filter: "alpha(opacity = 100)"
                        }, {
                            delay: 100
                        });
                if (i == ($_items.length - 1)) {
                    $(".aztabs-items-inner").addClass("play");
                }
            }

            showAnimateItems($items_first_active);
            $tab.on("click.tab", function () {
                var $this = $(this);
                if ($this.hasClass("tab-sel")) return false;
                if ($this.parents(".aztabs-tabs").hasClass("aztabs-open")) {
                    $this.parents(".aztabs-tabs").removeClass("aztabs-open");
                }
                $tab.removeClass("tab-sel");
                $this.addClass("tab-sel");
                var items_active = $this.attr("data-active-content");
                var _items_active = $(items_active, $element);

                $items_content.removeClass("aztabs-items-selected");
                _items_active.addClass("aztabs-items-selected");
                $tab_label_select.html($tab.filter(".tab-sel").children(".aztabs-tab-label").html());
                var $loading = $(".aztabs-loading", _items_active);
                var loaded = _items_active.hasClass("aztabs-items-loaded");
                if (!loaded && !_items_active.hasClass("aztabs-process")) {
                    _items_active.addClass("aztabs-process");
                    var category_id = $this.attr("data-category-id");
                    $loading.show();
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: {
                            tabs_moduleid: rl_moduleid,
                            is_ajax_tabs: 1,
                            ajax_reslisting_start: 0,
                            categoryid: category_id,
							hook_name: hook_name
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(".aztabs-items-inner", _items_active).html(data.items_markup);
                                _items_active.addClass("aztabs-items-loaded").removeClass("aztabs-process");
                                $loading.remove();
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);

                                                                CreateProSlider($(".aztabs-items-inner", _items_active));
                                                            }
                        },
                        dataType: "json"
                    });
                } else {
                    
                                        var owl = $(".aztabs-items-inner", _items_active);
                    owl = owl.data("owlCarousel");
                    if (typeof owl === "undefined") {
                    } else {
                        owl.onResize();
                    }
                                    }
            });

            function updateStatus($el) {
                $(".aztabs-loadmore-btn", $el).removeClass("loading");
                var countitem = $(".aztabs-item", $el).length;
                
                $(".aztabs-image-loading", $el).css({display: "none"});
                
                $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_start", countitem);
                var rl_total = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_total");
                var rl_load = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_load");
                var rl_allready = $(".aztabs-loadmore-btn", $el).parent().attr("data-rl_allready");

                if (countitem >= rl_total) {
                    $(".aztabs-loadmore-btn", $el).addClass("loaded");
                    
                    $(".aztabs-image-loading", $el).css({display: "none"});
                    
                    $(".aztabs-loadmore-btn", $el).attr("data-label", rl_allready);
                    $(".aztabs-loadmore-btn", $el).removeClass("loading");
                }
            }

            $btn_loadmore.on("click.loadmore", function () {
                var $this = $(this);
                if ($this.hasClass("loaded") || $this.hasClass("loading")) {
                    return false;
                } else {
                    $this.addClass("loading");
                    
                    $(".aztabs-image-loading", $this).css({display: "inline-block"});
                    
                    var rl_start = $this.parent().attr("data-rl_start"),
                            rl_moduleid = $this.parent().attr("data-modid"),
							lt_hook_name = $this.parent().attr("data-hookname"),
                            rl_ajaxurl = baseDir + "modules/aztabs/aztabs_ajax.php",
                            effect = $this.parent().attr("data-effect"),
                            category_id = $this.parent().attr("data-categoryid"),
                            items_active = $this.parent().attr("data-active-content");
                    var _items_active = $(items_active, $element);

                    $.ajax({
                        type: "POST",
                        url: rl_ajaxurl,
                        data: {
                            tabs_moduleid: rl_moduleid,
                            is_ajax_tabs: 1,
                            ajax_reslisting_start: rl_start,
                            categoryid: category_id,
							hook_name: lt_hook_name
                        },
                        success: function (data) {
                            if (data.items_markup != "") {
                                $(data.items_markup).insertAfter($(".aztabs-item", _items_active).nextAll().last());
                                
                                $(".aztabs-image-loading", $this).css({display: "none"});
                                
                                showAnimateItems(_items_active);
                                updateStatus(_items_active);
                            }
                        }, dataType: "json"
                    });
                }
                return false;
            });

            
            if ($(".aztabs-items-inner", $element).parent().hasClass("aztabs-items-selected")) {
                var items_active = $(".aztabs-tab.tab-sel", $element).attr("data-active-content");
                var _items_active = $(items_active, $element);
                CreateProSlider($(".aztabs-items-inner", _items_active));
            }

            function CreateProSlider($items_inner) {
                $items_inner.owlCarousel({
                    center: false,
                    nav: false,
                    loop: true,
                    margin: 0,
                    slideBy: 1,
                    autoplay: false,
                    autoplayHoverPause: true,
                    autoplayTimeout: 1000,
                    autoplaySpeed: 1000,
                    navSpeed: 1000,
                    smartSpeed: 1000,
                    startPosition: 1,
                    mouseDrag: true,
                    touchDrag:true,
                    pullDrag:true,
                    dots: false,
                    autoWidth: false,
                    navClass: ["owl-prev", "owl-next"],
                    navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
                    
                    responsive: {
						0: {items:1 },
                        480: {items:2 },
                        768: {items:3},
                        992: {items:4},
                        1200: {items: 4}
                    }
                });
            }
            
        })("#az_tabs_2_147849493924697");
    });
    //]]>
</script>

            </div>
            <!-- End AZ Tabs -->




<?php }} ?>
