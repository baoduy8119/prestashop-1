<?php
/**
 * package AZ MegaMenu
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.aztemplates.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

include_once ( '../../config/config.inc.php' );
include_once ( '../../init.php' );
include_once ( 'azmegamenu.php' );
$context = Context::getContext ();
$azmegamenu = new azmegamenu();
$items = array();
if (!Tools::isSubmit ('secure_key') || Tools::getValue ('secure_key') != $azmegamenu->secure_key || !Tools::getValue ('action'))
	die( 1 );
if (Tools::getValue ('action') == 'updateGroupPosition' && Tools::getValue ('item'))
{
	$items = Tools::getValue ('item');
	$pos = array();
	$success = true;
	foreach ($items as $position => $item)
	{
		$success &= Db::getInstance ()->execute ('
			UPDATE `'._DB_PREFIX_.'azmegamenu_group` SET `position` = '.(int)$position.'
			WHERE `id_azmegamenu_group` = '.(int)$item);
	}

	if (!$success)
		die( Tools::jsonEncode (array(
			'error' => 'Update Fail'
		)) );
	die( Tools::jsonEncode (array(
		'success' => 'Update Success !',
		'error'   => false
	)) );
}