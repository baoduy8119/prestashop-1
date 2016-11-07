<?php
/**
 * package AZ Templates
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.aztemplates.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */


if (!defined ('_PS_VERSION_'))
	exit;

class AzStatics extends ObjectModel
{
	public $id_azstaticsblock;
	public $title_module;
	public $content;
	public $active;
	public $hook;
	public $params;
	public $ordering;
	public $postext;
	public $id_shop = array();
	public static $definition = array(
	'table' => 'azstaticsblock',
	'primary' => 'id_azstaticsblock',
	'multilang' => true,
	'fields' => array( 'hook' => array( 'type' => self::TYPE_INT, 'validate' => 'isunsignedInt' ),
		'title_module' => array( 'type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255 ),
		'content' => array( 'type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true ),
		'active' => array( 'type' => self::TYPE_INT, 'shop' => true,  'validate' => 'isunsignedInt' ),
		'params' => array( 'type' => self::TYPE_HTML,  'validate' => 'isString'),
		'ordering' => array( 'type' => self::TYPE_INT, 'validate' => 'isInt' )
	) );

	public function __construct($id_azstaticsblock = null, $id_lang = null, $id_shop = null)
	{
		Shop::addTableAssociation ('azstaticsblock', array('type' => 'shop'));
		parent::__construct ($id_azstaticsblock, $id_lang, $id_shop);
	}

	public function add($autodate = true, $null_values = false)
	{
		$this->ordering = $this->getHigherPosition () + 1;
		$res = parent::add($autodate, $null_values);
		return $res;
	}

	public function getHigherModuleID()
	{
		$sql = 'SELECT MAX(`id_azstaticsblock`)
				FROM `'._DB_PREFIX_.'azstaticsblock`';
		$id_azstaticsblock = DB::getInstance ()->getValue($sql);
		return ( is_numeric ($id_azstaticsblock) )?$id_azstaticsblock:1;
	}
	public function duplicate($autodate = true)
	{
		$this->ordering = $this->getHigherPosition () + 1;
		$return = parent::add ($autodate, true);
		return $return;
	}

	public function delete()
	{
		$res = true;
		$res &= $this->reOrderPositions();
		$res &= parent::delete();
		return $res;
	}

	public static function cleanPositions()
	{
		$sql = 'SELECT `id_azstaticsblock`, `ordering` FROM `'._DB_PREFIX_.'azstaticsblock` ORDER BY `ordering` ASC';
		$db = Db::getInstance ();
		$values = $db->executeS ($sql);
		if (!empty( $values ))
		{
			foreach ($values as $position => $value)
			{
				$sql1 = 'UPDATE `'._DB_PREFIX_.'azstaticsblock` SET `ordering` = '.(int)$position
					.' WHERE `id_azstaticsblock` = '.(int)$value['id_azstaticsblock'];
				Db::getInstance ()->execute ($sql1);
			}
		}
	}

	public function getHigherPosition()
	{
		$sql = 'SELECT MAX(`ordering`)
				FROM `'._DB_PREFIX_.'azstaticsblock`';
		$ordering = DB::getInstance ()->getValue ($sql);
		return ( is_numeric ($ordering) )? $ordering : 0;
	}

	public static function getAssociatedIdsShop($id_azstaticsblock)
	{
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT css.`id_shop`
			FROM `'._DB_PREFIX_.'azstaticsblock` cs
			LEFT JOIN `'._DB_PREFIX_.'azstaticsblock_shop` css ON (css.`id_azstaticsblock` = cs.`id_azstaticsblock`)
			WHERE cs.`id_azstaticsblock` = '.(int)$id_azstaticsblock
		);

		if (!is_array($result))
			return false;

		$return = array();

		foreach ($result as $id_shop)
			$return[] = (int)$id_shop['id_shop'];
		return $return;
	}
	public function reOrderPositions()
	{
		$id_azstaticsblock = $this->id;
		$context = Context::getContext();
		$id_shop = $context->shop->id;

		$max = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT MAX(cs.`ordering`) as ordering
			FROM `'._DB_PREFIX_.'azstaticsblock` cs, `'._DB_PREFIX_.'azstaticsblock_shop` css
			WHERE css.`id_azstaticsblock` = cs.`id_azstaticsblock` AND css.`id_shop` = '.(int)$id_shop
		);

		if ((int)$max == (int)$id_azstaticsblock)
			return true;

		$rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT cs.`ordering` as ordering, cs.`id_azstaticsblock` as id_azstaticsblock
			FROM `'._DB_PREFIX_.'azstaticsblock` cs
			LEFT JOIN `'._DB_PREFIX_.'azstaticsblock_shop` css ON (css.`id_azstaticsblock` = cs.`id_azstaticsblock`)
			WHERE css.`id_shop` = '.(int)$id_shop.' AND cs.`ordering` > '.(int)$this->ordering
		);

		foreach ($rows as $row)
		{
			$customs = new AzStatics($row['id_azstaticsblock']);
			--$customs->ordering;
			$customs->update();
			unset($customs);
		}

		return true;
	}
}
