<?php

namespace Thecoachsmb\CustomPayment\Block\Onepage;

use Magento\Checkout\Block\Onepage\Success as MagentoSuccess;


    
class Success extends MagentoSuccess
{
    /**
     * Retrieve the last order
     *
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    public function getOrder()
    {
        return $this->_checkoutSession->getLastRealOrder();
    }
}