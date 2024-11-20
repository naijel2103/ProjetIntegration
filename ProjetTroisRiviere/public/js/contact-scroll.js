document.addEventListener('DOMContentLoaded', function() {

    const listeButtons = document.querySelectorAll('.btn-carte');
    
    function switchCard(sens, fournisseur, typeCarte, contactId){
        const fournisseurElement = document.querySelector(`[data-fournisseur-id="${fournisseur}"]`);
        const contactElement = fournisseurElement.querySelector(`[data-contact-id="${contactId}"]`);
        
        let attributeKey;


        switch(typeCarte){
            case 0:
                attributeKey='carteCom';
                listeAMod = fournisseurElement.querySelectorAll(`.${attributeKey}`);
                currentIndex = parseInt(fournisseurElement.getAttribute(`data-current-index-${attributeKey}`) || 0, 10);
            break;

            case 1:
                attributeKey='carteContact';
                listeAMod = fournisseurElement.querySelectorAll(`.${attributeKey}`);
                currentIndex = parseInt(fournisseurElement.getAttribute(`data-current-index-${attributeKey}`) || 0, 10);
            break;

            case 2:
                attributeKey='carteComsContact';
                listeAMod = contactElement.querySelectorAll(`.${attributeKey}`);
                currentIndex = parseInt(contactElement.getAttribute(`data-current-index-${attributeKey}`) || 0, 10);
                
            break;
        }

        listeAMod.forEach((carte) => {
            carte.style.display = 'none';
        });
        
        const totalCards = listeAMod.length;

        if (totalCards === 0) return;
        
        if(sens === 0){
            currentIndex = (currentIndex === 0) ? totalCards - 1 : currentIndex - 1;
        } else {
            currentIndex = (currentIndex === totalCards - 1) ? 0 : currentIndex + 1;
        }
        
        if(typeCarte!=2){
            fournisseurElement.setAttribute('data-current-index-'+ attributeKey , currentIndex);
        } else {
            contactElement.setAttribute('data-current-index-'+ attributeKey , currentIndex);
        }
        
        listeAMod[currentIndex].style.display = 'block';
    }

    function checkNbrCards(fournisseur){
        const fournisseurElement = document.querySelector(`[data-fournisseur-id="${fournisseur}"]`);
        
        const contactElements = fournisseurElement.querySelectorAll('[data-contact-id]');

        for(let typeCarte=0; typeCarte<3; typeCarte++){
            let attributeKey;
            let listeMod;
            let cardExiste;
            switch(typeCarte){
                case 0:
                    attributeKey='carteCom';
                    cardExiste = fournisseurElement.querySelectorAll(`.${attributeKey}`);
                break;
    
                case 1:
                    attributeKey='carteContact';
                    cardExiste = fournisseurElement.querySelectorAll(`.${attributeKey}`);
                break;
    
                case 2:
                    attributeKey='carteComsContact';

                    contactElements.forEach(contactCard => {
                        cardExiste = contactCard.querySelector(`.${attributeKey}`);
    
                        if (cardExiste) {
                            const btnUpContactComs = contactCard.querySelector('.btnUpContactComs');
                            const btnDownContactComs = contactCard.querySelector('.btnDownContactComs');
    
                            listeAMod = contactCard.querySelectorAll(`.${attributeKey}`);

                            listeAMod.forEach((carte) => {
                                carte.style.display = 'none';
                            });
                            
                            const totalCards = listeAMod.length;
                    
                            if (totalCards <= 1){
                                if (btnUpContactComs) btnUpContactComs.style.display = 'none';
                                if (btnDownContactComs) btnDownContactComs.style.display = 'none';
                            } else {
                                contactCard.setAttribute('data-current-index-'+ attributeKey , 0);
                                listeAMod[0].style.display = 'block';
                            }
                        }
                    });
                break;;
            }
            
            if(typeCarte !=2){
                if(cardExiste.length > 0){
                    
                    const btnUpComs = document.querySelectorAll('.btnUpComs');
                    const btnDownComs = document.querySelectorAll('.btnDownComs');
                    const btnUpContact = document.querySelectorAll('.btnUpContact');
                    const btnDownContact = document.querySelectorAll('.btnDownContact');

                    listeAMod = fournisseurElement.querySelectorAll(`.${attributeKey}`);

                    listeAMod.forEach((carte) => {
                        carte.style.display = 'none';
                    });
                    
                    const totalCards = listeAMod.length;
            
                    if (totalCards <= 1){
                        switch(typeCarte){
                            case 0:
                                if(btnUpComs && btnDownComs){
                                    btnUpComs.style.display='none';
                                    btnDownComs.style.display='none';
                                }
                            break;
                
                            case 1:
                                if(btnUpContact && btnDownContact){
                                    btnUpContact.style.display='none';
                                    btnDownContact.style.display='none';
                                }
                            break;
                        }
                    } else {
                        fournisseurElement.setAttribute('data-current-index-'+ attributeKey , 0);

                        listeAMod[0].style.display = 'block';
                    }
                }
            }
        }
    }

    document.querySelectorAll('.unFournisseur').forEach(fournisseurElement => {
        const fournisseurId = fournisseurElement.getAttribute('data-fournisseur-id');
        checkNbrCards(fournisseurId);
    });

    listeButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const fournisseurId = button.closest('.unFournisseur').getAttribute('data-fournisseur-id');
            let contactId; 

            const classes = Array.from(button.classList);
            const specificClass = classes.find(cls => cls !== 'btn-action');

            switch (specificClass) {
                case 'btnUpComs':
                    switchCard(0, fournisseurId, 0); 
                    break;
                case 'btnDownComs':
                    switchCard(1, fournisseurId, 0); 
                    break;
                case 'btnUpContact':
                    switchCard(0, fournisseurId, 1); 
                    break;
                case 'btnDownContact':
                    switchCard(1, fournisseurId, 1); 
                    break;
                case 'btnUpContactComs':
                    contactId = button.getAttribute('data-leContact-id');
                    switchCard(0, fournisseurId, 2,contactId); 
                    break;
                case 'btnDownContactComs':
                    contactId = button.getAttribute('data-leContact-id');
                    switchCard(1, fournisseurId, 2,contactId); 
                    break;
                default:
                    console.log('Type de bouton non reconnu');
            }
        });
    });

    document.querySelectorAll('.contacte-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let statusText = this.nextElementSibling;
            
            if (this.checked) {
                statusText.textContent = 'Contacté';  
                this.setAttribute('checked', 'checked');  
            } else {
                statusText.textContent = 'Non contacté';  
                this.removeAttribute('checked');  
            }
        });
    });
});