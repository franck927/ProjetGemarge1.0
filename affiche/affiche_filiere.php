<?php
require('../config/config.php'); 
include('../include/fonction.php');
require('../include/annee_scolaire.php');
extract($_GET);
?>
<div class="col-lg-3"> 
Filières:<select name="idfiliere" class="control-label" onchange="showMatiere(this.value)">
<option value="">Choisissez sa filière</option>
<?php 
$sql=$mysqli->prepare("SELECT idfiliere,filiere FROM matieres_enseignees NATURAL JOIN filiere WHERE idprofesseurs=? AND idmodule=? AND idann_sco=? GROUP BY idfiliere") or die(mysqli_error($mysqli));
$sql->bind_param('iii',$q,$idmodule,$idann_sco);
$sql->execute();
$sql->bind_result($idfiliere,$filiere);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo intval($idfiliere);?>|<?php echo $q; ?>"><?php echo htmlentities($filiere); ?></option>
<?php }?>
</select>
</div> 