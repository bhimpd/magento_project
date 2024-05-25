<?php
namespace Thecoachsmb\Mymodule\Controller\Adminhtml\Sync;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Catalog::products');
    }

    public function execute()
    {
       
        if ($this->getRequest()->getParam('sync_all')) {
            // Handle the sync action
            // ...
            $this->messageManager->addSuccessMessage(__('Files synced successfully.'));
            return $this->_redirect('*/*/');
        }
    
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Catalog::sync_files');
        $resultPage->getConfig()->getTitle()->prepend(__('Sync Catalog Files From OneDrive'));
        
        return $resultPage;
        
    }
}