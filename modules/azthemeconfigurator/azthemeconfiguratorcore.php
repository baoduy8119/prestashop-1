<?php

/**
 * @package AZ Theme Editor
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @author AZ Templates http://www.aztemplates.com
 */

if (!defined('_PS_VERSION_')) exit;


class AZThemeConfiguratorCore extends Module {
	private $_output = '';
    private $_standardConfig = '';
    private $_styleConfig = '';
    private $_multiLangConfig = '';

    private $_bgImageConfig = '';
    private $_fontConfig = '';

    private $_cssRules = array();
    private $_configDefaults = array();
    private $systemFonts = array();
    private $googleFonts = array();
	
	public function __construct() {
		parent::__construct();
		 $this->_defineArrays();
	}
	
   
	public function getThemeFields() {
		$languages = $this->context->language->getLanguages();

        foreach ($languages as $language) {
			$copyRighttext[$language['id_lang']] = 'Copyright &copy;  - Leonard - All rights reserved';
            $wellcomeMsg[$language['id_lang']] = 'Welcome to our store!';
			$loggedMsg[$language['id_lang']] = 'Hi to our store!';
        }
	
		$themeFields = array(
	    	// General Options
			'AZ_stickyMenu' => 0,
			'AZ_responsive' => 1,
			'AZ_animationScroll' => 0,
            'AZ_liveEditor' => 1,
			'AZ_paymentImage' => 'payments-1.png',
            'AZ_wellcomeMsg' => $wellcomeMsg,
            'AZ_loggedMsg' =>  $loggedMsg,
            'AZ_copyRight' => $copyRighttext,
			
			// Layout Options
			'AZ_themeSkin'		=> '#e54e5d',
			'AZ_headerOption' => 'header-v1',
			'AZ_contentOption' => 'content-v1',
			'AZ_footerOption' => 'footer-v1',
			'AZ_layoutOption' => 'layout-full',
			'AZ_layoutWidth' => 1200,
			
			// Background Options
			'AZ_bgColor' => '#ffffff',
			'AZ_bgRepeat' => 'repeat',
			'AZ_bgAttachment' => 'fixed',
			'AZ_patternOption' => 'none',
			
			// Font Options
			'AZ_mainFont' 		=> 'Raleway',
			'AZ_headingsFont' 	=> 'Raleway',
			'AZ_menuFont' 		=> 'Raleway',
			'AZ_otherFont'		=> 'Playfair Display',
			'AZ_bodySelectors' 	=> 'body',
			'AZ_headSelectors' 	=> 'h1,h2,h3,h4,h5,h6',
			'AZ_menuSelectors' 	=> '',
			'AZ_otherSelectors' => '.titleFont, .featured-products .menu-title',
			
			// Category Page Options
			'AZ_subCat' => 0,
			'AZ_subCatColumns' => 3,
			'AZ_subCatTitle' => 0,
			'AZ_subCatDes' => 0,
			'AZ_sidebar' => 'left',
			'AZ_productColumns' => 3,
			'AZ_productTitle' => 1,
			'AZ_productDes' => 0,
			'AZ_productColor' => 0,
			'AZ_productStock' => 0,
			'AZ_secondImg' => 0,
			'AZ_sliderImg' => 0,
			'AZ_quickView' => 1,
			'AZ_productCatRating' => 1,
			
			// Product Page Options
			'AZ_productOption' => 'product-full',
			'AZ_zoomImage' => 1,
			'AZ_productRating' => 1,
			'AZ_share' => 1,
			'AZ_producShortdesc' => 1,
			'AZ_productTaxLabel' => 0,
			
			// Blog Page Options
			'AZ_blogOption' => 'blog-small_image',
			'smartpostperpage' => 6,
			
			// Advanced Options
			'AZ_Scsscompile' => 1,
			'AZ_Scssformat' => 'scss_formatter',
			
			// Soical  Options
			'AZ_socialFooter' => 1,
			'AZ_sfFacebook' => '#',
			'AZ_sfTwitter' => '#',
			'AZ_sfGoogle' => '#',
			'AZ_sfFlickr' =>'',
			'AZ_sfPinterest' => '#',
			'AZ_sfLinkedIn' => '',
			
			
			// Custom Codes
			'AZ_customCSS' => '',
			'AZ_customJS' => '',

	    );
		return $themeFields;
	}
	
	
    /* ------------------------------------------------------------- */
    /*  DEFINE ARRAYS
    /* ------------------------------------------------------------- */
   protected function _defineArrays()
    {
        
        $bgPatternDir = $this->context->link->getMediaLink(_MODULE_DIR_ . $this->name . '/patterns/');
		$bodySelectors = Configuration::get('AZ_bodySelectors');
		$menuSelectors = Configuration::get('AZ_menuSelectors');
		$headSelectors = Configuration::get('AZ_headSelectors');
		$otherSelectors = Configuration::get('AZ_otherSelectors');
		
        // SPECIAL ARRAYS
        // These arrays are only for defining certain config values that needs to be handled differently.
        $this->_standardConfig = array(
            // General Options
            'AZ_responsive',
			'AZ_liveEditor',
			'AZ_stickyMenu',
            'AZ_animationScroll',
			'AZ_paymentImage',
			
            // Layout Options
			'AZ_themeSkin',
            'AZ_layoutOption',
			'AZ_headerOption',
			'AZ_contentOption',
			'AZ_footerOption',
			'AZ_layoutWidth',
			
            // Category Page Options
			'AZ_subCat',
			'AZ_subCatColumns',
			'AZ_sidebar',
			'AZ_productColumns',
			'AZ_subCatTitle',
			'AZ_subCatDes',
			'AZ_productTitle',
            'AZ_productDes',
			'AZ_productColor',
            'AZ_secondImg',
			'AZ_sliderImg',
            'AZ_quickView',
			'AZ_productCatRating',
            'AZ_productRating',
            'AZ_productStock',

            // Product Page Options
			'AZ_productOption',
			'AZ_zoomImage',
            'AZ_productRating',
            'AZ_share',
            'AZ_producShortdesc',
            'AZ_productTaxLabel',
			
			// Blog Pages Options
			'AZ_blogOption',
			'smartpostperpage',
			
			// Advanced Page Options
            'AZ_Scsscompile',
			'AZ_Scssformat',
			
            // Font Options
			'AZ_mainFont',
			'AZ_headingsFont',
			'AZ_menuFont',
			'AZ_otherFont',
			'AZ_bodySelectors',
			'AZ_headSelectors',
			'AZ_menuSelectors',
			'AZ_otherSelectors',
			
			// Social Options
			'AZ_socialFooter',
			'AZ_sfFacebook',
			'AZ_sfTwitter',
			'AZ_sfGoogle',
			'AZ_sfFlickr',
			'AZ_sfPinterest',
			'AZ_sfLinkedIn',

			
			// Custom Codes
            'AZ_customCSS',
            'AZ_customJS',
        );

        $this->_styleConfig = array(
            // Background Options
			'AZ_patternOption',
			'AZ_paymentImage',
			
            'AZ_bgRepeat',
            'AZ_bgAttachment',
            'AZ_bgColor',
        );

        $this->_multiLangConfig = array(
            // General Options
			'AZ_wellcomeMsg',
			'AZ_loggedMsg',
			'AZ_copyRight',
        );

        
        $this->_bgImageConfig = array(
            
			'AZ_paymentImage',
        );
		
        $this->_fontConfig = array(
            'AZ_mainFont',
			'AZ_headingsFont',
			'AZ_menuFont',
			'AZ_otherFont',
        );
        // End - SPECIAL ARRAYS

        // CSS AND CONFIG RELATIONS
        $this->_cssRules = array(
            // #wrapper Background
			'AZ_layoutWidth' => array(
                array(
                    'selector' => '.container',
                    'rule' => 'width',
                    'suffix' => 'px'
                )
            ),
			'AZ_patternOption' => array(
                array(
                    'selector' => 'body.layout-boxed',
                    'rule' => 'background-image',
					'prefix' => 'url("' . $bgPatternDir,
                    'suffix' => '.png")'
                )
            ),
            
            'AZ_bgRepeat' => array(
                array(
                    'selector' => '.layout-boxed',
                    'rule' => 'background-repeat'
                )
            ),
            'AZ_bgAttachment' => array(
                array(
                    'selector' => '.layout-boxed',
                    'rule' => 'background-attachment'
                )
            ),
			
            // Body Background
            'AZ_bgColor' => array(
                array(
                    'selector' => '.layout-boxed',
                    'rule' => 'background-color'
                )
            ),
			
            // Font
            'AZ_mainFont' => array(
                array(
                    'selector' => ''.$bodySelectors.'',
                    'rule' => 'font-family'
                )
            ), 
			'AZ_headingsFont' => array(
                array(
                    'selector' => ''.$headSelectors.'',
                    'rule' => 'font-family'
                )
            ),
			'AZ_menuFont' => array(
                array(
                    'selector' => ''.$menuSelectors.'',
                    'rule' => 'font-family'
                )
            ),
			'AZ_otherFont' => array(
                array(
                    'selector' => ''.$otherSelectors.'',
                    'rule' => 'font-family'
                )
            ),
			
           
        );
       
        // Web-safe Fonts
        $this->systemFonts = array('Arial', 'Helvetica', 'Verdana', 'Georgia', 'Times New Roman', 'sans-serif');

        // Google Fonts
        $this->googleFonts = array(
            'ABeeZee' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Abel' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Abril Fatface' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Aclonica' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Acme' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Actor' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Adamina' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Advent Pro' => array('subsets' => array('latin', 'latin-ext', 'greek'), 'variants' => array('100', '200', '300', '400', '500', '600', '700')),
            'Aguafina Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Akronim' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Aladin' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Aldrich' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alef' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Alegreya' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Alegreya SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Alegreya Sans' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Alegreya Sans SC' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Alex Brush' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Alfa Slab One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alice' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alike' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alike Angular' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Allan' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Allerta' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Allerta Stencil' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Allura' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Almendra' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Almendra Display' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Almendra SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Amarante' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Amaranth' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Amatic SC' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Amethysta' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Anaheim' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Andada' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Andika' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Angkor' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Annie Use Your Telescope' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Anonymous Pro' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Antic' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Antic Didone' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Antic Slab' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Anton' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Arapey' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Arbutus' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Arbutus Slab' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Architects Daughter' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Archivo Black' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Archivo Narrow' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Arimo' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Arizonia' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Armata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Artifika' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Arvo' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Asap' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Asset' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Astloch' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Asul' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Atomic Age' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Aubrey' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Audiowide' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Autour One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Average' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Average Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Averia Gruesa Libre' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Averia Libre' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Averia Sans Libre' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Averia Serif Libre' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Bad Script' => array('subsets' => array('cyrillic', 'latin'), 'variants' => array('400')),
            'Balthazar' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bangers' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Basic' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Battambang' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Baumans' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bayon' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Belgrano' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Belleza' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'BenchNine' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '700')),
            'Bentham' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Berkshire Swash' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bevan' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bigelow Rules' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bigshot One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bilbo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bilbo Swash Caps' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bitter' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Black Ops One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bokor' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Bonbon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Boogaloo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bowlby One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bowlby One SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Brawler' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bree Serif' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bubblegum Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bubbler One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Buda' => array('subsets' => array('latin'), 'variants' => array('300')),
            'Buenard' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Butcherman' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Butterfly Kids' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cabin' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic')),
            'Cabin Condensed' => array('subsets' => array('latin'), 'variants' => array('400', '500', '600', '700')),
            'Cabin Sketch' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Caesar Dressing' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cagliostro' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Calligraffitti' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cambo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Candal' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cantarell' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Cantata One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cantora One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Capriola' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cardo' => array('subsets' => array('greek-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700')),
            'Carme' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Carrois Gothic' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Carrois Gothic SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Carter One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Caudex' => array('subsets' => array('greek-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Cedarville Cursive' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ceviche One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Changa One' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Chango' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chau Philomene One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Chela One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chelsea Market' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chenla' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Cherry Cream Soda' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cherry Swash' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Chewy' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Chicle' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chivo' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '900', '900italic')),
            'Cinzel' => array('subsets' => array('latin'), 'variants' => array('400', '700', '900')),
            'Cinzel Decorative' => array('subsets' => array('latin'), 'variants' => array('400', '700', '900')),
            'Clicker Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Coda' => array('subsets' => array('latin'), 'variants' => array('400', '800')),
            'Coda Caption' => array('subsets' => array('latin'), 'variants' => array('800')),
            'Codystar' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400')),
            'Combo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Comfortaa' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('300', '400', '700')),
            'Coming Soon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Concert One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Condiment' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Content' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Contrail One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Convergence' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cookie' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Copse' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Corben' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Courgette' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cousine' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Coustard' => array('subsets' => array('latin'), 'variants' => array('400', '900')),
            'Covered By Your Grace' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Crafty Girls' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Creepster' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Crete Round' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Crimson Text' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '600', '600italic', '700', '700italic')),
            'Croissant One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Crushed' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cuprum' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Cutive' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cutive Mono' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Damion' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Dancing Script' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Dangrek' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Dawning of a New Day' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Days One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Delius' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Delius Swash Caps' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Delius Unicase' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Della Respira' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Denk One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Devonshire' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Didact Gothic' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400')),
            'Diplomata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Diplomata SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Domine' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Donegal One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Doppio One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Dorsa' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Dosis' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', '500', '600', '700', '800')),
            'Dr Sugiyama' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Droid Sans' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Droid Sans Mono' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Droid Serif' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Duru Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Dynalight' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'EB Garamond' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese'), 'variants' => array('400')),
            'Eagle Lake' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Eater' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Economica' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Electrolize' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Elsie' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '900')),
            'Elsie Swash Caps' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '900')),
            'Emblema One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Emilys Candy' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Engagement' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Englebert' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Enriqueta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Erica One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Esteban' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Euphoria Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ewert' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Exo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Exo 2' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Expletus Sans' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic')),
            'Fanwood Text' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Fascinate' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fascinate Inline' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Faster One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fasthand' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Fauna One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Federant' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Federo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Felipa' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fenix' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Finger Paint' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fjalla One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fjord One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Flamenco' => array('subsets' => array('latin'), 'variants' => array('300', '400')),
            'Flavors' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fondamento' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Fontdiner Swanky' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Forum' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Francois One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Freckle Face' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fredericka the Great' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fredoka One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Freehand' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Fresca' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Frijole' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fruktur' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fugaz One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'GFS Didot' => array('subsets' => array('greek'), 'variants' => array('400')),
            'GFS Neohellenic' => array('subsets' => array('greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Gabriela' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gafata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Galdeano' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Galindo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gentium Basic' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Gentium Book Basic' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Geo' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Geostar' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Geostar Fill' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Germania One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Gilda Display' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Give You Glory' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Glass Antiqua' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Glegoo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gloria Hallelujah' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Goblin One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Gochi Hand' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Gorditas' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Goudy Bookletter 1911' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Graduate' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Grand Hotel' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gravitas One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Great Vibes' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Griffy' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gruppo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gudea' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Habibi' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Hammersmith One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Hanalei' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Hanalei Fill' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Handlee' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Hanuman' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Happy Monkey' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Headland One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Henny Penny' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Herr Von Muellerhoff' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Holtwood One SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Homemade Apple' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Homenaje' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'IM Fell DW Pica' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell DW Pica SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell Double Pica' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell Double Pica SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell English' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell English SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell French Canon' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell French Canon SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell Great Primer' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell Great Primer SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Iceberg' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Iceland' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Imprima' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Inconsolata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Inder' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Indie Flower' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Inika' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Irish Grover' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Istok Web' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Italiana' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Italianno' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Jacques Francois' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Jacques Francois Shadow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Jim Nightshade' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Jockey One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Jolly Lodger' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Josefin Sans' => array('subsets' => array('latin'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic')),
            'Josefin Slab' => array('subsets' => array('latin'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic')),
            'Joti One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Judson' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700')),
            'Julee' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Julius Sans One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Junge' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Jura' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('300', '400', '500', '600')),
            'Just Another Hand' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Just Me Again Down Here' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kameron' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Kantumruy' => array('subsets' => array('khmer'), 'variants' => array('300', '400', '700')),
            'Karla' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Kaushan Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kavoon' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kdam Thmor' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Keania One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kelly Slab' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Kenia' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Khmer' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Kite One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Knewave' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kotta One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Koulen' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Kranky' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Kreon' => array('subsets' => array('latin'), 'variants' => array('300', '400', '700')),
            'Kristi' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Krona One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'La Belle Aurore' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lancelot' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lato' => array('subsets' => array('latin'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic')),
            'League Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Leckerli One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ledger' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Lekton' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Lemon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Libre Baskerville' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Life Savers' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Lilita One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Lily Script One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Limelight' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Linden Hill' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Lobster' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Lobster Two' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Londrina Outline' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Londrina Shadow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Londrina Sketch' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Londrina Solid' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lora' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Love Ya Like A Sister' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Loved by the King' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lovers Quarrel' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Luckiest Guy' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lusitana' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Lustria' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Macondo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Macondo Swash Caps' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Magra' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Maiden Orange' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Mako' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Marcellus' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Marcellus SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Marck Script' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Margarine' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Marko One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Marmelad' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Marvel' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Mate' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Mate SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Maven Pro' => array('subsets' => array('latin'), 'variants' => array('400', '500', '700', '900')),
            'McLaren' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Meddon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'MedievalSharp' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Medula One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Megrim' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Meie Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Merienda' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Merienda One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Merriweather' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic')),
            'Merriweather Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '800', '800italic')),
            'Metal' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Metal Mania' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Metamorphous' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Metrophobic' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Michroma' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Milonga' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Miltonian' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Miltonian Tattoo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Miniver' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Miss Fajardose' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Modern Antiqua' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Molengo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Molle' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('italic')),
            'Monda' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Monofett' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Monoton' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Monsieur La Doulaise' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Montaga' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Montez' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Montserrat' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Montserrat Alternates' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Montserrat Subrayada' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Moul' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Moulpali' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Mountains of Christmas' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Mouse Memoirs' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mr Bedfort' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mr Dafoe' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mr De Haviland' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mrs Saint Delafield' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mrs Sheppards' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Muli' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic')),
            'Mystery Quest' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Neucha' => array('subsets' => array('cyrillic', 'latin'), 'variants' => array('400')),
            'Neuton' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', 'italic', '700', '800')),
            'New Rocker' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'News Cycle' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Niconne' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Nixie One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nobile' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Nokora' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Norican' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Nosifer' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Nothing You Could Do' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Noticia Text' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Noto Sans' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Noto Serif' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Nova Cut' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Flat' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Mono' => array('subsets' => array('latin', 'greek'), 'variants' => array('400')),
            'Nova Oval' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Round' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Slim' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Square' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Numans' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nunito' => array('subsets' => array('latin'), 'variants' => array('300', '400', '700')),
            'Odor Mean Chey' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Offside' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Old Standard TT' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700')),
            'Oldenburg' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Oleo Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Oleo Script Swash Caps' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Open Sans' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic')),
            'Open Sans Condensed' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('300', '300italic', '700')),
            'Oranienbaum' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Orbitron' => array('subsets' => array('latin'), 'variants' => array('400', '500', '700', '900')),
            'Oregano' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Orienta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Original Surfer' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Oswald' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '700')),
            'Over the Rainbow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Overlock' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Overlock SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ovo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Oxygen' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '700')),
            'Oxygen Mono' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'PT Mono' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'PT Sans' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'PT Sans Caption' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', '700')),
            'PT Sans Narrow' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', '700')),
            'PT Serif' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'PT Serif Caption' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Pacifico' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Paprika' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Parisienne' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Passero One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Passion One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700', '900')),
            'Pathway Gothic One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Patrick Hand' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('400')),
            'Patrick Hand SC' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('400')),
            'Patua One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Paytone One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Peralta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Permanent Marker' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Petit Formal Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Petrona' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Philosopher' => array('subsets' => array('cyrillic', 'latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Piedra' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Pinyon Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Pirata One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Plaster' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Play' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', '700')),
            'Playball' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Playfair Display' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', '400italic', '700', '700italic')),
            'Playfair Display SC' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Podkova' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Poiret One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Poller One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Poly' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Pompiere' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Pontano Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
			'Poppins' => array('subsets' => array('latin', 'latin-ext', 'devanagari'), 'variants' => array('300', '400', '500', '600', '700')),
            'Port Lligat Sans' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Port Lligat Slab' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Prata' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Preahvihear' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Press Start 2P' => array('subsets' => array('cyrillic', 'latin', 'latin-ext', 'greek'), 'variants' => array('400')),
            'Princess Sofia' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Prociono' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Prosto One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Puritan' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Purple Purse' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Quando' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Quantico' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Quattrocento' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Quattrocento Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Questrial' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Quicksand' => array('subsets' => array('latin'), 'variants' => array('300', '400', '700')),
            'Quintessential' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Qwigley' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Racing Sans One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Radley' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Raleway' => array('subsets' => array('latin'), 'variants' => array('500','600','700')),
            'Raleway Dots' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rambla' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Rammetto One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ranchers' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rancho' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Rationale' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Redressed' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Reenie Beanie' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Revalia' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ribeye' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ribeye Marrow' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Righteous' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Risque' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Roboto' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '900', '900italic')),
            'Roboto Condensed' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Roboto Slab' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('100', '300', '400', '700')),
            'Rochester' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Rock Salt' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Rokkitt' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Romanesco' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ropa Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Rosario' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Rosarivo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Rouge Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ruda' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700', '900')),
            'Rufina' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Ruge Boogie' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ruluko' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rum Raisin' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ruslan Display' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Russo One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Ruthie' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rye' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sacramento' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sail' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Salsa' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sanchez' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Sancreek' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sansita One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sarina' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Satisfy' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Scada' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Schoolbell' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Seaweed Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sevillana' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Seymour One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Shadows Into Light' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Shadows Into Light Two' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Shanti' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Share' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Share Tech' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Share Tech Mono' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Shojumaru' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Short Stack' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Siemreap' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Sigmar One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Signika' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '600', '700')),
            'Signika Negative' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '600', '700')),
            'Simonetta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '900', '900italic')),
            'Sintony' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Sirin Stencil' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Six Caps' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Skranji' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Slackey' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Smokum' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Smythe' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sniglet' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '800')),
            'Snippet' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Snowburst One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sofadi One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sofia' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sonsie One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sorts Mill Goudy' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Source Code Pro' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', '500', '600', '700', '900')),
            'Source Sans Pro' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '900', '900italic')),
            'Special Elite' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Spicy Rice' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Spinnaker' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Spirax' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Squada One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Stalemate' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Stalinist One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Stardos Stencil' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Stint Ultra Condensed' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Stint Ultra Expanded' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Stoke' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400')),
            'Strait' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sue Ellen Francisco' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sunshiney' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Supermercado One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Suwannaphum' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Swanky and Moo Moo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Syncopate' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Tangerine' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Taprom' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Tauri' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Telex' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Tenor Sans' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Text Me One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'The Girl Next Door' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Tienne' => array('subsets' => array('latin'), 'variants' => array('400', '700', '900')),
            'Tinos' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Titan One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Titillium Web' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '900')),
            'Trade Winds' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Trocchi' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Trochut' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700')),
            'Trykker' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Tulpen One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ubuntu' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic')),
            'Ubuntu Condensed' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400')),
            'Ubuntu Mono' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Ultra' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Uncial Antiqua' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Underdog' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Unica One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'UnifrakturCook' => array('subsets' => array('latin'), 'variants' => array('700')),
            'UnifrakturMaguntia' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Unkempt' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Unlock' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Unna' => array('subsets' => array('latin'), 'variants' => array('400')),
            'VT323' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vampiro One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Varela' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Varela Round' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vast Shadow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vibur' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vidaloka' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Viga' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Voces' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Volkhov' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Vollkorn' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Voltaire' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Waiting for the Sunrise' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Wallpoet' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Walter Turncoat' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Warnes' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Wellfleet' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Wendy One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Wire One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Yanone Kaffeesatz' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', '700')),
            'Yellowtail' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Yeseva One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Yesteryear' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Zeyada' => array('subsets' => array('latin'), 'variants' => array('400'))
        );

    }
	
    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    protected function _defaultValues()
    {
	    $response = true;
        foreach($this->getThemeFields() as $k=>$v){
			$response &= Configuration::updateValue($k, $v,true);
		}
        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    protected function _deleteConfigs()
    {
		$response = true;
        foreach($this->getThemeFields() as $k=>$v){
            $response &= Configuration::deleteByName($k);
		}
        return $response;
    }

   

    /* ------------------------------------------------------------- */
    /*  CREATE THE TAB MENU
    /* ------------------------------------------------------------- */
    protected function _createTab()
    {
        $response = true;
        // First check for parent tab
        $parentTabID = Tab::getIdFromClassName('AdminAZ');

        if ($parentTabID) {
            $parentTab = new Tab($parentTabID);
        }
        else {
            $parentTab = new Tab();
            $parentTab->active = 1;
            $parentTab->name = array();
            $parentTab->class_name = "AdminParentPreferences";
            foreach (Language::getLanguages() as $lang) {
                $parentTab->name[$lang['id_lang']] = "AZ Templates";
            }
            $parentTab->id_parent = 0;
            $parentTab->module = $this->name;
            $response &= $parentTab->add();
        }

        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = "AdminAZConfig";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = "AZ Theme Editor";
        }
        $tab->id_parent = $parentTab->id;
        $tab->module = $this->name;
        $response &= $tab->add();

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TAB MENU
    /* ------------------------------------------------------------- */
    protected function _deleteTab()
    {
        $id_tab = Tab::getIdFromClassName('AdminAZConfig');
        $parentTabID = Tab::getIdFromClassName('AdminParentPreferences');

        $tab = new Tab($id_tab);
        $tab->delete();

        // Get the number of tabs inside our parent tab
        // If there is no tabs, remove the parent
        $tabCount = Tab::getNbTabs($parentTabID);
        if ($tabCount == 0) {
            $parentTab = new Tab($parentTabID);
            $parentTab->delete();
        }

        return true;
    }
	
	 // Font Options
	 public function fontOptions() {
		$system = $google = array();
		foreach($this->systemFonts as $fontName)
			$system[] = array('id'=>$fontName,'name'=>$fontName);
		foreach($this->googleFonts as $fontName => $fontInfo)
			$google[] = array('id'=>$fontName,'name'=>$fontName);
		$module = new azthemeconfigurator();
		return array(
			array('name'=>$module->l('System Web fonts'),'query'=>$system),
			array('name'=>$module->l('Google Web Fonts'),'query'=>$google),
		);
	 }
	
	// Patterns Options
	 public function getPatternsArray(){
        $arr = array();
        for($i=1;$i<=9;$i++)
            $arr[] = array('id'=>$i,'name'=>$i); 
        return $arr;   
    }
	public function getPatterns(){
        $html = '';
        foreach(range(1,9) as $v)
            $html .= '<div class="parttern_wrap"><span>'.$v.'</span><img src="'.$this->_path.'patterns/'.$v.'.png" /></div>';
        return $html;
    }
       
		

	
    /* ------------------------------------------------------------- */
    /*  GET CONTENT
    /* ------------------------------------------------------------- */
    public function getContent()
    {
			
        $id_shop = $this->context->shop->id;
        $languages = $this->context->language->getLanguages();
        $errors = array();

        // Load css file for option panel
        $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/admin/az_themeconfig.css');
        // Load js file for option panel
        $this->context->controller->addJqueryPlugin('azthemes', _MODULE_DIR_ . $this->name . '/views/js/admin/');
		
	
        if (Tools::isSubmit('submit' . $this->name)) {
            // Standard config
            foreach ($this->_standardConfig as $config) {
                if (Tools::isSubmit($config)) {
                    Configuration::updateValue($config, Tools::getValue($config),true);
                }
				
            }
			
            // Style config
            foreach ($this->_styleConfig as $config) {
				
                // Check if the config is a background image
                if (in_array($config, $this->_bgImageConfig)) {
				
                    if (isset($_FILES[$config]) && isset($_FILES[$config]['tmp_name']) && !empty($_FILES[$config]['tmp_name'])) {
                        if ($error = ImageManager::validateUpload($_FILES[$config], Tools::convertBytes(ini_get('upload_max_filesize')))) {
                            $errors[] = $error;
                        }
                        else {
                            $imageName = explode('.', $_FILES[$config]['name']);
                            $imageExt = $imageName[1];
                            $imageName = $imageName[0];
                            $backgroundImageName = $imageName . '-' . $id_shop . '.' . $imageExt;
							
                            if (!move_uploaded_file($_FILES[$config]['tmp_name'], _PS_MODULE_DIR_ . $this->name . '/patterns/' . $backgroundImageName)) {
                                $errors[] = $this->l('File upload error.');
                            }
                            else {
                                Configuration::updateValue($config, $backgroundImageName);
                            }
                        }
                    }

                    continue;
                }

                if (Tools::isSubmit($config)) {
                    Configuration::updateValue($config, Tools::getValue($config),true);
                }
				
            }
           
            // Multilanguage config
            foreach ($this->_multiLangConfig as $config) {
                foreach ($languages as $language) {
                    if (Tools::isSubmit($config . '_' . $language['id_lang'])) {
                        $multilangConfig[$language['id_lang']] = Tools::getValue($config . '_' . $language['id_lang']);
                    }
                }
				
				if (is_array($multilangConfig) && $multilangConfig) {
                    Configuration::updateValue($config, $multilangConfig, true);
                }

                $multilangConfig = false;
					
            }
			
            // Custom Codes
            if (Tools::isSubmit('AZ_customCSS')) {
                Configuration::updateValue('AZ_customCSS', Tools::getValue('AZ_customCSS'));
            }

            if (Tools::isSubmit('AZ_customJS')) {
                Configuration::updateValue('AZ_customJS', Tools::getValue('AZ_customJS'));
            }
			
            // Write the configurations to a CSS file
            $response = $this->_writeCss();
			
			
            if (!$response) {
                $errors[] = $this->l('An error occured while writing the css file!');
            }

            // Prepare the output
            if (count($errors)) {
                $this->_output .= $this->displayError(implode('<br />', $errors));
            }
            else {
                $this->_output .= $this->displayConfirmation($this->l('Configuration updated'));
            }
			
			
			
        } elseif (Tools::isSubmit('deleteConfig')) {
            $config = Tools::getValue('deleteConfig');
            $configValue = Configuration::get($config);

            if (file_exists(_PS_MODULE_DIR_ . $this->name . '/patterns/' . $configValue)) {
                unlink(_PS_MODULE_DIR_ . $this->name . '/patterns/' . $configValue);
            }

            Configuration::updateValue($config, null);

        }
       
		// HTML content setting
        return $this->_output . $this->getFormHTML();
    }

    /* ------------------------------------------------------------- */
    /*  DISPLAY CONFIGURATION FORM
    /* ------------------------------------------------------------- */
    private function getFormHTML()
    {
        $id_default_lang = $this->context->language->id;
        $languages = $this->context->language->getLanguages();
        $id_shop = $this->context->shop->id;

        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = $id_default_lang;
        $helper->allow_employee_form_lang = $id_default_lang;
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules'),
            )
        );

        foreach ($languages as $language) {
            $helper->languages[] = array(
                'id_lang' => $language['id_lang'],
                'iso_code' => $language['iso_code'],
                'name' => $language['name'],
                'is_default' => ($id_default_lang == $language['id_lang'] ? 1 : 0)
            );
        }
		
		
        // Load standard field values
        foreach ($this->_standardConfig as $key => $standardField) {
            $helper->fields_value[$standardField] = Configuration::get($standardField);
			
        }
		
        // Load css field values
        foreach ($this->_styleConfig as $key => $cssField) {
            $helper->fields_value[$cssField] = Configuration::get($cssField);
        }

         // Load multi-language field values
        foreach ($this->_multiLangConfig as $key => $multiLangField) {
            foreach ($languages as $language) {
                $helper->fields_value[$multiLangField][$language['id_lang']] = Tools::getValue($multiLangField . '_' . $language['id_lang'], Configuration::get($multiLangField, $language['id_lang']));
            }
        }
        
        // Custom variables 	
        $helper->tpl_vars = array(
            'aztabs' => $this->getTabs(),
            'versions' => $this->versions,
            'imagePath' => _MODULE_DIR_ . $this->name . '/patterns/',
			'controller_url' => $this->context->link->getAdminLink('AdminAZConfig'),
            'shopId' => $id_shop
        );
		
        return $helper->generateForm(array(
			'general' 	=> $this->generalSettings(),
			'layout'  	=> $this->layoutSettings(),
			'background'  	=> $this->backgroundSettings(),
			'fonts'  	=> $this->fontSettings(),
			'category'  => $this->categorySettings(),
			'product'  	=> $this->productSettings(),
			'bonuspage' => $this->bonuspageSettings(),
			'advanced'  => $this->advancedSettings(),
			'social'   => $this->socialSettings(),
			'custom'   => $this->customSettings(),
			
		));
    }


    /* ------------------------------------------------------------- */
    /*  GET TABS
    /* ------------------------------------------------------------- */
    private function getTabs(){
        $tabArray = array(
            '<i class="icon-home"></i> General' 				=> 'fieldset_general',
            '<i class="icon-credit-card"></i> Layout' 			=> 'fieldset_layout',
			'<i class="icon-picture-o"></i> Background'    => 'fieldset_background',
			'<i class="icon-font"></i> Fonts' 					=> 'fieldset_fonts',
            '<i class="icon-folder-open"></i> Category Page' 	=> 'fieldset_category',
            '<i class="icon-file-text"></i> Product Page' 		=> 'fieldset_product',
			'<i class="icon-archive"></i> Blog Pages' 		    => 'fieldset_bonuspage',
            '<i class="icon-AdminAdmin"></i> Advanced' 			=> 'fieldset_advanced',
			'<i class="icon-group"></i> Social Accounts' 		=> 'fieldset_social',
			'<i class="icon-pencil-square"></i> Custom Codes' 	=> 'fieldset_custom'
        );

        return $tabArray;
    }
	
	/*	TABS GENERAL*/
	protected function generalSettings() {
		$fields_form = array(
			$this->field_onOff('AZ_stickyMenu','Sticky Menu'),
			$this->field_onOff('AZ_responsive', 'Responsive Layout','','Enable responsive design for mobile devices'),
			$this->field_onOff('AZ_animationScroll','Anmation Scroll'),
			$this->field_onOff('AZ_liveEditor','Display Live Editor'),
			array(
				'type' => 'file',
				'name' => 'AZ_paymentImage',
				'label' => $this->l('Payments Image Footer'),
			),
			$this->field_text ('AZ_wellcomeMsg', 'Guest Welcome Msg','', true),
			$this->field_text ('AZ_loggedMsg', 'Logged Welcome Msg','', true),
			$this->field_text ('AZ_copyRight', 'Copyright Text Footer', '', true),
			
		
        );
		return $this->getFormSection($fields_form, 'General');
	}
	
	/*	TABS LAYOUT*/
	protected function layoutSettings() {
		$fields_form = array(
			array(
				'type' => 'color',
				'label' => $this->l('Theme Skin'),
				'name' => 'AZ_themeSkin'
			),
			 array(
				 'type' => 'select',
				 'label' => $this->l('Select Header'),
				 'name' => 'AZ_headerOption',
				 'options' => array(
					 'query' => array(
						 array('value' => 'header-v1', 'name' => 'Header 1'),
						 
					 ),
					 'id' => 'value',
					 'name' => 'name',
				 ),
			 ),
			 array(
				 'type' => 'select',
				 'label' => $this->l('Select Content'),
				 'name' => 'AZ_contentOption',
				 'options' => array(
					 'query' => array(
						 array('value' => 'content-v1', 'name' => 'Content 1'),
						 
					 ),
					 'id' => 'value',
					 'name' => 'name',
				 ),
			 ),
			 array(
				 'type' => 'select',
				 'label' => $this->l('Select Footer'),
				 'name' => 'AZ_footerOption',
				 'options' => array(
					 'query' => array(
						 array('value' => 'footer-v1', 'name' => 'Footer 1'),
					 ),
					 'id' => 'value',
					 'name' => 'name',
				 ),
			 ),
			array(
				'type' => 'select',
				'label' => $this->l('Select Layout'),
				'name' => 'AZ_layoutOption',
				'options' => array(
				   'query' => array(
						array('value' => 'layout-full', 'name' => 'Full Width'),
						array('value' => 'layout-boxed', 'name' => 'Boxed'),
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			$this->field_text ('AZ_layoutWidth', 'Layout Width', 'input-large', false, '','px')
			
        );
		return $this->getFormSection($fields_form, 'Layout');
	}
	
	/*	TABS Background*/
	protected function backgroundSettings() {
		$fields_form = array(
			array(
				'type' => 'color',
				'label' => $this->l('Background Color'),
				'name' => 'AZ_bgColor',
			),
			array(
				'type' => 'select',
				'name' => 'AZ_bgRepeat',
				'label' => $this->l('Background Repeat'),
				'options' => array(
					'query' => array(
						array('value' => 'repeat-x','name' => 'Repeat-X'),
						array('value' => 'repeat-y','name' => 'Repeat-Y'),
						array('value' => 'repeat','name' => 'Repeat Both'),
						array('value' => 'no-repeat','name' => 'No Repeat')
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			array(
				'type' => 'select',
				'name' => 'AZ_bgAttachment',
				'label' => $this->l('Background Attachment'),
				'options' => array(
					'query' => array(
						array('value' => 'scroll', 'name' => 'Scroll'),
						array('value' => 'fixed', 'name' => 'Fixed')
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			array(
				'type' => 'select',
				'label' => $this->l('Background Image'),
				'name' => 'AZ_patternOption',
				'options' => array(
					'query' => $this->getPatternsArray(),
					'id' => 'id',
					'name' => 'name',
					'default' => array(
						'value' => 'none',
						'label' => $this->l('None')
					),
				),
				'desc' => $this->getPatterns(),
				'validation' => 'isUnsignedInt',
			)
        );
		return $this->getFormSection($fields_form, 'Background');
	}
	
	/*	TABS FONTS*/
	protected function fontSettings() {
		$fields_form = array(
			
			array(
				'type' => 'select',
				'label' => $this->l('Body font'),
				'name' => 'AZ_mainFont',
				'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
				'class' => 'fontOptions',
				'options' => array(
				   'optiongroup' => array (
						'query' => $this->fontOptions(),
						'label' => 'name'
					),
					'options' => array (
						'query' => 'query',
						'id' => 'id',
						'name' => 'name'
					),
					'default' => array(
						'value' => 0,
						'label' => $this->l('Use default')
					),
				),
				'desc' => '<p  id="AZ_mainFont_example" class="fontshow">Example normal text</p>',
				'validation' => 'isGenericName',
			),
			$this->field_text ('AZ_bodySelectors', 'Font selector', 'text_Selectors', false),
			array(
				'type' => 'select',
				'label' => $this->l('Menu font: '),
				'name' => 'AZ_menuFont',
				'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
				'class' => 'fontOptions',
				'options' => array(
				   'optiongroup' => array (
						'query' => $this->fontOptions(),
						'label' => 'name'
					),
					'options' => array (
						'query' => 'query',
						'id' => 'id',
						'name' => 'name'
					),
					'default' => array(
						'value' => 0,
						'label' => $this->l('Use default')
					),
				),
				'desc' => '<p  id="AZ_menuFont_example" class="fontshow">Example normal text</p>',
				'validation' => 'isGenericName',
			),
			$this->field_text ('AZ_menuSelectors', 'Font selector', 'text_Selectors', false),
			array(
				'type' => 'select',
				'label' => $this->l('Headings font'),
				'name' => 'AZ_headingsFont',
				'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
				'class' => 'fontOptions',
				'options' => array(
				   'optiongroup' => array (
						'query' => $this->fontOptions(),
						'label' => 'name'
					),
					'options' => array (
						'query' => 'query',
						'id' => 'id',
						'name' => 'name'
					),
					'default' => array(
						'value' => 0,
						'label' => $this->l('Use default')
					),
				),
				'desc' => '<p  id="AZ_headingsFont_example" class="fontshow">Example normal text</p>',
				'validation' => 'isGenericName',
			),
			$this->field_text ('AZ_headSelectors', 'Font selector', 'text_Selectors', false),
			array(
				'type' => 'select',
				'name' => 'AZ_otherFont',
				'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
				'label' => $this->l('Other font: '),
				'class' => 'fontOptions',
				'options' => array(
				   'optiongroup' => array (
						'query' => $this->fontOptions(),
						'label' => 'name'
					),
					'options' => array (
						'query' => 'query',
						'id' => 'id',
						'name' => 'name'
					),
					'default' => array(
						'value' => 0,
						'label' => $this->l('Use default')
					),
				),
				'desc' => '<p  id="AZ_otherFont_example" class="fontshow">Example normal text</p>',
				'validation' => 'isGenericName',
			),
			$this->field_text ('AZ_otherSelectors', 'Font selector', 'text_Selectors', false),
			
			
		
        );
		return $this->getFormSection($fields_form, 'Fonts');
	}
	
	/*	TABS CATEGORY*/
	protected function categorySettings() {
		$fields_form = array(
			$this->field_onOff('AZ_subCat','Display Subcategories'),
			array(
				'type' => 'select',
				'name' => 'AZ_subCatColumns',
				'label' => $this->l('Subcategories Columns '),
				'required' => false,
				'lang' => false,
				'options' => array(
					'query' => array(
						array('value' => '2', 'name' => '2 Columns'),
						array('value' => '3', 'name' => '3 Columns'),
						array('value' => '4', 'name' => '4 Columns'),
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			$this->field_onOff('AZ_subCatTitle', 'Subcategories Title'),
			$this->field_onOff('AZ_subCatDes','Subcategories Description'),
			array(
				'type' => 'select',
				'label' => $this->l('Display Sidebar'),
				'name' => 'AZ_sidebar',
				'options' => array(
					'query' => array(
						array('value' => 'none', 'name' => 'None'),
						array('value' => 'left', 'name' => 'Left Sidebar'),
						array('value' => 'right', 'name' => 'Right Sidebar')
					),
					'id' => 'value',
					'name' => 'name'
				),
			),
			array(
				'type' => 'select',
				'name' => 'AZ_productColumns',
				'label' => $this->l('Product Columns'),
				'desc' =>  $this->l('Only for "Grid" view'),
				'required' => false,
				'lang' => false,
				'options' => array(
					'query' => array(
						array('value' => '2', 'name' => '2 Columns'),
						array('value' => '3', 'name' => '3 Columns'),
						array('value' => '4', 'name' => '4 Columns'),
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			$this->field_onOff('AZ_productTitle','Product Title','Only for "Grid" view'),
			$this->field_onOff('AZ_productDes','Product Description','Only for "Grid" view'),
			$this->field_onOff('AZ_productColor','Product Colors','Only for "Grid" view'),
			$this->field_onOff('AZ_productStock','Product Stock','Only for "Grid" view'),
			$this->field_onOff('AZ_secondImg', 'Display Second Image'),
			$this->field_onOff('AZ_quickView','Enable Quick View'),
			$this->field_onOff('AZ_productCatRating','Product Rating'),
			
        );
		return $this->getFormSection($fields_form, 'Category Pages');
	}
	
	/*	TABS PRODUCT*/
	protected function productSettings() {
		$fields_form = array(
		
			array(
				 'type' => 'select',
				 'label' => $this->l('Product Page Styles'),
				 'name' => 'AZ_productOption',
				 'options' => array(
					 'query' => array(
						 array('value' => 'product-full', 'name' => 'Product Full '),
						 array('value' => 'product-left', 'name' => 'Product Left Sidebar'),
						 array('value' => 'product-right', 'name' => 'Product Right Sidebar'),
					 ),
					 'id' => 'value',
					 'name' => 'name',
				 ),
			 ),
			$this->field_onOff('AZ_zoomImage', 'Zoom Image Effect'),
			$this->field_onOff('AZ_productRating', 'Product Rating (Review)'),
			$this->field_onOff('AZ_share','Share buttons'),
			$this->field_onOff('AZ_producShortdesc','Short Product Description'),
			$this->field_onOff('AZ_productTaxLabel','Display tax label'),			
        );
		return $this->getFormSection($fields_form, 'Product Pages');
	}
	
	/*	TABS BONUS PAGE*/
	protected function bonuspageSettings() {
		$fields_form = array(
			
			 array(
				 'type' => 'select',
				 'label' => $this->l('Blog styles'),
				 'name' => 'AZ_blogOption',
				 'options' => array(
					 'query' => array(
						 array('value' => 'blog-grid', 'name' => 'Blog Grid 2 Columns'),
						 array('value' => 'blog-small_image', 'name' => 'Blog Small Image'),
						 array('value' => 'blog-large_image', 'name' => 'Blog Large Image'),
					 ),
					 'id' => 'value',
					 'name' => 'name',
				 ),
			 ),
			array(
                    'type' => 'text',
                    'label' => $this->l('Number of posts per page'),
                    'name' => 'smartpostperpage',
                    'size' => 6,
                    'required' => false
                ),
			
        );
		return $this->getFormSection($fields_form, 'Blog Pages');
	}
	
	/*	TABS ADVANCED*/
	protected function advancedSettings() {
		$fields_form = array(
			$this->field_onOff('AZ_Scsscompile', 'SCSS Compile'),
			array(
				'type' => 'select',
				'label' => $this->l('CSS Format'),
				'name' => 'AZ_Scssformat',
				'options' => array(
					'query' => array(
						array('id' => 'scss_formatter', 'name' => 'scss_formatter'),
						array('id' => 'scss_formatter_nested', 'name' => 'scss_formatter_nested'),
						array('id' => 'scss_formatter_compressed', 'name' => 'scss_formatter_compressed')
					),
					'id' => 'id',
					'name' => 'name'
				)
			),
			array(
				'name' => 'AZ_clearcss',
				'type' => 'btn_clearcss',
			),
        );
		return $this->getFormSection($fields_form, 'Advanced');
	}
	
	
	/*	TABS SOCIAL*/
	protected function socialSettings() {
		$fields_form = array(
			$this->field_onOff('AZ_socialFooter', 'Show Social Footer '),
			$this->field_text('AZ_sfFacebook','Facebook <i class="icon-facebook-square"> </i>', 'input-large', false),
			$this->field_text('AZ_sfTwitter','Twitter <i class="icon-twitter-square"> </i> ', 'input-large', false),
			$this->field_text('AZ_sfGoogle','Google <i class="icon-google-plus-square"> </i> ', 'input-large', false),
			$this->field_text('AZ_sfFlickr','Flickr <i class="icon-flickr"> </i> ', 'input-large', false),
			$this->field_text('AZ_sfPinterest','Pinterest <i class="icon-pinterest"> </i>', 'input-large', false),
			$this->field_text('AZ_sfLinkedIn','LinkedIn <i class="icon-linkedin-square"> </i>', 'input-large', false),
			
        );
		return $this->getFormSection($fields_form, 'Social Accounts');
	}
	
	/*	TABS CUSTOM CODE*/
	protected function customSettings() {
		$fields_form = array(
			$this->field_textarea ('AZ_customCSS', 'Custom CSS Code','',false,false),
			$this->field_textarea ('AZ_customJS', 'Custom JS Code','',false,false),
        );
		return $this->getFormSection($fields_form, 'Custom Codes');
	}
    /* ------------------------------------------------------------- */
    /*  WRITE CSS
    /* ------------------------------------------------------------- */
    private function _writeCss()
    {
        $id_shop = $this->context->shop->id;
        $cssFile = _PS_MODULE_DIR_ . $this->name . '/views/css/front/configCss-' . $id_shop . '.css';
        $handle = fopen($cssFile, 'w');
        $config = $this->_getThemeConfig();

        // Starting of the cssCode
        $cssCode = '';

        // Read _cssRules and create css rules
        foreach ($this->_cssRules as $configName => $css) {

            // Check if the config is set, and it's not the default value
            if ($config[$configName] == '') {
                continue;
            }
            if (isset($this->_configDefaults[$configName]) && $config[$configName] == $this->_configDefaults[$configName]) {
                continue;
            }

            // If the config is a font config then do this and write the css rule for it
            if ( in_array($configName, $this->_fontConfig) ){

                // Check if the font is one of the web-safe fonts,
                // if it's then just write the basic font-family rule
                if ( in_array($config[$configName], $this->systemFonts) ){
                    foreach ($css as $line){
                        $cssCode .= $line['selector'] . '{' . $line['rule'] . ':' . (isset($line['prefix']) ? $line['prefix'] : '') . (isset($line['value']) ? $line['value'] : '"' . $config[$configName] . '", "sans-serif"') . (isset($line['suffix']) ? $line['suffix'] : '') . ';}';
                    }
                    continue;
                }
				
                // If not then do some preparations for google fonts
                // then write the proper css rule
				
                $googleFontName 		= str_replace(' ', '+', $config[$configName]);
                $googleFontSubsets 		= $this->googleFonts[$config[$configName]]['subsets'];
                $googleFontVariants 	= $this->googleFonts[$config[$configName]]['variants'];
				
                
				
                $importCode = '@import "//fonts.googleapis.com/css?family='.$googleFontName;
				
                /* VARIANTS */
                // Include normal (400)
                $importCode .= ':400';
				
				// Include light if available
                if ( in_array('300', $googleFontVariants) ){
                    $importCode .= ',300';
                }
				
                // Include bold if available
                if ( in_array('700', $googleFontVariants) ){
                    $importCode .= ',700';
                }
				
				// Include medium if available
                if ( in_array('500', $googleFontVariants) ){
                    $importCode .= ',500';
                }
				
				// Include semibold if available
                if ( in_array('600', $googleFontVariants) ){
                    $importCode .= ',600';
                }
				
				// Include extra bold if available
                if ( in_array('900', $googleFontVariants) ){
                    $importCode .= ',900';
                }

                /* SUBSETS */
                // Include Latin and Latin-ext
                $importCode .= '&subset=latin,latin-ext';

                

                $importCode .= '";';
				
				
                $cssCode = $importCode . $cssCode;

                foreach ($css as $line){
                    $cssCode .= $line['selector'] . '{' . $line['rule'] . ':' . (isset($line['prefix']) ? $line['prefix'] : '') . (isset($line['value']) ? $line['value'] : '"' . $config[$configName] . '", "Helvetica", "Arial", "sans-serif"') . (isset($line['suffix']) ? $line['suffix'] : '') . ';}';
                }

                continue;
            }
			
				
            // Otherwise create the general css rule for it
			
            foreach ($css as $line) {
                $cssCode .= $line['selector'] . '{' . $line['rule'] . ':' . (isset($line['prefix']) ? $line['prefix'] : '') . (isset($line['value']) ? $line['value'] : $config[$configName]) . (isset($line['suffix']) ? $line['suffix'] : '') . ';}';
				
            }


        }

        $response = fwrite($handle, $cssCode);

        return $response;

    }
	
	
    /* ------------------------------------------------------------- */
    /*  GET THEME CONFIG
    /* ------------------------------------------------------------- */
    private function _getThemeConfig($standard = true, $style = true, $multiLang = true)
    {
        $id_default_lang = $this->context->language->id;
        $config = array();
		
        if ($standard) {
            foreach ($this->_standardConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem);
            }
        }
		
        if ($style) {
            foreach ($this->_styleConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem);
            }
        }

        if ($multiLang) {
            foreach ($this->_multiLangConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem, $id_default_lang);
            }
			
        }
		
        return $config;
    }

    
    /* ------------------------------------------------------------- */
    /*  PREPARE FOR HOOK
    /* ------------------------------------------------------------- */
    protected function _prepHook($params)
    {
        $config 		= 	$this->_getThemeConfig();
		$isLogged 		= 	$this->context->customer->isLogged();
		$firstname		=	$this->context->customer->firstname;
		$lastname		=	$this->context->customer->lastname;
		$AZ_loggedMsg	=	Configuration::get('AZ_loggedMsg', $this->context->language->id);
		$AZ_wellcomeMsg	=	Configuration::get('AZ_wellcomeMsg', $this->context->language->id);
		$AZ_paymentImage	=	Configuration::get('AZ_paymentImage');
		$bgPatternDir 	= $this->context->link->getMediaLink(_MODULE_DIR_ . $this->name . '/patterns/');
		
        if ($config) {
            foreach ($config as $key => $value) {
				$this->smarty->assignGlobal($key ,$value);
            }
        }
		
		/*Welcome msg*/
		$wellcome_txt= $isLogged  ? $AZ_loggedMsg.' '.$firstname.' '.$lastname : $AZ_wellcomeMsg;
		$this->context->smarty->assign('wellcome_txt',$wellcome_txt);
		$this->context->smarty->assign('paymentImage',$bgPatternDir.$AZ_paymentImage);
			
		/* COPYRIGHT */
		$copyRight = Configuration::get('AZ_copyRight',$this->context->language->id);
		if($copyRight !=''){
			$copyRight_short = str_replace('{year}', date('Y'), $copyRight);
			$copyRight_by = ' Designed By <a target="_blank" title="AZ Templates" href="aztemplates.Com">aztemplates.com</a>';
			//$copyRight_txt = $copyRight_short.' '.$copyRight_by; 
			$copyRight_txt = $copyRight_short; 
			$this->context->smarty->assign('copyRight_txt',$copyRight_txt);
		}
    }
	
	protected function field_textarea ($name, $label, $class = '', $lang = false, $editor = true, $hint = '') {
		$field = array ();
		$field['type'] = 'textarea';
		$field['label'] = $this->l($label);
		$field['name'] = $name;
		if($class) $field['class'] = $class;
		if($lang) $field['lang'] = $lang;
		if($editor) $field['autoload_rte'] = $editor;
		if($hint) $field['hint'] = $this->l($hint);
		
		return $field;
	}
	protected function field_text ($name, $label, $class = '', $lang = false, $hint = '',$suffix = '') {
		$field = array ();
		$field['type'] = 'text';
		$field['label'] = $label;
		$field['name'] = $name;
		
		if($class) $field['class'] = $class;
		if($lang) $field['lang'] = $lang;
		if($hint) $field['hint'] = $this->l($hint);
		if (!empty($suffix)) $field['suffix'] = $suffix;
		
		return $field;
	}
	protected function field_onOff ($name, $label,$des ='') {
		return array(
			'type' => 'switch',
			'label' => $label,
			'name' => $name,
			'desc' => $des,
			'is_bool' => true,
			'values' => array(
				array(
					'id' => $name.'_ON',
					'value' => 1,
					'label' => $this->l('Enabled')
				),
				array(
					'id' => $name.'_OFF',
					'value' => 0,
					'label' => $this->l('Disabled')
				)
			)
		);
	}
	protected function getFormSection ($fields_form, $title, $icon = 'icon-cogs') {
		return array(
			'form' => array(
				'legend' => array(
					'title' => $title,
					'icon' => $icon
				),
				'input' => $fields_form,
				'submit' => array(
					'title' => $this->l('Save')
				)
			)
		);
	}
	public function randColor($colors = null, $min = 0, $max = 255) {
		if($colors != null) {
			$colorArr = explode(',', $colors);
			foreach($colorArr as $k => $color) {
				$color = str_replace(' ', '', trim($color));
				if(preg_match('/^#[a-f0-9]{6}$|^#[a-f0-9]{3}$/i', $color)) $colorArr[$k] = strtolower($color);
				else unset($colorArr[$k]);
			}
			if(count($colorArr)) {
				$rand_key = array_rand($colorArr, 1);
				return $colorArr[$rand_key];
			}
			
			$colorArr = explode(',', $colors);
			foreach($colorArr as $k => $color) {
				$color = str_replace(' ', '', trim($color));
				if(is_int($color)) $colorArr[$k] = $color;
				else unset($colorArr[$k]);
			}
			if(count($colorArr)) {
				if($colorArr[0] < $colorArr[1]) {
					$min = $colorArr[0];
					$max = $colorArr[1];
				} else {
					$min = $colorArr[1];
					$max = $colorArr[0];
				}
			}
		}

		
		$color = '#';
		$color .= str_pad( dechex( mt_rand( $min, $max ) ), 2, '0', STR_PAD_LEFT);
		$color .= str_pad( dechex( mt_rand( $min, $max ) ), 2, '0', STR_PAD_LEFT);
		$color .= str_pad( dechex( mt_rand( $min, $max ) ), 2, '0', STR_PAD_LEFT);
		return $color;
	}
}
?>