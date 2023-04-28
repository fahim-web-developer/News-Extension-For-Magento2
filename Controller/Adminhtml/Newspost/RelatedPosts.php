<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newspost;

use Acme\FahimNews\Controller\Adminhtml\Newspost;

/**
 * Class RelatedPosts
 * @package Acme\FahimNews\Controller\Adminhtml\Newspost
 */
class RelatedPosts extends Newspost
{
    /**
     *
     */
    public function execute()
    {
        if (empty($this->_model)) {
            $this->_model = $this->_newspostFactory->create();

            $id = (int)$this->getRequest()->getParam('newspost_id');
            if ($id) {
                $this->_model->load($id);
            }
        }
        $this->_coreRegistry->register('related_post_model', $this->_model);
        $this->_view->loadLayout()
            ->getLayout()
            ->getBlock('acme_fahimnews_relatedposts')
            ->setPostsRelated(
                $this->getRequest()->getPost('posts_related', null)
            );
        $this->_view->renderLayout();
    }
}
