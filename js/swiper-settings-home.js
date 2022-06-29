const swiperHome = new Swiper('.swiper-home', {
  loop: true,
  pagination: {
      el: '.swiper-home-pagination',
      clickable: true,
  },
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  // autoHeight: true,
  navigation: {
      nextEl: '.swiper-home-button-next',
      prevEl: '.swiper-home-button-prev',
  },
  slidesPerView: 1,
});