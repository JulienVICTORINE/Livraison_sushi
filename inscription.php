<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nom = $prenom = $email = $password = $confirm_password = "";
$role = "logisticien";
$nom_err = $prenom_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate le nom
    if(empty(trim($_POST["nom"]))){
        $nom_err = "Please enter a lastname.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM utilisateur WHERE nom = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nom);
            
            // Set parameters
            $param_nom = trim($_POST["nom"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $nom_err = "This lastname is already taken.";
                } else{
                    $nom = trim($_POST["nom"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate le prénom
    if(empty(trim($_POST["prenom"]))){
        $prenom_err = "Please enter a firstname.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM utilisateur WHERE prenom = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_prenom);
            
            // Set parameters
            $param_prenom = trim($_POST["prenom"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $prenom_err = "This firstname is already taken.";
                } else{
                    $prenom = trim($_POST["prenom"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate address email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an address email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM utilisateur WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This address email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["mot_de_passe"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["mot_de_passe"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["mot_de_passe"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($nom_err) && empty($prenom_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO utilisateur (nom, prenom, role, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_nom, $param_prenom, $param_role, $param_email, $param_password);
            
            // Set parameters
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_role = $role;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: connexion.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">

    <!-- CDN Google Front Police -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sirin+Stencil&display=swap" rel="stylesheet">

    <link rel="icon" href="https://zupimages.net/up/21/14/sinq.png">
</head>
<body>

    <!-- Formulaire d'inscription -->
    <form class="formulaire_inscription" action="" method="post">

        <!-- titre du formulaire -->
        <h2 class="formulaire_titre">Inscrivez-vous !</h2>
        <br>

        <!-- Nom-->
        <label class="label" for="nom">Nom<br>
            <input required class="input_formulaire <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>" id="nom" type="text" name="nom" value="<?php echo $nom; ?>"><br>
            <span class="invalid-feedback"><?php echo $nom_err; ?></span>
        </label>
        <br>

        <!-- prenom-->
        <label class="label" for="prenom">Prénom<br>
            <input class="input_formulaire <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" id="prenom" type="text" name="prenom" value="<?php echo $prenom; ?>"><br>
            <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
        </label>
        <br>

        <!-- Email-->
        <label class="label" for="email">Adresse E-mail<br>
            <input class="input_formulaire <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" id="email" type="email" name="email" value="<?php echo $email; ?>"><br>
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </label>
        <br>

        <!-- Mot de passe-->
        <label class="label" for="mot_de_passe">Mot de passe <br>
            <input class="input_formulaire <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="mot_de_passe" type="password" name="mot_de_passe" value="<?php echo $password; ?>"><br>
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </label>
        <br>

        <!-- Confirmation du mot de passe-->
        <label class="label" for="mot_de_passe_conf">Confirmez votre mot de passe<br>
            <input class="input_formulaire <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="mot_de_passe_conf" type="password" name="confirm_password" value="<?php echo $confirm_password; ?>"><br>
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </label>
        <br>

        <!-- Bouton de connexion -->
        <input type="submit" value="S'inscrire" class="formulaire_bouton">
        <br>

        <p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>
    </form>
    <!-- Fin du formulaire d'inscription -->
</body>
</html>