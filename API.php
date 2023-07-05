<?php
header('Content-Type: application/json');

require_once 'Database.php';
require_once 'DAO.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

switch ($action) {
    case 'get_orders':
        echo json_encode(get_orders_with_pagination($page));
        break;
    default:
        echo json_encode(['error' => 'Action non spécifiée ou non prise en charge.']);
        break;
}

function get_orders_with_pagination($page) {
    $database = new Database();
    $db = $database->getConnection();

    $limit = 10;
    $offset = ($page - 1) * $limit;

    $query = 'SELECT * FROM commande LIMIT :limit OFFSET :offset'; 
    $statement = $db->prepare($query);
    
    $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>
