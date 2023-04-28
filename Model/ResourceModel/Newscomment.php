<?php

namespace Acme\FahimNews\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Newscomment
 * @package Acme\FahimNews\Model\ResourceModel
 */
class Newscomment extends AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('acme_fahimnews_comment', 'comment_id');
    }
}
