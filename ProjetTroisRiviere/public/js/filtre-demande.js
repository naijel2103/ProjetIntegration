document.addEventListener('DOMContentLoaded', function() {
    const statusBar = document.getElementById("status-bar");
    const optionTri = document.getElementById("optionTri");
    const StatusCheckboxes = statusBar.querySelectorAll('input[type="checkbox"]');

    const listeDemande = Array.from(document.querySelectorAll("tbody tr"));

    function getDateDemande(demande, type, nouveau) {
        const info = demande.querySelectorAll("td");
        const dateDemandeText = info[type].textContent.trim(); 

        if (dateDemandeText === "Aucune demande") {
            if(nouveau){
                return new Date(0);
            } else {
                return Infinity;
            }
        }

        return new Date(dateDemandeText);
    }

    function sortByDate(type, nouveau) {
        listeDemande.sort((demandeA, demandeB) => {
            const dateA = getDateDemande(demandeA , type, nouveau);
            const dateB = getDateDemande(demandeB, type, nouveau);

            if(nouveau){
                return dateB - dateA;
            } else {
                return dateA - dateB;
            }
        });

        const tbody = document.querySelector("tbody");
        listeDemande.forEach(uneDemande => {
            tbody.appendChild(uneDemande);
        });
    }


    function majListe(index, value){
        switch(index){
            
            case "attente":
                if(value == true){
                    listeDemande.forEach(uneDemande =>{
                        const info = uneDemande.querySelectorAll("td");
                        const statut = info[0].querySelector("p").textContent.trim();

                        if(statut == "En attente"){
                            uneDemande.style.display="table-row";
                        }
                    })
                } else {
                    listeDemande.forEach(uneDemande =>{
                        const info = uneDemande.querySelectorAll("td");
                        const statut = info[0].querySelector("p").textContent.trim();

                        if(statut == "En attente"){
                            uneDemande.style.display="none";
                        }
                    })
                }
            break;

            case "refusees":
                if(value == true){
                    listeDemande.forEach(uneDemande =>{
                        const info = uneDemande.querySelectorAll("td");
                        const statut = info[0].querySelector("p").textContent.trim();

                        if(statut == "Refusée"){
                            uneDemande.style.display="table-row";
                        }
                    })
                } else {
                    listeDemande.forEach(uneDemande =>{
                        const info = uneDemande.querySelectorAll("td");
                        const statut = info[0].querySelector("p").textContent.trim();

                        if(statut == "Refusée"){
                            uneDemande.style.display="none";
                        }
                    })
                }
            break;

            case "desactivee":
                if(value == true){
                    listeDemande.forEach(uneDemande =>{
                        const info = uneDemande.querySelectorAll("td");
                        const statut = info[0].querySelector("p").textContent.trim();

                        if(statut == "Désactivée"){
                            uneDemande.style.display="table-row";
                        }
                    })
                } else {
                    listeDemande.forEach(uneDemande =>{
                        const info = uneDemande.querySelectorAll("td");
                        const statut = info[0].querySelector("p").textContent.trim();

                        if(statut == "Désactivée"){
                            uneDemande.style.display="none";
                        }
                    })
                }
            break;

            case "dateDemande":
                sortByDate(2,false);
            break;

            case "dateModification":
                sortByDate(3,true);
            break;

            case "dateChangementStatut":
                sortByDate(4,true);
            break;
        }
    }

    StatusCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                majListe(this.value, true);
            } else {
                majListe(this.value, false);
            }
        });
    });

    optionTri.addEventListener('change', function() {
        const selectedValue = this.value;
        majListe(this.value)
    });

    sortByDate(2,false);

});