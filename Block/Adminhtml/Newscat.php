<?php

namespace Acme\FahimNews\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Newscat extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_newscat';
        $this->_blockGroup = 'Acme_FahimNews';
        $this->_headerText = __('Manage News Category');
        $this->_addButtonLabel = __('Add New Category');
        parent::_construct();
    }
}