<?php

namespace Acme\FahimNews\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Newscat
 * @package Acme\FahimNews\Model
 */
class Newscat extends AbstractModel
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Acme\FahimNews\Model\ResourceModel\Newscat');
    }

    /**
     * @param $urlKey
     * @return mixed
     */
    public function checkUrlKey($urlKey)
    {
        return $this->_getResource()->checkUrlKey($urlKey);
    }

    /**
     * @return $this
     */
    public function beforeSave()
    {
        $this->_cacheManager->clean();
        return $this;
    }
}
