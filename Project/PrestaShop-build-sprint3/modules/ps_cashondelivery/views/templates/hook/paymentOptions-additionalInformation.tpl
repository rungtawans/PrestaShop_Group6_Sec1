{**
  * Copyright since 2007 PrestaShop SA and Contributors
  * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
  *
  * NOTICE OF LICENSE
  *
  * This source file is subject to the Academic Free License version 3.0
  * that is bundled with this package in the file LICENSE.md.
  * It is also available through the world-wide-web at this URL:
  * https://opensource.org/licenses/AFL-3.0
  * If you did not receive a copy of the license and are unable to
  * obtain it through the world-wide-web, please send an email
  * to license@prestashop.com so we can send you a copy immediately.
  *
  * @author    PrestaShop SA and Contributors <contact@prestashop.com>
  * @copyright Since 2007 PrestaShop SA and Contributors
  * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
  *}
 
 <section id="ps_cashondelivery-paymentOptions-additionalInformation">
   <p>{l s='Promptpay : 0958445963' d='Modules.Cashondelivery.Shop'}</p><br>
   <p>{l s='Name : Prastashop Group6' d='Modules.Cashondelivery.Shop'}</p>
   <div>
    <img src="https://cdn.ttgtmedia.com/rms/misc/qr_code_barcode.jpg">
 </div>

<form id="promptPayForm" action="{$link->getModuleLink('ps_cashondelivery', 'validation', [], true)}" method="post" enctype="multipart/form-data">
    <input type="file" id="payment_slip" class="btn btn-default" name="payment_slip" accept="image/*" required">
    <button type="submit" name="submitPaymentSlip" class="btn btn-danger">Check Slip</button>
</form>
 </section>
