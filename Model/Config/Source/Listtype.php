<?php

namespace Acme\FahimNews\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Listtype
 * @package Acme\FahimNews\Model\Config\Source
 */
class Listtype implements ArrayInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'grid',
                'label' => __('Grid')
            ],
            [
                'value' => 'list',
                'label' => __('List')
            ]
        ];
    }
}
