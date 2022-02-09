<?php
/* Informations d'identification de la base de données. En supposant que vous exécutez MySQL
serveur avec paramètre par défaut (utilisateur 'root' sans mot de passe) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'phpmyadmin');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'sushi');
 
/* Tentative de connexion à la base de données MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
