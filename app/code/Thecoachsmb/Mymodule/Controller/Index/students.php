<?php

namespace Thecoachsmb\Mymodule\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Thecoachsmb\Mymodule\Model\StudentsFactory;

class Students implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var StudentsFactory
     */
    protected $studentsFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param StudentsFactory $studentsFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StudentsFactory $studentsFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->studentsFactory = $studentsFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // Fetch data from the "students" table
        $studentsCollection = $this->studentsFactory->create()->getCollection();
        
        // Pass data to the template
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Students List'));
        $resultPage->getLayout()->getBlock('students_list')->setStudents($studentsCollection);
        
        return $resultPage;
    }
}
