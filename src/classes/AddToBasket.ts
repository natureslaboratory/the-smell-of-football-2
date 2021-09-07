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
        this.counter = new Counter(node.getElementsByClassName("c-purchase__counter")[0] as HTMLElement);
        this.addButton = node.getElementsByClassName("c-purchase__purchase-button")[0] as HTMLButtonElement;
        this.addEventListeners();
    }

    addEventListeners() {
        this.addButton.addEventListener("click", () => {
            console.log(this.counter.count);
            this.counter.resetCount();
        })
    }
}