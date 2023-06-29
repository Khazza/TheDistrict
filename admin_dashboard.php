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

    <!-- Ajout de la section pour ajouter une nouvelle catégorie -->
    <h3>Ajouter une nouvelle catégorie</h3>
    <form action="add_category.php" method="post" enctype="multipart/form-data">
        <label for="libelle">Libelle:</label>
        <input type="text" name="libelle" required>
        <label for="image">Image:</label>
        <input type="file" name="image" required>
        <label for="active">Active:</label>
        <select name="active">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
        <input type="submit" value="Ajouter">
    </form>

    <table class="dashboard-table">
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>Active</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($categories as $categorie) : ?>
            <tr>
                <form action="update_category.php" method="post" enctype="multipart/form-data">
                    <td><?php echo $categorie['id']; ?></td>
                    <td><input type="text" name="libelle" value="<?php echo $categorie['libelle']; ?>"></td>
                    <td>
                        <select name="active">
                            <option value="Yes" <?php if ($categorie['active'] === 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($categorie['active'] === 'No') echo 'selected'; ?>>No</option>
                        </select>
                    </td>
                    <td>
                        <label for="image">Image:</label>
                        <input type="file" name="image">
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

    <!-- Ajout de la section pour ajouter un nouveau plat -->
    <h3>Ajouter un nouveau plat</h3>
    <form action="add_plat.php" method="post" enctype="multipart/form-data">
        <label for="libelle">Libelle:</label>
        <input type="text" name="libelle" required>
        <label for="description">Description:</label>
        <input type="text" name="description" required>
        <label for="prix">Prix:</label>
        <input type="number" step="0.01" name="prix" required>
        <label for="image">Image:</label>
        <input type="file" name="image" required>
        <label for="active">Active:</label>
        <select name="active">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
        <label for="id_categorie">Catégorie:</label>
        <select name="id_categorie">
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['libelle']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ajouter">
    </form>

    <?php
    // Regrouper les plats par catégorie
    $plats_by_category = [];
    foreach ($plats as $plat) {
        $plats_by_category[$plat['id_categorie']][] = $plat;
    }

    // Itérer sur les catégories
    foreach ($categories as $categorie) {
        if (isset($plats_by_category[$categorie['id']])) {
            echo "<h3 class='category-title'>{$categorie['libelle']}</h3>";

            echo "<table class='dashboard-table'>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Active</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>";

            // Itérer sur les plats de cette catégorie
            foreach ($plats_by_category[$categorie['id']] as $plat) {
                echo "<tr>
                    <form action='update_plat.php' method='post' enctype='multipart/form-data'>
                        <td>{$plat['id']}</td>
                        <td><input type='text' name='libelle' value='{$plat['libelle']}'></td>
                        <td><input type='text' name='description' value='{$plat['description']}'></td>
                        <td><input type='text' name='prix' value='{$plat['prix']}'></td>
                        <td>
                            <select name='active'>
                                <option value='Yes'" . ($plat['active'] === 'Yes' ? ' selected' : '') . ">Yes</option>
                                <option value='No'" . ($plat['active'] === 'No' ? ' selected' : '') . ">No</option>
                            </select>
                        </td>
                        <td>
                            <label for='image'>Image:</label>
                            <input type='file' name='image'>
                        </td>
                        <td>
                            <input type='hidden' name='id' value='{$plat['id']}'>
                            <input type='hidden' name='id_categorie' value='{$plat['id_categorie']}'>
                            <input type='submit' value='Modifier'>
                            <a href='delete_plat.php?id={$plat['id']}' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce plat?');\">Supprimer</a>
                        </td>
                    </form>
                </tr>";
            }

            echo "</table>";
        }
    }
    ?>

</div>

<?php render_footer(); ?>
