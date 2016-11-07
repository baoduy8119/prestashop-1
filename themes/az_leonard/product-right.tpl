	
	

	<div class="primary_block col-lg-9 col-md-9 col-sm-8 " id="product_left">
		<div class="row">
			{if isset($adminActionDisplay) && $adminActionDisplay}
				<div id="admin-action">
					<p>{l s='This product is not visible to your customers.'}
						<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
						<input type="submit" value="{l s='Publish'}" name="publish_button" class="exclusive" />
						<input type="submit" value="{l s='Back'}" name="lnk_view" class="exclusive" />
					</p>
					<p id="admin-action-result"></p>
				</div>
			{/if}
			{if isset($confirmation) && $confirmation}
				<p class="confirmation">
					{$confirmation}
				</p>
			{/if}
			<!-- left infos-->
			<div class="pb-left-column col-lg-5 col-md-5 col-sm-12 col-xs-12">
				
				
				<!-- product img-->
				<div id="image-block">
					{if $product->new || $product->on_sale}
						<div class="label-box">
							{if $product->new}
								<span class="new-box">
									<span class="new-label">{l s='New'}</span>
								</span>
							{/if}
							{if $product->on_sale}
								<span class="sale-box no-print">
									<span class="sale-label">{l s='Sale!'}</span>
								</span>
							{elseif $product->specificPrice && $product->specificPrice.reduction && $productPriceWithoutReduction > $productPrice}
								<span class="sale-box">{l s='Sale!'}</span>
							{/if}
						</div>
					{/if}
					
					<span id="view_full_size">
						{if $jqZoomEnabled && $have_image && !$content_only}
							<a class="jqzoom" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" rel="gal1" href="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox_default')|escape:'html':'UTF-8'}" itemprop="url">
								<img itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}"/>
							</a>
						{else}
							<img id="bigpic" {if !$content_only} data-zoom-image="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox_default')|escape:'html':'UTF-8'}" {/if} itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" />
						{/if}
					</span>
					
				</div> <!-- end image-block -->
				
				<!-- thumbnails -->
				{if isset($images) && count($images) > 0}
					<div id="views_block">
						<div id="thumbs_list">
							{if isset($images)}
								{foreach from=$images item=image name=thumbnails}
									{assign var=imageIds value="`$product->id`-`$image.id_image`"}
									{if !empty($image.legend)}
										{assign var=imageTitle value=$image.legend|escape:'html':'UTF-8'}
									{else}
										{assign var=imageTitle value=$product->name|escape:'html':'UTF-8'}
									{/if}
									<div id="thumbnail_{$image.id_image}" class="thumbnail_image {if $smarty.foreach.thumbnails.last} last{/if}">
										<a{if $jqZoomEnabled && $have_image && !$content_only} href="javascript:void(0);" rel="{literal}{{/literal}gallery: 'gal1', smallimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}',largeimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}'{literal}}{/literal}"{else} href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}"	data-fancybox-group="gallery" class="fancybox{if $image.id_image == $cover.id_image} shown{/if}"{/if} title="{$imageTitle}">
											<img class="img-responsive" id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'small_default')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}"  itemprop="image" />
										</a>
									</div>
								{/foreach}
							{/if}
						</div>
						
					</div> <!-- end views-block -->
					<!-- end thumbnails -->
				{/if}

				{if isset($images) && count($images) > 1}
					<p class="resetimg clear no-print">
						<span id="wrapResetImages" style="display: none;">
							<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" name="resetImages">
								<i class="fa fa-repeat"></i>
								{l s='Display all pictures'}
							</a>
						</span>
					</p>
				{/if}
			</div> <!-- end pb-left-column -->
			<!-- end left infos-->
			
			<!-- Right infos -->
			<div class="pb-right-column col-lg-7 col-md-7 col-sm-12 col-xs-12">
				{if $product->online_only}
					<p class="online_only">{l s='Online only'}</p>
				{/if}
				<h1 class="product_name" itemprop="name">{$product->name|escape:'html':'UTF-8'}</h1>
				
				
				<!-- h=displayRightColumnProduct / Product Comments -->
				{if isset($nbComments) && $AZ_productRating }
					<div class="comments_note" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
						<div class="star_content">
							{section name="i" start=0 loop=5 step=1}
								{if $averageTotal le $smarty.section.i.index}
									<div class="star"></div>
								{else}
									<div class="star star_on"></div>
								{/if}
							{/section}
							<meta itemprop="worstRating" content = "0" />
							<meta itemprop="ratingValue" content = "{if isset($ratings.avg)}{$ratings.avg|round:1|escape:'html':'UTF-8'}{else}{$averageTotal|round:1|escape:'html':'UTF-8'}{/if}" />
							<meta itemprop="bestRating" content = "5" />
						</div>
						
						<ul class="comments_advices">
							<li class="nb-comments">
								<a class="reviews">
									 <span itemprop="reviewCount">{$nbComments} reviews</span>
								</a>
							</li>
							
							{if ($too_early == false AND ($is_logged OR $allow_guests))}
								<li class="write-comments">
									<a class="open-comment-form" href="#new_comment_form">
										{l s='Add your review' mod='productcomments'}
									</a>
								</li>
							{/if}
						</ul>
					</div>
				{/if}
				
				<div class="content_prices clearfix">
					{if $product->show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
						<!-- prices -->
						<div class="price">
							<p class="our_price_display" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								{if $product->quantity > 0}<link itemprop="availability" href="http://schema.org/InStock"/>{/if}
								{if $priceDisplay >= 0 && $priceDisplay <= 2}
									<span id="our_price_display" itemprop="price">{convertPrice price=$productPrice}</span>
									 {if $tax_enabled && $AZ_productTaxLabel == 1}
										{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
									  {/if} 
									<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
									{hook h="displayProductPriceBlock" product=$product type="price"}
								{/if}
							</p>
							
							<p id="reduction_amount" {if !$product->specificPrice || $product->specificPrice.reduction_type != 'amount' || $product->specificPrice.reduction|floatval ==0} style="display:none"{/if}>
								<span id="reduction_amount_display">
								{if $product->specificPrice && $product->specificPrice.reduction_type == 'amount' && $product->specificPrice.reduction|floatval !=0}
									-{convertPrice price=$productPriceWithoutReduction-$productPrice|floatval}
								{/if}
								</span>
							</p>
							<p id="old_price"{if (!$product->specificPrice || !$product->specificPrice.reduction) && $group_reduction == 0} class="hidden"{/if}>
								{if $priceDisplay >= 0 && $priceDisplay <= 2}
									{hook h="displayProductPriceBlock" product=$product type="old_price"}
									<span id="old_price_display">{if $productPriceWithoutReduction > $productPrice}{convertPrice price=$productPriceWithoutReduction}{/if}</span>
									 {if $tax_enabled && $AZ_productTaxLabel == 1}{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}{/if} 
								{/if}
							</p>
							<!--<p id="reduction_percent" {if !$product->specificPrice || $product->specificPrice.reduction_type != 'percentage'} style="display:none;"{/if}>
								<span id="reduction_percent_display">
									{if $product->specificPrice && $product->specificPrice.reduction_type == 'percentage'}-{$product->specificPrice.reduction*100}%{/if}
								</span>
							</p>-->
							{if $priceDisplay == 2}
								<br />
								<span id="pretaxe_price">
									<span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span>
									{l s='tax excl.'}
								</span>
							{/if}
						</div> <!-- end prices -->
						{if $packItems|@count && $productPrice < $product->getNoPackPrice()}
							<p class="pack_price">{l s='Instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
						{/if}
						{if $product->ecotax != 0}
							<p class="price-ecotax">{l s='Including'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='for ecotax'}
								{if $product->specificPrice && $product->specificPrice.reduction}
								<br />{l s='(not impacted by the discount)'}
								{/if}
							</p>
						{/if}
						<!--{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
							{math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
							<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'html':'UTF-8'}</p>
							{hook h="displayProductPriceBlock" product=$product type="unit_price"}
						{/if}-->
					{/if} {*close if for show price*}
					{hook h="displayProductPriceBlock" product=$product type="weight"}
					<div class="clear"></div>
				</div> <!-- end content_prices -->
				
				{if $PS_STOCK_MANAGEMENT}
					<!-- availability -->
					<p id="availability_statut"{if ($product->quantity <= 0 && !$product->available_later && $allow_oosp) || ($product->quantity > 0 && !$product->available_now) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
						{*<span id="availability_label">{l s='Availability:'}</span>*}
						<span id="availability_value"{if $product->quantity <= 0 && !$allow_oosp} class="warning_inline"{/if}>{if $product->quantity <= 0}{if $allow_oosp}{$product->available_later}{else}{l s='This product is no longer in stock'}{/if}{else}{$product->available_now}{/if}</span>
					</p>
					{hook h="displayProductDeliveryTime" product=$product}
					<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties || $product->quantity <= 0) || $allow_oosp || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none"{/if} >{l s='Warning: Last items in stock!'}</p>
				{/if}
				<p id="availability_date"{if ($product->quantity > 0) || !$product->available_for_order || $PS_CATALOG_MODE || !isset($product->available_date) || $product->available_date < $smarty.now|date_format:'%Y-%m-%d'} style="display: none;"{/if}>
					<span id="availability_date_label">{l s='Availability date:'}</span>
					<span id="availability_date_value">{dateFormat date=$product->available_date full=false}</span>
				</p>
				<!-- Out of stock hook -->
				<div id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>
					{$HOOK_PRODUCT_OOS}
				</div>
				
				<div class="product-code">
					<label>{l s='Product code :'} </label>
					<span>{$product->reference|escape:'html':'UTF-8'}</span>
				</div>
				<!--<ul class="product_reference inline">
					<li id="product_reference"{if empty($product->reference) || !$product->reference} style="display: none;"{/if}>
						<label>{l s='Model:'} </label>
						<span class="editable" itemprop="sku">{if !isset($groups)}{$product->reference|escape:'html':'UTF-8'}{/if}</span>
					</li>
					{if $product->condition}
					<li id="product_condition">
						<label>{l s='Condition: '} </label>
						{if $product->condition == 'new'}
							<link itemprop="itemCondition" href="http://schema.org/NewCondition"/>
							<span class="editable">{l s='New'}</span>
						{elseif $product->condition == 'used'}
							<link itemprop="itemCondition" href="http://schema.org/UsedCondition"/>
							<span class="editable">{l s='Used'}</span>
						{elseif $product->condition == 'refurbished'}
							<link itemprop="itemCondition" href="http://schema.org/RefurbishedCondition"/>
							<span class="editable">{l s='Refurbished'}</span>
						{/if}
					</li>
					{/if}
				</ul>
				-->
				
				{if $AZ_producShortdesc || $packItems|@count > 0}
					<div id="short_description_block">
						{if $product->description_short}
							<div id="short_description_content" class="rte align_justify" itemprop="description">{$product->description_short}</div>
						{/if}

						
						{if $packItems|@count > 0}
							<div class="short_description_pack">
							<h3>{l s='Pack content'}</h3>
								{foreach from=$packItems item=packItem}

								<div class="pack_content">
									{$packItem.pack_quantity} x <a href="{$link->getProductLink($packItem.id_product, $packItem.link_rewrite, $packItem.category)|escape:'html':'UTF-8'}">{$packItem.name|escape:'html':'UTF-8'}</a>
									<p>{$packItem.description_short}</p>
								</div>
								{/foreach}
							</div>
						{/if}
					</div> <!-- end short_description_block -->
				{/if}
	
				<!--{if ($display_qties == 1 && !$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && $product->available_for_order)}
					
					<p id="pQuantityAvailable"{if $product->quantity <= 0} style="display: none;"{/if}>{l s='Availability: '}
						<span id="quantityAvailable"> {$product->quantity|intval}</span>
						<span {if $product->quantity > 1} style="display: none;"{/if} id="quantityAvailableTxt">{l s='Item'}</span>
						<span {if $product->quantity == 1} style="display: none;"{/if} id="quantityAvailableTxtMultiple">{l s='Items'}</span>
					</p>
				{/if}
				-->
				
				{if ($product->show_price && !isset($restricted_country_mode)) || isset($groups) || $product->reference || (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}
				<!-- add to cart form-->
				<form id="buy_block"{if $PS_CATALOG_MODE && !isset($groups) && $product->quantity > 0} class="hidden"{/if} action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">
					<!-- hidden datas -->
					<p class="hidden">
						<input type="hidden" name="token" value="{$static_token}" />
						<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
						<input type="hidden" name="add" value="1" />
						<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
					</p>
					<div class="box-info-product">
						
						<div class="product_attributes clearfix">
							
							{if isset($groups)}
								<!-- attributes -->
								<div id="attributes">
									<div class="clearfix"></div>
									{foreach from=$groups key=id_attribute_group item=group}
										{if $group.attributes|@count}
											<fieldset class="attribute_fieldset attribute_fieldset_{$id_attribute_group|intval}">
												<label class="attribute_label" {if $group.group_type != 'color' && $group.group_type != 'radio'}for="group_{$id_attribute_group|intval}"{/if}>{$group.name|escape:'html':'UTF-8'} : &nbsp;</label>
												{assign var="groupName" value="group_$id_attribute_group"}
												<div class="attribute_list">
													{if ($group.group_type == 'color')}
														<ul id="color_to_pick_list" class="clearfix">
															{assign var="default_colorpicker" value=""}
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																{assign var='img_color_exists' value=file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}
																<li{if $group.default == $id_attribute} class="selected"{/if}>
																	<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" id="color_{$id_attribute|intval}" name="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" class="color_pick{if ($group.default == $id_attribute)} selected{/if} {if $img_color_exists} have_image {/if}"{if !$img_color_exists && isset($colors.$id_attribute.value) && $colors.$id_attribute.value} style="background:{$colors.$id_attribute.value|escape:'html':'UTF-8'};"{/if} title="{$colors.$id_attribute.name|escape:'html':'UTF-8'}">
																		{if $img_color_exists}
																			<img src="{$img_col_dir}{$id_attribute|intval}.jpg" alt="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" title="{$colors.$id_attribute.name|escape:'html':'UTF-8'}"  />
																		{/if}
																	</a>
																</li>
																{if ($group.default == $id_attribute)}
																	{$default_colorpicker = $id_attribute}
																{/if}
															{/foreach}
														</ul>
														<input type="hidden" class="color_pick_hidden" name="{$groupName|escape:'html':'UTF-8'}" value="{$default_colorpicker|intval}" />
													{elseif ($group.group_type == 'select')}
														<select name="{$groupName}" id="group_{$id_attribute_group|intval}" class="form-control attribute_select no-print">
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'html':'UTF-8'}">{$group_attribute|escape:'html':'UTF-8'}</option>
															{/foreach}
														</select>
													
													{elseif ($group.group_type == 'radio')}
														<ul>
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																<li>
																	<input type="radio" class="attribute_radio" name="{$groupName|escape:'html':'UTF-8'}" value="{$id_attribute}" {if ($group.default == $id_attribute)} checked="checked"{/if} />
																	<span>{$group_attribute|escape:'html':'UTF-8'}</span>
																</li>
															{/foreach}
														</ul>
													{/if}
												</div> <!-- end attribute_list -->
											</fieldset>
										{/if}
									{/foreach}
								</div> <!-- end attributes -->
							{/if}
							
							<!-- quantity wanted -->
							{if !$PS_CATALOG_MODE}
							<div id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
								
								<div class="qty">
									<input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" />
									<a href="#" data-field-qty="qty" class="button-plus product_quantity_up">
										<span>+</span>
									</a>
									<a href="#" data-field-qty="qty" class="button-minus product_quantity_down">
										<span>-</span>
									</a>

								</div>
								
							</div>
							{/if}
							
							
							<div class="box-cart-bottom">
								
								 
								<div{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || (isset($restricted_country_mode) && $restricted_country_mode) || $PS_CATALOG_MODE} class="unvisible"{/if}>
									<p id="add_to_cart" class="buttons_bottom_block no-print">
										<button type="submit" name="Submit" class=" exclusive" title="Add to Cart">
											{if $content_only && (isset($product->customization_required) && $product->customization_required)}{l s='Customize'}{else}{l s='Add to cart'}{/if}</span>
										</button>
									</p>
									
								<!-- h=displayProductButtons / 	Wishlist block  -->
								{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}
								
								{if isset($comparator_max_item) && $comparator_max_item}
								   <div class="compare">
										<a class=" button add_to_compare " href="#" title="{l s='Add to compare'}" data-id-product="{$product->id}"><i class="fa fa-exchange"></i></a>
								   </div>
								 {/if}
									
							</div>
							
							<!-- minimal quantity wanted -->
							<div id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
								{l s='This product is not sold individually. You must select at least'} <b id="minimal_quantity_label">{$product->minimal_quantity}</b> {l s='quantity for this product.'}
							</div>
							
							
							</div> <!-- end product_attributes -->
						
						
						</div> <!-- end box-cart-bottom -->
					</div> <!-- end box-info-product -->
				</form>
				{/if}
				
				<!-- h=displayRightColumnProduct / Product Comments -->
				{if $AZ_share}
					<div class="sharing-buttons">
						<label>{l s='Share Link:'}</label>
						<div class="buttons">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
							<a href="#"><i class="fa fa-rss"></i></a>
						</div>
					</div>
				{/if}
				
				
			</div>
			<!-- end Center infos-->
			
			
		</div> <!-- end primary_block -->
		

		{if !$content_only}
		<div class="moreinfo_block">
			<div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
				{if $product->description}
					<div class="panel panel-default active">
						<div id="headingOne" role="tab" class="panel-heading">
							<h4 class="panel-title titleFont"> 
								<a aria-controls="collapseOne" aria-expanded="false" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">{l s='Description'}</a>
							</h4>
						</div>
						<div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
							<div class="panel-body">
								<div  class="rte">{$product->description}</div>
							</div>
						</div> 
					</div>
				{/if}
				
				{if $features}
					<div class="panel panel-default">
						<div id="headingTwo" role="tab" class="panel-heading">
							<h4 class="panel-title titleFont">
								<a aria-controls="collapseTwo" aria-expanded="false" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">{l s='Information'}</a> 
							</h4>
						</div> 
						<div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="collapseTwo" aria-expanded="false" style="height: 0px;">
							<div class="panel-body"> 
								<table class="table-data-sheet">
									{foreach from=$features item=feature}
									<tr class="{cycle values="odd,even"}">
										{if isset($feature.value)}
											<td>{$feature.name|escape:'html':'UTF-8'}</td>
											<td>{$feature.value|escape:'html':'UTF-8'}</td>
										{/if}
									</tr>
									{/foreach}
								</table>
							</div>
						</div>
					</div>
				{/if}
				
				<div class="panel panel-default">
					<div id="headingThree" role="tab" class="panel-heading">
						<h4 class="panel-title titleFont">
							<a aria-controls="collapseThree" aria-expanded="false" href="#collapseThree" data-parent="#accordion" data-toggle="collapse" role="button" class="">{l s='Customer Reviews'}</a>
						</h4>
					</div> 
					<div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;"> 
						<div class="panel-body">
							{if isset($HOOK_PRODUCT_TAB_CONTENT) && $HOOK_PRODUCT_TAB_CONTENT}{$HOOK_PRODUCT_TAB_CONTENT}{/if}
						</div>
					</div>
				</div>
				
				{if isset($attachments) && $attachments}
					<div class="panel panel-default">
						<div id="headingFour" role="tab" class="panel-heading">
							<h4 class="panel-title titleFont">
								<a aria-controls="collapseFour" aria-expanded="false" href="#collapseFour" data-parent="#accordion" data-toggle="collapse" role="button" class="">{l s='Download'}</a>
							</h4>
						</div> 
						<div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="collapseFour" aria-expanded="false" style="height: 0px;"> 
							<div class="panel-body">
								{foreach from=$attachments item=attachment name=attachements}
									{if $smarty.foreach.attachements.iteration %3 == 1}<div class="row">{/if}
										<div class="col-lg-4">
											<h4><a href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}">{$attachment.name|escape:'html':'UTF-8'}</a></h4>
											<p class="text-muted">{$attachment.description|escape:'html':'UTF-8'}</p>
											<a class="btn btn-default btn-block" href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}">
												<i class="fa fa-download"></i>
												{l s="Download"} ({Tools::formatBytes($attachment.file_size, 2)})
											</a>
											<hr />
										</div>
									{if $smarty.foreach.attachements.iteration %3 == 0 || $smarty.foreach.attachements.last}</div>{/if}
								{/foreach}
							</div>
						</div>
					</div>
				{/if}
				
				{if isset($product) && $product->customizable}
					<div class="panel panel-default">
						<div id="headingFive" role="tab" class="panel-heading">
							<h4 class="panel-title titleFont">
								<a aria-controls="collapseFive" aria-expanded="false" href="#collapseFive" data-parent="#accordion" data-toggle="collapse" role="button" class="">{l s='Product customization'}</a>
							</h4>
						</div> 
						<div aria-labelledby="headingFive" role="tabpanel" class="panel-collapse collapse" id="collapseFive" aria-expanded="false" style="height: 0px;"> 
							<div class="panel-body">
								<form method="post" action="{$customizationFormTarget}" enctype="multipart/form-data" id="customizationForm" class="clearfix">
									<p class="infoCustomizable">
										{l s='After saving your customized product, remember to add it to your cart.'}
										{if $product->uploadable_files}
										<br />
										{l s='Allowed file formats are: GIF, JPG, PNG'}{/if}
									</p>
									{if $product->uploadable_files|intval}
										<div class="customizableProductsFile">
											<h5 class="product-heading-h5">{l s='Pictures'}</h5>
											<ul id="uploadable_files" class="clearfix">
												{counter start=0 assign='customizationField'}
												{foreach from=$customizationFields item='field' name='customizationFields'}
													{if $field.type == 0}
														<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
															{if isset($pictures.$key)}
																<div class="customizationUploadBrowse">
																	<img src="{$pic_dir}{$pictures.$key}_small" alt="" />
																		<a href="{$link->getProductDeletePictureLink($product, $field.id_customization_field)|escape:'html':'UTF-8'}" title="{l s='Delete'}" >
																			<img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" class="customization_delete_icon" width="11" height="13" />
																		</a>
																</div>
															{/if}
															<div class="customizationUploadBrowse form-group">
																<label class="customizationUploadBrowseDescription">
																	{if !empty($field.name)}
																		{$field.name}
																	{else}
																		{l s='Please select an image file from your computer'}
																	{/if}
																	{if $field.required}<sup>*</sup>{/if}
																</label>
																<input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="form-control customization_block_input {if isset($pictures.$key)}filled{/if}" />
															</div>
														</li>
														{counter}
													{/if}
												{/foreach}
											</ul>
										</div>
									{/if}
									{if $product->text_fields|intval}
										<div class="customizableProductsText">
											<h5 class="product-heading-h5">{l s='Text'}</h5>
											<ul id="text_fields">
											{counter start=0 assign='customizationField'}
											{foreach from=$customizationFields item='field' name='customizationFields'}
												{if $field.type == 1}
													<li class="customizationUploadLine{if $field.required} required{/if}">
														<label for ="textField{$customizationField}">
															{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
															{if !empty($field.name)}
																{$field.name}
															{/if}
															{if $field.required}<sup>*</sup>{/if}
														</label>
														<textarea name="textField{$field.id_customization_field}" class="form-control customization_block_input" id="textField{$customizationField}" rows="3" cols="20">{strip}
															{if isset($textFields.$key)}
																{$textFields.$key|stripslashes}
															{/if}
														{/strip}</textarea>
													</li>
													{counter}
												{/if}
											{/foreach}
											</ul>
										</div>
									{/if}
									<p id="customizedDatas">
										<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
										<input type="hidden" name="submitCustomizedDatas" value="1" />
										<button class="button btn btn-default button button-small" name="saveCustomization">
											<span>{l s='Save'}</span>
										</button>
										<span id="ajax-loader" class="unvisible">
											<img src="{$img_ps_dir}loader.gif" alt="loader" />
										</span>
									</p>
								</form>
								<p class="clear required"><sup>*</sup> {l s='required fields'}</p>
							</div>
						</div>
					</div>
				{/if}
				
				{if (isset($quantity_discounts) && count($quantity_discounts) > 0)}
					<div class="panel panel-default">
						<div id="headingSix" role="tab" class="panel-heading">
							<h4 class="panel-title titleFont">
								<a aria-controls="collapseSix" aria-expanded="false" href="#collapseSix" data-parent="#accordion" data-toggle="collapse" role="button" class="">{l s='Discount'}</a>
							</h4>
						</div> 
						<div aria-labelledby="headingSix" role="tabpanel" class="panel-collapse collapse" id="collapseSix" aria-expanded="false" style="height: 0px;"> 
							<div class="panel-body">
								<div id="quantityDiscount">
									<table class="std table-product-discounts">
										<thead>
											<tr>
												<th>{l s='Quantity'}</th>
												<th>{if $display_discount_price}{l s='Price'}{else}{l s='Discount'}{/if}</th>
												<th>{l s='You Save'}</th>
											</tr>
										</thead>
										<tbody>
											{foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}
											<tr id="quantityDiscount_{$quantity_discount.id_product_attribute}" class="quantityDiscount_{$quantity_discount.id_product_attribute}" data-discount-type="{$quantity_discount.reduction_type}" data-discount="{$quantity_discount.real_value|floatval}" data-discount-quantity="{$quantity_discount.quantity|intval}">
												<td>
													{$quantity_discount.quantity|intval}
												</td>
												<td>
													{if $quantity_discount.price >= 0 || $quantity_discount.reduction_type == 'amount'}
														{if $display_discount_price}
															{convertPrice price=$productPrice-$quantity_discount.real_value|floatval}
														{else}
															{convertPrice price=$quantity_discount.real_value|floatval}
														{/if}
													{else}
														{if $display_discount_price}
															{convertPrice price = $productPrice-($productPrice*$quantity_discount.reduction)|floatval}
														{else}
															{$quantity_discount.real_value|floatval}%
														{/if}
													{/if}
												</td>
												<td>
													<span>{l s='Up to'}</span>
													{if $quantity_discount.price >= 0 || $quantity_discount.reduction_type == 'amount'}
														{$discountPrice=$productPrice-$quantity_discount.real_value|floatval}
													{else}
														{$discountPrice=$productPrice-($productPrice*$quantity_discount.reduction)|floatval}
													{/if}
													{$discountPrice=$discountPrice*$quantity_discount.quantity}
													{$qtyProductPrice = $productPrice*$quantity_discount.quantity}
													{convertPrice price=$qtyProductPrice-$discountPrice}
												</td>
											</tr>
											{/foreach}
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				{/if}
				
			</div>

		</div>

	{/if}

</div>

{if !$content_only}
	<div class="left-sidebar col-lg-3 col-md-3 col-sm-4" id="sidebar">
		{hook h="displayLeftColumn"}
	</div>
{/if}

{if !$content_only}
		
	<!-- h=displayFooterProduct | Products in the same category  -->
	{if isset($HOOK_PRODUCT_FOOTER) && $HOOK_PRODUCT_FOOTER}{$HOOK_PRODUCT_FOOTER}{/if}
	
	<!-- description & features -->
	{if (isset($product) && $product->description) || (isset($features) && $features) || (isset($accessories) && $accessories) || (isset($HOOK_PRODUCT_TAB) && $HOOK_PRODUCT_TAB) || (isset($attachments) && $attachments) || isset($product) && $product->customizable}
		
		
	{/if}
	{if isset($packItems) && $packItems|@count > 0}
	<section id="blockpack">
		<h3 class="page-product-heading">{l s='Pack content'}</h3>
		{include file="$tpl_dir./product-list.tpl" products=$packItems}
	</section>
	{/if}
{/if}



<script type="text/javascript">
// <![CDATA[
	$('#thumbs_list').slick({
	  infinite: true,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  arrows: true,
	  responsive: [
		{
		  breakpoint: 992,
		  settings: {
			slidesToShow: 4,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 5,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		  }
		}]
	});
			
// ]]>

	var _acc = $('#accordion');
	$('.panel-default',_acc).each(function(){
		$(this).on('click', function(){
			$('.panel-default',_acc).removeClass('active');
			 $(this).addClass('active')
		});
	});
</script>
	
{if $AZ_zoomImage && !$content_only}
<script>
	$('#bigpic').elevateZoom({
		zoomType: "window",
		cursor: "crosshair",
		zoomWindowFadeIn: 500,
		zoomWindowFadeOut: 750
	}); 
</script>
{/if}
