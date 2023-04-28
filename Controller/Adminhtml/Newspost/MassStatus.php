<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newspost;

use Acme\FahimNews\Controller\Adminhtml\Newspost;

/**
 * Class MassStatus
 * @package Acme\FahimNews\Controller\Adminhtml\Newspost
 */
class MassStatus extends Newspost
{
    /**
     * @return $this
     */
    public function execute()
    {
        $newspostIds = $this->getRequest()->getParam('newspost');
        if (!is_array($newspostIds) || empty($newspostIds)) {
            $this->messageManager->addError(__('Please select news post(s).'));
        } else {
            try {
                $status = (int)$this->getRequest()->getParam('status');
                foreach ($newspostIds as $postId) {
                    $post = $this->_newspostFactory->create()
                        ->load($postId);
                    $post->setIsActive($status)->save();
                }
                $this->messageManager->addSuccess(
                    __(
                        'A total of %1 record(s) have been updated.',
                        count($newspostIds)
                    )
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('news/*/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Acme_FahimNews::newscomment');
    }
}
