<?php
// Initialiser la session
session_start();
 
// Vérifiez si l'utilisateur est déjà connecté, si oui, redirigez-le vers la page d'accueil
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // si les identifiants corresponds, alors on est redirigé vers la page d'accueil
    header("location: index.php");
    exit;
}
 
// Inclure le fichier de configuration
require_once "config.php";
 
// Définir des variables et initialiser avec des valeurs vides
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Traitement des données du formulaire
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Je vérifie que le champs de l'email est vide
    if(empty(trim($_POST["email"]))){
        $email_err = "Merci d'entrer une adresse e-mail.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Je vérifie si le champs du mot de passe est vide
    if(empty(trim($_POST["mot_de_passe"]))){
        $password_err = "Merci d'entrer un mot de passe.";
    } else{
        $password = trim($_POST["mot_de_passe"]);
    }
    
    // Valider les identifiants
    if(empty($email_err) && empty($password_err)){
        // Préparation de la requête
        $sql = "SELECT id, email, mot_de_passe FROM utilisateur WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Lier des variables à l'instruction préparée en tant que paramètres
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Définir les paramètres
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Stocker le résultat
                mysqli_stmt_store_result($stmt);
                
                // Si l'adresse e-mail existe alors on vérifie le mot de passe
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Lier les variables de résultat
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password))
                        {
                            // Le mot de passe est correct, alors démarrez une nouvelle session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            $requete = "SELECT * FROM utilisateur WHERE id ='$id'";
                            if($result = mysqli_query($link, $sql))
                            {
                                // retourne le nombre de lignes
                                if(mysqli_num_rows($result) > 0)
                                {
                                    //retourne la ligne du résultat sous forme de tableau
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo $row['role'];
                                    }
                                    // Close result set
                                    mysqli_free_result($result);
                                } 
                            
                                // Rediriger l'utilisateur vers la page d'accueil
                                if ($role == "logisticien") 
                                {
                                    header("location: index.php");
                                }
                                else {
                                    header("location: admin_utilisateur.php");
                                }

                            } else{
                                // Le mot de passe n'est pas valide, affiche un message d'erreur générique
                                $login_err = "Le mot de passe est invalide.";
                            }
                        }
                    } else{
                        // Le nom d'utilisateur n'existe pas, affiche un message d'erreur générique
                        $login_err = "L'adresse e-mail est invalide.";
                    }
                } else{
                    echo "Oops! Un problème est survenu. Veuillez réessayer plus tard.";
                }
            }

            // Ferme la déclaration
            mysqli_stmt_close($stmt);
        }
    }
    
    // Ferme la connexion
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>

    <link rel="stylesheet" href="style.css">

    <!-- CDN Google Front Police -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sirin+Stencil&display=swap" rel="stylesheet">

    <link rel="icon" href="https://zupimages.net/up/21/14/sinq.png">
</head>
<body>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        
        <!-- Formualaire de connexion -->
        <form class="formulaire_connexion" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Logo du formulaire -->
            <div class="formulaire_logo">
                <img src="logo.png" alt="">
            </div>
            <br>

            <!-- titre du formulaire -->
            <h2 class="formulaire_titre">Connectez-vous !</h2>
            <br>

            <!-- saisir une adresse e-mail -->
            <label class="label" for="email">Adresse e-mail <br>
                <input class="formulaire_entrees <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" type="email" name="email" id="email" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </label>
            <br>

            <!-- saisir un mot de passe -->
            <div>
                <label clas="label" for="mot_de_passe">Mot de passe <br>
                    <input class="formulaire_entrees <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" name="mot_de_passe" id="mot_de_passe">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </label>
                <br>
            </div>
            
            <!-- Bouton de connexion -->
            <input type="submit" value="Se connecter" class="formulaire_bouton">
            <br>

            <p>Vous êtes nouveau ? <a href="inscription.php">Inscrivez-vous maintenant</a></p>
        </form>
        <!-- Fin du formulaire -->
</body>
</html>