jQuery(function ($) {
  /* Carousel Keyboard Navigation for images */
  let cavatina_flCarouselTextLength;
  if (childFinder("body", "c-carousel__post-title")) {
    cavatina_flCarouselTextLength = cavatina_flCarouselText.slides.length - 1;
  }

  $(".c-carousel__cell > a:first").on("focusin", function (e) {
    cavatina_flCarouselMain.select(0);
  });

  $(".c-carousel__cell > a").on("keydown blur", function (e) {
    if (e.shiftKey && e.keyCode === 9) {
      cavatina_flCarouselText.previous();
    } else if (e.keyCode === 9) {
      cavatina_flCarouselText.next();
    }
  });

  /* Carousel Keyboard Navigation for Texts */
  $(".c-carousel__post-title:last-child").on("focusin", function (e) {
    cavatina_flCarouselMain.select(cavatina_flCarouselTextLength);
  });

  $(".c-carousel__post-title").on("keydown blur", function (e) {
    if (e.shiftKey && e.keyCode === 9) {
      cavatina_flCarouselText.previous();
    } else if (e.keyCode === 9) {
      cavatina_flCarouselText.next();
    }
  });

  /* Last menu item trap focus */
  $(".s-nav li:last-child").focusout(function () {
    if (cavatina_IsBackward === true) {
    } else if (cavatina_IsBackward === false) {
      $(".js-menu").focus();
    }
  });

  /*------------------------------------*\
    #Handle Load More button
  \*------------------------------------*/
  $(document).ready(function () {
    const button = $(".js-pagination__load-more__btn");
    $(".js-pagination__load-more").click(function () {
      setTimeout(function () {
        cavatina_lazyLoadInstance.update();
      }, 1000);

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
  // End Loadmore handling
});
// End jquery

var cavatina_menuToggle = document.querySelector(".js-menu");
var cavatina_menu = document.querySelector(".s-nav");
var cavatina_menuListItems = cavatina_menu.querySelectorAll("li");
var cavatina_menuLinks = cavatina_menu.getElementsByTagName("a");
var cavatina_lastIndex = cavatina_menuListItems.length - 1;
cavatina_menuListItems[cavatina_lastIndex].focus();

document.addEventListener("keydown", function (e) {
  if (e.shiftKey && e.keyCode == 9) {
    cavatina_isBackward = true;
  } else {
    cavatina_isBackward = false;
  }
});
cavatina_menuToggle.addEventListener("blur", function (e) {
  if (cavatina_isBackward) {
    cavatina_menuLinks[cavatina_lastIndex].focus();
  }
});

//preloader fadeout
const cavatina_preloader = document.querySelector(".o-preloader");

function fadeEffect() {
  setTimeout(function () {
    setInterval(function () {
      if (!cavatina_preloader.style.opacity) {
        cavatina_preloader.style.opacity = 1;
      }
      if (cavatina_preloader.style.opacity > 0) {
        cavatina_preloader.style.opacity -= 0.1;
      } else {
        if (!cavatina_preloader.style.opacity === 0) {
          clearInterval(fadeEffect);
        } else {
          cavatina_preloader.style.display = "none";
        }
      }
    }, 10);
  }, 1000);
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
let cavatina_isToggled = false;
function searchToggleHeader() {
  const headerSearch = document.querySelector(".js-header__search");
  const searchOverlay = document.querySelector(".js-search__overlay");

  if (childFinder("body", "o-overlay")) {
    headerSearch.addEventListener("click", function () {
      // Fade in/out the search overlay
      if (cavatina_isToggled === true) {
        fadeOut(searchOverlay);
        headerSearch.classList.remove("c-header__search--toggle");

        cavatina_isToggled = false;
      } else {
        fadeIn(searchOverlay, "flex");
        headerSearch.classList.add("c-header__search--toggle");

        /* Trap focus on element blur */
        const searchbtn = document.querySelector(".search-submit");
        searchbtn.addEventListener("blur", function () {
          if (cavatina_IsBackward === false) {
            headerSearch.focus();
          }
        });

        headerSearch.addEventListener("blur", function () {
          if (cavatina_IsBackward === true) {
            searchbtn.focus();
          }
        });

        cavatina_isToggled = true;
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
  const pageMain = document.querySelector(".js-page__main");
  const overlay = document.querySelector(".js-overlay");
  const searchOverlay = document.querySelector(".js-search__overlay");

  if (childFinder("body", "c-aside")) {
    let aside = document.querySelector(".js-aside");
    if (pageMain.classList.contains("o-page__main--blur")) {
      aside.classList.remove("c-aside--blur");
    } else {
      aside.classList.add("c-aside--blur");
    }
  }

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

let cavatina_currentSlide = 0;
let cavatina_flCarouselMain = {};
let cavatina_flCarouselText = {};
// Main page Carousels
if (childFinder("body", "js-carousel__context")) {
  // Carousel (Home)
  let carousel = document.querySelector(".js-carousel__context");
  cavatina_flCarouselMain = new Flickity(carousel, {
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

  // Carousel (Home Page) - text
  let carouselImage = document.querySelector(".js-carousel__post-titles");

  cavatina_flCarouselText = new Flickity(carouselImage, {
    setGallerySize: true,
    freeScroll: false,
    prevNextButtons: false,
    pageDots: false,
    sync: ".c-carousel__context",
    draggable: true,
    selectedAttraction: 0.2,
    friction: 0.8,
    on: {
      change: function (index) {
        cavatina_currentSlide = index;
      },
      ready: function () {
        const postTitiles = document.querySelector(".c-carousel__post-titles");
        postTitiles.style.opacity = 1;
      },
    },
  });

  // Carousel (Home Page) - text Mobile
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

// lazy load image
var cavatina_lazyLoadInstance = new LazyLoad({
  elements_selector: [".c-carousel__image", ".c-post__thumbnail__image"],
});

let cavatina_IsBackward;
document.addEventListener("keydown", function (e) {
  if (e.shiftKey && e.keyCode == 9) {
    // Shift + tab
    cavatina_IsBackward = true;
  } else {
    // Tab
    cavatina_IsBackward = false;
  }
});

// truncate long text
if (childFinder("body", "c-post__entry-title__anchor")) {
  const postTitles = document.querySelectorAll(".c-post__entry-title__anchor");

  document
    .querySelectorAll(".c-post__entry-title__anchor")
    .forEach(function (postLink) {
      if (postLink.textContent.length > 82) {
        // box.addEventListener("click", () => box.classList.toggle("red"));
        let currentPostLink = postLink.textContent;
        currentPostLink = currentPostLink.substr(0, 80) + "...";
        postLink.textContent = currentPostLink;
      }
    });
}
