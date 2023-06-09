<?php

namespace Acme\FahimNews\Block\Adminhtml\Newspost\Edit;

/**
 * Class Tabs
 * @package Acme\FahimNews\Block\Adminhtml\Newspost\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('News Post Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'related_posts_section',
            [
                'label' => __('Related Posts'),
                'url' => $this->getUrl(
                    'fahimnews/newspost/relatedPosts',
                    ['_current' => true]
                ),
                'class' => 'ajax',
            ]
        );

        $this->addTab(
            'related_products_section',
            [
                'label' => __('Related Products'),
                'url' => $this->getUrl(
                    'fahimnews/newspost/relatedProducts',
                    ['_current' => true]
                ),
                'class' => 'ajax',
            ]
        );
        return parent::_beforeToHtml();
    }
}
