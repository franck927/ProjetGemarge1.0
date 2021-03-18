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
$module=explode('|',$module);
$annee=explode('|',$ann_sco);
// Si vide
if(empty($annee[0]) || empty($annee[1]) || empty($module[0]) || empty($module[1])){
	die('<h3 style="color:red;">TOUS LES CHAMPS SONT OBLIGATOIRES</h3>');
}
// Ecriture
$valeur='
<?php 
// Modifier le '.$jour.'
$idann_sco='.$annee[0].'; 
$ann_sco="'.$annee[1].'";
$idmodule="'.$module[0].'";
$module="'.$module[1].'";
?>';
$fichier= "../include/annee_scolaire.php";
$fo=fopen($fichier,"w");
$go=fputs($fo,$valeur);
fclose($fo);
if($go){
	header ('Location:'.HOME_LINK.'?&ajoutyes');
	} else 
		{ die ('IMPOSSIBLE DE CHANGER L\'ANNEE, CONTACTER L\'ADMINISTRATEUR');}
}
?>

</body>
</html>