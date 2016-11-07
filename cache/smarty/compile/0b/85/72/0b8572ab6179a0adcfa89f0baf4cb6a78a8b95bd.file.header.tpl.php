<?php /* Smarty version Smarty-3.1.19, created on 2016-11-05 08:22:04
         compiled from "C:\xampp\htdocs\prestashop\themes\az_leonard\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9231581dceec101577-40881480%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b8572ab6179a0adcfa89f0baf4cb6a78a8b95bd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prestashop\\themes\\az_leonard\\header.tpl',
      1 => 1478348053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9231581dceec101577-40881480',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang_iso' => 0,
    'meta_title' => 0,
    'meta_description' => 0,
    'meta_keywords' => 0,
    'nobots' => 0,
    'nofollow' => 0,
    'favicon_url' => 0,
    'img_update_time' => 0,
    'AZ_responsive' => 0,
    'css_files' => 0,
    'css_dir' => 0,
    'css_uri' => 0,
    'media' => 0,
    'js_defer' => 0,
    'js_files' => 0,
    'js_def' => 0,
    'js_uri' => 0,
    'HOOK_HEADER' => 0,
    'languages' => 0,
    'language' => 0,
    'AZ_patternOption' => 0,
    'AZ_layoutOption' => 0,
    'page_name' => 0,
    'AZ_contentOption' => 0,
    'is_rtl' => 0,
    'content_only' => 0,
    'classBody_pattern' => 0,
    'classBody_layoutOption' => 0,
    'restricted_country_mode' => 0,
    'geolocation_country' => 0,
    'AZ_headerOption' => 0,
    'AZ_sidebar' => 0,
    'hide_left_column' => 0,
    'HOOK_LEFT_COLUMN' => 0,
    'sidebarClasses' => 0,
    'centerColumnClasses' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_581dceec22f467_87198918',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_581dceec22f467_87198918')) {function content_581dceec22f467_87198918($_smarty_tpl) {?>
<!DOCTYPE HTML>

<html lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
">
	<head>
		<meta charset="utf-8" />
		<title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
		
		<?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)&&$_smarty_tpl->tpl_vars['meta_description']->value) {?>
			<meta name="description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
		<?php }?>
		
		<?php if (isset($_smarty_tpl->tpl_vars['meta_keywords']->value)&&$_smarty_tpl->tpl_vars['meta_keywords']->value) {?>
			<meta name="keywords" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
		<?php }?>
		
		
		<meta charset="utf-8" />
        <meta name="generator" content="PrestaShop" />
		<meta name="format-detection" content="telephone=no">
		<meta name="robots" content="<?php if (isset($_smarty_tpl->tpl_vars['nobots']->value)) {?>no<?php }?>index,<?php if (isset($_smarty_tpl->tpl_vars['nofollow']->value)&&$_smarty_tpl->tpl_vars['nofollow']->value) {?>no<?php }?>follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['img_update_time']->value;?>
" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['img_update_time']->value;?>
" />
		
		
		
		<?php if (($_smarty_tpl->tpl_vars['AZ_responsive']->value)) {?>
		 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<?php }?>
		
		
		
		
		<meta name="apple-mobile-web-app-capable" content="YES" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        
		
		<?php if (isset($_smarty_tpl->tpl_vars['css_files']->value)) {?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
fonts/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
			<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['media']->_loop = false;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['css_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value) {
$_smarty_tpl->tpl_vars['media']->_loop = true;
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
				<link rel="stylesheet" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['css_uri']->value, ENT_QUOTES, 'UTF-8', true);?>
" type="text/css" media="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['media']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
			<?php } ?>
		
		<?php }?>
		

		
		
		
		<?php if (isset($_smarty_tpl->tpl_vars['js_defer']->value)&&!$_smarty_tpl->tpl_vars['js_defer']->value&&isset($_smarty_tpl->tpl_vars['js_files']->value)&&isset($_smarty_tpl->tpl_vars['js_def']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['js_def']->value;?>

			<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js_uri']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['js_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value) {
$_smarty_tpl->tpl_vars['js_uri']->_loop = true;
?>
				<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['js_uri']->value, ENT_QUOTES, 'UTF-8', true);?>
"></script>
			<?php } ?>
	
		<?php }?>
		
		
		
		<?php echo $_smarty_tpl->tpl_vars['HOOK_HEADER']->value;?>

		
		
        <!--[if IE 9]> <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
ie9.css" type="text/css" media="all" /><![endif]-->
		<!--[if IE 11]> <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
ie9.css" type="text/css" media="all" /><![endif]-->
        
		
		
		<!-- ADD RTL CLASSS -->
		<?php $_smarty_tpl->tpl_vars['is_rtl'] = new Smarty_variable(false, null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['language']->key;
?>
			<?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code']==$_smarty_tpl->tpl_vars['lang_iso']->value) {?>
				<?php if ($_smarty_tpl->tpl_vars['language']->value['is_rtl']==1) {?>
					<?php $_smarty_tpl->tpl_vars['is_rtl'] = new Smarty_variable(true, null, 0);?>
				<?php }?>
			<?php }?>
		<?php } ?>
		
		
	</head>
	
	<?php if ($_smarty_tpl->tpl_vars['AZ_patternOption']->value) {?>  <?php $_smarty_tpl->tpl_vars['classBody_pattern'] = new Smarty_variable("pattern".((string)$_smarty_tpl->tpl_vars['AZ_patternOption']->value), null, 0);?> <?php }?> 
	<?php if ($_smarty_tpl->tpl_vars['AZ_layoutOption']->value) {?>  <?php $_smarty_tpl->tpl_vars['classBody_layoutOption'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['AZ_layoutOption']->value), null, 0);?> <?php }?> 
	
	<body<?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)) {?> id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>   itemscope itemtype="http://schema.org/WebPage" class=" <?php if (($_smarty_tpl->tpl_vars['AZ_contentOption']->value=='content-v1')) {?> layout1 <?php }?> <?php if (($_smarty_tpl->tpl_vars['AZ_contentOption']->value=='content-v2')) {?> layout2 <?php }?> <?php if (($_smarty_tpl->tpl_vars['AZ_contentOption']->value=='content-v3')) {?> layout3 <?php }?><?php if (($_smarty_tpl->tpl_vars['is_rtl']->value)) {?> rtl<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)) {?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?>  <?php if (isset($_smarty_tpl->tpl_vars['content_only']->value)&&$_smarty_tpl->tpl_vars['content_only']->value) {?> content_only<?php }?> lang_<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['classBody_pattern']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['classBody_layoutOption']->value;?>
 ">
	
	<?php if (!isset($_smarty_tpl->tpl_vars['content_only']->value)||!$_smarty_tpl->tpl_vars['content_only']->value) {?>
	
		<?php if (isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['restricted_country_mode']->value) {?>
			<div id="restricted-country">
				<p><?php echo smartyTranslate(array('s'=>'You cannot place a new order from your country.'),$_smarty_tpl);?>
 <span class="bold"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['geolocation_country']->value, ENT_QUOTES, 'UTF-8', true);?>
</span></p>
			</div>
		<?php }?>
		
		
		
		<div id="wrapper" >
			 <!-- Header -->
			 <div class="header-container">
				<?php if (isset($_smarty_tpl->tpl_vars['AZ_headerOption']->value)) {?>
					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./".((string)$_smarty_tpl->tpl_vars['AZ_headerOption']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				<?php } else { ?>
					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./header-v1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				<?php }?>
			 </div>
			 <!-- End of Header -->
			 
			
			
			
			
			<!-- Breadcrumb Column -->
			<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'&&$_smarty_tpl->tpl_vars['page_name']->value!='pagenotfound') {?>
				 <div class="breadcrumb-container">
					<div class="container">
						<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					</div>
				</div>
			<?php }?>
			<!-- End Breadcrumb Column -->
			
			<!-- Columns -->
			<div class="columns-container">
				<div id="columns" class="container">
					<div class="row">
						
						<?php if (($_smarty_tpl->tpl_vars['AZ_sidebar']->value!=="none")&&!in_array($_smarty_tpl->tpl_vars['page_name']->value,array('index','product','pagenotfound'))&&$_smarty_tpl->tpl_vars['page_name']->value!='products-comparison'&&!$_smarty_tpl->tpl_vars['hide_left_column']->value) {?>
							 <?php if ((isset($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value))) {?>
								<?php if (($_smarty_tpl->tpl_vars['AZ_sidebar']->value=="left")) {?>
									<?php $_smarty_tpl->tpl_vars['sidebarClasses'] = new Smarty_variable('sidebar-left', null, 0);?>
									<?php $_smarty_tpl->tpl_vars['centerColumnClasses'] = new Smarty_variable('col-sm-8 col-md-9 col-lg-9', null, 0);?>
								<?php } elseif (($_smarty_tpl->tpl_vars['AZ_sidebar']->value=="right")) {?>
									<?php $_smarty_tpl->tpl_vars['sidebarClasses'] = new Smarty_variable('col-sm-push-8 col-md-push-9 col-lg-push-9 sidebar-right', null, 0);?>
									<?php $_smarty_tpl->tpl_vars['centerColumnClasses'] = new Smarty_variable('col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3', null, 0);?>
								<?php }?>
								
								 <!-- Sidebar -->
								<div id="sidebar" class="column  col-lg-3 col-md-3 col-sm-4 <?php echo $_smarty_tpl->tpl_vars['sidebarClasses']->value;?>
">
									<?php echo $_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value;?>

								</div>
								 <!-- End of Sidebar -->
							 <?php }?>
							 <?php } else { ?>
								<?php $_smarty_tpl->tpl_vars['centerColumnClasses'] = new Smarty_variable('col-sm-12', null, 0);?>
						<?php }?>
					
					
						
						
						<!-- Center Column -->
						<div id="center_column" class="column <?php echo $_smarty_tpl->tpl_vars['centerColumnClasses']->value;?>
">
							
							
	<?php }?><?php }} ?>
