$('.autoplay').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    pauseOnFocus: false,
    pauseOnHover: false,
    arrows: true,
    dots: false,
    // centerMode: true,
    prevArrow: '<img class="slick-prev slick-arrow img-fluid image__slick-prev" src="img/arrow-left.svg">',
    nextArrow: '<img class="slick-next slick-arrow img-fluid image__slick-next" src="img/arrow-right.svg">',
    responsive: [{
        breakpoint: 1200,
        settings: {
            slidesToShow: 5,
            slidesToScroll: 1
        }
    },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 790,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 576,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },


    ]
});
