<?php
/**
 * package   AZ Search Block
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.aztemplates.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

include_once ( '../../config/config.inc.php' );
include_once ( _PS_CONFIG_DIR_.'config.inc.php' );
include_once ( '../../init.php' );
include_once ( 'azsearchblock.php' );
$context = Context::getContext ();
class AzSearchBlockAjaxCore extends Search
{
	public static function find($id_lang, $expr, $page_number = 1, $page_size = 1, $order_by = 'position', $order_way = 'desc', $ajax = false,
		$use_cookie = true, Context $context = null)
	{
		$cate_id = Tools::getValue ('cat_id');
		$number_days_new_product = 9999;
		if ($number_days_new_product == 0)
			$number_days_new_product = -1;
		if (empty( $cate_id ) && empty($use_cookie))
			return;
		if (!$context)
			$context = Context::getContext ();
		$db = Db::getInstance (_PS_USE_SQL_SLAVE_);

		// todo_overwrite : smart page management
		if ($page_number < 1)
			$page_number = 1;
		if ($page_size < 1)
			$page_size = 1;

		if (!Validate::isOrderBy ($order_by) || !Validate::isOrderWay ($order_way))
			return false;

		$intersect_array = array();
		$score_array = array();
		$words = explode (' ', Search::sanitize ($expr, $id_lang, false, $context->language->iso_code));

		foreach ($words as $key => $word)
			if (!empty( $word ) && Tools::strlen ($word) >= (int)Configuration::get ('PS_SEARCH_MINWORDLEN'))
			{
				$word = str_replace ('%', '\\%', $word);
				$word = str_replace ('_', '\\_', $word);
				$start_search = Configuration::get ('PS_SEARCH_START')?'%':'';
				$end_search = Configuration::get ('PS_SEARCH_END')?'':'%';

				$intersect_array[] = 'SELECT si.id_product
					FROM '._DB_PREFIX_.'search_word sw
					LEFT JOIN '._DB_PREFIX_.'search_index si ON sw.id_word = si.id_word
					WHERE sw.id_lang = '.(int)$id_lang.'
						AND sw.word LIKE
					'.( $word[0] == '-'
						?' \''.$start_search.pSQL (Tools::substr ($word, 1, PS_SEARCH_MAX_WORD_LENGTH)).$end_search.'\''
						:' \''.$start_search.pSQL (Tools::substr ($word, 0, PS_SEARCH_MAX_WORD_LENGTH)).$end_search.'\''
					);

				if ($word[0] != '-')
					$score_array[] = 'sw.word LIKE \''.$start_search.pSQL (Tools::substr ($word, 0, PS_SEARCH_MAX_WORD_LENGTH)).$end_search.'\'';
			}
			else
				unset( $words[$key] );

		if (!count ($words))
			return ( $ajax?array():array( 'total' => 0, 'result' => array() ) );

		$score = '';
		if (count ($score_array))
			$score = ',(
				SELECT SUM(weight)
				FROM `'._DB_PREFIX_.'search_word` sw
				LEFT JOIN '._DB_PREFIX_.'search_index si ON sw.id_word = si.id_word
				WHERE sw.`id_lang` = '.(int)$id_lang.'
					AND sw.`id_shop` = '.$context->shop->id.'
					AND si.`id_product` = p.`id_product`
					AND ('.implode (' OR ', $score_array).')
			) position';

		$sql_groups = '';
		if (Group::isFeatureActive ())
		{
			$groups = FrontController::getCurrentCustomerGroups ();
			$sql_groups = 'AND cg.`id_group` '.( count ($groups)?'IN ('.implode (',', $groups).')':'= 1' );
		}

		$results = $db->executeS ('
		SELECT cp.`id_product`,ps.`quantity` AS sell
		FROM `'._DB_PREFIX_.'category_product` cp
		'.( Group::isFeatureActive ()?'INNER JOIN `'._DB_PREFIX_.'category_group` cg ON cp.`id_category` = cg.`id_category`':'' ).'
		INNER JOIN `'._DB_PREFIX_.'category` c ON cp.`id_category` = c.`id_category`
		INNER JOIN `'._DB_PREFIX_.'product` p ON cp.`id_product` = p.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_sale` ps ON (p.`id_product` = ps.`id_product` '.Shop::addSqlAssociation ('product_sale', 'ps').')
		'.Shop::addSqlAssociation ('product', 'p', false).'
		WHERE c.`active` = 1
		AND product_shop.`active` = 1
		AND product_shop.`visibility` IN ("both", "search")
		AND product_shop.`indexed` = 1
		'.$sql_groups);

		$eligible_products = array();
		foreach ($results as $row)
			$eligible_products[] = $row['id_product'];
		foreach ($intersect_array as $query)
		{
			$eligible_products2 = array();
			foreach ($db->executeS ($query) as $row)
				$eligible_products2[] = $row['id_product'];

			$eligible_products = array_intersect ($eligible_products, $eligible_products2);
			if (!count ($eligible_products))
				return ( $ajax?array():array( 'total' => 0, 'result' => array() ) );
		}

		$eligible_products = array_unique ($eligible_products);

		$product_pool = '';
		foreach ($eligible_products as $id_product)
			if ($id_product)
				$product_pool .= (int)$id_product.',';
		if (empty( $product_pool ))
			return ( $ajax?array():array( 'total' => 0, 'result' => array() ) );
		$product_pool = ( ( strpos ($product_pool, ',') === false )?( ' = '.(int)$product_pool.' ' ):( ' IN ('.rtrim ($product_pool, ',').') ' ) );

		if ($ajax)
		{
			$sql = 'SELECT DISTINCT p.`id_product`, pl.`name` pname, cl.`name` cname,
						cl.`link_rewrite` crewrite, pl.`link_rewrite` prewrite '.$score.'
					FROM `'._DB_PREFIX_.'product` p
					INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON (
						p.`id_product` = pl.`id_product`
						AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang ('pl').'
					)
					INNER JOIN `'._DB_PREFIX_.'category_product` ctp ON (
						p.`id_product` = ctp.`id_product`
					)
					'.Shop::addSqlAssociation ('product', 'p').'
					INNER JOIN `'._DB_PREFIX_.'category_lang` cl ON (
						product_shop.`id_category_default` = cl.`id_category`
						AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang ('cl').'
					)
					WHERE p.`id_product` '.$product_pool.' AND ctp.`id_category` IN ('.$cate_id.')
					ORDER BY position DESC LIMIT '.$page_size.'';
			return $db->executeS ($sql);
		}

		if (strpos ($order_by, '.') > 0)
		{
			$order_by = explode ('.', $order_by);
			$order_by = pSQL ($order_by[0]).'.`'.pSQL ($order_by[1]).'`';
		}
		$alias = '';
		if ($order_by == 'price')
			$alias = 'product_shop.';
		elseif (in_array ($order_by, array( 'date_upd', 'date_add', 'id_product' )))
			$alias = 'p.';
		if ($order_by == 'sell')
			$alias = '';
		$sql = 'SELECT p.*, product_shop.*, stock.`out_of_stock`, IFNULL(stock.`quantity`, 0) as quantity,ps.`quantity` AS sell,
				pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`name`,
			 MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` manufacturer_name '.$score.( Combination::isFeatureActive ()?',
			 MAX(product_attribute_shop.`id_product_attribute`) id_product_attribute':'' ).'
				'.( Combination::isFeatureActive ()?',
			MAX(product_attribute_shop.minimal_quantity) AS product_attribute_minimal_quantity':'' ).',
			p.`date_add` > "'
			.date ('Y-m-d', strtotime ('-'.( $number_days_new_product?(int)$number_days_new_product:20 ).' DAY')).'" as new
				FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation ('product', 'p').'
				INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON (
					p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang ('pl').'
				)
				INNER JOIN `'._DB_PREFIX_.'category_product` ctp ON (
						p.`id_product` = ctp.`id_product`
				)
				'.( Combination::isFeatureActive ()?'LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa	ON (p.`id_product` = pa.`id_product`)
				'.Shop::addSqlAssociation ('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
				'.Product::sqlStock ('p', 'product_attribute_shop',
					false, $context->shop):Product::sqlStock ('p', 'product', false, Context::getContext ()->shop) ).'
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
				LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation ('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'product_sale` ps ON (p.`id_product` = ps.`id_product` '.Shop::addSqlAssociation ('product_sale', 'ps').')
				WHERE p.`id_product` '.$product_pool.' AND ctp.`id_category` IN ('.$cate_id.')
				GROUP BY product_shop.`id_product`
				'.( $order_by?'ORDER BY  '.$alias.$order_by:'' ).( $order_way?' '.$order_way:'' ).'
				LIMIT '.( ( $page_number - 1 ) * $page_size ).','.(int)$page_size;

		$result = $db->executeS ($sql);

		$sql2 = 'SELECT p.`id_product`
				FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation ('product', 'p').'
				INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON (
					p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang ('pl').'
				)
				INNER JOIN `'._DB_PREFIX_.'category_product` ctp ON (
						p.`id_product` = ctp.`id_product`
				)
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
				WHERE p.`id_product` '.$product_pool.' AND ctp.`id_category` IN ('.$cate_id.')
				LIMIT '.$page_size.'
				';

		$total = count($db->executeS ($sql2));
		if (!$result)
			$result_properties = false;
		else
			$result_properties = Product::getProductsProperties ((int)$id_lang, $result);

		return array( 'total' => $total, 'result' => $result_properties );
	}

}

class AzSearchBlockControllerCore extends FrontController
{
	public $php_self = 'az_searchblock';
	public $instant_search;
	public $ajax_search;

	public static $initialized = false;
	public $p;
	public $n;
	protected static $link;

	public function init()
	{
		parent::init ();

		$this->instant_search = Tools::getValue ('instantSearch');

		$this->ajax_search = Tools::getValue ('ajaxSearch');
		if ($this->instant_search || $this->ajax_search)
		{
			$this->display_header = false;
			$this->display_footer = false;
		}
	}

	public function ajaxDie($value = null, $controller = null, $method = null)
	{
		if ($controller === null)
			$controller = get_class ($this);

		if ($method === null)
		{
			$bt = debug_backtrace ();
			$method = $bt[1]['function'];
		}

		Hook::exec ('actionBeforeAjaxDie', array( 'controller' => $controller, 'method' => $method, 'value' => $value ));
		Hook::exec ('actionBeforeAjaxDie'.$controller.$method, array( 'value' => $value ));

		die( $value );
	}

	public function pagination($total_products = null)
	{
		if (!self::$initialized)
			$this->init();
		elseif (!$this->context)
			$this->context = Context::getContext();

		// Retrieve the default number of products per page and the other available selections
		$default_products_per_page = max(1, (int)Configuration::get('PS_PRODUCTS_PER_PAGE'));
		$n_array = array($default_products_per_page, $default_products_per_page * 2, $default_products_per_page * 5);

		if ((int)Tools::getValue('n') && (int)$total_products > 0)
			$n_array[] = $total_products;
		// Retrieve the current number of products per page (either the default, the GET parameter or the one in the cookie)
		$this->n = $default_products_per_page;
		if (isset($this->context->cookie->nb_item_per_page) && in_array($this->context->cookie->nb_item_per_page, $n_array))
			$this->n = (int)$this->context->cookie->nb_item_per_page;

		if ((int)Tools::getValue('n') && in_array((int)Tools::getValue('n'), $n_array))
			$this->n = (int)Tools::getValue('n');

		// Retrieve the page number (either the GET parameter or the first page)
		$this->p = (int)Tools::getValue('p', 1);
		// If the parameter is not correct then redirect (do not merge with the previous line, the redirect is required in order to avoid duplicate content)
		if (!is_numeric($this->p) || $this->p < 1)
			Tools::redirect ($this->context->link->getModuleLink('azsearchblock', 'catesearch'));
		// Remove the page parameter in order to get a clean URL for the pagination template
		$current_url = preg_replace('/(\?)?(&amp;)?p=\d+/', '$1', Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']));

		if ($this->n != $default_products_per_page || isset($this->context->cookie->nb_item_per_page))
			$this->context->cookie->nb_item_per_page = $this->n;

		$pages_nb = ceil($total_products / (int)$this->n);
		if ($this->p > $pages_nb && $total_products != 0)
			Tools::redirect ($this->context->link->getModuleLink('azsearchblock', 'catesearch'));
		$range = 2; /* how many pages around page selected */
		$start = ($this->p - $range);
		if ($start < 1)
			$start = 1;
		$stop = ($this->p + $range);
		if ($stop > $pages_nb)
			$stop = (int)$pages_nb;

		$this->context->smarty->assign(array(
			'nb_products' => $total_products,
			'products_per_page' => $this->n,
			'pages_nb' => $pages_nb,
			'p' => $this->p,
			'n' => $this->n,
			'n_array' => $n_array,
			'range' => $range,
			'start' => $start,
			'stop' => $stop,
			'current_url' => $current_url
		));
	}

	public function initContent()
	{
		$this->instant_search = Tools::getValue ('instantSearch');
		$this->ajax_search = Tools::getValue ('ajaxSearch');

		$query = Tools::replaceAccentedChars (urldecode (Tools::getValue ('q')));
		$original_query = Tools::getValue ('q');

		$orderby = Tools::getValue('orderby');
		$ordering = Tools::getValue('orderway');
		if ($this->ajax_search)
		{
			$search_results = AzSearchBlockAjaxCore::find (( Tools::getValue ('id_lang') ), $query, 1, 10, $orderby, $ordering, true);
			if (is_array ($search_results))
				foreach ($search_results as &$product)
				{
				$product['product_link'] = $this->context->link->getProductLink ($product['id_product'], $product['prewrite'], $product['crewrite']);
					$obj = new Product(( $product['id_product'] ), false, $this->context->language->id);
					$images = $obj->getImages ($this->context->language->id);
					$images_product = array();
					if (!empty( $images ))
					{
						foreach ($images as $image)
							$images_product[] = $obj->id.'-'.$image['id_image'];
					}
				}

			$this->ajaxDie (Tools::jsonEncode ($search_results));
		}
		// Only controller content initialization when the user use the normal search
		parent::initContent ();
		if ($this->instant_search && !is_array ($query))
		{
			$this->productSort ();
			$this->n = abs((Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
			//$this->p = abs (( Tools::getValue ('p', 1) ));
			$search = AzSearchBlockAjaxCore::find ($this->context->language->id, $query, 1, $this->n, $orderby, $ordering);
			Hook::exec ('actionSearch', array( 'expr' => $query, 'total' => $search['total'] ));
			$nbProducts = $search['total'];
			$this->pagination ($nbProducts);
			$this->addColorsToProductList ($search['result']);

			$this->context->smarty->assign (array(
				'products'        => $search['result'], // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $search['result'],
				'nbProducts'      => count($search['result']),
				'search_query'    => $original_query,
				'instant_search'  => $this->instant_search,
				'hide_right_column' => true,
				'homeSize'        => Image::getSize (ImageType::getFormatedName ('home')) ));
		}
		elseif (( $query = Tools::getValue ('search_query', Tools::getValue ('ref')) ) && !is_array ($query))
		{
			$this->productSort ();
			$this->n = abs((Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
			$this->p = abs (( Tools::getValue ('p', 1) ));
			$original_query = $query;
			$query = Tools::replaceAccentedChars (urldecode ($query));
			$search = AzSearchBlockAjaxCore::find ($this->context->language->id, $query, $this->p, $this->n, $this->orderBy, $this->orderWay);
			if (is_array ($search['result']))
				foreach ($search['result'] as &$product)
					$product['link'] .= ( strpos ($product['link'], '?') === false?'?':'&' ).
						'search_query='.urlencode ($query).'&results='.(int)$search['total'];
			Hook::exec ('actionSearch', array( 'expr' => $query, 'total' => $search['total'] ));
			$nbProducts = $search['total'];
			$this->pagination ($nbProducts);

			$this->addColorsToProductList ($search['result']);

			$this->context->smarty->assign (array(
				'products'        => $search['result'],
				'search_products' => $search['result'],
				'nbProducts'      => isset( $search['total'] )?$search['total']:false,
				'search_query'    => $original_query,
				'hide_right_column' => true,
				'homeSize'        => Image::getSize (ImageType::getFormatedName ('home')) ));
		}
		elseif (( $tag = urldecode (Tools::getValue ('tag')) ) && !is_array ($tag))
		{
			$nbProducts = AzSearchBlockAjaxCore::searchTag ($this->context->language->id, $tag, true);
			$this->pagination ($nbProducts);
			$result = AzSearchBlockAjaxCore::searchTag ($this->context->language->id, $tag, false, $this->p, $this->n, $this->orderBy, $this->orderWay);
			Hook::exec ('actionSearch', array( 'expr' => $tag, 'total' => count ($result) ));

			$this->addColorsToProductList ($result);

			$this->context->smarty->assign (array(
				'search_tag'      => $tag,
				'products'        => $result,
				'search_products' => $result,
				'nbProducts'      => $nbProducts,
				'homeSize'        => Image::getSize (ImageType::getFormatedName ('home')) ));
		}
		else
		{
			$this->context->smarty->assign (array(
				'products'        => array(),
				'search_products' => array(),
				'pages_nb'        => 1,
				'nbProducts'      => 0 ));
		}
		$this->context->smarty->assign (array( 'add_prod_display' => Configuration::get ('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
						'comparator_max_item' => Configuration::get ('PS_COMPARATOR_MAX_ITEM') ));
		if ($this->ajax_search || $this->instant_search)
		{
			$smarty = $this->context->smarty;
			$smarty->display(_PS_THEME_DIR_.'search.tpl');
		}
	}

	public function setMedia()
	{
		parent::setMedia ();
		if (!$this->instant_search && !$this->ajax_search)
			$this->addCSS (_THEME_CSS_DIR_.'product_list.css');
	}

}

$id_searchblock = Tools::getValue ('azsb_module_id');
$searchblock = new AzSearchBlockClass($id_searchblock);
$params = Tools::jsonDecode ($searchblock->params, true);
$az_searchblock_controlle = new AzSearchBlockControllerCore();
if (isset($searchblock->id_azsearchblock) && $id_searchblock == $searchblock->id_azsearchblock)
	echo $az_searchblock_controlle->initContent();