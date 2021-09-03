(function () {
    'use strict';

    var hamburgerContainer = document.getElementById("hamburger-container");
    var hamburgerButton = document.getElementById("hamburger-button");
    var hamburgerMenu = document.getElementById("hamburger-menu");
    function hasAncestor(current, parent) {
        if (current.parentElement.localName == "body" || current.localName == "body") {
            return false;
        }
        if (current.parentElement == parent) {
            return true;
        }
        else {
            return hasAncestor(current.parentElement, parent);
        }
    }
    if (hamburgerButton && hamburgerMenu) {
        hamburgerButton.addEventListener("click", function () {
            if (hamburgerMenu.classList.contains("show")) {
                hamburgerMenu.classList.remove("show");
            }
            else {
                var hamburgerContainerRect = hamburgerButton.getBoundingClientRect();
                hamburgerMenu.classList.add("show");
                hamburgerMenu.style.top = hamburgerContainerRect.bottom + "px";
                hamburgerMenu.style.right = "0px";
            }
        });
        document.addEventListener("click", function (e) {
            if (!hasAncestor(e.target, hamburgerContainer)) {
                hamburgerMenu.classList.remove("show");
            }
        });
    }

}());
