import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['source', 'button'];

    copy() {
        navigator.clipboard.writeText(this.sourceTarget.textContent);
        const original = this.buttonTarget.textContent;
        this.buttonTarget.textContent = 'Copié !';
        setTimeout(() => {
            this.buttonTarget.textContent = original;
        }, 2000);
    }
}
