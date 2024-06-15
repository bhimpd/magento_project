<?php

namespace Thecoachsmb\SalesOrderCronjob\Controller\TestRoute;

//base class for all frontend controller
//provides necessary struture for handling requests and responses
use Magento\Framework\App\Action\Action;

//used to inject dependencies into controller
//provides access to the request,response,session and other common objects
use Magento\Framework\App\Action\Context;

//used to create a page result object, which is necessary for rendering a full page.
use Magento\Framework\View\Result\PageFactory;


//to interact with the product entities like fetching product details by ID
use Magento\Catalog\Api\ProductRepositoryInterface;

//to access the customer details
use Magento\Customer\Api\CustomerRepositoryInterface;


//to retrieve order detaisl
use Magento\Sales\Api\OrderRepositoryInterface;



use Magento\Catalog\Helper\Image as ImageHelper;

class TestRoute extends Action
{

    protected $resultPageFactory;
    protected $orderRepository;
    protected $customerRepository;
    protected $productRepository;
    protected $imageHelper;

public function __construct(
    Context $context,
    PageFactory $resultPageFactory,
    ProductRepositoryInterface $productRepository,
    OrderRepositoryInterface $orderRepository,
    CustomerRepositoryInterface $customerRepository,
    ImageHelper $imageHelper

){

    $this->resultPageFactory = $resultPageFactory;
    $this->productRepository = $productRepository;
    $this->orderRepository = $orderRepository;
    $this->customerRepository = $customerRepository;
    $this->imageHelper = $imageHelper;



    parent::__construct($context);


}

public function execute()
{
// echo "knock";die("here");
    $resultPage = $this->resultPageFactory->create();

    // Retrieve product details
    $productId = 1; // Example product ID
    $product = $this->productRepository->getById($productId);

    // Retrieve order details
    $orderId = 1; // Example order ID
    $order = $this->orderRepository->get($orderId);

    // Retrieve customer details
    $customerId = 1; // Example customer ID
    $customer = $this->customerRepository->getById($customerId);




        // Retrieve product image URL
        $imageUrl = $this->imageHelper->init($product, 'product_base_image')->getUrl();

    // Pass data to the block
    $resultPage->getLayout()->getBlock('testroute')
        ->setData('product', $product)
        ->setData('order', $order)
        ->setData('customer', $customer)
        ->setData('product_image_url', $imageUrl);


    return $resultPage;
}
}

