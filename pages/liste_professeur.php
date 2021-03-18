<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<script>
function deleteThing(id){
	var idmatieres=id;
swal({   title: "Êtes-vous sûr?",   
text: "De vouloir supprimer cette information définitivement? Elle ne sera pas supprimée si elle est liée à d\'autres informations",   
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
      url:'traitement/supp_prof.php?id='+idmatieres, //===PHP file name====
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
<title>Liste des Professeurs - GeMarge ::: Logiciel D'émargement</title>
<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="./">Liste</a></li>
											<li class="active">Liste des Professeurs</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
<!--DEBUT CONTENU-->
<div class="clearfix"></div>

<h3 class="inner-tittle two">Liste des Professeurs/Enseignants <a href="#" name="listeProf">#</a> 
<a href="?/NouveauProf/" class="btn btn-primary">Ajouter un Nouveau Professeur</a></h3>
<div class="graph">
<div class="tables">
<table class="table table-bordered"> 
<thead> 
<tr> 
<th>N°</th> 
<th>NOM</th>
<th>PRENOMS</th> 
<th>SEXE</th>  
<th>DATE NAI.</th> 
<th>CONTACT</th> 
<th>PROFESSION</th>
<th>DIPLÔME</th>  
<th>ACTION</th> 
</tr> 
</thead>
 <tbody>
<?php 
$actif=1;
$sql=$mysqli->prepare("SELECT idprofesseurs,nom,prenoms,sexe,date_nai,contacts,adresse,email,profession,diplome,photo FROM professeurs WHERE actif=?") or die(mysqli_error($mysqli));
$sql->bind_param('i',$actif);
$sql->execute();
$sql->bind_result($idprofesseurs,$nom,$prenoms,$sexe,$date_nai,$contacts,$adresse,$email,$profession,$diplome,$photo);
$sql->store_result();
$i=0;
while($sql->fetch()){
	$i++;
?>  
 <tr> 
 <th scope="row"><?php echo $i; ?></th> 
 <td><?php echo htmlentities($nom); ?></td> 
 <td><?php echo htmlentities($prenoms); ?></td> 
 <td><?php echo htmlentities($sexe); ?></td> 
 <td><?php echo htmlentities($date_nai); ?></td>
 <td><?php echo htmlentities($contacts); ?></td>
 <td><?php echo htmlentities($profession); ?></td>
 <td><?php echo htmlentities($diplome); ?></td>
 <td>
 <a href="?/DetailsProf/&prof=<?php echo encode($idprofesseurs); ?>" title="Details"><i class="fa fa-user"></i></a> /|\ 
 <a href="#" data-toggle="modal" data-target="#Modifier<?php echo $i; ?>" title="Modifier"><i class="fa fa-edit"></i></a> /|\ 
 <a href="#" id="<?php echo htmlentities($idprofesseurs); ?>" onClick="deleteThing(this.id)" title="Supprimer"><i class="fa fa-cut"></i></a>
 <!-- Modal Modifier-->
<div id="Modifier<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modification des info du Professeur</h4>
      </div>
      <div class="modal-body">
        <form action="traitement/modif_prof.php" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo intval($idprofesseurs); ?>" name="idprof" />
        Nom:
        <input type="text" value="<?php echo htmlentities($nom); ?>" name="nom" class="form-control control-label" />
        Prenoms:
        <input type="text" value="<?php echo htmlentities($prenoms); ?>" name="prenoms" class="form-control control-label" />
        Date de Naissance:
        <input type="text" value="<?php echo htmlentities($date_nai); ?>" name="date_nai" class="form-control control-label" />
        Sexe:
        <select name="sexe" class="control-label form-control" required>
        <option value="<?php echo htmlentities($sexe); ?>"><?php echo htmlentities($sexe); ?></option>
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
        </select>
        Contact:
        <input type="text" value="<?php echo htmlentities($contacts); ?>" name="contacts" class="form-control control-label" />
        Email:
        <input type="text" value="<?php echo htmlentities($email); ?>" name="email" class="form-control control-label" />
        Adresse:
        <input type="text" value="<?php echo htmlentities($adresse); ?>" name="adresse" class="form-control control-label" />
        profession:
        <input type="text" value="<?php echo htmlentities($profession); ?>" name="profession" class="form-control control-label" />
        Diplôme:
        <input type="text" value="<?php echo htmlentities($diplome); ?>" name="diplome" class="form-control control-label" />
        
        <input type="submit" name="go" class="btn btn-success" value="Valider" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>
    </div>

  </div>
</div>
<!--FIN MODAL MODIFIER-->
 </td>
 </tr>
<?php }?> 
 </tbody> 
 </table> 
															</div>
													</div>
										</div>
<!--FIN DERNIER EMARGEMENT--> 
<!--FIN CONTENU-->
										</div>
										<!--//graph-visual-->