<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:16
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\aztabs\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7045581dd0246b19e5-65631610%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4a2084416132408de9eb554422d14cbb2d75ccc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7045581dd0246b19e5-65631610',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'items' => 0,
    'moduleclass_sfx' => 0,
    'cookie' => 0,
    'rand' => 0,
    'randid' => 0,
    'condition' => 0,
    'tag_id' => 0,
    'base_dir' => 0,
    'hook_name' => 0,
    'class_condition' => 0,
    '_list' => 0,
    'item' => 0,
    'cls' => 0,
    'cls2' => 0,
    'cls_animate' => 0,
    'child_items' => 0,
    'classloaded' => 0,
    'id_caterogy' => 0,
    'classloaded_2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd0248a2971_75631461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd0248a2971_75631461')) {function content_581dd0248a2971_75631461($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.math.php';
?>

<!-- AZ Tabs -->
<?php if (isset($_smarty_tpl->tpl_vars['list']->value)&&!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['list']->value)&&!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
        <?php  $_smarty_tpl->tpl_vars['items'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['items']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['items']->key => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars['_list'] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->products, null, 0);?>
            <?php $_smarty_tpl->tpl_vars["moduleclass_sfx"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['items']->value->params['moduleclass_sfx']) ? $_smarty_tpl->tpl_vars['items']->value->params['moduleclass_sfx'] : '', null, 0);?>
            <div class="az_module <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['moduleclass_sfx']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                <?php if (isset($_smarty_tpl->tpl_vars['items']->value->title_module[$_smarty_tpl->tpl_vars['cookie']->value->id_lang])&&$_smarty_tpl->tpl_vars['items']->value->params['display_title_module']) {?>
                    <div class="az_titleModule titleFont">
                        <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->title_module[$_smarty_tpl->tpl_vars['cookie']->value->id_lang], ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                <?php }?>

                <?php echo smarty_function_math(array('equation'=>'rand()','assign'=>'rand'),$_smarty_tpl);?>

                <?php $_smarty_tpl->tpl_vars['randid'] = new Smarty_variable((strtotime("now")).($_smarty_tpl->tpl_vars['rand']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["tag_id"] = new Smarty_variable("az_tabs_".((string)$_smarty_tpl->tpl_vars['items']->value->id_aztabs)."_".((string)$_smarty_tpl->tpl_vars['randid']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["class_ltabs"] = new Smarty_variable(((((((("ltabs01-").($_smarty_tpl->tpl_vars['items']->value->params['nb_column1'])).(' ltabs02-')).($_smarty_tpl->tpl_vars['items']->value->params['nb_column2'])).(' ltabs03-')).($_smarty_tpl->tpl_vars['items']->value->params['nb_column3'])).(' ltabs04-')).($_smarty_tpl->tpl_vars['items']->value->params['nb_column4']), null, 0);?>
                
                <?php $_smarty_tpl->tpl_vars["center"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['center']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["nav"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['nav']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["loop"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['loop']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["margin"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['margin']>=0 ? $_smarty_tpl->tpl_vars['items']->value->params['margin'] : 5, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["slideBy"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['slideBy']>=0 ? $_smarty_tpl->tpl_vars['items']->value->params['slideBy'] : 1, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["autoplay"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['autoplay']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["autoplayTimeout"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['autoplayTimeout']>0 ? $_smarty_tpl->tpl_vars['items']->value->params['autoplayTimeout'] : 2000, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["autoplayHoverPause"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['autoplayHoverPause']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["autoplaySpeed"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['autoplaySpeed']>0 ? $_smarty_tpl->tpl_vars['items']->value->params['autoplaySpeed'] : 2000, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["navSpeed"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['navSpeed']>0 ? $_smarty_tpl->tpl_vars['items']->value->params['navSpeed'] : 2000, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["smartSpeed"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['smartSpeed']>0 ? $_smarty_tpl->tpl_vars['items']->value->params['smartSpeed'] : 2000, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["startPosition"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['startPosition']>=0 ? $_smarty_tpl->tpl_vars['items']->value->params['startPosition'] : 0, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["mouseDrag"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['mouseDrag']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["touchDrag"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['touchDrag']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["pullDrag"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['pullDrag']==1 ? 'true' : 'false', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["condition"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['show_loadmore_slider']=='slider' ? true : false, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["effect_show"] = new Smarty_variable($_smarty_tpl->tpl_vars['condition']->value==true ? '' : $_smarty_tpl->tpl_vars['items']->value->params['effect'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["class_condition"] = new Smarty_variable($_smarty_tpl->tpl_vars['condition']->value==true ? 'show-slider' : 'show-loadmore', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["language_site"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->language_site=='true' ? 'true' : 'false', null, 0);?>
                
                
                <div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag_id']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="az_tabs first-load">
                    <div class="aztabs-wrap">
                        <!--Begin Tabs-->
                        <div class="aztabs-tabs-container"
                             data-delay="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['interval'], ENT_QUOTES, 'UTF-8', true);?>
"
                             data-duration="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['duration'], ENT_QUOTES, 'UTF-8', true);?>
"
                             data-effect="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['effect'], ENT_QUOTES, 'UTF-8', true);?>
"
                             data-ajaxurl="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                             data-modid="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->id_aztabs, ENT_QUOTES, 'UTF-8', true);?>
"
							 data-hookname="<?php echo $_smarty_tpl->tpl_vars['hook_name']->value;?>
">
                            <?php echo $_smarty_tpl->getSubTemplate ("./default_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                        </div>
                        <!-- End Tabs-->

                        <!--Begin aztabs-items-container-->
                        <div class="aztabs-items-container product_list grid row <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['class_condition']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                <?php $_smarty_tpl->tpl_vars["child_items"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['item']->value['child']) ? $_smarty_tpl->tpl_vars['item']->value['child'] : '', null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["cls_animate"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['effect'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["cls"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['item']->value['sel'])&&$_smarty_tpl->tpl_vars['item']->value['sel']=='sel' ? ' aztabs-items-selected aztabs-items-loaded' : '', null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["cls2"] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['id_category']=="*" ? ' items-category-all' : (' items-category-').($_smarty_tpl->tpl_vars['item']->value['id_category']), null, 0);?>
                                <div class="aztabs-items <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cls']->value, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cls2']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                                    <div class="aztabs-items-inner <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cls_animate']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                                        <?php if (!empty($_smarty_tpl->tpl_vars['child_items']->value)) {?>
                                            <?php echo $_smarty_tpl->getSubTemplate ("./default_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                                        <?php } else { ?>
                                            <div class="aztabs-loading"></div>
                                        <?php }?>
                                    </div>

                                    <?php if ($_smarty_tpl->tpl_vars['items']->value->params['show_loadmore_slider']=='loadmore') {?>
                                    <?php $_smarty_tpl->tpl_vars["classloaded"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['count_number']>=$_smarty_tpl->tpl_vars['item']->value['count']||$_smarty_tpl->tpl_vars['items']->value->params['count_number']==0 ? 'loaded' : '', null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars["classloaded_2"] = new Smarty_variable($_smarty_tpl->tpl_vars['classloaded']->value ? 'All Ready' : 'Show All', null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars["id_caterogy"] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['id_category']=='*' ? 'all' : $_smarty_tpl->tpl_vars['item']->value['id_category'], null, 0);?>
                                    <div class="load-clear"></div>
                                    <div class="aztabs-loadmore"
                                         data-active-content=".items-category-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_caterogy']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                         data-categoryid="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id_category'], ENT_QUOTES, 'UTF-8', true);?>
"
                                         data-rl_start="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['count_number'], ENT_QUOTES, 'UTF-8', true);?>
"
                                         data-rl_total="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['count'], ENT_QUOTES, 'UTF-8', true);?>
"
                                         data-rl_allready="All Ready"
                                         data-ajaxurl="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                         data-modid="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->id_aztabs, ENT_QUOTES, 'UTF-8', true);?>
"
                                         data-rl_load="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->params['count_number'], ENT_QUOTES, 'UTF-8', true);?>
"
										 data-hookname="<?php echo $_smarty_tpl->tpl_vars['hook_name']->value;?>
">
                                        <div class="aztabs-loadmore-btn <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['classloaded']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                             data-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['classloaded_2']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                                            <span class="aztabs-image-loading"></span>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--End aztabs-wrap-->
                </div>

                <?php echo $_smarty_tpl->getSubTemplate ("./default_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


            </div>
        <?php } ?>
    <?php } else { ?>
        <?php echo smartyTranslate(array('s'=>'Has no content to show! In Module aztabs','mod'=>'aztabs'),$_smarty_tpl);?>

    <?php }?>
<?php }?>
<!-- End AZ Tabs -->




<?php }} ?>
