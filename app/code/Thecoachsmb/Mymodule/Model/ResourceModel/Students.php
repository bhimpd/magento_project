<?php

namespace Thecoachsmb\Mymodule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Students extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('students', 'id');
    }
}
