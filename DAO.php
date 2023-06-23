<?php
require_once 'database.php';


// function get_categories()
// {
//     $database = new Database();
//     $db = $database->getConnection();

//     $query = "SELECT * FROM categorie WHERE active = 'Yes' LIMIT 6";
//     $stmt = $db->prepare($query);
//     $stmt->execute();

//     $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     return $categories;
// }

function get_popular_categories($limit = 6) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "
        SELECT categorie.id, categorie.libelle, categorie.image, SUM(commande.quantite) as total_quantity
        FROM categorie
        JOIN plat ON categorie.id = plat.id_categorie
        JOIN commande ON plat.id = commande.id_plat
        WHERE categorie.active = 'Yes'
        GROUP BY categorie.id
        ORDER BY total_quantity DESC
        LIMIT :limit
    ";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_most_sold_dishes()
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT plat.*, SUM(commande.quantite) AS total_sold 
              FROM plat 
              JOIN commande ON plat.id = commande.id_plat
              WHERE plat.active = 'Yes'
              GROUP BY plat.id
              ORDER BY total_sold DESC
              LIMIT 6";
              
    $stmt = $db->prepare($query);
    $stmt->execute();

    $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dishes;
}
?>

<?php 
function get_categories_paginated($limit, $offset) {
    $database = new Database();
    $db = $database->getConnection();

    // Utilisez des placeholders nommés dans la requête SQL
    $query = "SELECT * FROM categorie LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    
    // Convertir les limites et les décalages en entiers
    $limit = (int) $limit;
    $offset = (int) $offset;

    // Lier les valeurs en tant qu'entiers
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    // Exécutez la requête
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php
// Cette fonction renvoie le nombre total de catégories dans la base de données.
function get_total_categories() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT COUNT(*) as total FROM categorie";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch();

    return $row['total'];
}

// Cette fonction génère les liens de pagination en fonction de la page actuelle et du nombre total de catégories.
function generate_pagination_links($current_page, $total_categories, $items_per_page) {
    $total_pages = ceil($total_categories / $items_per_page);
    
    $links = '';
    if ($current_page > 1) {
        $links .= '<a href="?page=' . ($current_page - 1) . '" class="btn btn-primary me-2">Précédent</a>';
    }
    
    if ($current_page < $total_pages) {
        $links .= '<a href="?page=' . ($current_page + 1) . '" class="btn btn-primary">Suivant</a>';
    }
    
    return $links;
}
?>

( ! ) Fatal error: Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''6' OFFSET '0'' at line 1 in /home/mahe/Bureau/TheDistrict/DAO.php on line 77
( ! ) PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''6' OFFSET '0'' at line 1 in /home/mahe/Bureau/TheDistrict/DAO.php on line 77
Call Stack
#	Time	Memory	Function	Location
1	0.0000	356424	{main}( )	.../categories.php:0
2	0.0000	356480	get_categories_paginated( $limit = 6, $offset = 0 )	.../categories.php:28
3	0.0004	399848	execute( $params = [':limit' => 6, ':offset' => 0] )	.../DAO.php:77