import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['content', 'button'];

    toggle() {
        const hidden = this.contentTarget.hidden;
        this.contentTarget.hidden = !hidden;
        this.buttonTarget.textContent = hidden ? 'Masquer' : 'Voir';
    }
}
