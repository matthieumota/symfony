import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { max: { type: Number, default: 200 } };
    static targets = ['counter'];

    connect() {
        this.counterTarget.textContent = this.maxValue;
    }

    update(event) {
        const remaining = this.maxValue - event.target.value.length;
        this.counterTarget.textContent = remaining;
        this.counterTarget.classList.toggle('text-red-500', remaining < 20);
    }
}
