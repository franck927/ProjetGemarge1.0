<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<script>
function newValue(id){
	//var idmatieres=$('#idmatieres').data('id');
	//var idFilieres=id;
swal({   title: "Nouvelle Anneée Scolaire!",   
text: "Entrez la Nouvelle Anneée Scolaire:",   
type: "input",   
showCancelButton: true,   
closeOnConfirm: false,   
animation: "slide-from-top",   
inputPlaceholder: "Anneée Scolaire: 2016-2017" }, 
function(inputValue){   
	if (inputValue === false) return false;      
		if (inputValue === "") {     
		swal.showInputError("Vous devez écrire quelque chose!");     return false   
		}
//
//$("input,select,textarea,a"),
		$.ajax({
      url:'traitement/trai_ajout_ann_sco.php?text='+inputValue, //===PHP file name====
      data:$(this).serialize(),
      type:'GET',
	  grouped: true,
      success:function(data){
        console.log(data);
	    swal("¡Success!", "Information Ajouter!", "success");
		location.reload();
      },
      error:function(data){
	    swal("Oops...", "Cette information ne peut être supprimée ", "error");
      }
    });
//    
//swal("Nice!", "You wrote: " + inputValue, "success"); 
});
}
</script>
<title>Ajout d'Anneée Scolaire - GeMarge ::: Logiciel D'émargement</title>
<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="index.html">Configuration</a></li>
											<li class="active">Ajout d'Anneée Scolaire</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">Nouvelle Anneée Scolaire</h2>
												<div class="graph">
														 <div class="block-page">
<!--DEBUT CONTENU-->
<div class="form-body">
<div data-example-id="simple-form-inline"> 
<form class="form-inline"> 
<a href="#" id="1" onClick="newValue(this.id)" class="control-label btn btn-primary">Nouvelle Anneée Scolaire</a>
</form>
</div>
</div>

<!--DENIERE EMARGEMENT-->
<h3 class="inner-tittle two">Les Anneée Scolaire Disponibles</h3>
<div class="graph">
<div class="tables">
<table class="table table-bordered"> 
<thead> 
<tr> 
<th>N°</th> 
<th>ANNEES SCOLAIRES</th> 
<th>ACTION</th> 
</tr> 
</thead>
 <tbody>
<?php 
$sql=$mysqli->prepare("SELECT idann_sco,ann_sco FROM ann_sco ORDER BY ann_sco DESC") or die(mysqli_error($mysqli));
$sql->execute();
$sql->bind_result($idann,$ann);
$sql->store_result();
$i=0;
while($sql->fetch()){
	$i++;
?>  
 <tr> 
 <th scope="row"><?php echo $i; ?></th> 
 <td><?php echo htmlentities($ann); ?></td> 
 <td><!--<a href="#" id="<?php //echo htmlentities($idfiliere); ?>" onClick="deleteThing(this.id)" title="Supprimer">X</a>--></td>
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
										        </div>
<div id="txtHint3"></div>											
										</div>
										<!--//graph-visual-->