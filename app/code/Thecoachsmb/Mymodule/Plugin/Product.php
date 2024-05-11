<?php
namespace Thecoachsmb\Mymodule\Plugin;
use Magento\Quote\Model\Quote as MainProduct;

class Product
{
    public function beforeAddProduct(MainProduct $subject, $productInfo, $requestInfo = null )
        {
            $requestInfo['qty']=5;
            return [$productInfo,$requestInfo];
        }        
}

