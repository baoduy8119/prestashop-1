<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:27:15
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\modules\azblockuserinfo\nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25804581dd02352fb91-44248615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7a62e80d4f166f7a35fff4bd82b022fe3e72387' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\modules\\azblockuserinfo\\nav.tpl',
      1 => 1478348055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25804581dd02352fb91-44248615',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'order_process' => 0,
    'is_logged' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dd023573568_42273145',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dd023573568_42273145')) {function content_581dd023573568_42273145($_smarty_tpl) {?><!-- AZ User Info  -->

<div id="user_infoblock-top" class="header_user_info">
	<ul class="userinfo-block_ul">
		<li class="account">
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'My Account','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
				<?php echo smartyTranslate(array('s'=>'My Account','mod'=>'azblockuserinfo'),$_smarty_tpl);?>

			</a>
		</li>
		
		<li class="wishlist">
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist');?>
" title="<?php echo smartyTranslate(array('s'=>'My Wishlist','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
" >
				<?php echo smartyTranslate(array('s'=>'My Wishlist','mod'=>'azblockuserinfo'),$_smarty_tpl);?>

			</a>
		</li>
		
		<!--<li class="compare">
			<a href="index.php?controller=products-comparison" title="<?php echo smartyTranslate(array('s'=>'Compare','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
" >
				<?php echo smartyTranslate(array('s'=>'Compare','mod'=>'azblockuserinfo'),$_smarty_tpl);?>

			</a>
		</li>-->
		
		<li class="checkout">
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Checkout','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
				<?php echo smartyTranslate(array('s'=>'Checkout','mod'=>'azblockuserinfo'),$_smarty_tpl);?>

			</a>
		</li>
		
		<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
			<li class="logout"> 
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log out','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
">
					<?php echo smartyTranslate(array('s'=>'Logout','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
 
				</a>
			</li>
		<?php } else { ?>
			<li class="login">
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log in to your customer account','mod'=>'azblockuserinfo'),$_smarty_tpl);?>
">
					<?php echo smartyTranslate(array('s'=>'Login','mod'=>'azblockuserinfo'),$_smarty_tpl);?>

				</a>
			</li>
		<?php }?>
	</ul>
</div>

<!-- /AZ User Info -->
<?php }} ?>
