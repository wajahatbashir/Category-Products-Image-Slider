<?php

namespace WB\ProductImageSlider\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Config extends Template
{
    /**
     * Check if the Product Slider is enabled in Admin configuration.
     *
     * @return bool
     */
    public function isSliderEnabled()
    {
        return (bool)$this->_scopeConfig->getValue(
            'wb_productimageslider/general/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }
}
