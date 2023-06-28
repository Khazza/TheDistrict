document.querySelector('.order-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêcher l'envoi du formulaire immédiatement
    
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Voulez-vous vraiment envoyer votre commande?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui !',
        cancelButtonText: 'Non, annulez!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('.order-form').submit();
        }
    });
});
