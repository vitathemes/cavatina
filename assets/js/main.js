jQuery(function ($) {
    /*----------------------------------------*\
      #Carousel Keyboard Navigation (images)
    \*----------------------------------------*/
    let cavatina_flCarouselTextLength;
    if (cavatina_childFinder("body", "c-carousel__post-title")) {
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

    /*----------------------------------------*\
      #Carousel Keyboard Navigation (Texts)
    \*----------------------------------------*/
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
    /*------------------------------------*\
      #Last menu item trap focus
    \*------------------------------------*/
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
        const cavatina_loadMoreButton = $(".js-pagination__load-more__btn");
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
                    cavatina_loadMoreButton.text("Loading . . . ");
                },
                success: function (data) {
                    if (data) {
                        loadMore.prev().after(data);
                        cavatina_loadMoreButton.text("Load More");
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
    // End Load more handling
});
// End jquery

/*--------------------------------------*\
  #Detect Element inside other element
\*--------------------------------------*/
function cavatina_childFinder(parentElement, childElement) {
    let result = document.querySelector(parentElement).getElementsByClassName(childElement)[0]
        ? true
        : false;
    return result;
}

/*------------------------------------*\
  #Menu items trap focus
\*------------------------------------*/
if (cavatina_childFinder("body", "s-nav")) {
    var cavatina_menuToggle = document.querySelector(".js-menu");
    var cavatina_headerMain = document.querySelector(".js-header__main");
    var cavatina_menu = document.querySelector(".s-nav");
    var cavatina_menuListItems = cavatina_menu.querySelectorAll("li");
    var cavatina_menuLinks = cavatina_menu.getElementsByTagName("a");
    var cavatina_lastIndex = cavatina_menuListItems.length - 1;
    var cavatina_isBackward;

    cavatina_menuListItems[cavatina_lastIndex].focus();

    document.addEventListener("keydown", function (e) {
        if (e.shiftKey && e.keyCode == 9) {
            cavatina_isBackward = true;
            console.log("true");
        } else {
            cavatina_isBackward = false;
            console.log("false");
        }
    });

    cavatina_menuToggle.addEventListener("blur", function (e) {
        if (cavatina_headerMain.classList.contains("is-open")) {
            if (cavatina_isBackward) {
                cavatina_menuLinks[cavatina_lastIndex].focus();
            }
        }
    });
}

/*------------------------------------*\
  #preloader fadeout
\*------------------------------------*/
const cavatina_preloader = document.querySelector(".o-preloader");
function cavatina_fadeEffect() {
    setTimeout(function () {
        setInterval(function () {
            if (!cavatina_preloader.style.opacity) {
                cavatina_preloader.style.opacity = 1;
            }
            if (cavatina_preloader.style.opacity > 0) {
                cavatina_preloader.style.opacity -= 0.1;
            } else {
                if (!cavatina_preloader.style.opacity === 0) {
                    clearInterval(cavatina_fadeEffect);
                } else {
                    cavatina_preloader.style.display = "none";
                }
            }
        }, 10);
    }, 1000);
}
window.addEventListener("load", cavatina_fadeEffect());

/*------------------------------------*\
  #Check device is mobile or not
\*------------------------------------*/
function cavatina_isDesktop() {
    if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    ) {
        return false;
    } else {
        return true;
    }
}

/*------------------------------------*\
  #Fade Out Vanilla JS
\*------------------------------------*/
function cavatina_fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= 0.1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

/*------------------------------------*\
  # Fade In Vanilla JS
\*------------------------------------*/
function cavatina_fadeIn(el, display) {
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

/*--------------------------------------*\
  #Search Box Desktop
\*--------------------------------------*/
let cavatina_isToggled = false;
function cavatina_searchToggleHeader() {
    const headerSearch = document.querySelector(".js-header__search");
    const searchOverlay = document.querySelector(".js-search__overlay");
    const searchForm = document.querySelector(".search-field");
    if (cavatina_childFinder("body", "o-overlay")) {
        headerSearch.addEventListener("click", function () {
            // Fade in/out the search overlay
            if (cavatina_isToggled === true) {
                cavatina_fadeOut(searchOverlay);
                headerSearch.classList.remove("c-header__search--toggle");
                cavatina_isToggled = false;
            } else {
                cavatina_fadeIn(searchOverlay, "flex");
                headerSearch.classList.add("c-header__search--toggle");
                /* Trap Focus On element Blur */
                const searchbtn = document.querySelector(".search-submit");
                searchbtn.addEventListener("blur", function () {
                    if (cavatina_IsBackward === false) {
                        headerSearch.focus();
                    }
                });
                /* Trap Focus on Element Blur */
                headerSearch.addEventListener("blur", function () {
                    if (cavatina_IsBackward === true) {
                        searchbtn.focus();
                    }
                    if (cavatina_IsBackward === false) {
                        searchForm.focus();
                    }
                });
                searchForm.addEventListener("blur", function () {
                    if (cavatina_IsBackward === true) {
                        headerSearch.focus();
                    }
                });
                cavatina_isToggled = true;
            }
        });
    }
}
cavatina_searchToggleHeader();

/*--------------------------------------*\
  #Search Box mobile
\*--------------------------------------*/
function cavatina_searchToggleMobile() {
    const oPageMain = document.querySelector(".js-page");
    const searchIcon = document.querySelector(".js-search__icon");
    const searchBlock = document.querySelector(".js-search__form");
    const searchinput = document.querySelector(
        ".c-search__holder > .c-search__form > label > .search-field"
    );
    const searchinputButton = document.querySelector(
        ".c-search__holder > .c-search__form > .search-submit-mobile"
    );

    let pageMainContain = oPageMain.contains(searchIcon);

    if (pageMainContain === true) {
        searchIcon.addEventListener("click", function () {
            searchIcon.classList.toggle("c-search__icon--toggled");
            searchBlock.classList.toggle("c-search__form--toggled");

            if (searchIcon.classList.contains("c-search__icon--toggled")) {
                searchIcon.addEventListener("blur", function () {
                    if (cavatina_isBackward === true) {
                        searchinput.focus();
                    }
                });

                searchinputButton.addEventListener("blur", function () {
                    if (cavatina_isBackward === false) {
                        searchIcon.focus();
                    }
                });
            }
        });
    }
}
cavatina_searchToggleMobile();

/*-------------------------------------------*\
  #o-page toggle for add blur effect content
\*-------------------------------------------*/
function cavatina_blurToggle() {
    const pageMain = document.querySelector(".js-page__main");
    const overlay = document.querySelector(".js-overlay");
    const searchOverlay = document.querySelector(".js-search__overlay");

    if (cavatina_childFinder("body", "c-aside")) {
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

/*---------------------------------------------------------*\
  #Make first letter uppercase ( use case unsupported css )
\*---------------------------------------------------------*/
function cavatina_capitalizeFirstLetter() {
    // js-carousel__post-title__text
    if (cavatina_childFinder("body", "js-carousel__post-title__text")) {
        const carouselTitle = document.querySelector(".js-carousel__post-title__text");

        carouselTitle.textContent =
            carouselTitle.textContent.charAt(0).toUpperCase() + carouselTitle.textContent.slice(1);
    }

    // js-carousel__post-title__text-mobile
    if (cavatina_childFinder("body", "js-carousel__post-title__text-mobile")) {
        const carouselTitle = document.querySelector(".js-carousel__post-title__text-mobile");

        carouselTitle.textContent =
            carouselTitle.textContent.charAt(0).toUpperCase() + carouselTitle.textContent.slice(1);
    }

    // c-post__entry-title__anchor
    if (cavatina_childFinder("body", "c-post__entry-title__anchor")) {
        const projectPostTitle = document.querySelector(".c-post__entry-title__anchor");

        projectPostTitle.textContent =
            projectPostTitle.textContent.charAt(0).toUpperCase() +
            projectPostTitle.textContent.slice(1);
    }
}
cavatina_capitalizeFirstLetter();

/*--------------------------------------*\
  #cavatina carousels
\*--------------------------------------*/
let cavatina_currentSlide = 0;
let cavatina_flCarouselMain = {};
let cavatina_flCarouselText = {};
// Main page Carousels
if (cavatina_childFinder("body", "js-carousel__context")) {
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

    // Carousel (Home) - text
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
    let carouselTextMobile = document.querySelector(".js-carousel__post-titles--mobile");

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
                const postTitiles2 = document.querySelector(".js-carousel__post-titles--mobile");
                postTitiles2.style.opacity = 1;
            },
        },
    });
}

/*--------------------------------------*\
  #Carousel - Single Page
\*--------------------------------------*/
if (cavatina_childFinder("body", "js-single__slider")) {
    let carouselSingle = document.querySelector(".js-single__slider");

    let flCarouselSingle = new Flickity(carouselSingle, {
        freeScroll: cavatina_isDesktop(),
        setGallerySize: false,
        imagesLoaded: true,
        cellAlign: "left",
        pageDots: !cavatina_isDesktop(),
        prevNextButtons: false,
        lazyLoad: true,
        on: {
            change: function (index) {
                if (cavatina_isDesktop() === true) {
                    // make slider full width with first drag
                    let singleCarousel = document.querySelector(".js-single__slider");
                    singleCarousel.classList.add("c-carousel__single__slider--full-width");

                    if (index === 0) {
                        singleCarousel.classList.remove("c-carousel__single__slider--full-width");
                    }
                }
            },
        },
    });
}

/*--------------------------------------*\
  #Remove (at) from comment
\*--------------------------------------*/
if (cavatina_childFinder("body", "comments-area")) {
    const cavatina_commentContainer = document.querySelector(".comments-area");
    let timeElement, timeElementCounter;
    timeElement = cavatina_commentContainer.querySelectorAll("time");
    for (timeElementCounter = 0; timeElementCounter < timeElement.length; timeElementCounter++) {
        let childHtml = timeElement[timeElementCounter].innerHTML;
        let result = childHtml.replace("at", "");
        timeElement[timeElementCounter].textContent = result;
    }
}

/*--------------------------------------*\
  #lazy load images
\*--------------------------------------*/
var cavatina_lazyLoadInstance = new LazyLoad({
    elements_selector: [".c-carousel__image", ".c-post__thumbnail__image"],
});

/*--------------------------------------*\
  #Detect keyboard navigation action
\*--------------------------------------*/
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

/*--------------------------------------*\
  #truncate long text
\*--------------------------------------*/
if (cavatina_childFinder("body", "c-post__entry-title__anchor")) {
    const cavatina_postTitles = document.querySelectorAll(".c-post__entry-title__anchor");

    document.querySelectorAll(".c-post__entry-title__anchor").forEach(function (postLink) {
        if (postLink.textContent.length > 82) {
            let currentPostLink = postLink.textContent;
            currentPostLink = currentPostLink.substr(0, 80) + "...";
            postLink.textContent = currentPostLink;
        }
    });
}

/*--------------------------------------*\
  #Handle logo animation 
\*--------------------------------------*/
