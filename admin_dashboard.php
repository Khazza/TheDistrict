<?php
session_start();

include 'database.php';
include 'DAO.php';
include './template/functions.php';

if (!isset($_SESSION['user']['nom_prenom']) || $_SESSION['user']['role'] !== 'admin') {
    // Rediriger vers la page de connexion ou une page d'erreur
    header('Location: login.php');
    exit();
}


// Appel de la fonction pour afficher le header
render_header();

// Récupération des catégories et plats de la base de données
$categories = get_all_categories();
$plats = get_all_plats();
?>

<div class="container dashboard">

    <!-- Section de gestion des catégories -->
    <h2>Gestion des catégories</h2>
    <table class="dashboard-table">
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($categories as $categorie) : ?>
            <tr>
                <form action="update_category.php" method="post">
                    <td><?php echo $categorie['id']; ?></td>
                    <td><input type="text" name="libelle" value="<?php echo $categorie['libelle']; ?>"></td>
                    <td>
                        <select name="active">
                            <option value="Yes" <?php if ($categorie['active'] === 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($categorie['active'] === 'No') echo 'selected'; ?>>No</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>">
                        <input type="submit" value="Modifier">
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Section de gestion des plats -->
    <h2>Gestion des plats</h2>
    <table class="dashboard-table">
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($plats as $plat) : ?>
            <tr>
                <form action="update_plat.php" method="post">
                    <td><?php echo $plat['id']; ?></td>
                    <td><input type="text" name="libelle" value="<?php echo $plat['libelle']; ?>"></td>
                    <td><input type="text" name="description" value="<?php echo $plat['description']; ?>"></td>
                    <td><input type="text" name="prix" value="<?php echo $plat['prix']; ?>"></td>
                    <td>
                        <select name="active">
                            <option value="Yes" <?php if ($plat['active'] === 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($plat['active'] === 'No') echo 'selected'; ?>>No</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $plat['id']; ?>">
                        <input type="submit" value="Modifier">
                        <a href="delete_plat.php?id=<?php echo $plat['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat?');">Supprimer</a>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php render_footer(); ?>