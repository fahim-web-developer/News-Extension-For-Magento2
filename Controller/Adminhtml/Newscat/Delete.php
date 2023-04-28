<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newscat;

use Magento\Backend\App\Action\Context;

/**
 * Class Delete
 * @package Acme\FahimNews\Controller\Adminhtml\Newscat
 */
class Delete extends \Magento\Backend\App\Action
{
    public function __construct(
        Context $context,
        \Acme\FahimNews\Model\NewscatFactory $newscatFactory
    ) {
        parent::__construct($context);
        $this->_newscatFactory = $newscatFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('cat_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_newscatFactory->create();
                $catCollection = $model->getCollection()
                    ->addFieldToFilter('cat_parent', $id);
                $catData = $catCollection->getData();
                if (empty($catData)) {
                    $model->load($id);
                    $model->delete();
                    $this->messageManager
                        ->addSuccess(
                            __('The category has been deleted.')
                        );
                } else {
                    $this->messageManager
                        ->addError(
                            __('Delete child category first.')
                        );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath(
                    '*/*/edit',
                    ['cat_id' => $id]
                );
            }
        }
        $this->messageManager->addError(
            __('We can\'t find a Category to delete.')
        );
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(
            'Acme_FahimNews::newscat'
        );
    }
}
