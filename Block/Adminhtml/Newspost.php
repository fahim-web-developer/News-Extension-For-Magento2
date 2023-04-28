<?php

namespace Acme\FahimNews\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Newspost extends Container
{
    protected function _construct()
    {
        
        $this->_controller = 'adminhtml_newspost';
        $this->_blockGroup = 'Acme_FahimNews';
        $this->_headerText = __('Manage News Post');
        $this->_addButtonLabel = __('Add New Post');
        parent::_construct();
    }
}
