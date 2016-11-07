<?php
/**
 * package   AZ Manufacturer
 *
 * @version 1.0.0
 * @author    AZTemplates http://www.AZTemplates.com
 * @copyright (c) 2016 AZTemplates Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

include_once ( '../../config/config.inc.php' );
include_once ( '../../init.php' );
include_once ( 'azmanufacturer.php' );
$context = Context::getContext ();
$extraslider = new azManufacturer();
$items = array();
if (!Tools::isSubmit ('secure_key') || Tools::getValue ('secure_key') != $extraslider->secure_key || !Tools::getValue ('action'))
	die( 1 );
if (Tools::getValue ('action') == 'updateSlidesPosition' && Tools::getValue ('item'))
{
	$items = Tools::getValue ('item');
	$pos = array();
	$success = true;
	foreach ($items as $position => $item)
	{
		$success = Db::getInstance ()->execute ('
			UPDATE `'._DB_PREFIX_.'azmanufacturer` SET `ordering` = '.(int)$position.'
			WHERE `id_module` = '.(int)$item);
		$pos[] = $position;
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