<?php
namespace Thecoachsmb\Mymodule\Block\Adminhtml\Product;
class CustomButton extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic
{
    public function getButtonData()
    {
        return [
            'label' => __('Custom Button'),
            'class' => 'action-secondary',
            'on_click' => 'alert("Hello vim !!")',
            'sort_order' => 10
        ];
    }
}