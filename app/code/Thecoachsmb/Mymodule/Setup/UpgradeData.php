<?php

namespace Thecoachsmb\Mymodule\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 *
 * @package Thecoachsmb\Mymodule\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * Creates sample articles
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '1.1.1') < 0
        ) {
            $tableName = $setup->getTable('thecoachsmb_article');

            $data = [
                [
                    'title' => 'How to create table in Magento2',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'How to insert data in table of Magento2',
                    'content' => 'Content of the second post.',
                ],
            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        $setup->endSetup();
    }
}