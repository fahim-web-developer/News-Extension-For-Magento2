<?php

namespace Acme\FahimNews\Controller\View;

use Acme\FahimNews\Helper\Data;
use Acme\FahimNews\Helper\Index\View;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Acme\FahimNews\Controller\View
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var ForwardFactory
     */
    protected $_resultForwardFactory;
    /**
     * @var View
     */
    protected $_viewHelper;
    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * Index constructor.
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param View $viewHelper
     * @param Data $dataHelper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory,
        View $viewHelper,
        Data $dataHelper,
        PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Acme\FahimNews\Model\NewspostFactory $newspostFactory
    ) {
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_viewHelper = $viewHelper;
        $this->_dataHelper = $dataHelper;
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_newspostFactory = $newspostFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        //Get Post Id
        $postId = $this->getRequest()
            ->getParam(
                'post_id',
                $this->getRequest()->getParam('id', false)
            );
        $post = $this->_newspostFactory->create()->load($postId);
        //get page layout
        $page = $this->_resultPageFactory
            ->create(false, ['isIsolated' => true]);
        //get Page number
        $pageNo = $this->getRequest()->getParam('p');
        //get page layout from helper
        $this->_viewHelper->prepareAndRenderPost(
            $page,
            $postId,
            $pageNo
        );
        //breadcrumbs
        $breadcrumbShow = $this->_dataHelper
            ->getStoreConfig('acme_fahimnews/general/breadcrumb');
        if ($breadcrumbShow == 1) {
            $listUrl = $this->_dataHelper
                ->getStoreConfig('acme_fahimnews/general/list_url');
            $breadcrumbs = $page->getLayout()
                ->getBlock('breadcrumbs');
            $breadcrumbs->addCrumb(
                'home',
                [
                    'label' => __('Home'),
                    'title' => __('Home'),
                    'link' => $this->_url->getUrl('')
                ]
            );
            $breadcrumbs->addCrumb(
                'acme_fahimnews',
                [
                    'label' => __('News Posts'),
                    'title' => __('News Posts'),
                    'link' => $this->_url->getUrl() . $listUrl
                ]
            );
            $breadcrumbs->addCrumb(
                'news_post_view',
                [
                    'label' => __($post->getTitle()),
                    'title' => __($post->getTitle())
                ]
            );
        }
        $this->_coreRegistry->register('current_post', $post);
        return $page;
    }
}
