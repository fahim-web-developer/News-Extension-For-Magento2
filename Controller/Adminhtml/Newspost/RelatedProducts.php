<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newspost;

use Acme\FahimNews\Controller\Adminhtml\Newspost;

/**
 * Class RelatedProducts
 * @package Acme\FahimNews\Controller\Adminhtml\Newspost
 */
class RelatedProducts extends Newspost
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
        $this->_coreRegistry->register('related_pro_model', $this->_model);
        $this->_view->loadLayout()
            ->getLayout()
            ->getBlock('acme_fahimnews_relatedproducts')
            ->setProductsRelated(
                $this->getRequest()->getPost('products_related', null)
            );

        $this->_view->renderLayout();
    }
}
