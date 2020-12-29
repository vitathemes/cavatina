// Check device is mobile or not
isDesktop = () => {
  if (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    )
  ) {
    return false;
  } else {
    return true;
  }
};

// search menu toggle
searchToggle = () => {
  let search = document.querySelector(".c-search");

  if (search.classList.contains("c-search--toggled")) {
    search.classList.remove("c-search--toggled");
  } else {
    search.classList.add("c-search--toggled");
  }
};

// Carousel (Main)
var carousel = document.querySelector(".c-carousel__context");
var flkty = new Flickity(carousel, {
  setGallerySize: false,
  freeScroll: false,
  prevNextButtons: true,
});

// Carosuel (Main Child) - text
var carouselImage = document.querySelector(".c-carousel__post-titles");
var flkty = new Flickity(carouselImage, {
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
var flkty = new Flickity(carouselTextMobile, {
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

var flkty = new Flickity(carouselSingle, {
  freeScroll: isDesktop(),
  setGallerySize: false,
  cellAlign: "left",
  prevNextButtons: false,
  on: {
    ready: function () {
      console.log("Flickity is ready");
    },
    change: function (index) {
      if (isDesktop() === true) {
        console.log("Slide changed to" + index);
        var singleCarousel = document.querySelector(".c-single__slider");
        singleCarousel.classList.add("c-single__slider--full-width");

        if (index === 0) {
          singleCarousel.classList.remove("c-single__slider--full-width");
        }
      }
    },
  },
});
