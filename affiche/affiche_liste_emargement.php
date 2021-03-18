<?php
require('../config/config.php'); 
include('../include/fonction.php');
include('../include/annee_scolaire.php');

extract($_GET);
$id=explode('|',$q);
//var_dump($id[0]);
//var_dump($id[1]);
//var_dump($id[2]);
?>

<input type="hidden" value="<?php echo $id[0]; ?>" name="idprof" />
<input type="hidden" value="<?php echo $id[1]; ?>" name="idfil" />
<input type="hidden" value="<?php echo $id[2]; ?>" name="idmat" />
<hr />
<h3 class="inner-tittle two">Liste des émargements <a href="?/DetailsProf/&prof=<?php echo encode($id[0]); ?>" class="btn btn-primary">(Voir tout)</a></h3>
<strong>Professeur:</strong> <?php echo infoBull('professeurs','nom','idprofesseurs',$id[0],$mysqli); ?> - 
<strong>Filière:</strong> <?php echo infoBull('filiere','filiere','idfiliere',$id[1],$mysqli); ?> - 
<strong>Matière:</strong> <?php echo infoBull('matieres','matieres','idmatieres',$id[2],$mysqli); ?> -
<a href="#" class="btn btn-primary" data-target="#EmarTitre" data-toggle="modal">Détails du cours</a>
<div class="graph">
<div class="tables">
<table class="table table-bordered"> 
<thead> 
<tr> 
<th>N°</th> 
<th>PROFESSEURS</th> 
<th>HEURES EFFECTUEES</th> 
<th>FILIERES</th> 
<th>MATIERES</th>
<th>DATES D'EMARGEMENT</th>
<th>ACTION</th> 
</tr> 
</thead>
 <tbody>
<?php 
$sql=$mysqli->prepare("SELECT idemargement,nom,prenoms,filiere,matieres,heure_eff,date_emar FROM emargement NATURAL JOIN filiere NATURAL JOIN matieres NATURAL JOIN professeurs WHERE idmodule=? AND idann_sco=? AND idprofesseurs=? AND idfiliere=? AND idmatieres=? ORDER BY date_emar DESC") or die(mysqli_error($mysqli));
$sql->bind_param('iiiii',$idmodule,$idann_sco,$id[0],$id[1],$id[2]);
$sql->execute();
$sql->bind_result($idemar,$nom,$prenoms,$filiere,$matieres,$heure_eff,$date_emar);
$sql->store_result();
$i=0;
while($sql->fetch()){
	$i++;
?>  
 <tr> 
 <th scope="row"><?php echo $i; ?></th> 
 <td><?php echo htmlentities($nom); ?> <?php echo htmlentities($prenoms); ?></td> 
 <td><?php echo htmlentities($heure_eff); ?>h</td> 
 <td><?php echo htmlentities($filiere); ?></td> 
 <td><?php echo htmlentities($matieres); ?></td>
 <td><?php echo htmlentities($date_emar); ?></td>
 <td><a href="#" id="<?php echo htmlentities($idemar); ?>" onClick="deleteThing(this.id)" title="Supprimer"><i class="fa fa-cut"</i></a></td>
 </tr>
<?php }?> 
 </tbody> 
 </table>
 
 
  <!-- Modal Modifier-->
<div id="EmarTitre" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Détails Emargement des cours</h4>
        <a href="" onclick="printDiv('print')">Imprimier</a>

      </div>
      <div class="modal-body">
      <div id="print">
<strong>Professeur:</strong> <?php echo htmlentities($nom); ?> <?php echo htmlentities($prenoms); ?> - Titre des cours      
<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col">N°</th>
    <th scope="col">FILIERES</th>
    <th scope="col">MATIERES</th>
    <th scope="col">H. EFF.</th>
    <th scope="col">TITRE</th>
    <th scope="col">DATE</th>
  </tr>
<?php 
$sqlx=$mysqli->prepare("SELECT idemargement,nom,prenoms,filiere,matieres,heure_eff,date_emar,titre_cours FROM emargement NATURAL JOIN filiere NATURAL JOIN matieres NATURAL JOIN professeurs WHERE idmodule=? AND idann_sco=? AND idprofesseurs=? AND idfiliere=? AND idmatieres=? ORDER BY date_emar DESC") or die(mysqli_error($mysqli));
$sqlx->bind_param('iiiii',$idmodule,$idann_sco,$id[0],$id[1],$id[2]);
$sqlx->execute();
$sqlx->bind_result($idemar,$nom,$prenoms,$fili,$mati,$h_eff,$d_ema,$titre_cour);
$sqlx->store_result();
$i=0;
while($sqlx->fetch()){
	$i++;
?>  
  <tr>
    <td><?php echo htmlentities($i); ?></td>
    <td><?php echo htmlentities($fili); ?></td>
    <td><?php echo htmlentities($mati); ?></td>
    <td><?php echo htmlentities($h_eff); ?></td>
    <td><?php echo htmlentities($titre_cour); ?></td>
    <td><?php echo htmlentities($d_ema); ?></td>
  </tr>
  <?php }?>
</table>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>
    </div>

  </div>
</div>
<!--FIN MODAL MODIFIER-->
 
															</div>
													</div>
										</div>
<!--FIN DERNIER EMARGEMENT--> 
<?php exit();?>