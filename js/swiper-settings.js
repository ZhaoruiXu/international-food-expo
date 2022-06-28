const swiper = new Swiper('.swiper', {
  loop: true,
  autoplay: {
    delay: 1500,
    disableOnInteraction: false,
  },
  autoHeight: true,
  navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
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