<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sushi Delivery - Modifier un sushi</title>
    
    <!-- Fichier CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- CDN Google Font Police -->
    <link href="https://fonts.googleapis.com/css2?family=Sirin+Stencil&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Menu du site -->
    <?php
        include('menu.php');
    ?>

    <!-- Formulaire de modification -->
    <form class="formulaire_modification" action="" method="post">
        <!-- titre du formulaire -->
        <h2 class="formulaire_titre">Modifier un sushi!</h2>
        <br>

        <!-- Modifier le nom -->
        <div>
            <input type="text" name="nom" id="nom" value=<?php echo $sushi['nom']; ?>>
        </div>

        <!-- Modifier la description -->
        <div>
            <input type="text" name="description" id="description" value=<?php echo $sushi['description']; ?>>
        </div>

        <!-- Modifier le prix -->
        <div>
            <input type="number" name="prix" id="prix" value=<?php echo $sushi['prix']; ?>>
        </div>

        <!-- Modifier le lien de la miniature -->
        <div>
            <input type="text" name="image" id="miniature" value=<?php echo $sushi['image']; ?>>
        </div>

        <!-- Bouton de modification -->
        <input type="submit" value="Valider" class="formulaire_bouton" name="submit_sushis">
    </form>
    <!-- Fin du formulaire -->

    <!-- Bas de page -->
    <?php
        include('footer.php');
    ?>
</body>
</html>