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

function loadOrders(page) {
    const limit = 10;
    const start = (page - 1) * limit;

    $.post('api.php', { action: 'get_all_orders', start: start, limit: limit }, function (data) {
        const orders = JSON.parse(data);
        const tbody = $('.dashboard-table tbody');
        tbody.empty();

        orders.forEach(order => {
            // Créez les éléments du tableau ici et ajoutez-les à 'tbody'
            // Vous pouvez utiliser la même structure que dans votre fichier PHP
        });

        // Mettez également à jour les contrôles de pagination ici
    });
}

// Chargez la première page de commandes au chargement de la page
$(document).ready(function () {
    loadOrders(1);
});

let currentPage = 1;

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        loadOrders(currentPage);
    }
}

function nextPage() {
    currentPage++;
    loadOrders(currentPage);
}