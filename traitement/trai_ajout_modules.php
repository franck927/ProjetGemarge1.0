<?php
require('../config/config.php'); 
include('../include/fonction.php');
require('../include/annee_scolaire.php');
sec_session_start();
inactivite(); 
if(login_check($mysqli) == true ) {
         //Add your protected page content here!
} else { 
        header ('Location: '.HOME_LINK.'login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Traitement</title>
</head>

<body>
<?php 
if(isset($_GET['text'])){
extract($_GET);
var_dump($text);
// si vide
if(empty($text)){
	die('<h3 align="center" style="color:red;">TOUS LES CHAMPS SONT OBLIGATOIRES</h3>');
}
	// Si existe deja un Emargement pour le jour actuel, pr le prof, filier, matiere
	if(!empty(siUnExi('module','module',$text,$mysqli))){
		die('<h3 align="center" style="color:red;">CETTE MATIERE EXISTE DEJA</h3>');
	}
	// Insertion dans la DB
	$sql=$mysqli->prepare("INSERT INTO module (module) VALUES (?)") or die(mysqli_error($mysqli));
	$sql->bind_param('s',$text);
	if(!$sql->execute()){
		die('<h3 style="color:red;" align="center">ERREUR</h3>'.mysqli_error($mysqli));
	} else{
		echo 'BIEN';
	}
}
?>
</body>
</html>