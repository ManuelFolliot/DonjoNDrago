import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static targets = ["background"];

  connect() {}
  // Méthode pour changer l'image de fond
  change(event) {
    const imageUrl = event.target.dataset.mappedUrl;
    this.backgroundTarget.src = imageUrl;
  }
}
