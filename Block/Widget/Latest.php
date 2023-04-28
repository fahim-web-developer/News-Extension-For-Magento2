<?php

namespace Acme\FahimNews\Block\Widget;

use Acme\FahimNews\Model\NewspostFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

/**
 * Class Latest
 * @package Acme\FahimNews\Block\Widget
 */
class Latest extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'widget/latest.phtml';

    /**
     * @var NewspostFactory
     */
    protected $_modelNewsFactory;

    /**
     * Latest constructor.
     * @param Context $context
     * @param array $data
     * @param NewspostFactory $modelNewsFactory
     */
    public function __construct(
        Context $context,
        NewspostFactory $modelNewsFactory,
        array $data = []
    ) {
        $this->_modelNewsFactory = $modelNewsFactory;
        parent::__construct($context, $data);
        $count = $this->getCount();
        $now = date('Y-m-d');
        $collection = $this->_modelNewsFactory->create()->getCollection();
        $collection->setActiveFilter(true)->setPostFilter();
        $collection->setStoreFilter($this->getStoreId());
        $collection->addFieldToFilter('publish_date', ['lteq' => $now]);
        $collection->setOrder('publish_date', 'DESC');
        if (isset($count) && $count != '') {
            $collection->setPageSize($count);
        } else {
            $collection->setPageSize(5);
        }
        $this->setCollection($collection);
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        return $this;
    }
}
