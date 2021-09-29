/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
    /*------------------------------------------------*\
      #Detect Screen size 
    \*------------------------------------------------*/
    let cavatina_clientWindowSize = window.matchMedia("(max-width: 979px)");
    function cavatina_isMobile(cavatina_clientWindowSize) {
        if (cavatina_clientWindowSize.matches) {
            // If media query matches
            return true;
        } else {
            return false;
        }
    }

    cavatina_isMobile(cavatina_clientWindowSize); // Call listener function at run time
    cavatina_clientWindowSize.addListener(cavatina_isMobile); // Attach listener function on state changes

    const siteNavigation = document.getElementById("site-navigation");

    // Return early if the navigation don't exist.
    if (!siteNavigation) {
        console.log("no navs");
        return;
    }

    const button = siteNavigation.querySelector(".js-menu");
    // Return early if the button don't exist.
    if ("undefined" === typeof button) {
        console.log("no button");
        return;
    }

    const menu = siteNavigation.getElementsByTagName("ul")[0];

    // Hide menu toggle button if menu is empty and return early.
    if ("undefined" === typeof menu) {
        button.style.display = "none";
        return;
    }

    if (!menu.classList.contains("s-nav")) {
        menu.classList.add("s-nav");
    }

    /*------------------------------------------------*\
      #Mobile menu height max-content
    \*------------------------------------------------*/

    // Menu header animation (Based on max-content)
    let cavatina_isCollapsed = false;
    function cavatina_slidetoggle() {
        const headerMain = document.querySelector(".js-header__main");
        let scrollerHeight = headerMain.scrollHeight;

        cavatina_isCollapsed = !cavatina_isCollapsed;
        const noHeightSet = !headerMain.style.height;

        headerMain.style.height =
            (cavatina_isCollapsed || noHeightSet ? 0 : scrollerHeight) + "px";

        if (noHeightSet) return cavatina_slidetoggle.call(this);
    }

    /*------------------------------------------------*\
      #Desktop menu width max-content
    \*------------------------------------------------*/
    let cavatina_isMenuCollapsed = false;
    function cavatina_DesktopWidthToggle() {
        const menuElement = document.querySelector(".js-header__main");
        let scrollerWidth = menuElement.scrollWidth * 2;

        cavatina_isMenuCollapsed = !cavatina_isMenuCollapsed;
        const noWidthSet = !menuElement.style.width;

        menuElement.style.width =
            (cavatina_isMenuCollapsed || noWidthSet ? 107 : scrollerWidth) + "px";

        if (noWidthSet) return cavatina_DesktopWidthToggle.call(this);
    }

    /*------------------------------------------------*\
      #Toggle the .toggled class and the aria-expanded 
       value each time the button is clicked.
    \*------------------------------------------------*/
    const menuLogo = document.querySelector(".js-logo");
    const navMenu = document.querySelector(".js-navigation");

    button.addEventListener("click", function () {
        if (!cavatina_isMobile(cavatina_clientWindowSize)) {
            if (!menuLogo.classList.contains("is-hide")) {
                menuLogo.classList.add("is-hide");
            }
        }

        setTimeout(() => {
            navMenu.classList.toggle("is-open");
        }, 800);

        if (!cavatina_isMobile(cavatina_clientWindowSize)) {
            if (menuLogo.classList.contains("has-animation")) {
                console.log(menuLogo.classList.contains("has-animation"));
                menuLogo.classList.remove("has-animation");
                menuLogo.classList.add("has-animation-out");

                setTimeout(() => {
                    menuLogo.classList.remove("has-animation-out");
                }, 500);
            }

            setTimeout(() => {
                if (menuLogo.classList.contains("is-hide")) {
                    menuLogo.classList.remove("is-hide");
                    menuLogo.classList.add("has-animation");
                }
            }, 500);
        }

        siteNavigation.classList.toggle("is-open");

        if (cavatina_isMobile(cavatina_clientWindowSize)) {
            cavatina_slidetoggle();
        } else {
            cavatina_DesktopWidthToggle();
        }

        // Header Holder animation ( Animation out => decrease Width )
        if (!siteNavigation.classList.contains("is-open")) {
            siteNavigation.classList.add("has-animation-out");
        } else {
            siteNavigation.classList.remove("has-animation-out");
        }

        if (button.getAttribute("aria-expanded") === "true") {
            button.setAttribute("aria-expanded", "false");
        } else {
            button.setAttribute("aria-expanded", "true");
        }
    });

    /*-------------------------------------------*\
      #Focus handler 
    \*-------------------------------------------*/

    // Get all the link elements within the menu.
    const links = menu.getElementsByTagName("a");

    // Toggle focus each time a menu link is focused or blurred.
    for (const link of links) {
        link.addEventListener("focus", toggleFocus, true);
        link.addEventListener("blur", toggleFocus, true);
    }

    // Toggle focus each time a menu link with children receive a touch event.
    // for (const link of linksWithChildren) {
    //     link.addEventListener("touchstart", toggleFocus, false);
    // }

    /*-------------------------------------------*\
      #Sets or removes .focus class on an element.
    \*-------------------------------------------*/
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
