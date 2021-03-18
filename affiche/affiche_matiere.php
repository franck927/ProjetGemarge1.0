<?php
require('../config/config.php'); 
include('../include/fonction.php');
require('../include/annee_scolaire.php');
extract($_GET);
$q=explode('|',$q);
?>
<div class="col-lg-3"> 
<select name="idmatieres" class="control-label" onchange="showEmarg(this.value)">
<option value="">Choisissez la matière</option>
<?php 
$sql=$mysqli->prepare("SELECT idmatieres,matieres,cout_heure FROM matieres_enseignees NATURAL JOIN matieres WHERE idprofesseurs=? AND idfiliere=? AND idmodule=? AND idann_sco=?") or die(mysqli_error($mysqli));
$sql->bind_param('iiii',$q[1],$q[0],$idmodule,$idann_sco);
$sql->execute();
$sql->bind_result($idmatieres,$matieres,$cout_heure);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo $q[1]?>|<?php echo $q[0]?>|<?php echo intval($idmatieres);?>|<?php echo intval($cout_heure); ?>"><?php echo htmlentities($matieres); ?></option>
<?php }?>
</select>
</div> 