<?php

namespace Acme\FahimNews\Model\ResourceModel\Newspost;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Acme\FahimNews\Model\ResourceModel\Newspost
 */
class Collection extends AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'Acme\FahimNews\Model\Newspost',
            'Acme\FahimNews\Model\ResourceModel\Newspost'
        );
    }

    /**
     * @param bool $isActive
     * @return $this
     */
    public function setActiveFilter($isActive = true)
    {
        $this->getSelect()->where('main_table.is_active=?', $isActive);
        return $this;
    }

    public function setPostFilter()
    {
        $this->addFieldToFilter('type', [['null' => true], ['neq' => 'revision']]);
        return $this;
    }

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreFilter($storeId = 0)
    {
        $connection = $this->getConnection();
        $inCondition = $connection->prepareSqlCondition(
            'main_table.store_id',
            [['finset' => $storeId], ['eq' => 0]]
        );
        $this->getSelect()->where($inCondition);
        return $this;
    }
}
