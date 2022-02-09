<?php
    if(isset($_POST['modifier'])) {
        header('location: cuisine.php');
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sushi Delivery - Modification</title>

    <!-- icône du site -->
    <link rel="icon" href="https://zupimages.net/up/21/14/sinq.png">

    <!-- CDN Google Font Police -->
    <link href="https://fonts.googleapis.com/css2?family=Sirin+Stencil&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Menu du site -->
    <?php
        include('menu.php');
    ?>

    <!-- Afficher les données à modifier -->
    <?php
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=sushi;charset=utf8', 'phpmyadmin', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $reponse = $bdd->query('SELECT * FROM sushis');
        while ($donnees = $reponse->fetch()) {
            echo '<form method="post">';
            echo '<input type="hidden" name="id" value="' . $donnees['id'] . '">';
            echo '<input type="text" name="md_nom" value="' . $donnees['nom'] . '">';
            echo '<input type="text" name="md_description" value="' . $donnees['description'] . '">';
            echo '<input type="number" name="md_prix" value="' . $donnees['prix'] . '">';
            echo '<input type="text" name="md_miniature" value="' . $donnees['image'] . '">';
            echo '<input type="submit" class="formulaire_bouton" name="modifier" value="Modifier">';
            echo '</form>';
        
            // Modifier les données
            if (isset($_POST['modifier'])) {
                $requete = 'UPDATE sushis SET nom="' . $_POST['md_nom'] . '" , description="' . $_POST['md_description'] . '" , prix="' . $_POST['md_prix'] . '" , image="' . $_POST['md_miniature'] . '"  WHERE id="' . $_POST['id'] . '"';
                $resultat = $bdd->query($requete);
            }
        }
    ?>
    <!-- Fin du traitement -->

    <!-- Bas de page -->
    <?php
        include('footer.php');
    ?>
</body>
</html>