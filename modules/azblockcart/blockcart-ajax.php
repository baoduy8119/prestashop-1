<?php
/*
* 2016 AZTemplates
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
* Do not edit or add to this file if you wish to upgrade AZTemplates to newer
* versions in the future. If you wish to customize AZTemplates for your
* needs please refer to http://www.AZTemplates.com for more information.
*
*  @author AZTemplates SA <contact@AZTemplates.com>
*  @copyright  2016 AZTemplates SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of AZTemplates SA
*/
// @TODO Find the reason why the blockcart.php is includ multiple time

include_once(dirname(__FILE__).'/azblockcart.php');
$context = Context::getContext();
$blockCart = new azBlockCart();
echo $blockCart->hookAjaxCall(array('cookie' => $context->cookie, 'cart' => $context->cart));