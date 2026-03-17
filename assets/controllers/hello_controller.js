import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ['output', 'username', 'list']
    static values = { username: String, default: 'Guest' }
    static classes = ['little', 'big', 'equal']

    connect() {
        const size = Math.random();
        this.element.classList.add(size.toFixed(1) < 0.5 ? this.littleClass : size.toFixed(1) > 0.5 ? this.bigClass : this.equalClass);

        this.outputTarget.textContent = `Hello ${size}! Edit me in assets/controllers/hello_controller.js`;
    }

    greet() {
        this.outputTarget.textContent = `Hello ${this.usernameValue}!`;
        setTimeout(() => this.connect(), 10000);
        this.dispatch('greeted', { detail: { username: this.usernameValue } });
    }

    updateUsername(event) {
        this.outputTarget.textContent = `Hello ${event.target.value}!`;
        // this.usernameValue = event.target.value;
        // this.greet();
    }

    add() {
        this.listTarget.insertAdjacentHTML('beforeend', `<div data-controller="hello" data-hello-username-value="Toto" data-hello-little-class="text-red-500" data-hello-big-class="text-4xl" data-hello-equal-class="text-green-500">
            <span data-hello-target="output"></span>
        </div>`);
    }
}
