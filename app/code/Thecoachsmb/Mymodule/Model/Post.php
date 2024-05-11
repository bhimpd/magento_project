<?php
namespace Thecoachsmb\Mymodule\Model;
class Post extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Thecoachsmb\Mymodule\Model\ResourceModel\Post');
	}
}