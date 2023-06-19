<?php
include 'database.php';
include 'DAO.php';
include './template/functions.php';
?>

<!-- Appel de la fonction pour afficher le header -->
<?php render_header(); ?>

<div class="legal-and-privacy">
    <h1>Mentions légales</h1>
    
    <h2>Société éditrice du site</h2>
    <p><strong>The District</strong></p>
    <p>SAS au capital de 250.000 euros</p>
    <p>N° TVA : FR 01 123456789</p>
    <p>Code NAF : 4791A</p>
    <p>Siège social :</p>
    <address>
        123 rue de la Gastronomie, <br>
        75001 Paris
    </address>
    <p>Tél : 01 23 45 67 89</p>
    <p>Mail : <a href="mailto:reply@thedistrict.com">reply@thedistrict.com</a></p>
    
    <h2>Directeur de publication</h2>
    <p>Justin Case</p>
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
