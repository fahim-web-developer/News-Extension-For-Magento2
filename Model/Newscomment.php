<?php

namespace Acme\FahimNews\Model;

use Acme\FahimNews\Helper\Data;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;

/**
 * Class Newscomment
 * @package Acme\FahimNews\Model
 */
class Newscomment extends AbstractModel
{
    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Acme\FahimNews\Model\ResourceModel\Newscomment');
    }

    /**
     * @var UrlInterface
     */
    protected $_urlModel;

    /**
     * Newscomment constructor.
     * @param Context $context
     * @param Registry $registry
     * @param UrlInterface $urlModel
     * @param Data $dataHelper
     */
    public function __construct(
        Context $context,
        Registry $registry,
        UrlInterface $urlModel,
        Data $dataHelper
    ) {
        parent::__construct($context, $registry);
        $this->_dataHelper = $dataHelper;
        $this->_urlModel = $urlModel;
    }

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        $dateFormat = $this->_dataHelper
            ->getStoreConfig('acme_fahimnews/general/date_format');
        return date($dateFormat, strtotime($this->getCommentedDate()));
    }

    /**
     * @return $this
     */
    public function beforeSave()
    {
        $this->_cacheManager->clean();
        return $this;
    }
}
