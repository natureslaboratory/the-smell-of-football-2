import AddToBasket from "./classes/AddToBasket";
import Counter from "./classes/Counter";

const hamburgerContainer = document.getElementById("hamburger-container");
const hamburgerButton = document.getElementById("hamburger-button");
const hamburgerMenu = document.getElementById("hamburger-menu");

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

if (hamburgerButton && hamburgerMenu) {
    hamburgerButton.addEventListener("click", () => {
        if (hamburgerMenu.classList.contains("show")) {
            hamburgerMenu.classList.remove("show");
        } else {
            const hamburgerContainerRect = hamburgerButton.getBoundingClientRect();
            hamburgerMenu.classList.add("show");
            hamburgerMenu.style.top = `${hamburgerContainerRect.bottom}px`;
            hamburgerMenu.style.right = `0px`;
        }
    })

    document.addEventListener("click", (e: PointerEvent) => {
        if (!hasAncestor(e.target as HTMLElement, hamburgerContainer)) {
            hamburgerMenu.classList.remove("show");
        }
    })
}


const addToBaskets = Array.from(document.getElementsByClassName("c-purchase") as HTMLCollectionOf<HTMLElement>);


addToBaskets.forEach(a => {
    new AddToBasket(a);
})
