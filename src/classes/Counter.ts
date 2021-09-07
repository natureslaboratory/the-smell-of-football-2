class Counter
{
    private node: HTMLElement;
    private counterPlus: HTMLElement;
    private counterMinus: HTMLElement;
    private counterDisplay: HTMLElement;
    public count = 0;


    /** Pass in c-purchase__counter
     * 
     */
    constructor(node: HTMLElement) {
        this.counterPlus = node.getElementsByClassName("c-purchase__counter-button--plus")[0] as HTMLElement;
        this.counterMinus = node.getElementsByClassName("c-purchase__counter-button--minus")[0] as HTMLElement;
        this.counterDisplay = node.getElementsByClassName("c-purchase__counter-count")[0] as HTMLElement;  

        this.addEventListeners(); 
    }

    private addEventListeners()
    {
        this.counterPlus.addEventListener("click", () => {
            this.incrementCount();
        })

        this.counterMinus.addEventListener("click", () => {
            this.decrementCount();
        })
    }

    private incrementCount()
    {
        this.count++;
        this.setDisplay(this.count);
    }

    private decrementCount()
    {
        if (this.count > 0) {
            this.count--;
            this.setDisplay(this.count);
        }
    }

    private setDisplay(value: number)
    {
        this.counterDisplay.innerHTML = value.toString();
    }

    public resetCount()
    {
        this.count = 0;
        this.setDisplay(0);
    }
}

export default Counter;