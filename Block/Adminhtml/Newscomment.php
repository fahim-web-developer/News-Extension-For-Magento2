<?php

namespace Acme\FahimNews\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Newscomment extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_newscomment';
        $this->_blockGroup = 'Acme_FahimNews';
        $this->_headerText = __('Manage News Comments');
        parent::_construct();
        $this->removeButton('add');
    }
}
