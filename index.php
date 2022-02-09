<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: connexion.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur le site</title>

    <link rel="stylesheet" href="style.css">

    <!-- icône du site -->
    <link rel="icon" href="https://zupimages.net/up/21/14/sinq.png">

    <!-- CDN Google Font Police -->
    <link href="https://fonts.googleapis.com/css2?family=Sirin+Stencil&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Menu de la page -->
    <?php
    if (isset($_SESSION['id'])) {
        include('menu.php');
    }
    ?>

    <!-- Affiche l'email de l'utilisateur -->
    <h1 class="mon_titre">Bonjour, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b><br> Je vous souhaite la bienvenue sur notre site.</h1>

    <div class="contenu_titre">
        <h2 class="accueil_titre">SUSHI DELIVERY <br> Pour vous servir, où vous voulez, quand vous voulez, comme vous voulez ! C’est vous qui décidez !</h2>
    </div>

    <div class="contenu_intro">
        <p class="intro_texte">Froides ou chaudes, sucrées ou salées, nos spécialités sont exclusivement préparées à la commande, avec des ingrédients de première qualité. <br>
        Et si vous aimez la couleur, les saveurs inattendues, les recettes revisitées et les surprises culinaires, vous êtes bien tombés. Nos chefs ont de l’imagination ! Chez nous, on aime la nouveauté !</p>
    </div>

    <!-- images de présentation -->
    <div class="slideshow">
        <ul>
            <li><img src="https://www.toulouscope.fr/wp-content/uploads/2016/09/10608-makis-saumon-avocat-avocado-salmon-sushi-rolls-1-of-1-3-759x500.jpg" alt="" width="100%" height="100%"></li>
            <li><img src="https://www.laboutiquedusushi.fr/wp-content/uploads/2019/11/sushi-jonage.jpg" alt="" width="100%" height="100%"></li>
            <li><img src="https://sakura1060.be/wp-content/uploads/2019/05/PlateauPetitBateau.jpg" alt="" width="100%" height="100%"></li>
        </ul>
    </div>

    <div class="contenu_intro">
        <p class="intro_texte">Envie de surprendre et de régaler vos convives ? Nous nous occupons de tout !</p>
    </div>

    <div class="contenu_intro">
        <p class="intro_texte">Inspirées des traditions japonaises, nos recettes et compositions sont réalisées à partir de produits frais de premier choix.<br>
        Notre petit truc en plus : des recettes revisités grâce à une touche d’inventivité et de créativité supplémentaire pour un plaisir toujours renouvelé.</p>
    </div>

    <!-- Bas de page -->
    <?php
        include('footer.php');
    ?>
</body>
</html>
