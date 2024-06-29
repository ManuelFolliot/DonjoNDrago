import { Controller } from "@hotwired/stimulus";

export default class extends Controller {

    // Défini les cibles de l'élément HTML
    static targets = ['currentEnemies'];

    // Méthode appelée lorsque le contrôleur est connecté
    connect() {
        console.log('Enemies Add Controller Connected');
    }

    // Méthode pour ajouter un ennemi à la liste
    add(event) {
        //  Empêcher le comportement par défaut du formulaire
        event.preventDefault();
        // Récupérer les données de l'ennemi sélectionné
        const selectedEnemyName = event.target.dataset.enemyName;
        // Récupérer les points de vie de l'ennemi sélectionné
        const selectedEnemyHitPoints = parseInt(event.target.dataset.enemyHitPoints);
        // Mettre à jour la liste des ennemis actuels
        this.updateCurrentEnemies(selectedEnemyName, selectedEnemyHitPoints);
    }

    // Méthode pour mettre à jour la liste des ennemis actuels
    updateCurrentEnemies(enemyName, enemyHitPoints) {
        const enemyElement = document.createElement('div');
        enemyElement.classList.add('mb-2', 'flex', 'items-center', 'justify-between');
        enemyElement.dataset.enemyName = enemyName;

        // Créer l'élément pour le nom de l'ennemi
        const nameElement = document.createElement('div');
        nameElement.textContent = enemyName;
        nameElement.classList.add('mx-2');

        // Créer l'élément pour changer la vie de l'ennemi
        const currentHitPointsElement = document.createElement('div');
        currentHitPointsElement.classList.add('flex', 'items-center', 'mr-4');

        const hitPointsInput = document.createElement('input');
        hitPointsInput.type = 'number';
        hitPointsInput.min = 0;
        hitPointsInput.value = enemyHitPoints;
        hitPointsInput.classList.add('w-auto', 'max-w-12', 'bg-black', 'bg-opacity-0', 'text-yellow-500', 'border', 'border-yellow-500', 'rounded', 'px-2', 'py-1', 'text-center', 'appearance-none');
        
        const increaseButton = document.createElement('button');
        increaseButton.textContent = '+';
        increaseButton.classList.add('border-1', 'border-yellow-500', 'text-yellow-500', 'text-2xl', 'px-2', 'py-1', 'rounded', 'mx-2');
        increaseButton.addEventListener('click', () => this.increaseEnemyHitPoints(enemyElement));
        
        const decreaseButton = document.createElement('button');
        decreaseButton.textContent = '-';
        decreaseButton.classList.add('border-1', 'border-yellow-500', 'text-yellow-500', 'text-2xl', 'px-2', 'py-1', 'rounded');
        decreaseButton.addEventListener('click', () => this.decreaseEnemyHitPoints(enemyElement));

        currentHitPointsElement.appendChild(hitPointsInput);
        currentHitPointsElement.appendChild(increaseButton);
        currentHitPointsElement.appendChild(decreaseButton);

        // Créer l'élément pour le bouton de suppression
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'X';
        deleteButton.classList.add('bg-red-500', 'text-white', 'px-2', 'py-1', 'rounded');
        deleteButton.addEventListener('click', () => this.removeEnemy(enemyName));

        enemyElement.appendChild(deleteButton);
        enemyElement.appendChild(nameElement);
        enemyElement.appendChild(currentHitPointsElement);

        this.currentEnemiesTarget.appendChild(enemyElement);
    }

    // Méthode pour diminuer les points de vie de l'ennemi
    decreaseEnemyHitPoints(enemyElement) {
        const hitPointsInput = enemyElement.querySelector('input[type="number"]');
        if (hitPointsInput.value > 0) {
            hitPointsInput.value--;
        }
    }

    // Méthode pour augmenter les points de vie de l'ennemi
    increaseEnemyHitPoints(enemyElement) {
        const hitPointsInput = enemyElement.querySelector('input[type="number"]');
        hitPointsInput.value++;
    }
    
    // Méthode pour supprimer un ennemi de la liste
    removeEnemy(enemyName) {
        // Logique pour supprimer l'ennemi de la liste
        console.log(`Suppression de l'ennemi : ${enemyName}`);
        // Récupérer l'élément de l'ennemi à supprimer
        const enemyElement = this.currentEnemiesTarget.querySelector(`div[data-enemy-name="${enemyName}"]`);
        // Supprimer l'élément de l'ennemi de la liste
        if (enemyElement) {
            this.currentEnemiesTarget.removeChild(enemyElement);
        }
    }
    
}