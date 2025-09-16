import Swiper, { Navigation } from "swiper";
import "swiper/css";
import "swiper/css/navigation";

document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector(".slider")) {
    const options = {
      slidesPerView: 1,
      spaceBetween: 18,
      freeMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 4,
        },
      },
    };
    Swiper.use([Navigation]);
    new Swiper(".slider", options);
  }
  var mySwiper = new Swiper(".swiper-container", {
    speed: 400,
    spaceBetween: 100,
    initialSlide: 0,
    //truewrapper adoptsheight of active slide
    autoHeight: false,
    // Optional parameters
    direction: "horizontal",
    // loop: true,
    // delay between transitions in ms
    autoplay: 5000,
    autoplayStopOnLast: true, // loop false also
    // If we need pagination
    pagination: ".swiper-pagination",
    paginationType: "bullets",

    // Navigation arrows
    navigation: {
      nextButton: ".swiper-button-next",
      prevButton: ".swiper-button-prev",
    },
    // And if we need scrollbar
    //scrollbar: '.swiper-scrollbar',
    // "slide", "fade", "cube", "coverflow" or "flip"
    effect: "slide",
    // Distance between slides in px.
    spaceBetween: 60,
    //

    slidesPerView: 1,
    breakpoints: {
      768: {
        slidesPerView: 3,
      },
    },
    //
    centeredSlides: true,
    //
    slidesOffsetBefore: 0,
    //
    grabCursor: true,
  });
});