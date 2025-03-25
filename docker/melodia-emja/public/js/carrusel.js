(function($) {
    setTimeout(function() {
        $('.slider-images-container').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            responsive: [{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }]
        });
    }, 1000);
}(jQuery));



