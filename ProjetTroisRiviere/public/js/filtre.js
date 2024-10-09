document.addEventListener('DOMContentLoaded', function() {
    const barRecherches = Array.from(document.getElementsByClassName('searchBar-filtre'));
    const listeFiltre = document.querySelector('.liste-filtre');
    const listeOffres = listeFiltre.querySelectorAll('.uneOffre');

    function majListe(event, index){
        switch(index){
            case 0:
                const textEntre = event.target.value.toLowerCase();
        
                listeOffres.forEach(offre => {
                const nomOffre = offre.textContent.trim().toLowerCase(); 
                const codeOffre = String(offre.querySelector('input[type="checkbox"]').value);
            
                if (nomOffre.includes(textEntre) || codeOffre.includes(textEntre) ) {
                    offre.style.display = 'block';
                } else {
                    offre.style.display = 'none'; 
                }
            });
        }
        
    }
    barRecherches.forEach(input => {
        input.addEventListener('input', (event) => {
            const index = Array.prototype.indexOf.call(barRecherches, event.target);
            console.log(index);
            majListe(event, index); 
        });
    });
});