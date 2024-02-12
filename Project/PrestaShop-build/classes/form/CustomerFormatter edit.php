<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
use Symfony\Contracts\Translation\TranslatorInterface;

class CustomerFormatterCore implements FormFormatterInterface
{
    private $translator;
    private $language;

    private $ask_for_birthdate = false;
    private $ask_for_partner_optin = false;
    private $partner_optin_is_required = false;
    private $ask_for_password = false;
    private $password_is_required = false;
    private $ask_for_new_password = false;

    public function __construct(
        TranslatorInterface $translator,
        Language $language
    ) {
        $this->translator = $translator;
        $this->language = $language;
    }

    public function setAskForBirthdate($ask_for_birthdate)
    {
        $this->ask_for_birthdate = $ask_for_birthdate;

        return $this;
    }

    public function setAskForPartnerOptin($ask_for_partner_optin)
    {
        $this->ask_for_partner_optin = $ask_for_partner_optin;

        return $this;
    }

    public function setPartnerOptinRequired($partner_optin_is_required)
    {
        $this->partner_optin_is_required = $partner_optin_is_required;

        return $this;
    }

    public function setAskForPassword($ask_for_password)
    {
        $this->ask_for_password = $ask_for_password;

        return $this;
    }

    public function setAskForNewPassword($ask_for_new_password)
    {
        $this->ask_for_new_password = $ask_for_new_password;

        return $this;
    }

    public function setPasswordRequired($password_is_required)
    {
        $this->password_is_required = $password_is_required;

        return $this;
    }

    public function getFormat()
    {
        $format = [];

        $format['tax_invoice'] = (new FormField())
            ->setName('tax_invoice')
            ->setLabel(
                $this->translator->trans(
                    'Tax Invoice',
                    [],
                    'Shop.Forms.Labels'
                )
            )
            ->setType('radio-buttons')
            ->setRequired(true)
            ->setAvailableValues(['Yes' => 'yes', 'No' => 'no']);
        
        return $this->addConstraints($format);
    }

    private function addConstraints(array $format)
    {
        $constraints = Customer::$definition['fields'];

        foreach ($format as $field) {
            if (!empty($constraints[$field->getName()]['validate'])) {
                $field->addConstraint(
                    $constraints[$field->getName()]['validate']
                );
            }
        }

        return $format;
    }
}
