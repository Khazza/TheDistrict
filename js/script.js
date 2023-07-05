document.querySelector('.order-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêcher l'envoi du formulaire immédiatement
    
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Voulez-vous vraiment envoyer votre commande?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#970747',
        cancelButtonColor: '#000000',
        confirmButtonText: 'Oui !',
        cancelButtonText: 'Non, annulez!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('.order-form').submit();
        }
    });
});

$(document).ready(function() {
    // code pour gérer l'affichage du modal pour modifier les catégories
    window.showEditModal = function(categorie) {
        // Remplir le formulaire avec les informations de la catégorie
        $('#edit-category-id').val(categorie.id);
        $('#edit-category-libelle').val(categorie.libelle);
        // ... assigner les valeurs aux autres champs ...

        // Afficher le modal
        $('#editCategoryModal').modal('show');
    };
});
