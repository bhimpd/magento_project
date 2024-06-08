<?php
namespace Thecoachsmb\SalesOrderCronjob\Api\Data;

interface CustomCategoryInterface extends \Magento\Catalog\Api\Data\CategoryInterface
{
    /**
     * Get custom text
     *
     * @return string|null
     */
    public function getCustomText();

    /**
     * Get short descriptions
     *
     * @return string|null
     */
    public function getShortDescriptions();

    /**
     * Get custom image
     *
     * @return string|null
     */
    public function getCustomImage();
}
