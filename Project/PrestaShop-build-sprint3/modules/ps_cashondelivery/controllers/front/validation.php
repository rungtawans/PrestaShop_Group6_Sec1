<?php
/**
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
 */

require_once 'vendor/autoload.php';

use Zxing\QrReader;

/**
 * This Controller receives customer after approval on checkout page
 */
class Ps_CashondeliveryValidationModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        $context = Context::getContext();
        $cart = $context->cart;

        if (Tools::isSubmit('submitPaymentSlip')) {

            if (isset($_FILES['payment_slip']) && !empty($_FILES['payment_slip']['name'])) {
                // Validate the uploaded file (e.g., file type, size, etc.)
                $validFile = $this->validateFile($_FILES['payment_slip']);

                if ($validFile) {

                    //   Process the payment details and update order status
                    $this->module->validateOrder(
                        $cart->id,
                        Configuration::get('PS_OS_PAYMENT'),
                        $cart->getOrderTotal(),
                        $this->module->displayName,
                        null,
                        array(),
                        null,
                        false,
                        $cart->secure_key
                    );

                    $customer = new Customer($cart->id_customer);
                    if (!Validate::isLoadedObject($customer)) {
                        Tools::redirect('index.php?controller=order&step=1');
                    }

                    $this->success[] = $this->l('Slip is Validated');
                    Tools::redirect('index.php?controller=order-confirmation&id_cart='
                        . $cart->id . '&id_module=' . $this->module->id . '&id_order='
                        . $this->module->currentOrder . '&key=' . $customer->secure_key);

                    return;

                } else {

                    $this->errors[] = $this->l('Please upload a valid slip.');
                    $this->redirectWithNotifications($this->getCurrentURL());
                   
                }
            } else {
                $this->errors[] = $this->l('Please upload a slip.');
                $this->redirectWithNotifications($this->getCurrentURL());
        
            }
        }

        $this->setTemplate('module:promptpay/views/templates/front/notifications.tpl');        
        Tools::redirect('index.php?controller=order&step=1');
    }


    public function validateFile($file)
    {
        // return true;
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return false; // No file uploaded
        }
        $qrcode = new QrReader($file['tmp_name']);
        $qrcode->decode();
        $result = $qrcode->getResult();

        return $result;
    }
}
