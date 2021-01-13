/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  const siteNavigation = document.querySelector(".js-nav");

  // Return early if the navigation don't exist.
  if (!siteNavigation) {
    console.log("no navs");
    return;
  }

  const button = siteNavigation.getElementsByTagName("button")[0];

  // Return early if the button don't exist.
  if ("undefined" === typeof button) {
    console.log("no button");
    return;
  }

  const menu = siteNavigation.getElementsByTagName("ul")[0];
  let mainHeader = document.querySelector(".js-header");
  let menuLogo = document.querySelector(".js-logo");
  let menuNav = document.querySelector(".js-navigation");

  // Hide menu toggle button if menu is empty and return early.
  if ("undefined" === typeof menu) {
    button.style.display = "none";
    return;
  }

  if (!menu.classList.contains("s-nav")) {
    menu.classList.add("s-nav");
  }

  // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
  button.addEventListener("click", function () {
    siteNavigation.classList.toggle("toggled");
    siteNavigation.classList.toggle("is-open");
    menuLogo.classList.toggle("is-open");
    menuNav.classList.toggle("is-open");

    // Header Holder animation ( Animation out => decrease Width )
    if (!siteNavigation.classList.contains("is-open")) {
      siteNavigation.classList.add("has-animation-out");
    } else {
      siteNavigation.classList.remove("has-animation-out");
    }

    // Menu Logo animation
    if (menuLogo.classList.contains("is-open")) {
      menuLogo.classList.add("logo-out");
      menuNav.classList.add("nav-out");

      // fadeIn animation after toggled
      setTimeout(() => {
        menuNav.style.display = "nav-in";
        siteNavigation.classList.add("space-top");
        menuLogo.classList.add("logo-in");
        menuLogo.classList.remove("logo-out");
        menuNav.classList.add("nav-in");
        menuNav.classList.remove("nav-out");
      }, 700);
    } else {
      siteNavigation.classList.remove("space-top");

      menuLogo.classList.remove("logo-in");
      menuLogo.classList.add("logo-out");

      menuNav.classList.remove("nav-in");
    }

    if (button.getAttribute("aria-expanded") === "true") {
      button.setAttribute("aria-expanded", "false");
    } else {
      button.setAttribute("aria-expanded", "true");
    }
  });

  // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
  document.addEventListener("click", function (event) {
    const isClickInside = siteNavigation.contains(event.target);
    let pageMain = document.querySelector(".o-page__main");
    let overlay = document.querySelector(".js-overlay");
    const searchOverlay = document.querySelector(".js-search__overlay");

    if (!isClickInside) {
      if (
        document.querySelector("body").getElementsByClassName("o-overlay")[0]
      ) {
        overlay.classList.remove("o-overlay--active");
        searchOverlay.classList.remove("o-page__main--blur");
        pageMain.classList.remove("o-page__main--blur");
      }

      siteNavigation.classList.remove("toggled");
      button.setAttribute("aria-expanded", "false");

      if (siteNavigation.classList.contains("is-open")) {
        siteNavigation.classList.add("has-animation-out");
        siteNavigation.classList.remove("is-open");
        siteNavigation.classList.remove("space-top");

        menuLogo.classList.add("logo-out");
        menuLogo.classList.remove("logo-in");
        menuLogo.classList.remove("is-open");
        menuNav.classList.remove("is-open");
        menuNav.classList.remove("nav-in");
      }
    }
  });

  // Get all the link elements within the menu.
  const links = menu.getElementsByTagName("a");

  // Get all the link elements with children within the menu.
  const linksWithChildren = menu.querySelectorAll(
    ".menu-item-has-children > a, .page_item_has_children > a"
  );

  // Toggle focus each time a menu link is focused or blurred.
  for (const link of links) {
    link.addEventListener("focus", toggleFocus, true);
    link.addEventListener("blur", toggleFocus, true);
  }

  // Toggle focus each time a menu link with children receive a touch event.
  for (const link of linksWithChildren) {
    link.addEventListener("touchstart", toggleFocus, false);
  }

  /**
   * Sets or removes .focus class on an element.
   */
  function toggleFocus() {
    if (event.type === "focus" || event.type === "blur") {
      let self = this;
      // Move up through the ancestors of the current link until we hit .s-nav.
      while (!self.classList.contains("s-nav")) {
        // On li elements toggle the class .focus.
        if ("li" === self.tagName.toLowerCase()) {
          self.classList.toggle("focus");
        }
        self = self.parentNode;
      }
    }

    if (event.type === "touchstart") {
      const menuItem = this.parentNode;
      event.preventDefault();
      for (const link of menuItem.parentNode.children) {
        if (menuItem !== link) {
          link.classList.remove("focus");
        }
      }
      menuItem.classList.toggle("focus");
    }
  }
})();
