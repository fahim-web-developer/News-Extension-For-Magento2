<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newscat;

use Acme\FahimNews\Controller\Adminhtml\Newscat;

/**
 * Class Edit
 * @package Acme\FahimNews\Controller\Adminhtml\Newscat
 */
class Edit extends Newscat
{
    /**
     *
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('cat_id');
        $model = $this->_newscatFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getCatId()) {
                $this->messageManager
                    ->addError(
                        __('This Category no longer exists.')
                    );
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('newscat', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
