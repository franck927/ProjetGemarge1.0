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
if(isset($_POST['Valider'])){
extract($_POST);
// si vide
if(empty($idprof) || empty($idfil) || empty($idmat) || empty($heure_eff) || empty($cours_eff) || empty($date_emar)){
	die('<h3 align="center" style="color:red;">TOUS LES CHAMPS SONT OBLIGATOIRES</h3>');
}
	// Si heure pas numeric
	if(!is_numeric($heure_eff)){
		die('<h3 align="center" style="color:red;">L\'HEURE EFFECTUEE N\'EST PAS NUMERIC</h3>');
	}
	// Si existe deja un Emargement pour le jour actuel, pr le prof, filier, matiere
	if(!empty(siExiste('emargement','date_emar','idprofesseurs','idfiliere','idmatieres',$date_emar,$idprof,$idfil,$idmat,$jour,$mysqli))){
		die('<h3 align="center" style="color:red;">CE PROFESSEUR A DEJA EMARGE DANS CETTE FILIERE ET POUR CETTE MATIERE AUJOURD\'HUI</h3>');
	}
	// Insertion dans la DB
	$cout_heure=$cout_heure*$heure_eff;
	$sql=$mysqli->prepare("INSERT INTO emargement (idprofesseurs,idfiliere,idmatieres,heure_eff,gain,titre_cours,date_emar,date_ajout,idcompte,idmodule,idann_sco) VALUES (?,?,?,?,?,?,?,now(),?,?,?)") or die(mysqli_error($mysqli));
	$sql->bind_param('iiissssiii',$idprof,$idfil,$idmat,$heure_eff,$cout_heure,$cours_eff,$date_emar,$_SESSION['idcompte'],$idmodule,$idann_sco);
	if(!$sql->execute()){
		die('<h3 style="color:red;" align="center">ERREUR</h3>'.mysqli_error($mysqli));
	} else{
		header('Location:'.$_SERVER['HTTP_REFERER'].'&ajoutyes');
	}
}
?>
</body>
</html>