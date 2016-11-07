<?php

/**
 * @package AZ Theme Configurator
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @author  AZ Templates http://www.aztemplates.com
 */


if (!defined('_PS_VERSION_')) exit;

include_once(dirname(__FILE__) . '/azthemeconfiguratorcore.php');

class azthemeconfigurator extends AZThemeConfiguratorCore
{	
   
	
    function __construct(){
        $this->name = 'azthemeconfigurator';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
		$this->versions = 'AZ Theme Editor v.'.$this->version.' | PS v.'._PS_VERSION_;		
        $this->author = 'AZ Templates';
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;
        $this->displayName = $this->l('AZ Theme Editor');
        $this->description = $this->l('Configure the main elements of your theme.');
		
		parent::__construct();
       
		$this->AZConfigCore = new azthemeconfiguratorcore;
		$this->defaults = $this->AZConfigCore->getThemeFields();
		
    }

    /* ------------------------------------------------------------- */
    /*  INSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function install()
    {
		if (  parent::install() && 
            $this->registerHook('header') && 
            $this->registerHook('displayAnywhere') &&
            $this->registerHook('actionShopDataDuplication') &&
            $this->registerHook('displayRightColumnProduct') &&
            $this->registerHook('displaySecondImage') &&
			$this->registerHook('displayAllImage') &&
            $this->registerHook('displayFooterSocial') &&
            $this->registerHook('displayFooterPayment') &&
            $this->registerHook('displaySidebarProduct') &&
            $this->_defaultValues() &&
			$this->_createTab()
        ){
            if ($id_hook = Hook::getIdByName('displayHeader'))
                $this->updatePosition($id_hook, 0, 1);
            return true;
        }
        return false;
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
		 if(!parent::uninstall() ||
			$this->_deleteTab() ||
            !$this->_deleteConfigs()
        )
			return true;

    }

   
	
    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookHeader($params)
    {
        $this->_prepHook($params);
		global $cookie, $smarty;
		$sp_var = array();
		
        $id_shop = $this->context->shop->id;
		$is_responsive = Configuration::get('AZ_responsive');
		$liveEditor = Configuration::get('AZ_liveEditor');
		$zoomImage = Configuration::get('AZ_zoomImage');
		
		foreach($this->defaults as $key => $value) {
			$sp_var[$key] = Configuration::get($key);
		}
		
		
		
		// Load Cpanel Config
		
		 if($liveEditor){ 
			$this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/front/az_livethemeeditor.css');
			//$this->context->controller->addCSS(__PS_BASE_URI__.'modules/'.$this->name.'/views/css/front/jquery.miniColors.css', 'all');
			$this->context->controller->addJS(__PS_BASE_URI__.'modules/'.$this->name.'/views/js/front/jquery.miniColors.min.js', 'all');
			$this->context->controller->addJS(__PS_BASE_URI__.'modules/'.$this->name.'/views/js/front/az_livethemeeditor.js', 'all');
			
			
			if( Tools::getIsset('AZ_lteApply') && strtolower( Tools::getValue('AZ_lteApply') ) == "apply" ){
		  		foreach($this->defaults as $key => $value) {
                    if(Tools::getIsset(str_replace('AZ_', 'AZ_lte', $key))){
                        $cookie->__set(str_replace('AZ_', 'AZ_lte', $key), Tools::getValue(str_replace('AZ_', 'AZ_lte', $key)) );
                    }
				}
				Tools::redirect( "index.php" );
			}
            if( Tools::getIsset('AZ_lteReset') && strtolower( Tools::getValue('AZ_lteReset') ) == "reset" ){
	  			foreach($this->defaults as $key => $value) {
					$cookie->__unset(str_replace('AZ_', 'AZ_lte', $key));
				}
				Tools::redirect( "index.php" );	
			}
			
			// Set value for params
			
	  		foreach($this->defaults as $key => $value) {
				if($cookie->__get(str_replace('AZ_', 'AZ_lte', $key))){
					$sp_var[$key] = $cookie->__get( str_replace('AZ_', 'AZ_lte', $key));
	  			}
				
			}
			
			
		}
		
		// compile scss
		$scssDir = _PS_ALL_THEMES_DIR_._THEME_NAME_.'/sass/';
		$cssDir = _PS_ALL_THEMES_DIR_._THEME_NAME_.'/css/';
		 
        /* We are loading css files in this hook, because
         * this is the only way to make sure these css files
         * will override any other css files.. Otherwise
         * module positioning will cause a lot of issues.
         */

        /* LOAD CSS */
		 $language = new Language($cookie->id_lang);
		 if ($language->is_rtl) $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'bootstrap/bootstrap-rtl.css');
		 else $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'bootstrap/bootstrap.min.css');
		 
       
	    // DO NOT MOVE THIS -> see the file for more information
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'jquery_plugins/jquery.plugins.css');
        
		// DO NOT MOVE THIS
		$themeSkin = $sp_var['AZ_themeSkin'];
		
		$smarty->assign( $sp_var );
		$themeSkin = strtolower($themeSkin);
		$themeCssName = 'theme-' . str_replace("#", "", $themeSkin) . '.css';
		$rtlCssName = 'rtl.css';
		$resCssName = 'responsive.css';
		$ie9CssName = 'ie9.css';
		
        // Load auto-created css files
        $cssFile = 'configCss-' . $id_shop . '.css';
        if (file_exists(_PS_MODULE_DIR_ . $this->name . '/views/css/front/' . $cssFile)) {
            $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/front/' . $cssFile);
        }
        else {
            $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/front/configCSS-default.css');
        }
		
		// Load auto-created SCSS Compile
		if((!file_exists($cssDir . $themeCssName)) || $sp_var['AZ_Scsscompile'] == 1) {
			require "scssphp/scss.inc.php";
			require "scssphp/compass/compass.inc.php";
			
			$scss = new scssc();
			new scss_compass($scss);
			
			if($sp_var['AZ_Scssformat']) $cssFormat = $sp_var['AZ_Scssformat'];
			else $cssFormat = 'scss_formatter_compressed';
			
			$scss->setFormatter($cssFormat);
			$scss->addImportPath($scssDir);
			
			$variables = '$colortheme: '.$themeSkin.';';
			$string_sass = $variables . file_get_contents($scssDir . "theme.scss");
			 
			$rtl_css 	= $scss->compile('@import "rtl.scss"');
			$res_css 	= $scss->compile('@import "responsive.scss"');
			$ie9_css 	= $scss->compile('@import "ie9.scss"');
			$string_css = $scss->compile($string_sass);
			$string_css = preg_replace('/\/\*[\s\S]*?\*\//', '', $string_css); // remove mutiple comments
			
			file_put_contents($cssDir . $themeCssName, $string_css);
			file_put_contents($cssDir . $rtlCssName, $rtl_css);
			file_put_contents($cssDir . $resCssName, $res_css);
			file_put_contents($cssDir . $ie9CssName, $ie9_css);
		}
		$this->context->controller->addCSS(array(
			__PS_BASE_URI__.'themes/'._THEME_NAME_.'/css/'.$themeCssName
		));
		
		 
		if($is_responsive) $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'responsive.css');
		else  $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'bootstrap/none-responsive.css');
		
		
		
        /* GLOBAL SMARTY VARS */
        /* LOAD JS */
        // Load custom JS files
		$controller_name = Dispatcher::getInstance()->getController();
		$this->context->controller->addJqueryPlugin('backtotop', _THEME_JS_DIR_ . 'az_lib/');
		if(Configuration::get('AZ_stickyMenu') == 1) $this->context->controller->addJqueryPlugin('keepmenu', _THEME_JS_DIR_ . 'az_lib/');
		
		
        $this->context->controller->addJqueryPlugin('global', _THEME_JS_DIR_ . 'az_lib/');
		$this->context->controller->addJqueryPlugin('ui.touch-punch.min', _THEME_JS_DIR_ . 'az_lib/');

		// Load js Zoom Image
		if($zoomImage){
			$this->context->controller->addJqueryPlugin('elevatezoom', _THEME_JS_DIR_ . 'az_lib/');
		}
		
		// Load JS Scroll
		if(Configuration::get('AZ_animationScroll') == 1) {
			$this->context->controller->addCSS(_THEME_CSS_DIR_ . 'az_lib/anicollection.css');
		}
      
		
    }
	
	/* ------------------------------------------------------------- */
    /*  GET DISPLAY SECOND IMAGE
    /* ------------------------------------------------------------- */
	public function hookDisplaySecondImage($params) {
		if (!Configuration::get('AZ_secondImg')) return;
		
		if (!$this->isCached('displaySecondImage.tpl', $this->getCacheId($params['id_product']))) {
			$id_lang = $this->context->language->id;
				$obj     = new Product((int) ($params['id_product']), false, $id_lang);
				$images  = $obj->getImages($this->context->language->id);
				$_images = array();
				if (!empty($images))
					foreach ($images as $k => $image)
						if(!$image['cover']) $_images[] = $obj->id . '-' . $image['id_image'];
			  
			$this->smarty->assign(array(
				'link_rewrite' => $params['link_rewrite'],
				'images' => $_images
			));
		}
		return $this->display(__FILE__, 'displaySecondImage.tpl', $this->getCacheId($params['id_product']));
	}
	
	
	/* ------------------------------------------------------------- */
    /*  GET DISPLAY ALL IMAGE
    /* ------------------------------------------------------------- */
	
	public function hookDisplayAllImage($params) {
		if (!Configuration::get('AZ_sliderImg')) return;
		
		if (!$this->isCached('displaySliderImage.tpl', $this->getCacheId($params['id_product']))) {
			$id_lang = $this->context->language->id;
				$obj     = new Product((int) ($params['id_product']), false, $id_lang);
				$images  = $obj->getImages($this->context->language->id);
				$_images = array();
				if (!empty($images))
					foreach ($images as $k => $image)
						if(!$image['cover']) $_images[] = $obj->id . '-' . $image['id_image'];
			  
			$this->smarty->assign(array(
				'link_rewrite' => $params['link_rewrite'],
				'images' => $_images
			));
		}
		return $this->display(__FILE__, 'displaySliderImage.tpl', $this->getCacheId($params['id_product']));
	}
	
	/* ------------------------------------------------------------- */
    /*  GET DISPLAY FOOTER SOCIAL
    /* ------------------------------------------------------------- */
	public function hookDisplayFooterSocial($params) {
		if (!Configuration::get('AZ_socialFooter')) return;
		if (!Configuration::get('AZ_socialFooter')) return;
		return $this->display(__FILE__, 'displaySocial.tpl');
	}
	
	/* ------------------------------------------------------------- */
    /*  GET DISPLAY SIDEBAR PRODUCT
    /* ------------------------------------------------------------- */
	public function hookDisplaySidebarProduct($params) {
		if (!Configuration::get('AZ_SidebarProduct')) return;
		return $this->display(__FILE__, 'displaySidebarProduct.tpl');
	}
	
	/* ------------------------------------------------------------- */
    /*  GET DISPLAY FOOTER SOCIAL
    /* ------------------------------------------------------------- */
	public function hookDisplayFooterPayment($params) {
		if (!Configuration::get('AZ_paymentImage')) return;
		return $this->display(__FILE__, 'displaypayment.tpl');
	}
}
