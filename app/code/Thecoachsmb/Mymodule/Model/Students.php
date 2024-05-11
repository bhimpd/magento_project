<?php

namespace Thecoachsmb\Mymodule\Model;

use Magento\Framework\Model\AbstractModel;

class Students extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Thecoachsmb\Mymodule\Model\ResourceModel\Students::class);
    }
}