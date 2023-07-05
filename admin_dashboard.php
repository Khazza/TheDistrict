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

<div class="container dashboard my-5">

    <!-- Affichage du message s'il existe -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
    <!-- Affichage du message de création s'il existe -->
    <?php if (isset($_SESSION['creation_message'])) : ?>
        <div class="alert alert-info">
            <?php
            echo $_SESSION['creation_message'];
            unset($_SESSION['creation_message']);
            ?>
        </div>
    <?php endif; ?>
    <!-- Affichage du message de suppression s'il existe -->
    <?php if (isset($_SESSION['deletion_message'])) : ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['deletion_message'];
            unset($_SESSION['deletion_message']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Section de gestion des catégories -->
    <div class="card mb-5">
        <div class="card-header custom-header-categories">
            <h2>Gestion des catégories</h2>
        </div>
        <div class="card-body">

            <!-- Ajout de la section pour ajouter une nouvelle catégorie -->
            <h3 class="mb-3">Ajouter une nouvelle catégorie</h3>
            <form action="add_category.php" method="post" enctype="multipart/form-data" class="mb-4">
                <div class="form-group mb-2">
                    <label for="libelle">Libelle:</label>
                    <input type="text" name="libelle" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="image">Image: </label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>
                <div class="form-group mb-2">
                    <label for="active">Active:</label>
                    <select name="active" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </form>

            <!-- Tableau des catégories existantes -->
            <div class="table-responsive">
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Libelle</th>
                            <th>Active</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $categorie) : ?>
                            <tr>
                                <form action="update_category.php" method="post" enctype="multipart/form-data">
                                    <td><?php echo $categorie['id']; ?></td>
                                    <td><input type="text" name="libelle" class="form-control" value="<?php echo $categorie['libelle']; ?>"></td>
                                    <td>
                                        <select name="active" class="form-control">
                                            <option value="Yes" <?php if ($categorie['active'] === 'Yes') echo 'selected'; ?>>Yes</option>
                                            <option value="No" <?php if ($categorie['active'] === 'No') echo 'selected'; ?>>No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="image">Image: </label>
                                        <input type="file" name="image" class="form-control-file">
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>">
                                        <input type="submit" value="Modifier" class="btn btn-secondary mb-1">
                                        <a href="delete_category.php?id=<?php echo $categorie['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?');">Supprimer</a>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Section de gestion des plats -->
    <div class="card">
        <div class="card-header custom-header-plats">
            <h2>Gestion des plats</h2>
        </div>
        <div class="card-body">
            <!-- Ajout de la section pour ajouter un nouveau plat -->
            <h3 class="mb-3">Ajouter un nouveau plat</h3>
            <form action="add_plat.php" method="post" enctype="multipart/form-data" class="mb-4">
                <div class="form-group mb-2">
                    <label for="libelle">Libelle:</label>
                    <input type="text" name="libelle" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="prix">Prix:</label>
                    <input type="number" step="0.01" name="prix" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="image">Image: </label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>
                <div class="form-group mb-2">
                    <label for="active">Active:</label>
                    <select name="active" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="id_categorie">Catégorie:</label>
                    <select name="id_categorie" class="form-control">
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['libelle']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </form>

            <div class="table-responsive">
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

                        echo "<table class='table dashboard-table'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Libelle</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Active</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";

                        // Itérer sur les plats de cette catégorie
                        foreach ($plats_by_category[$categorie['id']] as $plat) {
                            echo "<tr>
                            <form action='update_plat.php' method='post' enctype='multipart/form-data'>
                                <td>{$plat['id']}</td>
                                <td><input type='text' name='libelle' class='form-control' value='{$plat['libelle']}'></td>
                                <td><textarea name='description' class='form-control' >{$plat['description']}</textarea></td>
                                <td><input type='text' name='prix' class='form-control' value='{$plat['prix']}'></td>
                                <td>
                                    <select name='active' class='form-control'>
                                        <option value='Yes'" . ($plat['active'] === 'Yes' ? ' selected' : '') . ">Yes</option>
                                        <option value='No'" . ($plat['active'] === 'No' ? ' selected' : '') . ">No</option>
                                    </select>
                                </td>
                                <td>
                                    <label for='image'>Image:</label>
                                    <input type='file' name='image' class='form-control-file'>
                                </td>
                                <td>
                                    <input type='hidden' name='id' value='{$plat['id']}'>
                                    <input type='hidden' name='id_categorie' value='{$plat['id_categorie']}'>
                                    <input type='submit' value='Modifier' class='btn btn-secondary mb-1'>
                                    <a href='delete_plat.php?id={$plat['id']}' class='btn btn-danger' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce plat?');\">Supprimer</a>
                                </td>
                            </form>
                        </tr>";
                        }

                        echo "</tbody></table>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

<!-- Section de gestion des commandes -->
<div class="card mt-5">
    <div class="card-header custom-header-orders">
        <h2>Gestion des commandes</h2>
    </div>
    <div class="card-body">

        <!-- Tableau des commandes existantes -->
        <div class="table-responsive">
            <table class="table dashboard-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Plat</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Date Commande</th>
                        <th>État</th>
                        <th>Nom Client</th>
                        <th>Téléphone Client</th>
                        <th>Email Client</th>
                        <th>Adresse Client</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <!-- Les commandes seront insérées ici par JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <button onclick="prevPage()">Précédent</button>
            <button onclick="nextPage()">Suivant</button>
        </div>

    </div>
</div>


</div>

<!-- Bootstrap JS, jQuery -->
<script src="./js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>