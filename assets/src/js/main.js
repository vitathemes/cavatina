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
    let val = parseFloat(el.style.opacity);
    if (!((val += 0.1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
}

// Search Box Desktop
let isToggled = false;
function searchToggleHeader() {
  const header = document.querySelector(".js-header");
  const headerSearch = document.querySelector(".js-header__search");
  const searchOverlay = document.querySelector(".js-search__overlay");

  let headerContains = header.contains(headerSearch);

  if (headerContains === true) {
    headerSearch.addEventListener("click", function () {
      // Fade in/out the search overlay
      if (isToggled === true) {
        fadeOut(searchOverlay);
        headerSearch.classList.remove("c-header__search--toggle");
        isToggled = false;
      } else {
        fadeIn(searchOverlay, "flex");
        headerSearch.classList.add("c-header__search--toggle");
        isToggled = true;
      }
    });
  }
}

searchToggleHeader();

// Search Box mobile
function searchToggleAside() {
  const oPageMain = document.querySelector(".js-page");
  const searchIcon = document.querySelector(".js-search__icon");
  const searchBlock = document.querySelector(".js-search");

  let pageMainContain = oPageMain.contains(searchIcon);

  if (pageMainContain === true) {
    searchIcon.addEventListener("click", function () {
      searchIcon.classList.toggle("c-search__icon--toggled");
      searchBlock.classList.toggle("c-search--toggled");
    });
  }
}
searchToggleAside();

// o-page toggle for blur content
function blurToggle() {
  let pageMain = document.querySelector(".js-page__main");
  let overlay = document.querySelector(".js-overlay");

  if (pageMain.classList.contains("o-page__main--blur")) {
    pageMain.classList.remove("o-page__main--blur");
    overlay.classList.remove("c-overlay--active");
  } else {
    pageMain.classList.add("o-page__main--blur");
    overlay.classList.add("c-overlay--active");
  }
}

// Main page Carousels
function mainPageCarousels() {
  // Carousel (Main)
  let carousel = document.querySelector(".js-carousel__context");
  let flCarouselMain = new Flickity(carousel, {
    setGallerySize: false,
    freeScroll: false,
    prevNextButtons: true,
  });

  // Carousel (Main Child) - text
  let carouselImage = document.querySelector(".js-carousel__post-titles");
  let flCarouselText = new Flickity(carouselImage, {
    setGallerySize: true,
    freeScroll: false,
    prevNextButtons: false,
    pageDots: false,
    asNavFor: ".c-carousel__context",
    draggable: false,
    selectedAttraction: 0.2,
    friction: 0.8,
  });

  // Carousel (Main Child) - text Mobile
  let carouselTextMobile = document.querySelector(
    ".js-carousel__post-titles--mobile"
  );
  let flCarouselTextMobile = new Flickity(carouselTextMobile, {
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
}

// Carousel - Single Page
function singleCarousel() {
  let carouselSingle = document.querySelector(".js-single__slider");

  let flCarouselSingle = new Flickity(carouselSingle, {
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
          let singleCarousel = document.querySelector(".js-single__slider");
          singleCarousel.classList.add("c-single__slider--full-width");

          if (index === 0) {
            singleCarousel.classList.remove("c-single__slider--full-width");
          }
        }
      },
    },
  });
}

// if we have single carousel in page slider will render
const singleSlider = document.querySelector(".js-single__slider");
if (singleSlider.classList.contains("c-single__slider") === true) {
  singleCarousel();
}
