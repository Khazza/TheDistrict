<?php

require_once 'database.php';

function get_categories()
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM categorie WHERE active = 'Yes' LIMIT 6";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
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
              LIMIT 3";
              
    $stmt = $db->prepare($query);
    $stmt->execute();

    $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dishes;
}
?>
