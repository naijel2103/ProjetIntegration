document.addEventListener('DOMContentLoaded', function() {

    const btnUpCards = document.querySelectorAll('.btnUpCards');
    const btnDownCards = document.querySelectorAll('.btnDownCards');
    
    function switchCard(sens, fournisseur, typeCarte){
        
        const fournisseurElement = document.querySelector(`[data-fournisseur-id="${fournisseur}"]`);

        const listeAMod = fournisseurElement.querySelectorAll(typeCarte);

        let currentIndex = parseInt(fournisseurElement.getAttribute('data-current-index') || 0, 10);

        listeAMod.forEach((carte) => {
            carte.style.display = 'none';
        });

        const totalCards = listeAMod.length;

        if(sens === 0){
            currentIndex = (currentIndex === 0) ? totalCards - 1 : currentIndex - 1;
        } else {
            currentIndex = (currentIndex === totalCards - 1) ? 0 : currentIndex + 1;
        }

        fournisseurElement.setAttribute('data-current-index'  + typeCarte, currentIndex);

        listeAMod[currentIndex].style.display = 'block';
    }

    document.querySelectorAll('.unFournisseur').forEach(fournisseurElement => {
        const fournisseurId = fournisseurElement.getAttribute('data-fournisseur-id');
        switchCard(1, fournisseurId, '.carteCom');
        switchCard(1, fournisseurId, '.carteContact');
    });

    btnUpCards.forEach(btn => {
        btn.addEventListener('click', function() {
            const fournisseurId = btn.closest('.unFournisseur').getAttribute('data-fournisseur-id');
            const typeCarte = btn.closest('.infoComs').querySelector('.listeComs') ? '.carteCom' : '.carteContact';
            switchCard(1, fournisseurId, typeCarte); 
        });
    });

    btnDownCards.forEach(btn => {
        btn.addEventListener('click', function() {
            const fournisseurId = btn.closest('.unFournisseur').getAttribute('data-fournisseur-id');
            const typeCarte = btn.closest('.infoComs').querySelector('.listeComs') ? '.carteCom' : '.carteContact';
            switchCard(0, fournisseurId, typeCarte); 
        });
    });
});