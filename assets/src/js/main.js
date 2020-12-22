// Carousel
var carousel = document.querySelector(".c-carousel__context");
var flkty = new Flickity(carousel, {
  setGallerySize: false,
  freeScroll: false,
  //pageDots: false,
  prevNextButtons: true,
});

// Carosuel - text
var carouselImage = document.querySelector(".text-carousel");
var flkty = new Flickity(carouselImage, {
  setGallerySize: true,
  freeScroll: false,
  prevNextButtons: false,
  pageDots: false,
  asNavFor: ".c-carousel__context",
});

// Carosuel - text Mobile
var carouselTextMobile = document.querySelector(".text-carousel--mobile");
var flkty = new Flickity(carouselTextMobile, {
  setGallerySize: true,
  freeScroll: false,
  prevNextButtons: false,
  pageDots: false,
  asNavFor: ".c-carousel__context",
  contain: true,
  groupCells: true,
});
