const swiperFeaturedVendors = new Swiper('.swiper-vendors', {
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  // autoHeight: true,
  navigation: {
      nextEl: '.swiper-vendors-button-next',
      prevEl: '.swiper-vendors-button-prev',
  },
  pagination: {
    el: ".swiper-vendors-pagination",
    clickable: true,
  },
  slidesPerView: 1,
  spaceBetween: 16,
  breakpoints: {
    390: {
        slidesPerView: 2,
    },
    560: {
        slidesPerView: 3,
    },
    800: {
        slidesPerView: 5,
    },
  }
});