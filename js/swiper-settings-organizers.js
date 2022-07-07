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
  },
});
