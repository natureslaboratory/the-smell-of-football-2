import Counter from "./Counter";

export default class AddToBasket
{
    node: HTMLElement;
    counter: Counter;
    addButton: HTMLButtonElement;
    /**
     *
     */
    constructor(node: HTMLElement) {
        this.node = node;
        this.counter = new Counter(node.getElementsByClassName("c-purchase__counter")[0] as HTMLElement, node.getElementsByClassName("c-purchase__count-count-input")[0] as HTMLInputElement);
        this.addButton = node.getElementsByClassName("c-purchase__purchase-button")[0] as HTMLButtonElement;
        this.addEventListeners();
    }

    addEventListeners() {
        this.addButton.addEventListener("click", (e) => {
            // console.log(this.counter.count);
            // this.counter.resetCount();
        })
    }
}