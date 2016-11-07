<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 07:58:19
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\aztabs\default_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18805581f28eb4a6e61-70294345%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bf7617068a38b22e9103e82f2e681ff4a046269' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\aztabs\\default_tabs.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18805581f28eb4a6e61-70294345',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_list' => 0,
    'tab' => 0,
    'items' => 0,
    'tab_sel' => 0,
    'tab_all' => 0,
    'active_content' => 0,
    'link' => 0,
    'src' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f28eb5a3023_08486715',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f28eb5a3023_08486715')) {function content_581f28eb5a3023_08486715($_smarty_tpl) {?>
<div class="aztabs-tabs-wrap">
    <span class="aztabs-tab-selected"></span>
    <span class="aztabs-tab-arrow">&#9660;</span>
    <ul class="aztabs-tabs cf">
        <?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars["tab_sel"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['tab']->value['sel'])&&$_smarty_tpl->tpl_vars['tab']->value['sel']=='sel' ? '  tab-sel tab-loaded' : '', null, 0);?>
            <?php $_smarty_tpl->tpl_vars["tab_all"] = new Smarty_variable($_smarty_tpl->tpl_vars['tab']->value['id_category']=='*' ? ' tab-all' : '', null, 0);?>
            <?php $_smarty_tpl->tpl_vars["active_content"] = new Smarty_variable($_smarty_tpl->tpl_vars['tab']->value['id_category']=='*' ? 'all' : $_smarty_tpl->tpl_vars['tab']->value['id_category'], null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['items']->value->params['filter_type']=='categories') {?>
                <li class="aztabs-tab <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab_sel']->value, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab_all']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                    data-category-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['id_category'], ENT_QUOTES, 'UTF-8', true);?>
"
                    data-active-content=".items-category-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['active_content']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                    <?php if ($_smarty_tpl->tpl_vars['items']->value->params['display_icon']==1) {?>
                        <?php if ($_smarty_tpl->tpl_vars['tab']->value['id_category']!='*') {?>
                            <?php if ($_smarty_tpl->tpl_vars['tab']->value['image']) {?>
                                <div class="aztabs-tab-img">
                                    <?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['tab']->value['link_rewrite'],$_smarty_tpl->tpl_vars['tab']->value['id_category'],$_smarty_tpl->tpl_vars['items']->value->params['cat_image_size']), ENT_QUOTES, 'UTF-8', true);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['tab']->value['link_rewrite'],$_smarty_tpl->tpl_vars['tab']->value['id_category']), ENT_QUOTES, 'UTF-8', true);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["src"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['cat_image_size']!='none' ? $_tmp2 : $_tmp3, null, 0);?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['src']->value;?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                            <?php }?>
                        <?php } else { ?>
                            <div class="aztabs-tab-img">
                                <img class="cat-all" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
/modules/aztabs/views/img/icon-catall.png"
                                     title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"
                                     style="width: 36px; height:77px;"/>
                            </div>
                        <?php }?>
                    <?php }?>
                    <span class="aztabs-tab-label">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

					</span>
                </li>
            <?php } else { ?>
                <li class="aztabs-tab <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab_sel']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                    data-category-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['id_category'], ENT_QUOTES, 'UTF-8', true);?>
"
                    data-active-content=".items-category-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['active_content']->value, ENT_QUOTES, 'UTF-8', true);?>
">
					<span class="aztabs-tab-label">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

			        </span>
                </li>
            <?php }?>
        <?php } ?>
    </ul>
</div>
<?php }} ?>
