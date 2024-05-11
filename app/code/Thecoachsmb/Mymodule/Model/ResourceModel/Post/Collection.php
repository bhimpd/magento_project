<?php
namespace Thecoachsmb\Mymodule\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Thecoachsmb\Mymodule\Model\Post', 'Thecoachsmb\Mymodule\Model\ResourceModel\Post');
	}

}