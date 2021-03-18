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
if(isset($_POST['go'])){
extract($_POST);
// si vide
if(empty($idprof) || empty($idfilere) || empty($idmatieres) || empty($cout_heure) || empty($nbr_heure)){
	die('<h3 align="center" style="color:red;">TOUS LES CHAMPS SONT OBLIGATOIRES</h3>');
}
// Si pas numeric
if(empty($cout_heure) || empty($nbr_heure)){
	die('<h3 align="center" style="color:red;">LE NOMBRE D\'HEURE ET LE COUT PAR HEURE DOIT ETRE NUMERIC</h3>');
}
	// Si existe deja un Emargement pour le jour actuel, pr le prof, filier, matiere
	if(!empty(siYaTrois('matieres_enseignees','nbr_heure','idprofesseurs','idfiliere','idmatieres',$idprof,$idfilere,$idmatieres,$mysqli))){
		die('<h3 align="center" style="color:red;">CETTE MATIERE ET FILIERE ONT DEJA ETE ATTRIBUEES A CE PROFESSEUR</h3>');
	}
	// Cout total des heure a effectuer
	$cout_total=$cout_heure*$nbr_heure;
	// Insertion dans la DB
	$sql=$mysqli->prepare("INSERT INTO matieres_enseignees (idprofesseurs,idfiliere,idmatieres,nbr_heure,cout_heure,cout_total,idmodule,idann_sco) VALUES (?,?,?,?,?,?,?,?)") or die(mysqli_error($mysqli));
	$sql->bind_param('iiiiiiii',$idprof,$idfilere,$idmatieres,$nbr_heure,$cout_heure,$cout_total,$idmodule,$idann_sco);
	if(!$sql->execute()){
		die('<h3 style="color:red;" align="center">ERREUR</h3>'.mysqli_error($mysqli));
	} else{
		header('Location:'.$_SERVER['HTTP_REFERER'].'&ajoutyes');
	}
}
?>
</body>
</html>