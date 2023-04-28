<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newscat;

use Acme\FahimNews\Controller\Adminhtml\Newscat;

/**
 * Class NewAction
 * @package Acme\FahimNews\Controller\Adminhtml\Newscat
 */
class NewAction extends Newscat
{
    /**
     *
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
