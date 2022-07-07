const swiperFeaturedVendors = new Swiper('.swiper-vendors', {
  loop: true,
  autoplay: {
    delay: 1500,
    disableOnInteraction: false,
  },
  // autoHeight: true,
  navigation: {
      nextEl: '.swiper-vendors-button-next',
      prevEl: '.swiper-vendors-button-prev',
  },
  slidesPerView: 2,
  spaceBetween: 10,
  breakpoints: {
      450: {
          slidesPerView: 3,
          spaceBetween: 20
      },
      800: {
          slidesPerView: 5,
          spaceBetween: 30
      },
  }
});