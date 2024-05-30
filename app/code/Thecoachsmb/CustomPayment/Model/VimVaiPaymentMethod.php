<?php
namespace Thecoachsmb\CustomPayment\Model;

use Magento\Payment\Model\Method\AbstractMethod;

class VimVaiPaymentMethod extends AbstractMethod
{
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'vimvaipayment';

    /**
     * Authorize specified amount.
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     *
     * @return $this
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function authorize(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        // Implement authorization logic for VimVai Payment method here
        return $this;
    }
}