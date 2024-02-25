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
                //     // Validate the uploaded file (e.g., file type, size, etc.)
                $validFile = $this->validateFile($_FILES['payment_slip']);

                // $decodedText = $this->validateFile($_FILES['payment_slip']);
                // if ($decodedText) {
                //     // Output the decoded text in the HTML
                //     $this->context->smarty->assign('decodedText', $decodedText);
                // } else {
                //     // Handle the case where no file is uploaded or no QR code is found
                //     $this->context->smarty->assign('errorMessage', $this->module->l('No QR code found in the uploaded file.'));
                // }

                if ($validFile) {
                    Tools::redirect('index.php');
                    //         // Process the payment details and update order status
                    //         // $this->module->validateOrder(
                    //         //     $cart->id, Configuration::get('PS_OS_PAYMENT'), $cart->getOrderTotal(),
                    //         //     $this->module->displayName, null, array(), null, false, $cart->secure_key
                    //         // );
                    //         // $customer = new Customer($cart->id_customer);
                    //         // if (!Validate::isLoadedObject($customer)) {
                    //         // Tools::redirect('index.php?controller=order&step=1');
                    //         // }
                    //         // Tools::redirect('index.php?controller=order-confirmation&id_cart=' 
                    //         //     . $cart->id . '&id_module=' . $this->module->id . '&id_order=' 
                    //         //     . $this->module->currentOrder . '&key=' . $customer->secure_key);
                    //         Tools::redirect('index.php');
                    //         return;
                    //     } else {
                    //         $this->errors[] = $this->module->l('Invalid file. Please upload a valid payment slip.');
                    //     }
                } else {
                //     // $this->errors[] = $this->module->l('Please upload a payment slip.');
                    Tools::redirect('index.php?controller=order&step=1');
                }
            }

            // Set the template for displaying errors
            // $this->setTemplate('module:promptpay/views/templates/front/payment_form.tpl');
        }

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
        // $text = $qrcode->text();
        // echo $text;
        // return $text;
        return $result;
    }
}
