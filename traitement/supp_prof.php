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
if(isset($_GET['id'])){
extract($_GET);
var_dump($id);
// si vide
if(empty($id)){
	die('<h3 align="center" style="color:red;">TOUS LES CHAMPS SONT OBLIGATOIRES</h3>');
}
	// Suppression dans la DB
	$sql=$mysqli->prepare("DELETE FROM professeurs WHERE idprofesseurs=? LIMIT 1") or die(mysqli_error($mysqli));
	$sql->bind_param('i',$id);
	if(!$sql->execute()){
		die('<h3 style="color:red;" align="center">ERREUR</h3>'.mysqli_error($mysqli));
	} else{
		echo 'BIEN';
	}
}
?>
</body>
</html>