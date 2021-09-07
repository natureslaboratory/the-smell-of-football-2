class Counter
{
    node: HTMLElement;
    counterPlus: HTMLElement;
    counterMinus: HTMLElement;
    counterDisplay: HTMLElement;
    count = 0;
    /** Pass in c-purchase__counter
     * 
     */
    constructor(node: HTMLElement) {
        this.counterPlus = node.getElementsByClassName("c-purchase__counter-button--plus")[0] as HTMLElement;
        this.counterMinus = node.getElementsByClassName("c-purchase__counter-button--minus")[0] as HTMLElement;
        this.counterDisplay = node.getElementsByClassName("c-purchase__counter-count")[0] as HTMLElement;  

        this.addEventListeners(); 
    }

    addEventListeners()
    {
        this.counterPlus.addEventListener("click", () => {
            this.incrementCount();
        })

        this.counterMinus.addEventListener("click", () => {
            this.decrementCount();
        })
    }

    incrementCount()
    {
        this.count++;
        this.setDisplay(this.count);
    }

    decrementCount()
    {
        if (this.count > 0) {
            this.count--;
            this.setDisplay(this.count);
        }
    }

    setDisplay(value: number)
    {
        this.counterDisplay.innerHTML = value.toString();
    }
}

export default Counter;