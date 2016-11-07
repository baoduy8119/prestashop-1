<?php /* Smarty version Smarty-3.1.19, created on 2016-11-06 07:58:21
         compiled from "C:\xampp\htdocs\prestashop\modules\azmanufacturer\views\templates\hook\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17250581f28ed6d50e3-37484051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '897f70f524d6363abd1d9e4d3b22677be9db0e1a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\modules\\azmanufacturer\\views\\templates\\hook\\default.tpl',
      1 => 1478348059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17250581f28ed6d50e3-37484051',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'items' => 0,
    'moduleclass_sfx' => 0,
    '_list' => 0,
    'rand' => 0,
    'randid' => 0,
    'params' => 0,
    'tag_id' => 0,
    'cookie' => 0,
    'manufacturer' => 0,
    'myfile' => 0,
    'img_manu_dir' => 0,
    'link' => 0,
    'src' => 0,
    'autoplay' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581f28ed832f10_38041441',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581f28ed832f10_38041441')) {function content_581f28ed832f10_38041441($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'C:\\xampp\\htdocs\\prestashop\\tools\\smarty\\plugins\\function.math.php';
?>

<!-- AZ Manufacturer -->
<?php if (isset($_smarty_tpl->tpl_vars['list']->value)&&!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
    <?php  $_smarty_tpl->tpl_vars['items'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['items']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['items']->key => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["moduleclass_sfx"] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['items']->value->params['moduleclass_sfx']) ? $_smarty_tpl->tpl_vars['items']->value->params['moduleclass_sfx'] : '', null, 0);?>
        <div class="az_module <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['moduleclass_sfx']->value, ENT_QUOTES, 'UTF-8', true);?>
">
            
            <?php $_smarty_tpl->tpl_vars["params"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params, null, 0);?>

            <?php $_smarty_tpl->tpl_vars['_list'] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->products, null, 0);?>
            <?php if (isset($_smarty_tpl->tpl_vars['_list']->value)&&$_smarty_tpl->tpl_vars['_list']->value) {?>


                <?php echo smarty_function_math(array('equation'=>'rand()','assign'=>'rand'),$_smarty_tpl);?>

                <?php $_smarty_tpl->tpl_vars['randid'] = new Smarty_variable((strtotime("now")).($_smarty_tpl->tpl_vars['rand']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["tag_id"] = new Smarty_variable("az_manufacturer_".((string)$_smarty_tpl->tpl_vars['items']->value->id_azmanufacturer)."_".((string)$_smarty_tpl->tpl_vars['randid']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["interval"] = new Smarty_variable($_smarty_tpl->tpl_vars['params']->value['auto_play']==1 ? $_smarty_tpl->tpl_vars['params']->value['interval'] : 0, null, 0);?>
                <div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag_id']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="az_manufacturer">
					 <?php if ($_smarty_tpl->tpl_vars['items']->value->params['display_title_module']) {?>
						<h3 class="az_titleModule">
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['items']->value->title_module[$_smarty_tpl->tpl_vars['cookie']->value->id_lang], ENT_QUOTES, 'UTF-8', true);?>

						</h3>
					<?php }?>

                    <?php $_smarty_tpl->tpl_vars["class_respl"] = new Smarty_variable(((((((("preset01-").($_smarty_tpl->tpl_vars['params']->value['nb_column1'])).(' preset02-')).($_smarty_tpl->tpl_vars['params']->value['nb_column2'])).(' preset03-')).($_smarty_tpl->tpl_vars['params']->value['nb_column3'])).(' preset04-')).($_smarty_tpl->tpl_vars['params']->value['nb_column4']), null, 0);?>
                    <div class="owl-carousel az_manufacturer-inner">
						<?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manufacturer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['manufacturer_lists']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value) {
$_smarty_tpl->tpl_vars['manufacturer']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['manufacturer_lists']['iteration']++;
?>
							<?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp7=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["myfile"] = new Smarty_variable("img/m/".$_tmp7.".jpg", null, 0);?>
							<?php if (file_exists($_smarty_tpl->tpl_vars['myfile']->value)) {?>
								<?php if ($_smarty_tpl->tpl_vars['params']->value['manu_image_size']=='none') {?>
									<?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp8=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["src"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['img_manu_dir']->value).$_tmp8.".jpg", null, 0);?>
								<?php } else { ?>
									<?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp9=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["src"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['img_manu_dir']->value).$_tmp9."-".((string)$_smarty_tpl->tpl_vars['params']->value['manu_image_size']).".jpg", null, 0);?>
								<?php }?>
								<div class="item">
									<div class="item-inner">
										<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['manufacturer_lists']['iteration']<=20) {?>
												<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
" <?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['_target'];?>

												   title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
													<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['src']->value, ENT_QUOTES, 'UTF-8', true);?>
"
														 class="logo_manufacturer"
														 title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"
														 alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"/>
												</a>
										<?php }?>
									</div>
								</div>
							<?php }?>
						<?php } ?>
                    </div>
                </div>
				
				<?php $_smarty_tpl->tpl_vars["nav"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['display_control']=='1' ? 'true' : 'false', null, 0);?>			
				<?php $_smarty_tpl->tpl_vars["autoplay"] = new Smarty_variable($_smarty_tpl->tpl_vars['items']->value->params['auto_play']=='1' ? 'true' : 'false', null, 0);?>
				
                <script type="text/javascript">
				jQuery('.az_manufacturer-inner').owlCarousel({
					loop: true,
					autoplay: <?php echo $_smarty_tpl->tpl_vars['autoplay']->value;?>
,
					nav: <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>
,
					navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
					slideBy: <?php echo $_smarty_tpl->tpl_vars['items']->value->params['step'];?>
,
					autoplayTimeout: <?php echo $_smarty_tpl->tpl_vars['items']->value->params['interval'];?>
,
					smartSpeed: <?php echo $_smarty_tpl->tpl_vars['items']->value->params['speed'];?>
,
					responsive: {
						0:{
							items:1
						},
						480:{
							items:<?php echo $_smarty_tpl->tpl_vars['items']->value->params['nb_column4'];?>

						},
						768:{
							items:<?php echo $_smarty_tpl->tpl_vars['items']->value->params['nb_column3'];?>

						},
						992:{
							items:<?php echo $_smarty_tpl->tpl_vars['items']->value->params['nb_column2'];?>

						},
						1200:{
							items:<?php echo $_smarty_tpl->tpl_vars['items']->value->params['nb_column1'];?>

						}
					}				   
				});
			</script>
            <?php } else { ?>
                <?php echo smartyTranslate(array('s'=>'Has no content to show!','mod'=>'azmanufacturer'),$_smarty_tpl);?>

            <?php }?>

        </div>
    <?php } ?>
<?php }?>
<!-- / AZ Manufacturer --><?php }} ?>
