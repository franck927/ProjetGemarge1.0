<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<title>L'état des Emargements - GeMarge ::: Logiciel D'émargement</title>
<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="index.html">L'état des Emargements</a></li>
											<li class="active">Etat</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">L'état des émargements du 
                                            <u><?php echo $module; ?></u> de l'année <u><?php echo $ann_sco; ?></u></h2>
												<div class="graph">
														 <div class="block-page">
<!--DEBUT CONTENU-->
<?php
// recuperation des ID de chaque Prof qui ont emargé 
$sql=$mysqli->prepare("SELECT professeurs.idprofesseurs,nom,prenoms,contacts,sexe FROM professeurs INNER JOIN emargement ON professeurs.idprofesseurs=emargement.idprofesseurs WHERE idmodule=? AND idann_sco=? GROUP BY idprofesseurs") or die(mysqli_error($mysqli));
$sql->bind_param('ii',$idmodule,$idann_sco);
$sql->execute();
$sql->bind_result($id,$nom,$prenoms,$contact,$sexe);
$sql->store_result();
while($sql->fetch()){
?>
<a href="?DetailsEmargementProf&details=<?php echo encode($id); ?>" class="btn btn-success"><?php echo htmlentities($nom) ?> <?php echo htmlentities($prenoms) ?></a> /|\  
<?php }?>
<!--FIN CONTENU-->
																
                                                                </div>
										        </div>
										</div>
										<!--//graph-visual-->
<hr />                                        
<?php 
// Details des emargement par Prof
if(isset($_GET['DetailsEmargementProf'])){
	extract($_GET);
?>
<a href="?/DetailsProf/&prof=<?php echo $details; ?>" class="btn btn-primary">Voir l'état mensuel</a>  <a href="#" class="btn btn-primary" onclick="printDiv('impression')">Imprimer cet état</a>
<div id="impression">
<?php 
$sql=$mysqli->prepare("SELECT nom,prenoms,contacts FROM professeurs WHERE idprofesseurs=?") or die(mysqli_error($mysqli));
$sql->bind_param('i',decode($details));
$sql->execute();
$sql->bind_result($nom,$prenoms,$contact);
$sql->store_result();
$sql->fetch();
?>
<h3>Etat de <strong><?php echo htmlentities($nom. ' ' .$prenoms. '('. $contact.')'); ?> </strong> du <u><?php echo $module; ?></u> de l'année <u><?php echo $ann_sco; ?></u></h3>
<div class="graph">
<div class="tables">
<table class="table table-bordered"> 
<thead> 
<tr> 
<th>N°</th> 
<th>PROFESSEURS</th> 
<th>HEURES EFF.</th> 
<th>COÛT/HEURE</th> 
<th>TOTAL </th> 
<th>FILIERES</th> 
<th>MATIERES</th>
<th>DATES EMAR.</th>
</tr> 
</thead>
 <tbody>
<?php 
// Recuperation des emargement des prof Selon leur ID
$cool=$mysqli->prepare("SELECT nom,prenoms,idfiliere,idmatieres,heure_eff,gain,date_emar,cout_heure FROM emargement NATURAL JOIN professeurs NATURAL JOIN matieres_enseignees WHERE idprofesseurs=? AND idmodule=? AND idann_sco=?") or die(mysqli_error($mysqli));
$cool->bind_param('iii',decode($details),$idmodule,$idann_sco);
$cool->execute();
$cool->bind_result($nom,$prenoms,$idfiliere,$idmatieres,$heure_eff,$gain,$date_emar,$cou);
$cool->store_result();
$i=0;
while($cool->fetch()){
	$i++;
	$tt[] = $gain;
	// Affichage
?>
<!--<h3 class="inner-tittle two">L'état des Emargements</h3>-->

 <tr> 
 <th scope="row"><?php echo $i; ?></th> 
 <td><?php echo htmlentities($nom); ?> <?php echo htmlentities($prenoms); ?></td> 
 <td><?php echo htmlentities($heure_eff); ?>h</td>
 <td><?php echo number_format($cou,0,',','.'); ?></td>
 <td><?php echo number_format($gain,0,',','.');?></td> 
 <td><?php echo infoBull('filiere','filiere','idfiliere',$idfiliere,$mysqli); ?></td> 
 <td><?php echo infoBull('matieres','matieres','idmatieres',$idmatieres,$mysqli); ?></td>
 <td><?php echo htmlentities($date_emar); ?></td>
 </tr>

<?php }?>
 </tbody> 
 </table>
 <?php 
 if(is_array($tt)){
	 $total=array_sum($tt);
 }
 ?> 
    <h3 align="center">TOTAL A PAYER: <?php echo number_format($total,0,',','.'); ?></h3>

		</div>
	</div>
</div>
<?php }?>                                        