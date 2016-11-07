<?php
/**
 * package AZ Templates
 *
 * @version 1.0.0
 * @author    AZ Templates http://www.magentech.com
 * @copyright (c) 2016 AZ Templates. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

include_once ( '../../config/config.inc.php' );
include_once ( '../../init.php' );
include_once ( 'azhomeslider.php' );
$context = Context::getContext ();
$home_slider = new azhomeslider();
$items = array();
if (!Tools::isSubmit ('secure_key') || Tools::getValue ('secure_key') != $home_slider->secure_key || !Tools::getValue ('action'))
	die( 1 );
if (Tools::getValue ('action') == 'updateGroupPosition' && Tools::getValue ('item'))
{
	$items = Tools::getValue ('item');
	$pos = array();
	$success = true;
	foreach ($items as $position => $item)
	{
		$success &= Db::getInstance ()->execute ('
			UPDATE `'._DB_PREFIX_.'azhomeslider_groups` SET `position` = '.(int)$position.'
			WHERE `id_azhomeslider_groups` = '.(int)$item);
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