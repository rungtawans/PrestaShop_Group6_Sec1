<?php
class TaxInvoiceController extends FrontController
{

    public $guestAllowed = true;
    /** @var string */
    // public $php_self = 'order';
    /** @var string */
    // public $page_name = 'customer-form';
    /** @var bool */
    public $ssl = true;
    protected $customer_form;
    protected $should_redirect = false;

    public function initContent()
    {
    // In the template, we need the vars paymentId & paymentStatus to be defined
    $this->context->smarty->assign(
    array(
      'paymentId' => Tools::getValue(''), // Retrieved from GET vars
      'paymentStatus' => [...],
    ));
    }

    public function init()
    {
        parent::init();
        $this->customer_form = $this->makeCustomerForm();
        $this->context->smarty->assign('customer_form', $this->address_form->getProxy());
    }
    
    public function postProcess()
    {
        parent::postProcess();

        $taxInvoice = Tools::getValue('tax_invoice');
        
        // Handle form submission
        if (Tools::isSubmit('save_customer')) {

            if ($taxInvoice === 'yes') {
                $this->success[] = $this->trans('Invoice Yes', [], 'Shop.Notifications.Success');
            } elseif ($taxInvoice === 'no') {
                $this->success[] = $this->trans('Invoice No', [], 'Shop.Notifications.Success');
    
            }
            
        }
        
        // no taxInvoice no need to continue
        if (!$taxInvoice) {
            return;
        }
    }
}
