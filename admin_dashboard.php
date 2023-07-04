<?php
session_start();

include 'database.php';
include 'DAO.php';
include './template/functions.php';

if (!isset($_SESSION['user']['nom_prenom']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

render_header();

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
                                            <option value="Yes" <?php if ($categorie['active'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                            <option value="No" <?php if ($categorie['active'] == 'No') echo 'selected'; ?>>No</option>
                                        </select>
                                    </td>
                                    <td><input type="file" name="image" class="form-control-file"></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>">
                                        <input type="submit" value="Modifier" class="btn btn-warning">
                                    </td>
                                </form>
                                <td>
                                    <form action="delete_category.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>">
                                        <input type="submit" value="Supprimer" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Fin de la section de gestion des catégories -->

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
                    <label for="image">Image: </label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>
                <div class="form-group mb-2">
                    <label for="prix">Prix:</label>
                    <input type="number" step="0.01" name="prix" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="categorie">Catégorie:</label>
                    <select name="categorie" class="form-control">
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['libelle']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </form>

            <!-- Tableau des plats triés par catégorie -->
            <div class="table-responsive">
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Libelle</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>Image</th>
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
                                        <select name="categorie" class="form-control">
                                            <?php foreach ($categories as $categorie) : ?>
                                                <option value="<?php echo $categorie['id']; ?>" <?php if ($categorie['id'] == $plat['categorie']) echo 'selected'; ?>><?php echo $categorie['libelle']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="file" name="image" class="form-control-file"></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $plat['id']; ?>">
                                        <input type="submit" value="Modifier" class="btn btn-warning">
                                    </td>
                                </form>
                                <td>
                                    <form action="delete_plat.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $plat['id']; ?>">
                                        <input type="submit" value="Supprimer" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Fin de la section de gestion des plats -->
</div>

<?php
render_footer();
?>