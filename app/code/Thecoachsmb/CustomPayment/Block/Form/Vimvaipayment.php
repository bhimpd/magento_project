<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Thecoachsmb\CustomPayment\Block\Form;

/**
 * Block for VimVai payment method form
 */
class Vimvaipayment extends \Magento\OfflinePayments\Block\Form\AbstractInstruction
{
    /**
     * VimVai payment template
     *
     * @var string
     */
    protected $_template = 'Thecoachsmb_CustomPayment::form/vimvaipayment.phtml';
}