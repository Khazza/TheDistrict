<?php
// Appel des fonctions pour afficher le header
render_header();
?>

<div class="container dashboard">

    <!-- Formulaire d'ajout de plat -->
    <div class="row">
        <div class="col-12">
            <form action="add_plat.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4 form-group mb-2">
                        <label for="libelle">Libelle:</label>
                        <input type="text" name="libelle" class="form-control" required>
                    </div>
                    <div class="col-md-8 form-group mb-2">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group mb-2">
                        <label for="prix">Prix (en euros):</label>
                        <input type="number" step="0.01" name="prix" class="form-control" required>
                    </div>
                    <div class="col-md-4 form-group mb-2">
                        <label for="id_categorie">Catégorie:</label>
                        <select name="id_categorie" class="form-control">
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['libelle']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 form-group mb-2">
                        <label for="ingredients">Ingrédients:</label>
                        <textarea name="ingredients" class="form-control" required></textarea>
                    </div>
                </div>
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </form>
        </div>
    </div>

    <!-- Tableau des plats existants -->
    <div class="row">
        <div class="col-12">
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
                        <?php
                        foreach ($plats as $plat) {
                            render_plat_row($plat);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Appel des fonctions pour afficher le footer
render_footer();
?>
