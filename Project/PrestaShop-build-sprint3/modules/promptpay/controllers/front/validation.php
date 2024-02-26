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

                    // $redirectUrl = 'index.php?controller=order-confirmation&id_cart=' . 
                    // $cart->id . '&id_module=' . 
                    // $this->module->id . '&id_order=' . 
                    // $this->module->currentOrder . 
                    // '&key=' . $customer->secure_key;


                    $this->redirectWithNotifications($this->getCurrentURL());

                } else {

                    // echo '<script>alert("Please upload a valid payment slip.");</script>';

                    $this->errors[] = $this->l('Please upload a valid slip.');

                    $this->redirectWithNotifications($this->getCurrentURL());
                    // $redirectUrl = $this->getCurrentURL();

                }
            } else {
                $this->errors[] = $this->l('Please upload a slip.');

                // echo '<script>alert("Please upload a valid payment slip.");</script>';

                $this->redirectWithNotifications($this->getCurrentURL());
                // $redirectUrl = $this->getCurrentURL();

            }


        }
        
        $this->setTemplate('module:promptpay/views/templates/front/notifications.tpl');
        // Tools::redirect($redirectUrl);
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
