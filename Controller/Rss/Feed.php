<?php

namespace Acme\FahimNews\Controller\Rss;

use Magento\Framework\App\Action\Action;

/**
 * Class Feed
 * @package Acme\FahimNews\Controller\Rss
 */
class Feed extends Action
{
    /**
     *
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->getResponse()
            ->setHeader('Content-type', 'text/xml; charset=UTF-8')
            ->setBody($this->_view->getLayout()
                ->getBlock('acme_fahimnews.rss.feed')->toHtml());
    }
}
