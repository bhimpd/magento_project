<?php
 
namespace Thecoachsmb\Mymodule\Block\Adminhtml\Product\Edit;
 
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
 
class SyncButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Sync Files'),
            'class' => 'action-secondary',
            'data_attribute' => [
                'mage-init' => [
                    'Magento_Ui/js/form/button-adapter' => [
                        'actions' => [
                            [
                                'targetName' => 'product_form.product_form.test_model',
                                'actionName' => 'toggleModal'
                            ]
                        ]
                    ]
                ]
            ],
            'on_click' => '',
            'sort_order' => 10
        ];
    }
}