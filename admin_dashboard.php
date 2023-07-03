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

    <!-- Affichage des messages s'ils existent -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['creation_message'])) : ?>
        <div class="alert alert-info">
            <?php
            echo $_SESSION['creation_message'];
            unset($_SESSION['creation_message']);
            ?>
        </div>
    <?php endif; ?>
    
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
                <div class="row">
                    <div class="col-md-4 form-group mb-2">
                        <label for="libelle">Libelle:</label>
                        <input type="text" name="libelle" class="form-control" required>
                    </div>
                    <div class="col-md-4 form-group mb-2">
                        <label for="image">Image: </label>
                        <input type="file" name="image" class="form-control-file" required>
                    </div>
                    <div class="col-md-4 form-group mb-2">
                        <label for="active">Active:</label>
                        <select name="active" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
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
                <div class="row">
                    <div class="col-md-3 form-group mb-2">
                        <label for="libelle">Libelle:</label>
                        <input type="text" name="libelle" class="form-control" required>
                    </div>
                    <div class="col-md-3 form-group mb-2">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-2 form-group mb-2">
                        <label for="prix">Prix:</label>
                        <input type="number" step="0.01" name="prix" class="form-control" required>
                    </div>
                    <div class="col-md-2 form-group mb-2">
                        <label for="image">Image: </label>
                        <input type="file" name="image" class="form-control-file" required>
                    </div>
                    <div class="col-md-2 form-group mb-2">
                        <label for="active">Active:</label>
                        <select name="active" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group mb-2">
                        <label for="id_categorie">Catégorie:</label>
                        <select name="id_categorie" class="form-control">
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['libelle']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-8 form-group mb-2">
                        <label for="ingredients">Ingrédients:</label>
                        <textarea name="ingredients" class="form-control" required></textarea>
                    </div>
                </div>
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </form>

            <!-- Tableau des plats existants -->
            <div class="table-responsive">
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Libelle</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Image</th>
                            <th>Catégorie</th>
                            <th>Actif</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($plats as $plat) : ?>
                            <tr>
                                <form action="update_plat.php" method="post" enctype="multipart/form-data">
                                    <td><?php echo $plat['id']; ?></td>
                                    <td><input type="text" name="libelle" class="form-control" value="<?php echo $plat['libelle']; ?>"></td>
                                    <td><textarea name="description" class="form-control"><?php echo $plat['description']; ?></textarea></td>
                                    <td><input type="number" step="0.01" name="prix" class="form-control" value="<?php echo $plat['prix']; ?>"></td>
                                    <td>
                                        <label for="image">Image: </label>
                                        <input type="file" name="image" class="form-control-file">
                                    </td>
                                    <td>
                                        <select name="id_categorie" class="form-control">
                                            <?php foreach ($categories as $categorie) : ?>
                                                <option value="<?php echo $categorie['id']; ?>" <?php if ($plat['id_categorie'] == $categorie['id']) echo 'selected'; ?>><?php echo $categorie['libelle']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="active" class="form-control">
                                            <option value="Yes" <?php if ($plat['active'] === 'Yes') echo 'selected'; ?>>Yes</option>
                                            <option value="No" <?php if ($plat['active'] === 'No') echo 'selected'; ?>>No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $plat['id']; ?>">
                                        <input type="submit" value="Modifier" class="btn btn-secondary mb-1">
                                        <a href="delete_plat.php?id=<?php echo $plat['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat?');">Supprimer</a>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
// Appel de la fonction pour afficher le footer
render_footer();
?>
