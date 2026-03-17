import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { count: { type: Number, default: 0 } }
    static targets = ['output']

    connect() {
        this.outputTarget.textContent = this.countValue;
    }

    increment(event) {
        console.log(event, event.params.step)
        this.countValue++;
        this.outputTarget.textContent = this.countValue;
    }

    decrement() {
        this.countValue--;
        this.outputTarget.textContent = this.countValue;
    }
}
