<?php
include 'database.php';
include 'DAO.php';
include './template/functions.php';
?>

<!-- Appel de la fonction pour afficher le header -->
<?php render_header(); ?>

<div class="legal-notice">
    <h1>Mentions légales</h1>
    
    <h2>Société éditrice du site</h2>
    <p><strong>The District</strong></p>
    <p>SAS au capital de 00.000 euros</p>
    <p>N° TVA : FR XX XXXXXXXXX</p>
    <p>Code NAF : 4791A</p>
    <p>Siège social :</p>
    <address>
        XXX avenue d'XXXXXX, <br>
        XXXXX XXXXXXXXX
    </address>
    <p>Tél : -- -- -- -- --</p>
    <p>Mail : <a href="mailto:reply@thedistrict.com">reply@thedistrict.com</a></p>

    <h2>Directeur de publication</h2>
    <p>Prenom NOM</p>
    <p>Mail : <a href="mailto:reply@thedistrict.com">reply@thedistrict.com</a></p>

    <h2>Hébergeur du site</h2>
    <p><strong>OVH</strong></p>
    <p>SAS au capital de 10.069.020 euros</p>
    <p>Siège social :</p>
    <address>
        2 rue Kellermann, <br>
        59100 Roubaix
    </address>
    <p>Tél : 1007</p>
    <p>Mail : <a href="mailto:contact@ovh.com">contact@ovh.com</a></p>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>
