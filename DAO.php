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

function get_plats_by_category($category_id = null) {
    $database = new Database();
    $db = $database->getConnection();

    if ($category_id) {
        $query = "SELECT plat.*, categorie.libelle AS category_name
                  FROM plat
                  JOIN categorie ON plat.id_categorie = categorie.id
                  WHERE plat.id_categorie = :category_id
                  ORDER BY categorie.libelle";
    } else {
        $query = "SELECT plat.*, categorie.libelle AS category_name
                  FROM plat
                  JOIN categorie ON plat.id_categorie = categorie.id
                  ORDER BY categorie.libelle";
    }

    $stmt = $db->prepare($query);

    if ($category_id) {
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_plat_by_id($plat_id) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT plat.*, categorie.libelle AS category_name
              FROM plat
              JOIN categorie ON plat.id_categorie = categorie.id
              WHERE plat.id = :plat_id";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':plat_id', $plat_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function search_categories($queryCategories) {
    $database = new Database();
    $db = $database->getConnection();
    
    // Requête pour rechercher les catégories par libelle
    $query = "SELECT * FROM categorie WHERE libelle LIKE :searchQuery";
    $stmt = $db->prepare($query);
    
    // Ajouter des pourcentages autour de la requête pour une recherche de sous-chaîne
    $searchQuery = '%' . $queryCategories . '%';
    
    // Lier la valeur de recherche à la requête préparée
    $stmt->bindValue(':searchQuery', $searchQuery, PDO::PARAM_STR);
    
    // Exécutez la requête
    $stmt->execute();
    
    // Récupérer tous les résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function search_dishes($queryDishes) {
    $database = new Database();
    $db = $database->getConnection();
    
    // Requête pour rechercher les plats par libelle
    $query = "SELECT * FROM plat WHERE libelle LIKE :searchQuery";
    $stmt = $db->prepare($query);
    
    // Ajouter des pourcentages autour de la requête pour une recherche de sous-chaîne
    $searchQuery = '%' . $queryDishes . '%';
    
    // Lier la valeur de recherche à la requête préparée
    $stmt->bindValue(':searchQuery', $searchQuery, PDO::PARAM_STR);
    
    // Exécutez la requête
    $stmt->execute();
    
    // Récupérer tous les résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function get_plat_prix($db, $plat_id) {
    $query = "SELECT prix FROM plat WHERE id = :plat_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":plat_id", $plat_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['prix'] : null;
}

function insert_order($db, $plat_id, $quantite, $total, $nom_client, $telephone_client, $email_client, $adresse_client) {
    $query = "INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) VALUES (:plat_id, :quantite, :total, NOW(), 'en attente', :nom_client, :telephone_client, :email_client, :adresse_client)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":plat_id", $plat_id, PDO::PARAM_INT);
    $stmt->bindParam(":quantite", $quantite, PDO::PARAM_INT);
    $stmt->bindParam(":total", $total);
    $stmt->bindParam(":nom_client", $nom_client, PDO::PARAM_STR);
    $stmt->bindParam(":telephone_client", $telephone_client, PDO::PARAM_STR);
    $stmt->bindParam(":email_client", $email_client, PDO::PARAM_STR);
    $stmt->bindParam(":adresse_client", $adresse_client, PDO::PARAM_STR);
    $stmt->execute();
}



