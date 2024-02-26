{**
 * 2007-2020 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

<section>
  <p>ธนาคารกรุงไทย 64889465</p>


<form id="wirepayment" action="{$link->getModuleLink('ps_wirepayment', 'validation', [], true)}" method="post" enctype="multipart/form-data">
    <input type="file" id="payment_slip" class="btn btn-default" name="payment_slip" accept="image/*" required">
    <button type="submit" name="submitPaymentSlip" class="btn btn-primary">Place Order</button>
</form>

  <br><br>

