# **Product Image Slider for Magento 2**  

**WB_ProductImageSlider** is a Magento 2 module that enables a dynamic **image slider** on the **category page**, allowing users to navigate product images using hover, touch, and next/prev buttons.  

---

## **Features**  
✅ **Enable/Disable** from Admin (**Stores > Configuration > WB > Product Image Slider**)  
✅ **Displays multiple product images** dynamically in a **slider format**  
✅ **Auto-slide, smooth transitions, and hover effects**  
✅ **Next/Previous navigation only if multiple images exist**  
✅ **Fully responsive (Desktop & Mobile)**  
✅ **Compatible with Magento 2.0.x – 2.4.x**  

---

## Screenshots

### Frontend View
![Frontend View](https://github.com/wajahatbashir/wajahatbashir/blob/main/images/image-slider-frontend.jpg)

---

## **Installation**  

1️⃣ **Copy module files** to:  
   ```
   app/code/WB/ProductImageSlider
   ```  

2️⃣ **Run Magento commands:**  
   ```bash
   php bin/magento setup:upgrade
   php bin/magento setup:di:compile
   php bin/magento cache:flush
   php bin/magento setup:static-content:deploy -f
   ```  

---

## **Configuration**  

📌 **Enable/Disable** via:  
🔹 `Stores > Configuration > WB > Product Image Slider > Enable Slider`  

📌 **How It Works:**  
- If **enabled**, the **slider replaces the default product image** on the category page.  
- If **disabled**, Magento’s **default product images** are displayed.  

---

## **Usage in `list.phtml`**  

Modify `list.phtml` to **conditionally display the slider**:  

```php
<?php
$configBlock = $block->getLayout()->getBlock('wb_productimageslider_config');
$sliderEnabled = $configBlock && method_exists($configBlock, 'isSliderEnabled') ? $configBlock->isSliderEnabled() : false;
?>

<?php if ($sliderEnabled): ?>
    <div class="product-image-slider">
        <?= $block->getLayout()
            ->createBlock('WB\ProductImageSlider\Block\Category\ProductSlider')
            ->setProduct($_product)
            ->toHtml();
        ?>
    </div>
<?php else: ?>
    <a href="<?= $_product->getProductUrl() ?>" class="product photo product-item-photo">
        <span class="main-image"><?= $productImage->toHtml(); ?></span>
        <span class="hover-image"><?= $productHoverImage->toHtml(); ?></span>
    </a>
<?php endif; ?>
```

## **Support**  

🔹 **Bug Reports & Issues**: Contact the developer or report via your repository.  
🔹 **Contributions**: Contributions or pull requests are welcome to improve and maintain this module.