<?php

namespace Thecoachsmb\Mymodule\Model\ResourceModel\Students;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Thecoachsmb\Mymodule\Model\Students;
use Thecoachsmb\Mymodule\Model\ResourceModel\Students as StudentsResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Students::class, StudentsResource::class);
    }
}
