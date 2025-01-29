<?php

namespace WB\ProductImageSlider\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class ExampleCode extends Field
{
    /**
     * Render the example PHP code in the admin panel.
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $codeExample = <<<HTML
<pre style="background: #f8f9fa; padding: 10px; border: 1px solid #ddd; font-family: monospace; white-space: pre-wrap;">
&lt;?php
// Get the Config block from layout
\$configBlock = \$block->getLayout()->getBlock('wb_productimageslider_config');
\$sliderEnabled = false;

// If the block exists and has method isSliderEnabled, call it
if (\$configBlock && method_exists(\$configBlock, 'isSliderEnabled')) {
    \$sliderEnabled = \$configBlock->isSliderEnabled();
}
?&gt;

&lt;?php if (\$sliderEnabled): ?&gt;
    &lt;!-- Show Slider --&gt;
    &lt;div class="product-image-slider"&gt;
        &lt;?= \$block->getLayout()
            ->createBlock('WB\ProductImageSlider\Block\Category\ProductSlider')
            ->setProduct(\$_product)
            ->toHtml();
        ?&gt;
    &lt;/div&gt;
&lt;?php else: ?&gt;
    &lt;!-- Show Default Product Image --&gt;
    &lt;a href="&lt;?= \$_product->getProductUrl() ?&gt;" 
       class="product photo product-item-photo"
       tabindex="-1"&gt;
        &lt;span class="main-image"&gt;
            &lt;?= \$productImage->toHtml(); ?&gt;
        &lt;/span&gt;
        &lt;span class="hover-image"&gt;
            &lt;?= \$productHoverImage->toHtml(); ?&gt;
        &lt;/span&gt;
    &lt;/a&gt;
&lt;?php endif; ?&gt;
</pre>
HTML;
        return $codeExample;
    }
}
