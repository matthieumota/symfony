import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { items: { type: Array, default: [] } };
    static targets = ['list', 'total'];

    initialize() {
        // fetch ou localstorage
        const storedItems = localStorage.getItem('cartItems');
        if (storedItems) {
            this.itemsValue = JSON.parse(storedItems);
        }
    }

    add(event) {
        this.itemsValue = [...this.itemsValue, {
            name: event.params.name,
            price: event.params.price,
        }];
    }

    remove(event) {
        this.itemsValue = this.itemsValue.filter((_, i) => i !== event.params.index);
    }

    itemsValueChanged() {
        this.listTarget.innerHTML = this.itemsValue.map((item, i) => `
            <li class="flex justify-between items-center py-1">
                <span>${item.name} — ${item.price}€</span>
                <button data-action="click->cart#remove" data-cart-index-param="${i}"
                        class="text-red-500 text-sm ml-4">Supprimer</button>
            </li>
        `).join('');

        const total = this.itemsValue.reduce((sum, item) => sum + Number(item.price), 0);
        this.totalTarget.textContent = total;

        // Fetch ou localStorage
        console.log(this.itemsValue);
        localStorage.setItem('cartItems', JSON.stringify(this.itemsValue));
    }
}
