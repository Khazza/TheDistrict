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

document.addEventListener("DOMContentLoaded", function() {
    // Charge la première page de commandes lorsque le document est prêt
    loadOrders(currentPage);
});

function loadOrders(page) {
    fetch(`api.php?action=get_orders&page=${page}`)
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById("ordersTableBody");
        tableBody.innerHTML = ""; // Vider le tableau existant

        // Remplir le tableau avec des données
        data.orders.forEach(order => {
            tableBody.innerHTML += `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.id_plat}</td>
                    <td>${order.quantite}</td>
                    <td>${order.total}</td>
                    <td>${order.date_commande}</td>
                    <td>${order.etat}</td>
                    <td>${order.nom_client}</td>
                    <td>${order.telephone_client}</td>
                    <td>${order.email_client}</td>
                    <td>${order.adresse_client}</td>
                    <td>
                        <!-- Vous pouvez ajouter ici des boutons d'action -->
                    </td>
                </tr>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
}

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

