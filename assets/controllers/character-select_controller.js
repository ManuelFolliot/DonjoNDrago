import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["description", "radios", "emptyDescription"];

    // Connecte les boutons radios au contrôleur
    connect(){
        this.radiosTargets.forEach(radio => {
            if(radio.checked){
                this.show({params: {id: radio.value}});
            }
        });
    }

    // Affiche la description correspondant à l'élément sélectionné
    show({params}){
        this.emptyDescriptionTarget.classList.add('hidden');

        this.descriptionTargets.forEach(description => {
            if(description.dataset.descriptionId == params.id){
                description.classList.remove('hidden');
            }else{
                description.classList.add('hidden');
            }
        });
    }

}