<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:17
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\az_liveeditor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14636581dd025580b96-88630093%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1066a1825f907c2aa5cbed8d7b10f75b6389cadc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\az_liveeditor.tpl',
      1 => 1478348052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14636581dd025580b96-88630093',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_dir' => 0,
    'AZ_themeSkin' => 0,
    'AZ_layoutOption' => 0,
    'AZ_headerOption' => 0,
    'AZ_contentOption' => 0,
    'AZ_patternOption' => 0,
    'css_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd0255ff754_68313014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd0255ff754_68313014')) {function content_581dd0255ff754_68313014($_smarty_tpl) {?>
<div id="live-editor_btn">
	<i class="fa fa-hand-o-right"></i>
</div>		

<div id="live-editor">
	<form action="<?php echo $_smarty_tpl->tpl_vars['content_dir']->value;?>
" method="get" class="nomargin">
	
		<div class="title"> <?php echo smartyTranslate(array('s'=>"Live Theme Editor"),$_smarty_tpl);?>
 <span class="close-editor"><i class="fa fa-hand-o-left"></i></span></div>
		
		<div id="editor-option">
			<div class="option color">
				<label><?php echo smartyTranslate(array('s'=>"Theme Color"),$_smarty_tpl);?>
</label>
				<div class="skinbox">
					<input id="azlte_themeSkin" name="AZ_ltethemeSkin" class="form-control minicolors minicolors-input" type="text" value="<?php echo $_smarty_tpl->tpl_vars['AZ_themeSkin']->value;?>
" />
					<script type="text/javascript">
						(function($){
							$("#azlte_themeSkin").minicolors({
								position: "bottom right",
								changeDelay: 200,
								theme: "bootstrap"
							});
						})(jQuery)
					</script>
					<div class="themeSkin skin1 <?php ob_start();?><?php echo '#e54e5d';?>
<?php $_tmp11=ob_get_clean();?><?php if ($_tmp11==$_smarty_tpl->tpl_vars['AZ_themeSkin']->value) {?> active <?php }?>" data-skin="1" data-themeskin="#e54e5d"><span></span></div>
					<div class="themeSkin skin2 <?php ob_start();?><?php echo '#00B0FF';?>
<?php $_tmp12=ob_get_clean();?><?php if ($_tmp12==$_smarty_tpl->tpl_vars['AZ_themeSkin']->value) {?> active <?php }?>" data-skin="2" data-themeskin="#00B0FF"><span></span></div>
					<div class="themeSkin skin3 <?php ob_start();?><?php echo '#43becc';?>
<?php $_tmp13=ob_get_clean();?><?php if ($_tmp13==$_smarty_tpl->tpl_vars['AZ_themeSkin']->value) {?> active <?php }?>" data-skin="3" data-themeskin="#43becc"><span></span></div>
					<div class="themeSkin skin4 <?php ob_start();?><?php echo '#b0c052';?>
<?php $_tmp14=ob_get_clean();?><?php if ($_tmp14==$_smarty_tpl->tpl_vars['AZ_themeSkin']->value) {?> active <?php }?>" data-skin="4" data-themeskin="#b0c052"><span></span></div>
					<div class="themeSkin skin5 <?php ob_start();?><?php echo '#c59d5f';?>
<?php $_tmp15=ob_get_clean();?><?php if ($_tmp15==$_smarty_tpl->tpl_vars['AZ_themeSkin']->value) {?> active <?php }?>" data-skin="5" data-themeskin="#c59d5f"><span></span></div>
				 </div>
			</div>
		
			<div class="option layout hidden-device">
				<label><?php echo smartyTranslate(array('s'=>"Select Layout"),$_smarty_tpl);?>
</label>
				<div class="layoutbox">
					<select name="AZ_ltelayoutOption">
						<option <?php if ("layout-full"==$_smarty_tpl->tpl_vars['AZ_layoutOption']->value) {?>   selected="selected" <?php }?>value="layout-full"><?php echo smartyTranslate(array('s'=>"Fullwidth Layout"),$_smarty_tpl);?>
</option>
						<option <?php if ("layout-boxed"==$_smarty_tpl->tpl_vars['AZ_layoutOption']->value) {?>  selected="selected" <?php }?>value="layout-boxed"><?php echo smartyTranslate(array('s'=>"Boxed Layout"),$_smarty_tpl);?>
</option>
					</select>
				</div>
			</div>
			
			<div class="option header hidden">
				<label><?php echo smartyTranslate(array('s'=>"Select Header"),$_smarty_tpl);?>
</label>
				<div class="layoutbox">
					<select name="AZ_lteheaderOption">
						<option <?php if ("header-v1"==$_smarty_tpl->tpl_vars['AZ_headerOption']->value) {?>  selected="selected" <?php }?>value="header-v1"><?php echo smartyTranslate(array('s'=>"Header 1"),$_smarty_tpl);?>
</option>
					</select>
				</div>
			</div>
			
			<div class="option content hidden">
				<label><?php echo smartyTranslate(array('s'=>"Select Content"),$_smarty_tpl);?>
</label>
				<div class="layoutbox">
					<select name="AZ_ltecontentOption">
						<option <?php if ("content-v1"==$_smarty_tpl->tpl_vars['AZ_contentOption']->value) {?>  selected="selected" <?php }?>value="content-v1"><?php echo smartyTranslate(array('s'=>"Content 1"),$_smarty_tpl);?>
</option>
					</select>
				</div>
			</div>
			
			<div class="option pattern hidden-device">
				<label><?php echo smartyTranslate(array('s'=>"Background Images"),$_smarty_tpl);?>
</label>
				<div class="patternbox">
					<input type="hidden" name="AZ_ltepattern" value="<?php echo $_smarty_tpl->tpl_vars['AZ_patternOption']->value;?>
" />
					<div data-pattern="none" class="img-pattern pattern_none <?php ob_start();?><?php echo 'none';?>
<?php $_tmp16=ob_get_clean();?><?php if ($_tmp16==$_smarty_tpl->tpl_vars['AZ_patternOption']->value) {?>  active <?php }?>"><span></span></div>
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['name'] = 'patterns';
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'] = (int) 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'] = ((int) 1) == 0 ? 1 : (int) 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['patterns']['total']);
?>
						<div data-pattern="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['patterns']['index'];?>
" class="img-pattern pattern_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['patterns']['index'];?>
 <?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['patterns']['index'];?>
<?php $_tmp17=ob_get_clean();?><?php if ($_tmp17==$_smarty_tpl->tpl_vars['AZ_patternOption']->value) {?>  active <?php }?>"><span></span></div>
					<?php endfor; endif; ?>
				</div>
				

			</div>
			
			<div class="buttons">
				<input type="submit" class="btn btn-default" value="Reset" name="AZ_lteReset"/>
				<input type="submit" class="btn btn-success" value="Apply" name="AZ_lteApply"/>
			</div>
		</div>
	</form>	
</div>

<script type="text/javascript">
	
	(function($){
		$(".img-pattern").each(function(){
			var that = $(this) 	;
			that.on('click', function(){
				var _pattern =  $(this).data('pattern');
				$('input[name="AZ_ltepattern"]').val(_pattern);
				if($(this).hasClass('selected'))
					return;
				else{
					$(".img-pattern").removeClass('selected');
					$(".img-pattern").removeClass('active');
					$(this).addClass('selected');
				}
			});
		});
	})(jQuery);
	
	(function($){
		$(".themeSkin").each(function(){
			var that = $(this) 	;
			that.on('click', function(){
				var $skin = $(this).data('skin');
				var _themeSkin =  $(this).data('themeskin');
				$('input[name="AZ_ltethemeSkin"]').val(_themeSkin);
				if($(this).hasClass('selected'))
					return;
				else{
					$(".themeSkin").removeClass('selected');
					$(".themeSkin").removeClass('active');
					$(this).addClass('selected');
					$('body').removeClass('themeskin1 themeskin2 themeskin3 themeskin4 themeskin5');
					$('body').addClass('themeskin'+$skin);
					if($('body').hasClass('themeskin1'))
						$('head').append('<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
skins/skin1.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin2'))
						$('head').append('<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
skins/skin2.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin3'))
						$('head').append('<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
skins/skin3.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin4'))
						$('head').append('<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
skins/skin4.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin5'))
						$('head').append('<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
skins/skin5.css" rel="stylesheet" type="text/css" media="all" />');
				}
			});
		});
	})(jQuery);
	
</script><?php }} ?>
