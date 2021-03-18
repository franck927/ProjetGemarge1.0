<?php defined('page') or die('VOUS N\'AVEZ PAS DROIT A CETTE PAGE');?>
<title>Détails des Emargements - GeMarge ::: Logiciel D'émargement</title>
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
      url:'traitement/supp_emargement.php?id='+idmatieres, //===PHP file name====
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

function showFiliere(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","affiche/affiche_filiere.php?q="+str,true);
        xmlhttp.send();
    }
}

function showMatiere(str) {
    if (str == "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","affiche/affiche_matiere.php?q="+str,true);
        xmlhttp.send();
    }
}

function showEmarg(str) {
    if (str == "") {
        document.getElementById("txtHint3").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint3").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","affiche/affiche_liste_emargement.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="index.html">Emargement</a></li>
											<li class="active">Détails</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">Détails émargement</h2>
												<div class="graph">
														 <div class="block-page">
<!--DEBUT CONTENU-->
<div class="form-body">
<div data-example-id="simple-form-inline"> 
<form class="form-inline"> 
<div class="col-lg-3"> 
<select name="idprof" class="control-label" onChange="showFiliere(this.value)">
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
<div id="txtHint"></div>
<div id="txtHint2"></div>
</div>
</div>
<!--FIN CONTENU-->
																
                                                                </div>
										        </div>
<div id="txtHint3"></div>											
										</div>
										<!--//graph-visual-->