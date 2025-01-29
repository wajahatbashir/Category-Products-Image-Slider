<?php

namespace WB\ProductImageSlider\Block\Category;

use Magento\Catalog\Helper\Image as ImageHelper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;

class ProductSlider extends Template
{
    protected $imageHelper;
    protected $product;
    protected $productRepository;

    // Specify the template file for this block
    protected $_template = 'WB_ProductImageSlider::category/slider.phtml';

    public function __construct(
        Context $context,
        ImageHelper $imageHelper,
        ProductRepositoryInterface $productRepository,
        array $data = []
    ) {
        $this->imageHelper = $imageHelper;
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    // Set the product object
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    // Get the product object
    public function getProduct()
    {
        return $this->product;
    }

    // Get product images dynamically
    public function getProductImages()
    {
        if (!$this->product || !$this->product->getId()) {
            return ['Error: Invalid product object or product ID not found.'];
        }

        try {
            // Re-load the product fully, ensuring media gallery is present
            /** @var \Magento\Catalog\Api\ProductRepositoryInterface $productRepository */
            $productRepository = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Magento\Catalog\Api\ProductRepositoryInterface::class);

            // Load product by ID (or SKU) so that gallery data is included
            $loadedProduct = $productRepository->getById($this->product->getId());
            $images = $loadedProduct->getMediaGalleryImages();

            if (!$images || $images->getSize() === 0) {
                return ['Error: No media gallery images found for product ID: ' . $this->product->getId()];
            }

            $imageUrls = [];
            foreach ($images as $image) {
                $imageUrls[] = $this->imageHelper->init($loadedProduct, 'category_page_list')
                    ->setImageFile($image->getFile())
                    ->getUrl();
            }

            return $imageUrls;
        } catch (\Exception $e) {
            return ['Error fetching images: ' . $e->getMessage()];
        }
    }

}
