(function () {
    'use strict';

    var Counter = /** @class */ (function () {
        /** Pass in c-purchase__counter
         *
         */
        function Counter(node, hiddenInput) {
            if (hiddenInput === void 0) { hiddenInput = null; }
            this.count = 0;
            this.counterPlus = node.getElementsByClassName("c-purchase__counter-button--plus")[0];
            this.counterMinus = node.getElementsByClassName("c-purchase__counter-button--minus")[0];
            this.counterDisplay = node.getElementsByClassName("c-purchase__counter-count")[0];
            if (hiddenInput) {
                this.hiddenInput = hiddenInput;
            }
            this.addEventListeners();
        }
        Counter.prototype.addEventListeners = function () {
            var _this = this;
            this.counterPlus.addEventListener("click", function (e) {
                e.preventDefault();
                _this.incrementCount();
            });
            this.counterMinus.addEventListener("click", function (e) {
                e.preventDefault();
                _this.decrementCount();
            });
        };
        Counter.prototype.incrementCount = function () {
            this.count++;
            this.setDisplay(this.count);
        };
        Counter.prototype.decrementCount = function () {
            if (this.count > 0) {
                this.count--;
                this.setDisplay(this.count);
            }
        };
        Counter.prototype.setDisplay = function (value) {
            this.counterDisplay.innerHTML = value.toString();
            if (this.hiddenInput) {
                console.log("Change!", value);
                console.log(this.hiddenInput);
                this.hiddenInput.setAttribute("value", value.toString());
                this.hiddenInput.value = value.toString();
            }
        };
        Counter.prototype.resetCount = function () {
            this.count = 0;
            this.setDisplay(0);
        };
        return Counter;
    }());

    var AddToBasket = /** @class */ (function () {
        /**
         *
         */
        function AddToBasket(node) {
            this.node = node;
            this.counter = new Counter(node.getElementsByClassName("c-purchase__counter")[0], node.getElementsByClassName("c-purchase__count-count-input")[0]);
            this.addButton = node.getElementsByClassName("c-purchase__purchase-button")[0];
            this.addEventListeners();
        }
        AddToBasket.prototype.addEventListeners = function () {
            this.addButton.addEventListener("click", function (e) {
                // console.log(this.counter.count);
                // this.counter.resetCount();
            });
        };
        return AddToBasket;
    }());

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
    var addToBaskets = Array.from(document.getElementsByClassName("c-purchase"));
    addToBaskets.forEach(function (a) {
        new AddToBasket(a);
    });

}());
