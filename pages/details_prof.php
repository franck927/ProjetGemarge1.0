<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<script>
function deleteThing(id){
	var idmatieres=id;
swal({   title: "Êtes-vous sûr?",   
text: "De vouloir supprimer cette information définitivement? Elle ne sera pas supprimée si elle est liée à d\'autres informations. Tels que les émargements",   
type: "warning",   
showCancelButton: true,   
confirmButtonColor: "#DD6B55",   
confirmButtonText: "Oui, Supprimer!",   
cancelButtonText: "Non, Annuler!",   
closeOnConfirm: false,   
closeOnCancel: false }, 
function(isConfirm){   
	if (isConfirm) { 	    
		//swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
		//
		$("input,select,textarea,a"),
		$.ajax({
      url:'traitement/supp_matieres_prof.php?id='+idmatieres, //===PHP file name====
      data:$(this).serialize(),
      type:'GET',
	  grouped: true,
      success:function(data){
        console.log(data);
        //Success Message == 'Title', 'Message body', Last one leave as it is
	    swal("¡Success!", "Information supprimée!", "success");
		location.reload();
      },
      error:function(data){
        //Error Message == 'Title', 'Message body', Last one leave as it is
	    swal("Oops...", "Cette information ne peut être supprimée :(", "error");
      }
    });
		//  
		} else {     
			swal("Annulé", "Suppression Annulée :)", "error");   
			} 
		} 
	);
	
}

</script>
<?php 
extract($_GET);
if(empty($prof)){ die('<h3 style="color:red;">VALEUR VIDE</h3>');}
$idprof=decode($prof);
// receuill des info
$sql=$mysqli->prepare("SELECT idprofesseurs,nom,prenoms,sexe,date_nai,contacts,adresse,email,profession,diplome,photo FROM professeurs WHERE idprofesseurs=?")or die(mysqli_error($mysqli));
$sql->bind_param('i',$idprof);
$sql->execute();
$sql->bind_result($idprofesseurs,$nom,$prenoms,$sexe,$date_nai,$contacts,$adresse,$email,$profession,$diplome,$photo);
$sql->store_result();
$sql->fetch();
?>
<title>Détails du professeur - GeMarge ::: Logiciel D'émargement</title>
<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="./">Détails</a></li>
											<li class="active">Détails du professeur</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">Détails du professeur</h2>
												<div class="graph">
														 <div class="block-page">
<!--DEBUT CONTENU-->
<div style="float:left; width:30%">
<strong>Informations Générales:</strong>
<hr />
<strong>Nom:</strong> <?php echo htmlentities($nom); ?><br />
<strong>Prenoms:</strong> <?php echo htmlentities($prenoms); ?><br />
<strong>Sexe:</strong> <?php echo htmlentities($sexe); ?><br />
<strong>Date de naissance:</strong> <?php echo htmlentities($date_nai); ?><br />
<strong>Contact:</strong> <?php echo htmlentities($contacts); ?><br />
<strong>Adresse: </strong><?php echo htmlentities($adresse); ?><br />
<strong>Email:</strong> <?php echo htmlentities($email); ?><br />
<strong>Profession:</strong> <?php echo htmlentities($profession); ?><br />
<strong>Diplôme:</strong> <?php echo htmlentities($diplome); ?><br />
</div>
<strong>Matières Enseignées:</strong>
<hr />
<?php 
$sql=$mysqli->prepare("SELECT idmatieres_enseignees,matieres,filiere,nbr_heure,cout_heure FROM matieres_enseignees NATURAL JOIN matieres NATURAL JOIN filiere WHERE idprofesseurs=? AND idmodule=? AND idann_sco=?")or die(mysqli_error($mysqli));
$sql->bind_param('iii',$idprof,$idmodule,$idann_sco);
$sql->execute();
$sql->bind_result($idmat_ens,$matieres,$filiere,$nbr_h,$cout_h);
$sql->store_result();
while($sql->fetch()){
	echo '<strong>Filière:</strong> '.$filiere .' => <strong>Matieres:</strong> '. $matieres .' - 
	('.$nbr_h.'h, <strong>Cout/h:</strong> '.number_format($cout_h,0,',','.').')
	<a href="#" id="'.encode($idmat_ens).'" onclick="deleteThing(this.id)" title="Supprimer"><i class="fa fa-cut"></i></a><br>';
}
?>
<div class="clearfix"></div>
<br /><br />
<strong>Emargement effectués par le Professeur par mois:</strong>
<?php 
$sql=$mysqli->prepare("SELECT EXTRACT(MONTH from date_emar) AS mois, COUNT(*) nbr FROM emargement  WHERE idprofesseurs=? AND idmodule=? AND idann_sco=? GROUP BY EXTRACT(MONTH from date_emar)")or die(mysqli_error($mysqli));
$sql->bind_param('iii',$idprof,$idmodule,$idann_sco);
$sql->execute();
$sql->bind_result($moi,$nbr);
$sql->store_result();
$i=0;
while($sql->fetch()){
	$i++;
?>
<a href="#" data-toggle="modal" data-target="#DetailsEmargement<?php echo $i; ?>"><?php echo leMois($moi).' ('.$nbr.' fois)'; ?></a> /|\ 
<!-- Modal Modifier-->
<div id="DetailsEmargement<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Détails Emargement: <?php echo leMois($moi); ?></h4>
        <a href="" onclick="printDiv('print')">Imprimier</a>

      </div>
      <div class="modal-body">
      <div id="print">
<strong>Professeur:</strong> <?php echo htmlentities($nom); ?> <?php echo htmlentities($prenoms); ?>  | Mois: <?php echo leMois($moi); ?>     
<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col">N°</th>
    <th scope="col">FILIERES</th>
    <th scope="col">MATIERES</th>
    <th scope="col">H. EFF.</th>
    <th scope="col">COUT/H</th>
    <th scope="col">TOTAL</th>
    <th scope="col">DATE</th>
  </tr>
<?php 
$set=$mysqli->prepare("SELECT idfiliere,filiere,idmatieres,matieres,date_emar,heure_eff FROM emargement NATURAL JOIN filiere NATURAL JOIN matieres WHERE idprofesseurs=? AND idmodule=? AND idann_sco=? AND EXTRACT(MONTH from date_emar)=?") or die(mysqli_error($mysqli));
$set->bind_param('iiii',$idprof,$idmodule,$idann_sco,$moi);
$set->execute();
$set->bind_result($idfi,$fi,$idma,$ma,$d_emar,$heure_eff);
$set->store_result();
$i=0;
while($set->fetch()){
	$i++;
?>  
  <tr>
    <td><?php echo htmlentities($i); ?></td>
    <td><?php echo htmlentities($fi); ?></td>
    <td><?php echo htmlentities($ma); ?></td>
    <td><?php echo htmlentities($heure_eff); ?></td>
    <td><?php echo $couth=CoutHeure('matieres_enseignees','cout_heure','idfiliere','idmatieres','idmodule','idann_sco',$idfi,$idma,$idmodule,$idann_sco,$mysqli); ?></td>
    <td><?php echo number_format($heure_eff*$couth,0,',','.'); ?></td>
    <td><?php echo htmlentities($d_emar); ?></td>
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
<?php	
}
?>
<!--FIN CONTENU-->
																
                                                                </div>
										        </div>
										</div>
										<!--//graph-visual-->