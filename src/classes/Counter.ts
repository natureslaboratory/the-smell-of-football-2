class Counter
{
    private node: HTMLElement;
    private counterPlus: HTMLElement;
    private counterMinus: HTMLElement;
    private counterDisplay: HTMLElement;
    private hiddenInput: HTMLInputElement;
    private minimumCount: number;
    private maximumCount: number;
    public count = 0;


    /** Pass in c-purchase__counter
     * 
     */
    constructor(node: HTMLElement, hiddenInput: HTMLInputElement = null, minimumCount = 0, maximumCount = 1000) {
        this.counterPlus = node.getElementsByClassName("c-purchase__counter-button--plus")[0] as HTMLElement;
        this.counterMinus = node.getElementsByClassName("c-purchase__counter-button--minus")[0] as HTMLElement;
        this.counterDisplay = node.getElementsByClassName("c-purchase__counter-count")[0] as HTMLElement;  
        this.minimumCount = minimumCount;
        this.count = minimumCount;
        this.maximumCount = maximumCount;

        if (hiddenInput) {
            this.hiddenInput = hiddenInput;
        }

        this.setDisplay(this.minimumCount);

        this.addEventListeners(); 
    }

    private addEventListeners()
    {
        this.counterPlus.addEventListener("click", (e) => {
            e.preventDefault();
            this.incrementCount();
        })

        this.counterMinus.addEventListener("click", (e) => {
            e.preventDefault();
            this.decrementCount();
        })
    }

    private incrementCount()
    {
        if (this.count < this.maximumCount) {
            this.count++;
            this.setDisplay(this.count);
        }
    }

    private decrementCount()
    {
        if (this.count > 0 && this.count > this.minimumCount ) {
            this.count--;
            this.setDisplay(this.count);
        }
    }

    private setDisplay(value: number)
    {
        this.counterDisplay.innerHTML = value.toString();
        if (this.hiddenInput) {
            this.hiddenInput.setAttribute("value", value.toString());
            this.hiddenInput.value = value.toString();
        }
    }

    public resetCount()
    {
        this.count = 0;
        this.setDisplay(0);
    }
}

export default Counter;