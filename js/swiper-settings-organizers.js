const swiperOrganizers = new Swiper(".swiper-organizers", {
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  navigation: {
    nextEl: ".swiper-organizers-button-next",
    prevEl: ".swiper-organizers-button-prev",
  },
  pagination: {
    el: ".swiper-organizers-pagination",
    clickable: true,
  },
  slidesPerView: 1,
  spaceBetween: 16,
  breakpoints: {
    400: {
      slidesPerView: 2,
    },
    700: {
      slidesPerView: 3,
    },
    1000: {
      slidesPerView: 4,
    },
    1200: {
      slidesPerView: 5,
    },
  },
});
