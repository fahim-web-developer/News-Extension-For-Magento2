<?php

namespace Acme\FahimNews\Block\Widget;

use Acme\FahimNews\Block\News;

/**
 * Class Search
 * @package Acme\FahimNews\Block\Widget
 */
class Search extends News
{
    /**
     * @var string
     */
    protected $_searchkey = 'search';

    /**
     * @return mixed
     */
    public function getSearchQuery()
    {
        return $this->getRequest()->getParam('s', '');
    }

    /**
     * @return mixed
     */
    public function getSearchUrl()
    {
        return $this->_dataHelper->getStoreConfig(
            'acme_fahimnews/general/list_url'
        );
    }
}
