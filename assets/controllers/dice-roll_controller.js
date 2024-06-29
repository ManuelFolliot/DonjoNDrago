import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  // Défini les cibles de l'élément HTML
  static targets = ["diceResult"];

  // Méthode appelée lorsque le contrôleur est connecté
  connect() {}

  // Méthode pour lancer le dé
  async roll(event) {
    // Remplace temporairement le résultat du dé par des points de suspension
    this.diceResultTarget.textContent = "...";
    // Récupère le dé actuel
    const currentDice = event.currentTarget;
    // Récupère le type de dé
    const diceType = currentDice.dataset.dice;
    // Lance le dé et récupère le résultat
    const result = this.rollDice(diceType);
    // Anime le dé
    currentDice.classList.add("animate-spin");
    // Attend la fin de l'animation
    await this.#waitForAnimation(event);
    // Arrête l'animation du dé
    currentDice.classList.remove("animate-spin");
    // Met à jour le résultat du dé
    this.updateDiceValue(result);
  }

  // Méthode pour lancer le dé selon son nombre de faces
  rollDice(diceType) {
    return Math.floor(Math.random() * diceType) + 1;
  }

  // Méthode pour mettre à jour le résultat du dé
  updateDiceValue(result) {
    this.diceResultTarget.textContent = result;
  }

  // Méthode pour attendre la fin de l'animation
  #waitForAnimation(event) {
    return Promise.all(
      event.currentTarget.getAnimations().map((animation) => animation.finished)
    );
  }
}
