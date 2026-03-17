import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['output']
    interval;

    connect() {
        this.outputTarget.textContent = new Date().toLocaleTimeString();
        this.interval = setInterval(() => {
            this.outputTarget.textContent = new Date().toLocaleTimeString();
            console.log('CALL AJAX SUR LE SERVEUR');
        }, 1000);
    }

    disconnect() {
        clearInterval(this.interval);
    }

    destroy() {
        this.element.remove();
    }
}
