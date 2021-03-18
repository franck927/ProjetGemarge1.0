<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<title>Changement d'Anneée Scolaire - GeMarge ::: Logiciel D'émargement</title>
<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="index.html">Configuration</a></li>
											<li class="active">Changement d'Anneée Scolaire</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">Changement de l'Anneée Scolaire</h2>
                                            <strong style="color:red;">Attention:</strong> Si vous changez l'année scolaire, les données enregistrées sous une autre année ne seront pas visibles. Seule celle choisie.
												<div class="graph">
														 <div class="block-page">
<!--DEBUT CONTENU-->
<div class="form-body">
<div data-example-id="simple-form-inline"> 
<form class="form-inline" action="traitement/trai_change_ann_sco.php" method="post">
Année Scolaire:
<select name="ann_sco" class="control-label" required>
<option value="">-- Choisissez --</option>
<?php 
$sql=$mysqli->prepare("SELECT idann_sco,ann_sco FROM ann_sco ORDER BY ann_sco DESC");
$sql->execute();
$sql->bind_result($idan,$ann);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo intval($idan); ?>|<?php echo htmlentities($ann); ?>"><?php echo htmlentities($ann); ?></option>
<?php }?>
</select> 
Module:
<select name="module" class="control-label" required>
<option value="">-- Choisissez --</option>
<?php 
$sql=$mysqli->prepare("SELECT idmodule,module FROM module");
$sql->execute();
$sql->bind_result($idmo,$mo);
$sql->store_result();
while($sql->fetch()){
?>
<option value="<?php echo intval($idmo); ?>|<?php echo htmlentities($mo); ?>"><?php echo htmlentities($mo); ?></option>
<?php }?>
</select>
<input type="submit" class="btn btn-primary" value="Valider le Changement" name="go" />
</form>
</div>
</div>

<!--FIN CONTENU-->
																
                                                                </div>
										        </div>
<div id="txtHint3"></div>											
										</div>
										<!--//graph-visual-->