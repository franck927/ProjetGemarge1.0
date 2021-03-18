<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<title>Attribution de Matières au Professeur - GeMarge ::: Logiciel D'émargement</title>
<!--sub-heard-part-->
									  
                                      <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="index.html">Attribution </a></li>
											<li class="active">Attribution de Matières au Professeur</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">Attribution de Matières au Professeur</h2>
<!--DEBUT CONTENU-->
<div class="form-body">
<div data-example-id="simple-form-inline"> 
<form class="form-inline" action="traitement/trai_attri_mat_prof.php" method="post"> 
<div class="col-lg-3">
Professeur: 
<select name="idprof" class="control-label" required>
<option value="">Choisissez le professeur</option>
<?php 
$sql=$mysqli->prepare("SELECT idprofesseurs,nom,prenoms FROM professeurs WHERE actif=1") or die(mysqli_error($mysqli));
$sql->execute();
$sql->bind_result($idprof,$nom,$prenoms);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo intval($idprof);?>"><?php echo htmlentities($nom). ' ' .htmlentities($prenoms); ?></option>
<?php }?>
</select>
</div> 
<div class="col-lg-3"> 
Filiere enseignée:
<select name="idfilere" class="control-label" required>
<option value="">Choisissez la filière</option>
<?php 
$sql=$mysqli->prepare("SELECT idfiliere,filiere FROM filiere") or die(mysqli_error($mysqli));
$sql->execute();
$sql->bind_result($idfiliere,$filiere);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo intval($idfiliere);?>"><?php echo htmlentities($filiere); ?></option>
<?php }?>
</select>
</div> 
<div class="col-lg-3">
Matieres: 
<select name="idmatieres" class="control-label" required>
<option value="">Choisissez la matière</option>
<?php 
$sql=$mysqli->prepare("SELECT idmatieres,matieres FROM matieres") or die(mysqli_error($mysqli));
$sql->execute();
$sql->bind_result($idmatieres,$matieres);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo intval($idmatieres);?>"><?php echo htmlentities($matieres); ?></option>
<?php }?>
</select>
</div> 
<div class="col-lg-3"> 
Heure Total:
<input type="number" name="nbr_heure" value="" placeholder="Nbr Heure total" required="required" />
</div>
<div class="col-lg-3">
Coût par Heure:
<input type="number" name="cout_heure" value="" placeholder=" Cout par heure" required="required" />
</div>
<div class="col-lg-3"><input type="submit" class="control-label" name="go" value="Attribuer" /></div>
</form>
</div>
</div>
<!--FIN CONTENU-->
										</div>
										<!--//graph-visual-->