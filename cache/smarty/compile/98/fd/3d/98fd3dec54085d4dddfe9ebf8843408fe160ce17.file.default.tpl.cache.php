<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 07:58:17
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\azsearchblock\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10586581f28e9447bf2-59076444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98fd3dec54085d4dddfe9ebf8843408fe160ce17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azsearchblock\\default.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10586581f28e9447bf2-59076444',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'items' => 0,
    'moduleclass_sfx' => 0,
    'cookie' => 0,
    'search_query' => 0,
    'display_box_select' => 0,
    'link' => 0,
    'orderby' => 0,
    'orderway' => 0,
    'products' => 0,
    'count' => 0,
    'cat' => 0,
    'pro' => 0,
    'count2' => 0,
    'search_query_value' => 0,
    'n' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f28e95b3204_30298621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f28e95b3204_30298621')) {function content_581f28e95b3204_30298621($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.counter.php';
?>

<!--AZ Search Block-->
<?php if (isset($_smarty_tpl->tpl_vars['list']->value)&&!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['list']->value)&&!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
        <?php  $_smarty_tpl->tpl_vars['items'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['items']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['items']->key => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
?>

            <?php $_smarty_tpl->tpl_vars['_list'] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->products, null, 0);?>

            <?php $_smarty_tpl->tpl_vars["moduleclass_sfx"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['items']->value->params['moduleclass_sfx']) ? $_smarty_tpl->tpl_vars['items']->value->params['moduleclass_sfx'] : '', null, 0);?>
            <?php $_smarty_tpl->tpl_vars["tag_id"] = new Smarty_variable("az_searchblock_".((string)$_smarty_tpl->tpl_vars['items']->value->id_azsearchblock), null, 0);?>
            <div class="az_searchblock <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['moduleclass_sfx']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                <?php if ($_smarty_tpl->tpl_vars['items']->value->params['display_title_module']) {?>
                    <h3 class="az_titleModule">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->title_module[$_smarty_tpl->tpl_vars['cookie']->value->id_lang], ENT_QUOTES, 'UTF-8', true);?>

                    </h3>
                <?php }?>

                <?php $_smarty_tpl->tpl_vars["orderby"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['products_ordering'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["orderway"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['ordering_direction'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["instant_s"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['instant_search'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["ajax_s"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['ajax_search'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["id_module"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['items']->value->id_azsearchblock), null, 0);?>
                <?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)) {?>
                    <?php $_smarty_tpl->tpl_vars["search_query_value"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['search_query']->value), null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["search_query_value"] = new Smarty_variable('', null, 0);?>
                <?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['items']->value->params['display_box_select']) {?>
                    <?php $_smarty_tpl->tpl_vars["display_box_select"] = new Smarty_variable(" show-box", null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["display_box_select"] = new Smarty_variable(" hidden-box", null, 0);?>
                <?php }?>
				
				
                <?php $_smarty_tpl->tpl_vars['products'] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->products, null, 0);?>

				<div class="icon-search">
					<i class="fa fa-search"></i>
				</div>
                
                <div class="az_searchblock-container azsb-preload">
						<form class="azsb_searchform <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['display_box_select']->value, ENT_QUOTES, 'UTF-8', true);?>
"  method="get" action="<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('azsearchblock','catesearch'));?>
">
							<div>
							<input type="hidden" name="fc" value="module"/>
							<input type="hidden" name="module" value="azsearchblock"/>
							<input type="hidden" name="controller" value="catesearch"/>
							<input type="hidden" name="orderby" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderby']->value, ENT_QUOTES, 'UTF-8', true);?>
"/>
							<input type="hidden" name="orderway" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderway']->value, ENT_QUOTES, 'UTF-8', true);?>
"/>
							<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'name'=>'count','assign'=>"count"),$_smarty_tpl);?>

							<?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cat']->key;
?>
								<?php echo smarty_function_counter(array('name'=>'count'),$_smarty_tpl);?>

								<?php if ($_smarty_tpl->tpl_vars['count']->value==1) {?>
									<input type="hidden" name="cat_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cat']->value['id_option'], ENT_QUOTES, 'UTF-8', true);?>
">
								<?php }?>
							<?php } ?>
							
							
								
								
									<div class="azsb_selector_cat">
										<select class="azsb_cat">
											<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'name'=>'count2','assign'=>"count2"),$_smarty_tpl);?>

											<?php  $_smarty_tpl->tpl_vars['pro'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pro']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pro']->key => $_smarty_tpl->tpl_vars['pro']->value) {
$_smarty_tpl->tpl_vars['pro']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['pro']->key;
?>
												<?php echo smarty_function_counter(array('name'=>'count2'),$_smarty_tpl);?>

												<option value="<?php echo $_smarty_tpl->tpl_vars['pro']->value['id_option'];?>
">
													<?php if ($_smarty_tpl->tpl_vars['count2']->value==1) {?>
														<?php echo smartyTranslate(array('s'=>' All Categories','mod'=>'azsearchblock'),$_smarty_tpl);?>

													<?php } else { ?>
														<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pro']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

													<?php }?>
												</option>
											<?php } ?>
										</select>
									</div>
								
								<div class="inputblock">
									<div class="inputtext">
										<input class="azsb_query" type="text" name="search_query"
										   value="<?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['search_query_value']->value, ENT_QUOTES, 'UTF-8', true));?>
"
										   placeholder="<?php echo smartyTranslate(array('s'=>'Enter your keyword here','mod'=>'azsearchblock'),$_smarty_tpl);?>
"/>
									</div>

									<button value="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'azsearchblock'),$_smarty_tpl);?>
" class="azsb_button" type="submit" name="azsb_submitsearch">
										<i class="fa fa-search"></i>
									</button>
									<input value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['n']->value, ENT_QUOTES, 'UTF-8', true);?>
" type="hidden" name="n"/>
								</div>
								
							
							
							
							</div>
						</form>
	
                    
                </div>

                <?php echo $_smarty_tpl->getSubTemplate ("./default_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

            </div>
        <?php } ?>
    <?php } else { ?>
        <?php echo smartyTranslate(array('s'=>'Has no content to show! In Module AZ Search Block','mod'=>'azsearchblock'),$_smarty_tpl);?>

    <?php }?>
<?php }?>

<script type="text/javascript">
// <![CDATA[
	$(document).ready(function($){
		$(".azsb_searchform").addClass('show-form');
		$(".icon-search").click(function(){
			$(this).toggleClass("active").next().slideToggle("medium");
			
		});
	});
// ]]>
</script>

<!--/AZ Search Block--><?php }} ?>
