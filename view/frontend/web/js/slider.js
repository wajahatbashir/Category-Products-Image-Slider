require(['jquery'], function ($) {
    $(document).ready(function () {
        //console.log('Slider script loaded and initialized.'); // Debugging log

        // Initialize each product slider
        $('.product-slider').each(function () {
            const $slider = $(this);
            const $slides = $slider.find('.slide');
            const $prevButton = $slider.find('.prev');
            const $nextButton = $slider.find('.next');
            let currentIndex = 0;

            // Debugging log
            //console.log('Slides found:', $slides.length);

            // Show the slide at the given index
            function showSlide(index) {
                //console.log('Showing slide:', index); // Debugging log
                $slides.hide(); // Hide all slides
                $slides.eq(index).show(); // Show the selected slide
            }

            // Handle "Previous" button click
            $prevButton.on('click', function () {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : $slides.length - 1;
                showSlide(currentIndex);
            });

            // Handle "Next" button click
            $nextButton.on('click', function () {
                currentIndex = (currentIndex < $slides.length - 1) ? currentIndex + 1 : 0;
                showSlide(currentIndex);
            });

            // Initialize slider
            showSlide(currentIndex);
        });
    });
});
