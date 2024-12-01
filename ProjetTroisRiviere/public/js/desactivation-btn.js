document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("descativationBtn").addEventListener("click", function() {
        var textToCopy = document.getElementById("textToCopy");

        navigator.clipboard.writeText(textToCopy.innerText)
            .then(function() {
                alert("Texte copié dans le presse-papier !\nAller dans la page Liste à contacter pour afficher votre liste");
            })
            .catch(function(err) {
                console.error("Erreur lors de la copie: ", err);
            });
    });
});