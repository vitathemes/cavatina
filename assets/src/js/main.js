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

  if (document.querySelector("body").getElementsByClassName("o-overlay")[0]) {
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
  const searchBlock = document.querySelector(".js-search__form");

  let pageMainContain = oPageMain.contains(searchIcon);

  if (pageMainContain === true) {
    searchIcon.addEventListener("click", function () {
      searchIcon.classList.toggle("c-search__icon--toggled");
      searchBlock.classList.toggle("c-search__form--toggled");
    });
  }
}
searchToggleAside();

// o-page toggle for blur content
function blurToggle() {
  let pageMain = document.querySelector(".js-page__main");
  let overlay = document.querySelector(".js-overlay");
  let searchOverlay = document.querySelector(".js-search__overlay");

  if (document.querySelector("body").getElementsByClassName("c-aside")[0]) {
    console.log("true");
    let aside = document.querySelector(".js-aside");
    if (pageMain.classList.contains("o-page__main--blur")) {
      aside.classList.remove("c-aside--blur");
    } else {
      aside.classList.add("c-aside--blur");
    }
  }

  const headerMenuLogo = document.querySelector(".c-header__menu");

  if (pageMain.classList.contains("o-page__main--blur")) {
    searchOverlay.classList.remove("o-page__main--blur");
    pageMain.classList.remove("o-page__main--blur");
    overlay.classList.remove("o-overlay--active");
  } else {
    searchOverlay.classList.add("o-page__main--blur");
    pageMain.classList.add("o-page__main--blur");
    overlay.classList.add("o-overlay--active");
  }
}

// make first letter uppercase ( use case unsupported css )
function capitalizeFirstLetter() {
  // js-carousel__post-title__text
  if (
    document
      .querySelector("body")
      .getElementsByClassName("js-carousel__post-title__text")[0]
  ) {
    const carouselTitle = document.querySelector(
      ".js-carousel__post-title__text"
    );

    carouselTitle.textContent =
      carouselTitle.textContent.charAt(0).toUpperCase() +
      carouselTitle.textContent.slice(1);
  }

  // js-carousel__post-title__text-mobile
  if (
    document
      .querySelector("body")
      .getElementsByClassName("js-carousel__post-title__text-mobile")[0]
  ) {
    const carouselTitle = document.querySelector(
      ".js-carousel__post-title__text-mobile"
    );

    carouselTitle.textContent =
      carouselTitle.textContent.charAt(0).toUpperCase() +
      carouselTitle.textContent.slice(1);
  }

  // c-post__entry-title__anchor
  if (
    document
      .querySelector("body")
      .getElementsByClassName("c-post__entry-title__anchor")[0]
  ) {
    const projectPostTitle = document.querySelector(
      ".c-post__entry-title__anchor"
    );

    projectPostTitle.textContent =
      projectPostTitle.textContent.charAt(0).toUpperCase() +
      projectPostTitle.textContent.slice(1);
  }
}
capitalizeFirstLetter();

// Main page Carousels
function mainPageCarousels() {
  // Carousel (Main)
  let carousel = document.querySelector(".js-carousel__context");
  let flCarouselMain = new Flickity(carousel, {
    setGallerySize: false,
    freeScroll: false,
    prevNextButtons: true,
    on: {
      ready: function () {
        const mainCarousel = document.querySelector(".js-carousel__context");
        mainCarousel.style.opacity = 1;
      },
    },
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
    on: {
      ready: function () {
        const postTitiles = document.querySelector(".c-carousel__post-titles");
        postTitiles.style.opacity = 1;
      },
    },
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
    on: {
      ready: function () {
        const postTitiles2 = document.querySelector(
          ".js-carousel__post-titles--mobile"
        );
        postTitiles2.style.opacity = 1;
      },
    },
  });
}

// Carousel - Single Page
function singleCarousel() {
  let carouselSingle = document.querySelector(".js-single__slider");

  let flCarouselSingle = new Flickity(carouselSingle, {
    freeScroll: isDesktop(),
    setGallerySize: false,
    imagesLoaded: true,
    cellAlign: "left",
    pageDots: !isDesktop(),
    prevNextButtons: false,
    on: {
      ready: function () {},
      change: function (index) {
        if (isDesktop() === true) {
          // make slider full width with first drag
          let singleCarousel = document.querySelector(".js-single__slider");
          singleCarousel.classList.add(
            "c-carousel__single__slider--full-width"
          );

          if (index === 0) {
            singleCarousel.classList.remove(
              "c-carousel__single__slider--full-width"
            );
          }
        }
      },
    },
  });
}

// if we have single carousel in page slider will render
if (
  document
    .querySelector(".o-page__main")
    .getElementsByClassName("c-carousel__single__slider")[0]
) {
  singleCarousel();
}

// if we have single carousel in page slider will render
function validate() {
  if (document.myForm.Name.value == "") {
    alert("Please provide your name!");
    document.myForm.Name.focus();
    return false;
  }

  if (document.myForm.EMail.value == "") {
    alert("Please provide your Email!");
    document.myForm.EMail.focus();
    return false;
  }

  if (
    document.myForm.Zip.value == "" ||
    isNaN(document.myForm.Zip.value) ||
    document.myForm.Zip.value.length != 5
  ) {
    alert("Please provide a zip in the format #####.");
    document.myForm.Zip.focus();
    return false;
  }

  if (document.myForm.Country.value == "-1") {
    alert("Please provide your country!");
    return false;
  }
  return true;
}
