<?php
namespace Webdev\Helloworld\Controller\Index;

    
    class Index extends \Magento\Framework\App\Action\Action
    {
        protected $_pageFactory;
        protected $_dataFactory;
     
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory,
            \Webdev\Helloworld\Model\Data $dataFactory

          
        ) {
            $this->_pageFactory = $pageFactory;
            $this->dataFactory = $dataFactory;
            return parent::__construct($context);

                 }

        public function execute()
        {
            /** Fetch Data */
            $collection =$this->_dataFactory->create();
            $data = $collection->getCollection();
            print_r($data->getData());
            die("here");
            
            die('end here');
        }
    }