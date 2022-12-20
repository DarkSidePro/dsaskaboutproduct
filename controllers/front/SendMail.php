<?php
/**
* Advance Blog
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
*
* @author    Dark-Side.pro
* @copyright Copyright 2017 © Dark-Side.pro All right reserved
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
* @category  FO Module
* @package   dsafillate
*/

class DsdynamicpriceSaveConfigurationModuleFrontController extends ModuleFrontController
{
    public $guestAllowed = true;

    public function __construct($response = array())
    {
        parent::__construct($response);
        $this->display_header = false;
        $this->display_header_javascript = false;
        $this->display_footer = false;
    }

    public function initContent()
    {
        
        $this->ajax = true;
        parent::initContent();
    }

    public function postProcess()
    {
        if (!Tools::isSubmit('dsaskaboutproduct')) {
            echo Tools::jsonEncode(array('msg' => $this->l('Something is wrong with form.')));
            return;
        }
        
        if (!Tools::isSubmit('dsaskaboutproduct_product_id')) {
            echo Tools::jsonEncode(array('msg' => $this->l('Product ID is missing.')));
            return;
        }

        if (!Tools::isSubmit('dsaskaboutproduct_email') || !Tools::isSubmit('dsaskaboutproduct_phone')) {
            echo Tools::jsonEncode(array('msg' => $this->l('Phone or email is required.')));
            return;
        }

        if (!Tools::isSubmit('dsaskaboutproduct_message')) {
            echo Tools::jsonEncode(array('msg' => $this->l('Message is required.')));
            return;
        }

        $productID = Tools::getValue('dsaskaboutproduct_product_id');
        $sender = Tools::getValue('dsaskaboutproduct_email') ?? Tools::getValue('dsaskaboutproduct_phone');;
        $message = Tools::getValue('dsaskaboutproduct_message');

        $this->sendMail($productID, $sender, $message);

        echo Tools::jsonEncode(array('msg' => $this->l('Your message was sent.'), 'success' => true));
        return;
    }

    protected function getProductName(int $productID)
    {
        $sql = new DbQuery;
        $sql->select('name')
            ->from('product_lang')
            ->where('id_lang = 1');
        
        $result = Db::getInstance()->executeS($sql); 

        return $result;
    }

    protected function sendMail($productID, $sender, $message)
    {
        $date = new DateTime('now');
        $dateString = $date->format('Y-m-d H:i:s');
        $productName = $this->getProductName($productID);

        Mail::Send(
            (int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
            'contact', // email template file to be use
            'Ktoś zadał pytanie o produkt: ' . $productName . ', dnia: ' . $dateString, // email subject
            array(
                '{sender}' => $sender, // sender email or phone address
                '{message}' => $message, // email content
                '{productName}' => $productName
            ),
            Configuration::get('PS_SHOP_EMAIL'), // receiver email address
            NULL, //receiver name
            Configuration::get('PS_SHOP_EMAIL'), //from email address
            NULL,  //from name
            NULL, //file attachment
            TRUE, //mode smtp
            _PS_MODULE_DIR_ . 'dsaskaboutproduct/mails' //custom template path
        );
    }
}
