<?php

namespace Acme\FahimNews\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Version extends Field
{

    public function __construct(
        Context $context,
        \Magento\Framework\Module\ResourceInterface $moduleResource,
        array $data = []
    ) {
        $this->moduleResource = $moduleResource;
        parent::__construct($context, $data);
    }

    /**
     * @param  AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * @param  AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $version = $this->moduleResource->getDbVersion('Acme_FahimNews');
        return 'v' . $version;
    }
}
