 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav',
  responsive: [
  {
    breakpoint: 920,
    settings: {
      autoplay: true,
      autoplaySpeed: 2000
      }
    },
  ]
});
$('.slider-nav').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  arrows: true,
  centerMode: true,
  focusOnSelect: true,
  responsive: [
     {
      breakpoint: 1400,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 920,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: '10px',
        slidesToShow: 1
      }
    },
  ],
});    