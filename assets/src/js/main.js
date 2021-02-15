jQuery(function ($) {
  /*------------------------------------*\
      #Handle Load More button
  \*------------------------------------*/
  $(document).ready(function () {
    const button = $(".js-pagination__load-more__btn");
    $(".js-pagination__load-more").click(function () {
      var loadMore = $(this),
        data = {
          action: "loadmore",
          query: loadmore_params.posts,
          page: loadmore_params.current_page,
        };
      $.ajax({
        url: loadmore_params.ajaxurl,
        data: data,
        type: "POST",
        beforeSend: function (xhr) {
          button.text("Loading . . . ");
        },
        success: function (data) {
          if (data) {
            loadMore.prev().after(data);
            button.text("Load More");

            loadmore_params.current_page++;

            if (loadmore_params.current_page == loadmore_params.max_page)
              loadMore.remove();
          } else {
            loadMore.remove();
          }
        },
      });
    });
  });
});

//preloader fadeout
const preloader = document.querySelector(".o-preloader");
function fadeEffect() {
  setInterval(function () {
    if (!preloader.style.opacity) {
      preloader.style.opacity = 1;
    }
    if (preloader.style.opacity > 0) {
      preloader.style.opacity -= 0.1;
    } else {
      if (!preloader.style.opacity === 0) {
        clearInterval(fadeEffect);
      } else {
        preloader.style.display = "none";
      }
    }
  }, 30);
}
window.addEventListener("load", fadeEffect());

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

// Detect Element inside other element
function childFinder(parentElement, childElement) {
  let result = document
    .querySelector(parentElement)
    .getElementsByClassName(childElement)[0]
    ? true
    : false;
  return result;
}

// Search Box Desktop
let isToggled = false;
function searchToggleHeader() {
  const header = document.querySelector(".js-header");
  const headerSearch = document.querySelector(".js-header__search");

  const searchOverlay = document.querySelector(".js-search__overlay");

  if (childFinder("body", "o-overlay")) {
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

  if (childFinder("body", "c-aside")) {
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
  if (childFinder("body", "js-carousel__post-title__text")) {
    const carouselTitle = document.querySelector(
      ".js-carousel__post-title__text"
    );

    carouselTitle.textContent =
      carouselTitle.textContent.charAt(0).toUpperCase() +
      carouselTitle.textContent.slice(1);
  }

  // js-carousel__post-title__text-mobile
  if (childFinder("body", "js-carousel__post-title__text-mobile")) {
    const carouselTitle = document.querySelector(
      ".js-carousel__post-title__text-mobile"
    );

    carouselTitle.textContent =
      carouselTitle.textContent.charAt(0).toUpperCase() +
      carouselTitle.textContent.slice(1);
  }

  // c-post__entry-title__anchor
  if (childFinder("body", "c-post__entry-title__anchor")) {
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
if (childFinder("body", "js-carousel__context")) {
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
if (childFinder("body", "js-single__slider")) {
  let carouselSingle = document.querySelector(".js-single__slider");

  let flCarouselSingle = new Flickity(carouselSingle, {
    freeScroll: isDesktop(),
    setGallerySize: false,
    imagesLoaded: true,
    cellAlign: "left",
    pageDots: !isDesktop(),
    prevNextButtons: false,
    lazyLoad: true,
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

// Remove at from comment
if (childFinder("body", "comments-area")) {
  const testContainer = document.querySelector(".comments-area");
  let timeElement, timeElementCounter;
  timeElement = testContainer.querySelectorAll("time");
  for (
    timeElementCounter = 0;
    timeElementCounter < timeElement.length;
    timeElementCounter++
  ) {
    let childHtml = timeElement[timeElementCounter].innerHTML;
    let result = childHtml.replace("at", "");
    timeElement[timeElementCounter].textContent = result;
  }
}
