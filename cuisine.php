<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="affichage.css">
</head>
<body>

    <!-- Menu du site -->
    <?php
        include('menu.php');
    ?>

    <!-- Affichage des données -->
    <?php
        $bdd = new PDO('mysql:host=localhost;dbname=sushi;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $reponse = $bdd->query('SELECT * FROM sushis');
        echo '<div class="container2">';
        while ($donnees = $reponse->fetch()) {
            echo '<div class="contenu_principal">';
            echo '<div class="nom">' . $donnees['nom'] . '</div>';
            echo '<div class="miniature"><img class="img" src="' . $donnees['image'] . '"></div>';
            echo '<div class="description">';
            echo '<span>' . $donnees['description'] . '</span>';
            echo '</div>';
            echo '<div class="prix">' . $donnees['prix'] . '€</div>';

            echo "<a href=\"modifier_sushi.php\"><input type=\"submit\" value=\"Modifier\"></a>";
            echo "<a href=\"supprimer_sushi.php\"><input type=\"submit\" value=\"Supprimer\"></a>";
            echo '</div>';
        }
        echo '</div>';
    ?>

    <!-- Bas de page -->
    <?php
        include('footer.php');
    ?>
</body>
</html>