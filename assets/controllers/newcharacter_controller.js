import { Controller } from "@hotwired/stimulus";

/**
 * Classe contrôleur pour la création d'un nouveau personnage.
 */
export default class extends Controller {
  // Définition des cibles pour le contrôleur.
  static targets = [
    "pool",
    "cards",
    "radio",
    "strengthModifier",
    "dexterityModifier",
    "enduranceModifier",
    "intelligenceModifier",
    "wisdomModifier",
    "charismaModifier",
    "strengthBase",
    "dexterityBase",
    "enduranceBase",
    "intelligenceBase",
    "wisdomBase",
    "charismaBase",
    "totals",
    "age",
  ];

  /**
   * Connecte le contrôleur et initialise les valeurs des points de pool.
   */
  connect() {
    // Récupère les valeurs des points de pool et des stats.
    this.totalPoolPoints = this.poolTarget.dataset.initpool;
    // Récupère les valeurs des stats de la race
    this.statsRace = {
      strength: parseInt(this.strengthModifierTarget.innerText),
      dexterity: parseInt(this.dexterityModifierTarget.innerText),
      endurance: parseInt(this.enduranceModifierTarget.innerText),
      intelligence: parseInt(this.intelligenceModifierTarget.innerText),
      wisdom: parseInt(this.wisdomModifierTarget.innerText),
      charisma: parseInt(this.charismaModifierTarget.innerText),
    };
    // Met à jour les points de pool et les stats.
    this.updatePool();
    this.updateStats();
    this.updateTotal();
  }

  /**
   * Gère la sélection d'une race ou d'une classe.
   * @param {*} event
   */
  selectRadio(event) {
    const statsModifier = event.currentTarget.getAttribute(
      "data-newcharacter-stats"
    );

    // Si une race est sélectionnée, mise à jour des stats.
    if (statsModifier) {
      this.statsRace = JSON.parse(statsModifier);
      this.updateStats();
    }

    // Mise à jour et calcul du total des stats
    this.updateTotal();
  }

  // Mise à jour du pool de points de stats.
  updatePool() {
    this.poolTarget.innerText = this.totalPoolPoints;
  }

  // Mise à jour des stats à partir de la race sélectionnée et ajout d'un bouton +/-
  updateStats() {
    // Mise à jour des valeurs
    this.strengthModifierTarget.innerText = this.getModifierSign(
      this.statsRace.strength
    );
    this.dexterityModifierTarget.innerText = this.getModifierSign(
      this.statsRace.dexterity
    );
    this.enduranceModifierTarget.innerText = this.getModifierSign(
      this.statsRace.endurance
    );
    this.intelligenceModifierTarget.innerText = this.getModifierSign(
      this.statsRace.intelligence
    );
    this.wisdomModifierTarget.innerText = this.getModifierSign(
      this.statsRace.wisdom
    );
    this.charismaModifierTarget.innerText = this.getModifierSign(
      this.statsRace.charisma
    );
  }

  // Méthode pour obtenir le signe du modificateur.
  getModifierSign(value) {
    return value >= 0 ? `+${value}` : `${value}`;
  }

  /**
   * Mise à jour du total des stats.
   *
   * @param {string} statName : The name of the stat to update.
   */
  updateTotal(statName = null) {
    this.totalsTargets.forEach((total) => {
      if (statName === null) {
        const totalName = total.id.split("Total")[0];
        total.innerText =
          parseInt(this[`${totalName}BaseTarget`].value) +
          parseInt(this[`${totalName}ModifierTarget`].innerText);
      }

      else if (total.id == `${statName}Total`) {
        total.innerText =
          parseInt(this[`${statName}BaseTarget`].value) +
          parseInt(this[`${statName}ModifierTarget`].innerText);
      }
    });
  }

  // Mise à jour du total des stats.
  updateChange({ params }){
    this.totalPoolPoints -= parseInt(this[`${params.name}BaseTarget`].value);
    this.updatePool();
    this.updateTotal(params.name);
  }

  // Augmente et met à jour les points de pool totaux.
  increasePoolTotal() {
    this.totalPoolPoints++;
    this.updatePool();
  }

  // Diminue et met à jour les points de pool totaux.
  decreasePoolTotal() {
    if (this.totalPoolPoints > 0) {
      this.totalPoolPoints--;
      this.updatePool();
    }
  }

  // Augmente la stat si les points de pool sont supérieurs à 0.
  increaseStat({ params }) {
    // Récupère l'élément input basé sur le nom de la stat.
    const inputElement = this[`${params.name}BaseTarget`];

    // Vérifie si l'élément input existe et si les points de pool totaux sont supérieurs à 0.
    // Puis diminue les points de pool et met à jour le total des stats cibles.
    if (inputElement && this.totalPoolPoints > 0) {
      inputElement.value = parseInt(inputElement.value) + 1;
      this.decreasePoolTotal();
    }
    this.updateTotal(params.name);
  }
  // Vérifie si l'élément input existe et si les points de pool sont supérieurs à 6.
  // Puis diminue les points de pool et met à jour le total des stats cibles.
  decreaseStat({ params }) {
    const inputElement = this[`${params.name}BaseTarget`];
    
    if (inputElement && inputElement.value > 6) {
      inputElement.value = parseInt(inputElement.value) - 1;
      this.increasePoolTotal();
    }
    this.updateTotal(params.name);
  }

  increaseAge() {
    this.ageTarget.value = parseInt(this.ageTarget.value) + 1;
  }

  decreaseAge() {
    this.ageTarget.value = parseInt(this.ageTarget.value) - 1;
  }
}
