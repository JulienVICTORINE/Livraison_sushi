<?php
    if(isset($_POST['supprimer'])) {
        header('location: cuisine.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sushi Delivery - Suppression</title>
</head>
<body>

    <!-- Menu du site -->
    <?php
        include ('menu.php');
    ?>

    <!-- Formulaire de suppression -->
    <?php
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=sushi;charset=utf8', 'phpmyadmin', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $reponse = $bdd->query('SELECT * FROM sushis');
    while ($donnees = $reponse->fetch()) {
        echo '<form method="post">';
        echo '<input type="hidden" name="id" value="' . $donnees['id'] . '">';
        echo '<input   type="text" name="md_nom" value="' . $donnees['nom'] . '">';

        echo '<input type="submit" class="formulaire_bouton" name="supprimer" value="Supprimer">';
        echo '</form>';

        //Supprimer les données
        if (isset($_POST['supprimer'])) {
            $requete = 'DELETE FROM sushis WHERE id="' . $_POST['id'] . '"';
            $resultat = $bdd->query($requete);
        }
    }
    ?>

    <!-- Bas de page -->
    <?php
        include ('footer.php');
    ?>
</body>
</html>

