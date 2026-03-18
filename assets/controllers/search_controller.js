import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['results', 'status']
    static values  = { url: String }

    timer = null

    debounce(event) {
        clearTimeout(this.timer)
        this.timer = setTimeout(() => this.search(event.target.value), 300)
    }

    async search(q) {
        this.statusTarget.hidden = false

        const response = await fetch(`${this.urlValue}?q=${encodeURIComponent(q)}`)
        const products = await response.json()

        this.statusTarget.hidden = true
        this.resultsTarget.innerHTML = products
            .map(p => `<li>${p.name} — ${p.price} €</li>`)
            .join('')
    }
}
