<?php

namespace Thecoachsmb\Mymodule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Thecoachsmb\Mymodule\Model\ResourceModel\Students\CollectionFactory;

class Students extends Template
{
    protected $studentsCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $studentsCollectionFactory,
        array $data = []
    ) {
        $this->studentsCollectionFactory = $studentsCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getStudents()
    {
        return $this->studentsCollectionFactory->create()->getData();
    }
}
