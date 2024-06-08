<?php
namespace Thecoachsmb\SalesOrderCronjob\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\App\Request\Http;
use Thecoachsmb\SalesOrderCronjob\Api\Data\CustomCategoryInterface;

class CategoryAttributes extends Template
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var Http
     */
    protected $request;

    /**
     * CategoryAttributes constructor.
     * @param Context $context
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Http $request
     * @param array $data
     */
    public function __construct(
        Context $context,
        CategoryRepositoryInterface $categoryRepository,
        Http $request,
        array $data = []
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * Get the current category
     *
     * @return CustomCategoryInterface|null
     */
    public function getCurrentCategory()
    {
        $categoryId = $this->request->getParam('id');
        if ($categoryId) {
            try {
                return $this->categoryRepository->get($categoryId);
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }
}
