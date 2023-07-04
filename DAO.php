<?php
require_once 'database.php';

// ------------------------------------------------Index
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


<!-- --------------------------------Categories---------------------------- -->
<?php
function get_categories_paginated($limit, $offset) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM categorie WHERE active = 'Yes' LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    
    // Convertir les limites et les décalages en entiers
    $limit = (int) $limit;
    $offset = (int) $offset;

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php
// Cette fonction renvoie le nombre total de catégories dans la base de données.
function get_total_categories() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT COUNT(*) as total FROM categorie WHERE active = 'Yes'";
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
    
    $searchQuery = '%' . $queryCategories . '%';
    
    // Lier la valeur de recherche à la requête préparée
    $stmt->bindValue(':searchQuery', $searchQuery, PDO::PARAM_STR);
    
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function search_dishes($queryDishes) {
    $database = new Database();
    $db = $database->getConnection();
    
    // Requête pour rechercher les plats par libelle
    $query = "SELECT * FROM plat WHERE libelle LIKE :searchQuery";
    $stmt = $db->prepare($query);
    
    $searchQuery = '%' . $queryDishes . '%';
    
    // Lier la valeur de recherche à la requête préparée
    $stmt->bindValue(':searchQuery', $searchQuery, PDO::PARAM_STR);
    
    $stmt->execute();
    
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
    $query = "INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) VALUES (:plat_id, :quantite, :total, NOW(), 'En préparation', :nom_client, :telephone_client, :email_client, :adresse_client)";
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

// --------------------------------LOGIN/SIGNUP
function userExists($pdo, $email) {
    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function registerUser($pdo, $nom_prenom, $email, $password) {
    $database = new Database();
    $db = $database->getConnection();
    $stmt = $db->prepare("INSERT INTO utilisateur (nom_prenom, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$nom_prenom, $email, password_hash($password, PASSWORD_DEFAULT)]);
}

function loginUser($identifier, $password) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM utilisateur WHERE email = :identifier OR nom_prenom = :identifier";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':identifier', $identifier);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        return $user; // Renvoyez les informations de l'utilisateur en cas de réussite
    }
    
    return null; // Renvoyez null en cas d'échec
}


// ---------------------------------------Dashboard
function get_all_categories() {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM categorie";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_all_plats() {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM plat";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function updateCategory($db, $id, $libelle, $active, $imagePath) {
    $query = "UPDATE categorie SET libelle = :libelle, active = :active";
    
    if ($imagePath !== null) {
        $query .= ", image = :image";
    }

    $query .= " WHERE id = :id";

    $stmt = $db->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
    $stmt->bindParam(':active', $active, PDO::PARAM_STR);

    if ($imagePath !== null) {
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
    }

    return $stmt->execute();
}

function deleteCategory($db, $id) {
    $query = "DELETE FROM categorie WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function updatePlat($db, $id, $libelle, $description, $prix, $id_categorie, $active, $imagePath) {
    $query = "UPDATE plat SET libelle = :libelle, description = :description, prix = :prix, id_categorie = :id_categorie, active = :active";
    
    if ($imagePath !== null) {
        $query .= ", image = :image";
    }

    $query .= " WHERE id = :id";

    $stmt = $db->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
    $stmt->bindParam(':active', $active, PDO::PARAM_STR);

    if ($imagePath !== null) {
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
    }

    return $stmt->execute();
}


function deletePlat($db, $id) {
    $query = "DELETE FROM plat WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function addCategory($db, $libelle, $active, $imagePath) {
    $query = "INSERT INTO categorie (libelle, active, image) VALUES (:libelle, :active, :imagePath)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':active', $active);
    $stmt->bindParam(':imagePath', $imagePath);

    $stmt->execute();
}

function addPlat($db, $libelle, $description, $prix, $active, $id_categorie, $imagePath) {
    $query = "INSERT INTO plat (libelle, description, prix, active, id_categorie, image) VALUES (:libelle, :description, :prix, :active, :id_categorie, :imagePath)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':active', $active);
    $stmt->bindParam(':id_categorie', $id_categorie);
    $stmt->bindParam(':imagePath', $imagePath);

    $stmt->execute();
}

function get_all_orders() {
    $database = new Database();
    $db = $database->getConnection();

    $query = 'SELECT * FROM commande'; 
    $statement = $db->prepare($query);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function update_order($id, $quantite, $total, $etat) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE commande SET quantite = :quantite, total = :total, etat = :etat WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':etat', $etat);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}

function delete_order($id) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "DELETE FROM commande WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':id', $id);

    $stmt->execute();
}

?>