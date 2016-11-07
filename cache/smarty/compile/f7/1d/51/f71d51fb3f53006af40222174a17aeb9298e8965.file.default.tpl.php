<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:15
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\azstaticsblock\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17757581dd023370b01-63619076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f71d51fb3f53006af40222174a17aeb9298e8965' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azstaticsblock\\default.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17757581dd023370b01-63619076',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'rand' => 0,
    'randid' => 0,
    'moduleclass_sfx' => 0,
    'cookie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd02340a5f1_99532329',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd02340a5f1_99532329')) {function content_581dd02340a5f1_99532329($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.math.php';
?>

<!-- AZ Statics Block -->
<?php if (isset($_smarty_tpl->tpl_vars['list']->value)&&!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["moduleclass_sfx"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['item']->value->params['moduleclass_sfx']) ? $_smarty_tpl->tpl_vars['item']->value->params['moduleclass_sfx'] : '', null, 0);?>
        <?php echo smarty_function_math(array('equation'=>'rand()','assign'=>'rand'),$_smarty_tpl);?>

        <?php $_smarty_tpl->tpl_vars['randid'] = new Smarty_variable((strtotime("now")).($_smarty_tpl->tpl_vars['rand']->value), null, 0);?>
        <?php $_smarty_tpl->tpl_vars["uniqued"] = new Smarty_variable("az_staticsblock_".((string)$_smarty_tpl->tpl_vars['item']->value->id_azstaticsblock)."_".((string)$_smarty_tpl->tpl_vars['randid']->value), null, 0);?>
        <div class="az_staticsBlock <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['moduleclass_sfx']->value, ENT_QUOTES, 'UTF-8', true);?>
">
            <?php if (isset($_smarty_tpl->tpl_vars['item']->value->params['display_title_module'])&&$_smarty_tpl->tpl_vars['item']->value->params['display_title_module']&&!empty($_smarty_tpl->tpl_vars['item']->value->title_module[$_smarty_tpl->tpl_vars['cookie']->value->id_lang])) {?>
                <h3 class="az_titleModule">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->title_module[$_smarty_tpl->tpl_vars['cookie']->value->id_lang], ENT_QUOTES, 'UTF-8', true);?>

                </h3>
            <?php }?>
             
            <?php if (isset($_smarty_tpl->tpl_vars['item']->value->content[$_smarty_tpl->tpl_vars['cookie']->value->id_lang])&&!empty($_smarty_tpl->tpl_vars['item']->value->content[$_smarty_tpl->tpl_vars['cookie']->value->id_lang])) {?>
                   <?php echo $_smarty_tpl->tpl_vars['item']->value->content[$_smarty_tpl->tpl_vars['cookie']->value->id_lang];?>

            <?php }?>
        </div>
    <?php } ?>
<?php }?>
<!-- /AZ Statics Block -->

<?php if ($_smarty_tpl->tpl_vars['item']->value->id_azstaticsblock==4) {?>
<script>// <![CDATA[
jQuery(document).ready(function($) {
		$('.az_ttnm').owlCarousel({
			pagination: false,
			center: false,
			nav: false,
			dots: true,
			loop: true,
			margin: 0,
			navText: [ '<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
	});
// ]]></script>
	<?php }?><?php }} ?>
