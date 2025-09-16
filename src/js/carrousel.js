let currentIndex = 0;
const slides = document.querySelectorAll('.carousel__slide');

function changeSlide(direction) {
  slides[currentIndex].style.left = "-100%";

  currentIndex += direction;

  if (currentIndex < 0) {
    currentIndex = slides.length - 1;
  } else if (currentIndex >= slides.length) {
    currentIndex = 0;
  }

  slides[currentIndex].style.left = "0";
}

