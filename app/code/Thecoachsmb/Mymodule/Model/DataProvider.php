<?php
namespace Thecoachsmb\Mymodule\Model;
 
use Thecoachsmb\Mymodule\Model\ResourceModel\Post\CollectionFactory;
 
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
 
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $items = $this->collection->getItems();
        // print_r($items);exit;
        $this->loadedData = array();
        /** @var Customer $customer */
        foreach ($items as $blog) {
            $this->loadedData[$blog->getId()] = $blog->getData();
        }
        return $this->loadedData;
    }
}