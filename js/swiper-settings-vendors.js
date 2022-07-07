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
        spaceBetween: 32
    },
  }
});