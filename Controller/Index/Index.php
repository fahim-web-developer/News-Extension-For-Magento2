<?php

namespace Acme\FahimNews\Controller\Index;

use Acme\FahimNews\Helper\Data;
use Acme\FahimNews\Helper\Index\View;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Acme\FahimNews\Controller\Index
 */
class Index extends Action
{
    /**
     * @var View
     */
    protected $_viewHelper;
    /**
     * @var Data
     */
    protected $_dataHelper;
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param View $viewHelper
     * @param PageFactory $resultPageFactory
     * @param Data $dataHelper
     */
    public function __construct(
        Context $context,
        View $viewHelper,
        PageFactory $resultPageFactory,
        Data $dataHelper,
        \Magento\Framework\Controller\Result\Forward $resultForward
    ) {
        $this->_viewHelper = $viewHelper;
        $this->_dataHelper = $dataHelper;
        $this->_resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForward;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $enable = $this->_dataHelper->isEnable();
        if ($enable) {
            $page = $this->_resultPageFactory->create(false, ['isIsolated' => true]);
            $pageNo = $this->getRequest()->getParam('p');
            $s = $this->getRequest()->getParam('s');
            if ($s) {
                $page->getConfig()->getTitle()->set(__('Search Result for ' . $s));
            } else {
                $page->getConfig()->getTitle()->set(__('Latest News Posts'));
            }
            $this->_viewHelper->prepareAndRender($page, $pageNo);

            $breadcrumbShow = $this->_dataHelper
                ->getStoreConfig('acme_fahimnews/general/breadcrumb');
            if ($breadcrumbShow == 1) {
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
                if ($s) {
                    $breadcrumbs->addCrumb(
                        'acme_fahimnews',
                        [
                            'label' => __('Search Result for ' . $s),
                            'title' => __('Search Result for ' . $s)
                        ]
                    );
                } else {
                    $breadcrumbs->addCrumb(
                        'acme_fahimnews',
                        [
                            'label' => __('Latest News Posts'),
                            'title' => __('Latest News Posts')
                        ]
                    );
                }
            }
            // echo'<pre>';print_r($enable);exit;
            return $page;
        } else {
            $resultForward = $this->resultForwardFactory;
            $resultForward->forward('noroute'); // call the no route method
            return $resultForward;
        }
    }
}
