<?php

namespace Acme\FahimNews\Block\Adminhtml\Newscat\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    
    protected function _construct()
    {
        parent::_construct();
        $this->setId('newscat_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Category Information'));
    }
}
