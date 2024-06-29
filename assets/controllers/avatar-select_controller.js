import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static values = { avatar: String };
  static targets = ["images", "input"];

  connect() {

    this.imagesTargets.forEach((image) => {
      //console.log(image.getAttribute("data-value"));
      if (image.getAttribute("data-value") === this.inputTarget.value) {
        image.classList.add("border-opacity-100", "shadow-md");
      } else {
        image.classList.remove("border-opacity-100", "shadow-md");
      }
    });
  }

  select(event) {
    const imageUrl = event.target.parentNode.getAttribute("data-value");

    this.imagesTargets.forEach((image) => {
      image.classList.remove("border-opacity-100", "shadow-md");
    });
    // Mettre en surbrillance l'image sélectionnée
    event.target.parentNode.classList.add("border-opacity-100", "shadow-md");

    this.inputTarget.value = imageUrl;
    console.log(this.inputTarget.value);
  }
}
