<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création produit</title>

    <link rel="stylesheet" href="ajout_produit.css">

    <link rel="icon" href="https://zupimages.net/up/21/14/sinq.png">

    <!-- CDN Google Font Police -->
    <link href="https://fonts.googleapis.com/css2?family=Sirin+Stencil&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Menu du site -->
    <?php
        include('menu.php');
    ?>

    <!-- Formulaire d'ajout -->
    <div class="contenu_centre">
                <form class = "formulaire_ajouter" action="" method="post">
            <!-- titre du formulaire -->
            <h2 class="formulaire_titre">Ajouter un produit</h2>
            <br>

            <!-- Nom du produit -->
            <label clas="label" for="nom">Nom du produit <br>
                 <input type="text" name="nom" id="nom" placeholder="Entrez le nom du produit">
            </label>
            <br>

            <!-- Description du produit -->
            <label clas="label" for="description">Description <br>
                <input type="text" name="description" id="description" placeholder="Entrez une description">
            </label>
            <br>

            <!-- Prix du produit -->
            <label clas="label" for="prix">Prix <br>
                <input type="number" name="prix" id="prix" placeholder="Entrer le prix">
            </label>
            <br>

            <!-- Miniature du produit -->
            <label clas="label" for="miniature">Miniature <br>
                <input type="text" name="image" id="image" placeholder="Entrez le lien de l'image">
            </label>
            <br>

            <!-- Bouton d'ajout -->
            <input type="submit" value="Ajouter un produit" class="formulaire_bouton" name="valider">
        </form>
    </div>

        <!-- Insérer des données dans la base de données et les afficher le site -->
        <?php
            // si les champs sont vides, alors on complète
            if (isset($_POST['nom']) & isset($_POST['description']) & isset($_POST['prix']) & isset($_POST['image'])) {
                $bdd = new PDO('mysql:host=localhost;dbname=sushi;charset=utf8', 'phpmyadmin', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $reponse = $bdd->query('SELECT * FROM sushis');

                $requete = 'INSERT INTO sushis VALUES(NULL, "' . $_POST['nom'] . '", "' . $_POST['description'] . '", "' . $_POST['prix'] . '", "' . $_POST['image'] . '")';
                $resultat = $bdd->query($requete);
            }
        ?>

    <?php
        include('footer.php');
    ?>
</body>
</html>