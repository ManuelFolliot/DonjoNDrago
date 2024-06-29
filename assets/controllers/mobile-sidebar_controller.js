import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static targets = ["popUpMenu", "penIcon", "swordIcon"];
  connect() {
    }
    toggle(){
        this.popUpMenuTarget.classList.toggle('translate-x-full');
        this.popUpMenuTarget.classList.toggle('translate-x-0');
        this.penIconTarget.classList.toggle('rotate-45');
        this.penIconTarget.classList.toggle('-translate-x-10');
        this.swordIconTarget.classList.toggle('-rotate-45');
        this.swordIconTarget.classList.toggle('translate-x-10');
    }
}
