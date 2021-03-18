<?php 
// Reporte toutes les erreurs PHP
//error_reporting(E_ALL & ~E_NOTICE); //E_ALL & ~E_NOTICE
//ini_set('display_errors', 1); // Set Error ON 
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "root");    // The database username. 
define("PASSWORD", "");    // The database password. 
define("DATABASE", "emargement"); // Nom de la base de donnée
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
// Si vous utilisez HTTPS changez la valeur en TRUE Ex: define("SECURE", TRUE)
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!! 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// TEST DE CONNEXION 1
if($mysqli->connect_errno > 0){
    die('IMPOSSIBLE DE SE CONNECTER AU SERVEUR' .$mysqli->connect_error);
}
// Si vous n'utilisez pas un port, alors ôtez le numero du port (:81)
// define("HOME_LINK", 'http://localhost:81/Emargement/');
// define("LOGIN_LINK", 'http://localhost:81/Emargement/login.php');
?>