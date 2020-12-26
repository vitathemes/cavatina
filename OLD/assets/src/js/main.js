// Carousel
var carousel = document.querySelector(".c-carousel__context");
var flkty = new Flickity(carousel, {
  setGallerySize: false,
  freeScroll: false,
  //pageDots: false,
  prevNextButtons: true,
});

// Carosuel - text
var carouselImage = document.querySelector(".c-carousel__post-titles");
var flkty = new Flickity(carouselImage, {
  setGallerySize: true,
  freeScroll: false,
  prevNextButtons: false,
  pageDots: false,
  asNavFor: ".c-carousel__context",
  draggable: false,
});

// Carosuel - text Mobile
var carouselTextMobile = document.querySelector(
  ".c-carousel__post-titles--mobile"
);
var flkty = new Flickity(carouselTextMobile, {
  setGallerySize: true,
  freeScroll: false,
  prevNextButtons: false,
  pageDots: false,
  asNavFor: ".c-carousel__context",
  contain: true,
  groupCells: true,
  draggable: false,
});
