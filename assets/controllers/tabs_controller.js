import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['tab', 'panel'];
    static classes = ['active'];

    connect() {
        this.showPanel(0);
    }

    show(event) {
        this.showPanel(event.params.index);
    }

    showPanel(index) {
        this.panelTargets.forEach((panel, i) => {
            panel.hidden = i !== index;
        });

        this.tabTargets.forEach((tab, i) => {
            tab.classList.toggle(this.activeClass, i === index);
        });
    }
}
