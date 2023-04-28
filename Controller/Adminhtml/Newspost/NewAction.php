<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newspost;

use Acme\FahimNews\Controller\Adminhtml\Newspost;

/**
 * Class NewAction
 * @package Acme\FahimNews\Controller\Adminhtml\Newspost
 */
class NewAction extends Newspost
{
    /**
     *
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
