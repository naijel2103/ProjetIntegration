document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const barRecherches = Array.from(document.getElementsByClassName('searchBar-filtre'));
    const listeFiltres = document.querySelectorAll('.liste-filtre');
    const listeOffres = listeFiltres[0].querySelectorAll('.uneOffre');
    const listeCats = listeFiltres[1].querySelectorAll('.uneCategorie');
    const listeRegion = listeFiltres[2].querySelectorAll('.uneRegion');
    const listeVille = listeFiltres[3].querySelectorAll('.uneVille');

    var textEntre;
    var listeRegionSelect  = [];

    const listeDesFours = document.getElementsByClassName('les-fournisseurs')[0];
    const listeFours = listeDesFours.querySelectorAll('.un-fournisseur');
    const listeFoursAvecTaux = [];


    listeRegion.forEach(region => {
        const codeRegion = String(region.querySelector('input[type="checkbox"]').value);
        const checkboxRegion = region.querySelector('input[type="checkbox"]'); 
        
        if (checkboxRegion.checked) {
            majListeVille(codeRegion);
        }
    });


    function majListe(event, index){
        switch(index){
            case 0:
                textEntre = event.target.value.toLowerCase();
                
                listeOffres.forEach(offre => {
                const nomOffre = offre.textContent.trim().toLowerCase(); 
                const codeOffre = String(offre.querySelector('input[type="checkbox"]').value);
            
                if (nomOffre.includes(textEntre) || codeOffre.includes(textEntre) ) {
                    offre.style.display = 'block';
                } else {
                    offre.style.display = 'none'; 
                }
            });
            break;

            case 1:
                textEntre = event.target.value.toLowerCase();

                listeCats.forEach(categorie => {
                const nomCat = categorie.textContent.trim().toLowerCase(); 
                
                if (nomCat.includes(textEntre)) {
                    categorie.style.display = 'block';
                    
                } else {
                    categorie.style.display = 'none'; 
                }
            });
            break;

            case 2:
                textEntre = event.target.value.toLowerCase();

                listeRegion.forEach(region => {
                const nomRegion = region.textContent.trim().toLowerCase(); 
                
                if (nomRegion.includes(textEntre) ) {
                    region.style.display = 'block';
                    
                } else {
                    region.style.display = 'none'; 
                }
            });
            break;

            case 3:
                textEntre = event.target.value.toLowerCase();

                listeVille.forEach(ville => {
                const nomVille = ville.textContent.trim().toLowerCase(); 
                
                if (nomVille.includes(textEntre)) {
                    ville.style.display = 'block';
                    
                } else {
                    ville.style.display = 'none'; 
                }
            });
            break;
        }
        
    }

    function majListeVille(index){

        if(listeRegionSelect.includes(index)){
            let selectDelete = listeRegionSelect.indexOf(index);
            listeRegionSelect.splice(selectDelete);
        } else {
            listeRegionSelect.push(index);
        }
        
        if(listeRegionSelect.length > 0){
            listeVille.forEach(ville => {
                const numRegion = ville.dataset.coderegion;
                const checkboxVille = ville.querySelector('input[type="checkbox"]');
                
                if (listeRegionSelect.includes(numRegion) || checkboxVille.checked) {
                    ville.style.display = 'block';
                    
                } else {
                    ville.style.display = 'none'; 
                }
            });
        } else {
            listeVille.forEach(ville => {
                ville.style.display = 'block';
            });
        }
    }

    barRecherches.forEach(input => {
        input.addEventListener('input', (event) => {
            var index = Array.prototype.indexOf.call(barRecherches, event.target);
            majListe(event, index);
        });
    });

    listeRegion.forEach(region => {
        var checkbox = region.querySelector('input[type="checkbox"]');

        checkbox.addEventListener('change', (event) => {
            var value = event.target.value;
            majListeVille(value); 
        });
    });

    listeFours.forEach(fournisseur => {
        const regionSelected = fournisseur.getElementsByClassName('info-ville')[0].dataset.region_selected ;
        const villeSelected = fournisseur.getElementsByClassName('info-ville')[0].dataset.ville_selected;
        const nbrOffre = fournisseur.getElementsByClassName('info-offre')[0].dataset.nbr_offres ;
        const nbrCat = fournisseur.getElementsByClassName('info-cat')[0].dataset.nbr_cats ;
        const dansVille =  parseInt(fournisseur.getElementsByClassName('info-ville')[0].dataset.dans_ville) ;
        const dansRegion =  parseInt(fournisseur.getElementsByClassName('info-ville')[0].dataset.dans_region) ;
        const nbrOffreCoresp = fournisseur.getElementsByClassName('info-offre')[0].dataset.nbr_offres_correspondant ;
        const nbrCatCoresp = fournisseur.getElementsByClassName('info-cat')[0].dataset.nbr_cats_correspondant;

        let tauxCoresp = 0;
        
        if(regionSelected == "true" && villeSelected == "true"){
            if(dansRegion == 1){
                if(dansVille == 1){
                    tauxCoresp +=30;
                    fournisseur.getElementsByClassName('info-ville')[0].style.color = "#1bd115";
                } else {
                    tauxCoresp +=15;
                    fournisseur.getElementsByClassName('info-ville')[0].style.color = "#ffc400";
                }
            } else {
                fournisseur.getElementsByClassName('info-ville')[0].style.color = "#db0000";
            }

        } else if (regionSelected == "true" && villeSelected == "false"){
            if(dansRegion == 1){
                tauxCoresp +=30;
                fournisseur.getElementsByClassName('info-ville')[0].style.color = "#1bd115";
            } 

        } else if (regionSelected == "false" && villeSelected == "true"){
            if(dansVille == 1){
                tauxCoresp +=30;
                fournisseur.getElementsByClassName('info-ville')[0].style.color = "#1bd115";
            }

        } else if (regionSelected == "false" && villeSelected == "false"){
            tauxCoresp += 30;
        }

        if (nbrOffre > 0){
            tauxCoresp += (nbrOffreCoresp * 40)/nbrOffre;
            if(((nbrOffreCoresp * 40)/nbrOffre)>=20){
                fournisseur.getElementsByClassName('info-offre')[0].style.color = "#1bd115";
            } else if(((nbrOffreCoresp * 40)/nbrOffre)> 0){
                fournisseur.getElementsByClassName('info-offre')[0].style.color = "#ffc400";
            } else {
                fournisseur.getElementsByClassName('info-offre')[0].style.color = "#db0000";
            }
        } else {
            tauxCoresp +=40;
        }

        if (nbrCat > 0){
            tauxCoresp += (nbrCatCoresp * 30)/nbrCat;
            if(((nbrCatCoresp * 30)/nbrCat)>=15){
                fournisseur.getElementsByClassName('info-cat')[0].style.color = "#1bd115";
            } else if(((nbrCatCoresp * 30)/nbrCat)> 0){
                fournisseur.getElementsByClassName('info-cat')[0].style.color = "#ffc400";
            } else {
                fournisseur.getElementsByClassName('info-cat')[0].style.color = "#db0000";
            }
        } else {
            tauxCoresp +=30;
        }

        listeFoursAvecTaux.push({ fournisseur, tauxCoresp });
        
        if(tauxCoresp >= 60){
            fournisseur.style.backgroundColor = "#cbfdc3";
        } else if (tauxCoresp >= 30){
            fournisseur.style.backgroundColor = "#fdf4c3";
        } else {
            fournisseur.style.backgroundColor ="#fc897a";
        }
    });

    document.getElementById('openPopupExtract').addEventListener('click', function () {
        const selectedFournisseurs = Array.from(document.querySelectorAll('.fournisseur-checkbox:checked'))
        .map(checkbox => checkbox.value);

        if (selectedFournisseurs.length === 0) {
            alert('Veuillez sélectionner au moins un fournisseur.');
            return;
        }

        fetch(routeCreateListeFournisseur, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ fournisseurs: selectedFournisseurs })
            
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const popup = document.getElementById('popUpExtract');
                popup.querySelector('p').textContent = `${data.codeListe}`;
                popup.style.display = 'flex';
            } else {
                alert(data.message || 'Une erreur est survenue.');
            }
        })
        .catch(error => console.error('Erreur:', error));
    });

    document.getElementById('closePopup').addEventListener('click', function () {
        document.getElementById('popupModal').style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        const popup = document.getElementById('popUpExtract');
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });

    document.getElementById("copyButton").addEventListener("click", function() {
        var textToCopy = document.getElementById("textToCopy");
    
        navigator.clipboard.writeText(textToCopy.innerText)
            .then(function() {
                alert("Texte copié dans le presse-papier !\nAller dans la page Liste à contacter pour afficher votre liste");
            })
            .catch(function(err) {
                console.error("Erreur lors de la copie: ", err);
            });
    });

    listeFoursAvecTaux.sort((a, b) => b.tauxCoresp - a.tauxCoresp);

    listeDesFours.innerHTML = '';

    listeFoursAvecTaux.forEach(item => {
        listeDesFours.appendChild(item.fournisseur);
        
    });
});