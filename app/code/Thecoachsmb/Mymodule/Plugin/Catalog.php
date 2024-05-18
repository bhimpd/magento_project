<?php
namespace Thecoachsmb\Mymodule\Plugin;
use Magento\Catalog\Model\Product as MainProductName;

class Catalog
{
    public function afterGetName(MainProductName $subject, $result)
        {
           
            return $result . " Name Updated.";
        }
}

