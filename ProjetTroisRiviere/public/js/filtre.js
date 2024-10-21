document.addEventListener('DOMContentLoaded', function() {
    const barRecherches = Array.from(document.getElementsByClassName('searchBar-filtre'));
    const listeFiltres = document.querySelectorAll('.liste-filtre');
    const listeOffres = listeFiltres[0].querySelectorAll('.uneOffre');
    const listeCats = listeFiltres[1].querySelectorAll('.uneCategorie');
    var textEntre;

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
                const numCat = String(categorie.querySelector('input[type="checkbox"]').value);
                
                if (nomCat.includes(textEntre) || numCat.includes(textEntre) ) {
                    categorie.style.display = 'block';
                    
                } else {
                    categorie.style.display = 'none'; 
                }
            });
            break;
        }
        
    }
    barRecherches.forEach(input => {
        input.addEventListener('input', (event) => {
            var index = Array.prototype.indexOf.call(barRecherches, event.target);
            majListe(event, index); 
        });
    });
});