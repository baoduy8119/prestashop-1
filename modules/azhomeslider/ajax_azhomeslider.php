<?php
/*
* 2016 AZ Templates
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@AZTemplates.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade AZ Templates to newer
* versions in the future. If you wish to customize AZ Templates for your
* needs please refer to http://www.AZTemplates.com for more information.
*
*  @author AZ Templates <contact@AZTemplates.com>
*  @copyright  2016 AZ Templates
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of AZ Templates SA
*/
include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('azhomeslider.php');

$home_slider = new azhomeslider();
$slides = array();

if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $home_slider->secure_key || !Tools::getValue('action'))
	die(1);

if (Tools::getValue('action') == 'updateSlidesPosition' && Tools::getValue('slides'))
{
	$slides = Tools::getValue('slides');

	foreach ($slides as $position => $id_slide)
		$res = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'azhomeslider_slides` SET `position` = '.(int)$position.'
			WHERE `id_azhomeslider_slides` = '.(int)$id_slide
		);

	$home_slider->clearCache();
}
