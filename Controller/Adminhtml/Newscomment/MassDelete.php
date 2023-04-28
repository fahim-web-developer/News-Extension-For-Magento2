<?php

namespace Acme\FahimNews\Controller\Adminhtml\Newscomment;

use Magento\Backend\App\Action\Context;

/**
 * Class MassDelete
 * @package Acme\FahimNews\Controller\Adminhtml\Newscomment
 */
class MassDelete extends \Magento\Backend\App\Action
{
    public function __construct(
        Context $context,
        \Acme\FahimNews\Model\NewscommentFactory $newscommentFactory
    ) {
        parent::__construct($context);
        $this->_newscommentFactory = $newscommentFactory;
    }

    public function execute()
    {
        $newspostIds = $this->getRequest()->getParam('comment_id');
        if (!is_array($newspostIds) || empty($newspostIds)) {
            $this->messageManager->addError(__('Please select Comment(s).'));
        } else {
            try {
                foreach ($newspostIds as $postId) {
                    $post = $this->_newscommentFactory->create()
                        ->load($postId);
                    $post->delete();
                }
                $this->messageManager->addSuccess(
                    __(
                        'A total of %1 record(s) have been deleted.',
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
