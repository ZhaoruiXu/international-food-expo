const swiperOrganizers = new Swiper(".swiper-organizers", {
  loop: true,
  autoplay: {
    delay: 1500,
    disableOnInteraction: false,
  },
  autoHeight: true,
  navigation: {
    nextEl: ".swiper-organizers-button-next",
    prevEl: ".swiper-organizers-button-prev",
  },
  pagination: {
    el: ".swiper-organizers-pagination",
    clickable: true,
  },
  slidesPerView: 2,
  spaceBetween: 10,
  breakpoints: {
    450: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    800: {
      slidesPerView: 5,
      spaceBetween: 30,
    },
  },
});
