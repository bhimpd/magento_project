<?php

namespace Thecoachsmb\SalesOrderCronjob\Block\Adminhtml\Grid\Helper\Form\Gallery;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Media\Uploader;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\App\Filesystem\DirectoryList;

class Content extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery\Content
{
    protected function _prepareLayout()
    {
        $this->addChild('uploader', 'Magento\Backend\Block\Media\Uploader');

        $a = $this->getUploader()->getConfig()->setUrl(
            $this->_urlBuilder->addSessionParam()->getUrl('category/image/upload')
        )->setFileField(
            'image'
        )->setFilters(
            [
                'images' => [
                    'label' => __('Images (.gif, .jpg, .png)'),
                    'files' => ['*.gif', '*.jpg', '*.jpeg', '*.png'],
                ],
            ]
        );
    }

    public function getImageTypes()
    {
        return '[]';
    }

    public function getMediaAttributes()
    {
        return '[]';
    }
}
