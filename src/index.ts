import AddToBasket from "./classes/AddToBasket";
import Counter from "./classes/Counter";

const hamburgerContainer = document.getElementById("hamburger-container");
const hamburgerButton = document.getElementById("hamburger-button");
const hamburgerMenu = document.getElementById("hamburger-menu");
const hamburgerClose = document.getElementById("hamburger-close");

function hasAncestor(current: HTMLElement, parent: HTMLElement) {
    if (current.parentElement.localName == "body" || current.localName == "body") {
        return false;
    }

    if (current.parentElement == parent) {
        return true;
    } else {
        return hasAncestor(current.parentElement, parent);
    }
}

function openHamburger() {
    if (window.innerWidth > 600) {
        hamburgerMenu.style.right = "0px";
        hamburgerMenu.style.top = "36px";
    }
    hamburgerMenu.classList.add("show");
}

function closeHamburger() {
    hamburgerMenu.classList.remove("show");
    hamburgerMenu.style.right = "unset";
    hamburgerMenu.style.top = "0px";
}

if (hamburgerButton && hamburgerMenu) {

    
    hamburgerButton.addEventListener("click", () => {
        if (hamburgerMenu.classList.contains("show")) {
            closeHamburger()
        } else {
            openHamburger()
        }
    })

    hamburgerClose.addEventListener("click", closeHamburger);

    document.addEventListener("click", (e: PointerEvent) => {
        if (!hasAncestor(e.target as HTMLElement, hamburgerContainer)) {
            closeHamburger();
        }
    })
}


const addToBaskets = Array.from(document.getElementsByClassName("c-purchase") as HTMLCollectionOf<HTMLElement>);


addToBaskets.forEach(a => {
    new AddToBasket(a);
})
