<?php

namespace Acme\FahimNews\Model\ResourceModel\Newscomment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Acme\FahimNews\Model\ResourceModel\Newscomment
 */
class Collection extends AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'Acme\FahimNews\Model\Newscomment',
            'Acme\FahimNews\Model\ResourceModel\Newscomment'
        );
    }
}
