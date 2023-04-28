<?php

namespace Acme\FahimNews\Block\Archive;

use Acme\FahimNews\Block\News;

/**
 * Class NewsList
 * @package Acme\FahimNews\Block\Archive
 */
class NewsList extends News
{
    /**
     * @return int
     */
    public function getMonth()
    {
        return (int)$this->_coreRegistry
            ->registry('current_news_archive_month');
    }

    /**
     * Get archive year
     * @return string
     */
    public function getYear()
    {
        return (int)$this->_coreRegistry->registry('current_news_archive_year');
    }

    /**
     * @return mixed|null
     */
    public function getCollection()
    {
        parent::getCollection();
        $this->_postCollection->getSelect()
            ->where('MONTH(publish_date) = ?', $this->getMonth())
            ->where('YEAR(publish_date) = ?', $this->getYear());

        return $this->_postCollection;
    }
}
