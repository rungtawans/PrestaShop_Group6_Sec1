<?php

require_once 'vendor/autoload.php';

use Zxing\QrReader;

class PromptPayValidationModuleFrontController extends ModuleFrontController
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

        $this->setTemplate('module:ps_checkpayment/views/templates/front/notifications.tpl');
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
