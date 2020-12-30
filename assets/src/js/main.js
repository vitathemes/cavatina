// Check device is mobile or not
function isDesktop() {
  if (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    )
  ) {
    return false;
  } else {
    return true;
  }
}

// search menu toggle
function searchToggle() {
  let search = document.querySelector(".c-search");

  if (search.classList.contains("c-search--toggled")) {
    search.classList.remove("c-search--toggled");
  } else {
    search.classList.add("c-search--toggled");
  }
}

// o page toggle for blur content
function blurToggle() {
  var pageMain = document.querySelector(".o-page__main");
  var overlay = document.querySelector(".c-overlay");

  if (pageMain.classList.contains("o-page__main--blur")) {
    pageMain.classList.remove("o-page__main--blur");
    overlay.classList.remove("c-overlay--active");
  } else {
    pageMain.classList.add("o-page__main--blur");
    overlay.classList.add("c-overlay--active");
  }
}

// Carousel (Main)
var carousel = document.querySelector(".c-carousel__context");
var flCarouselMain = new Flickity(carousel, {
  setGallerySize: false,
  freeScroll: false,
  prevNextButtons: true,
});

// Carosuel (Main Child) - text
var carouselImage = document.querySelector(".c-carousel__post-titles");
var flCarouselText = new Flickity(carouselImage, {
  setGallerySize: true,
  freeScroll: false,
  prevNextButtons: false,
  pageDots: false,
  asNavFor: ".c-carousel__context",
  draggable: false,
  selectedAttraction: 0.2,
  friction: 0.8,
});

// Carosuel (Main Child) - text Mobile
var carouselTextMobile = document.querySelector(
  ".c-carousel__post-titles--mobile"
);
var flCarouselTextMobile = new Flickity(carouselTextMobile, {
  setGallerySize: true,
  freeScroll: false,
  prevNextButtons: false,
  pageDots: false,
  asNavFor: ".c-carousel__context",
  contain: true,
  groupCells: true,
  draggable: false,
  selectedAttraction: 0.2,
  friction: 0.8,
});

// Carosuel - Single Page
var carouselSingle = document.querySelector(".c-single__slider");

var flCarouselSingle = new Flickity(carouselSingle, {
  freeScroll: isDesktop(),
  setGallerySize: false,
  cellAlign: "left",
  prevNextButtons: false,
  on: {
    ready: function () {},
    change: function (index) {
      if (isDesktop() === true) {
        // console.log("Slide changed to" + index);
        var singleCarousel = document.querySelector(".c-single__slider");
        singleCarousel.classList.add("c-single__slider--full-width");

        if (index === 0) {
          singleCarousel.classList.remove("c-single__slider--full-width");
        }
      }
    },
  },
});
