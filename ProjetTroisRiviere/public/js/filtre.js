document.addEventListener('DOMContentLoaded', function() {
    const barRecherches = Array.from(document.getElementsByClassName('searchBar-filtre'));
    const listeFiltres = document.querySelectorAll('.liste-filtre');
    const listeOffres = listeFiltres[0].querySelectorAll('.uneOffre');
    const listeCats = listeFiltres[1].querySelectorAll('.uneCategorie');
    const listeRegion = listeFiltres[2].querySelectorAll('.uneRegion');
    const listeVille = listeFiltres[3].querySelectorAll('.uneVille');

    var textEntre;
    var listeRegionSelect  = [];

    const listeDesFours = document.querySelectorAll('.les-fournisseurs');
    const listeFours = listeDesFours.querySelectorAll('.un-fournisseur');


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
        const codeRegion = String(region.querySelector('input[type="checkbox"]').value);
        const checkboxRegion = region.querySelector('input[type="checkbox"]'); 
        
        if (checkboxRegion.checked) {
            majListeVille(codeRegion);
        }
    });
    
});