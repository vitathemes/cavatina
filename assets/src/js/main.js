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

// Fade Out Vanilla JS
function fadeOut(el) {
  el.style.opacity = 1;
  (function fade() {
    if ((el.style.opacity -= 0.1) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
}

// Fade In Vanilla JS
function fadeIn(el, display) {
  el.style.opacity = 0;
  el.style.display = display || "block";
  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += 0.1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
}

// Toggle element -> should describe with selector (# or .)
isToggled = false;
function toggleElement(toggledElement) {
  const toggleElement = document.querySelector(toggledElement);
  // toggleElement.classList.toggle("c-search__overlay--toggle");

  if (isToggled === true) {
    fadeOut(toggleElement);
    isToggled = false;
  } else {
    fadeIn(toggleElement, "flex");
    isToggled = true;
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
  pageDots: !isDesktop(),
  prevNextButtons: false,
  on: {
    ready: function () {},
    change: function (index) {
      if (isDesktop() === true) {
        // make slider full width with first drag
        var singleCarousel = document.querySelector(".c-single__slider");
        singleCarousel.classList.add("c-single__slider--full-width");

        if (index === 0) {
          singleCarousel.classList.remove("c-single__slider--full-width");
        }
      }
    },
  },
});
