import { Controller } from "@hotwired/stimulus";

export default class extends Controller {

    // Défini les cibles de l'élément HTML
    static targets = ['monsters'];

    // Liste des monstres à afficher
    monsters = ['wolf', 'goblin', 'ape', 'crocodile', 'zombie', 'aboleth', 'acolyte', 'adult-black-dragon', 'wight'];

    // Méthode appelée lorsque le contrôleur est connecté
    async connect() {
        console.log('Dnd Monsters Controller Connected');
        await this.fetchMonsterData();
    }

    // Méthode pour récupérer les données des monstres
    async fetchMonsterData() {
        // Création des headers pour la requête
        const myHeaders = new Headers();
        // Ajout de l'entête Accept pour spécifier le type de contenu attendu
        myHeaders.append("Accept", "application/json");

        // Options de la requête
        const requestOptions = {
            // Méthode de la requête
            method: "GET",
            // Entêtes de la requête
            headers: myHeaders,
            // Redirection de la requête
            redirect: "follow"
        };

        // Création d'un tableau de promesses pour chaque monstre
        const monsterDataPromises = this.monsters.map(async monster => {
            try {
                // Envoi de la requête pour récupérer les données du monstre
                const response = await fetch(`https://www.dnd5eapi.co/api/monsters/${monster}/`, requestOptions);
                if (!response.ok) {
                    throw new Error(`Failed to fetch data for ${monster}`);
                }
                return await response.json();
            } catch (error) {
                console.error(error);
                return null;
            }
        });
        // Récupération des données des monstres
        const monstersData = await Promise.all(monsterDataPromises);
        // Traitement des données des monstres
        this.handleMonstersData(monstersData.filter(Boolean));
    }

    // Méthode pour traiter les données des monstres
    handleMonstersData(monstersData) {
        // Création d'un tableau d'objets contenant les données des monstres
        const monsterImages = monstersData.map(monsterData => {
            // Récupération de l'URL de l'image du monstre
            const monsterImageUrl = this.getMonsterImageUrl(monsterData);
            // Récupération des points de vie du monstre
            const monsterHitPoints = this.getMonsterHitPoints(monsterData);
            return { name: monsterData.name, imageUrl: monsterImageUrl, hitPoints: monsterHitPoints };
        });
        // Ajout des monstres à l'interface utilisateur
        this.addMonstersToDOM(monsterImages);
    }

    // Méthode pour récupérer l'URL de l'image du monstre
    getMonsterImageUrl(monsterData) {
        if (monsterData.image === undefined || monsterData.image === '') {
            return 'https://www.dnd5eapi.co/api/images/monsters/wolf.png';
        } else {
            return `https://www.dnd5eapi.co${monsterData.image}`;
        }
    }
    // Méthode pour récupérer les points de vie du monstre
    getMonsterHitPoints(monsterData) {
        return monsterData.hit_points;
    }
    // Méthode pour ajouter les monstres à l'interface utilisateur
    addMonstersToDOM(monstersData) {
        monstersData.forEach(({ name, imageUrl, hitPoints }) => {
            const img = document.createElement('img');
            img.src = imageUrl;
            img.alt = name;
            img.classList.add('rounded-2xl', 'max-w-16', 'max-h-16');
            img.dataset.action = 'click->enemies-add#add';
            img.dataset.enemyName = name;
            img.dataset.enemyHitPoints = hitPoints;
            this.monstersTarget.appendChild(img);
        });
    }


}