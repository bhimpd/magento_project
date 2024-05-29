<?php

namespace Thecoachsmb\CustomPayment\Block\Checkout;

echo "nanan";exit;

use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\Order;

class CustomSuccess extends Template
{
    protected $order;

    public function __construct(
        Template\Context $context,
        Order $order,
        array $data = []
    ) {
        $this->order = $order;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        $lastOrderId = $this->_checkoutSession->getLastOrderId();
        return $this->order->load($lastOrderId);
    }

    public function getSuccessTemplate()
    {
        $order = $this->getOrder();
        $paymentMethod = $order->getPayment()->getMethod();

        echo "$paymentMethod, here";
        exit;
        switch ($paymentMethod) {
            case 'checkmo':
                return 'Thecoachsmb_CustomPayment::success_checkmo.phtml';
            case 'banktransfer':
                return 'Thecoachsmb_CustomPayment::success_banktransfer.phtml';
            case 'testpayment':
                return 'Thecoachsmb_CustomPayment::success_testpayment.phtml';
            default:
                return 'Magento_Checkout::success.phtml';
        }
    }
}
