<?php
namespace Thecoachsmb\Mymodule\Ui\Component\Listing\Sync;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SyncAllButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
   

        return [
            'label' => __('Sync All'),
            'on_click' => sprintf("location.href = '%s';", $this->getSyncUrl()),
            'class' => 'primary',
            'sort_order' => 10
        ];
    }

    protected function getSyncUrl()
    {
        return $this->urlBuilder->getUrl('*/*/syncall');
    }
}