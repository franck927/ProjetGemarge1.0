<?php
require('config/config.php'); 
include('include/fonction.php');
require('include/annee_scolaire.php'); 
sec_session_start();
inactivite(); 
if(login_check($mysqli) == true ) {
         //Add your protected page content here!
} else { 
        header ('Location: '.HOME_LINK.'login.php');
}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- jQuery -->
<link href='css/google.css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- /js -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/css3clock.js"></script>
<script src="js/skycons.js"></script>
<!-- //js-->
<!-- This is what you need -->
  <script src="sweetalert-master/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="sweetalert-master/dist/sweetalert.css">
  <!--.......................-->
<!--PRINT DIV-->
<script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>
<!-- FIN PRINT DIV -->  
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
	<div class="left-content">
	   <div class="inner-content">
		<!-- header-starts -->
<?php include('include/menu.php'); ?>			
						<!--outter-wp-->
<?php if(isset($_GET['ajoutyes'])){?>
<script>swal("Génial","L\'information a été ajoutee","success");</script> 
<?php }elseif(isset($_GET['bienvenue'])){?>
<script>swal("Bienvenue","GeMarge: Logiciel de gestion d\'émargement des Professeurs, Enseignants...");</script> 
<?php }?>                       
							<div class="outter-wp">
<?php 
if(isset($_GET['/NouveauEmargement/'])){ define('page',true); include('pages/new_emargement.php');}
elseif(isset($_GET['/DetailsEmargement/'])){ define('page',true); include('pages/details_emargement.php');}
elseif(isset($_GET['/AjoutMatieres/'])){ define('page',true); include('pages/ajout_matieres.php');}
elseif(isset($_GET['/AjoutFiliere/'])){ define('page',true); include('pages/ajout_filieres.php');}
elseif(isset($_GET['/AjoutModule/'])){ define('page',true); include('pages/ajout_modules.php');}
elseif(isset($_GET['/AnneeScolaire/'])){ define('page',true); include('pages/ajout_ann_sco.php');}
elseif(isset($_GET['/ChangerAnnSco/'])){ define('page',true); include('pages/changer_ann_sco.php');}
elseif(isset($_GET['/NouveauProf/'])){ define('page',true); include('pages/ajout_professeur.php');}
elseif(isset($_GET['/ListeProf/'])){ define('page',true); include('pages/liste_professeur.php');}
elseif(isset($_GET['/DetailsProf/'])){ define('page',true); include('pages/details_prof.php');}
elseif(isset($_GET['/AttributionMatiereProf/'])){ define('page',true); include('pages/attri_matiere_prof.php');}
elseif(isset($_GET['/Configuration/'])){ define('page',true); include('pages/configuration_main.php');}
elseif(isset($_GET['/EtatDesEmargements/'])){ define('page',true); include('pages/etat_emargement.php');}
elseif(isset($_GET['DetailsEmargementProf'])){ define('page',true); include('pages/etat_emargement.php');}// Detail Emargement par prof
else{
?> 
<title>GeMarge ::: Logiciel D'émargement</title>                           
									<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="./">Accueil</a></li>
											<li class="active">Principale</li>
										</ol>
									   </div>
								  <!--//sub-heard-part-->
									<div class="graph-visual tables-main">
											<h2 class="inner-tittle">Tableau de Bord</h2>
<?php include('include/statistique.php'); ?>                                            
												
                                                
<hr>
<!--DENIERE EMARGEMENT-->
<h3 class="inner-tittle two">Emargements du jour (<?php echo $jour; ?>)</h3>
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
$sql=$mysqli->prepare("SELECT idemargement,nom,prenoms,filiere,matieres,heure_eff,date_emar FROM emargement NATURAL JOIN filiere NATURAL JOIN matieres NATURAL JOIN professeurs WHERE idmodule=? AND idann_sco=? AND date_ajout=?") or die(mysqli_error($mysqli));
$sql->bind_param('iis',$idmodule,$idann_sco,$jour);
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
 <td><a href="#" id="<?php echo htmlentities($idemar); ?>" onClick="deleteThing(this.id)" title="Supprimer">X</a></td>
 </tr>
<?php }?> 
 </tbody> 
 </table> 
															</div>
													</div>
										</div>
<!--FIN DERNIER EMARGEMENT-->                                               
											
										</div>
										<!--//graph-visual-->
<?php }?>                                        
									</div>
									<!--//outer-wp-->
									 <!--footer section start-->
										<footer>
										   <p>&copy 2016 GeMarge . All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a> - Développé par <a href="http://djadjatechnology.com">Gueu Pacôme</a> - Facebook: <a href="">Eburnilive Eburnie</a></p>
										</footer>
									<!--footer section end-->
								</div>
							</div>
				<!--//content-inner-->
			<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo">
					<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="./"> <span id="logo"> <h1>GeMarge</h1></span> 
					<!--<img id="logo" src="" alt="Logo"/>--> 
				  </a> 
				</header>
			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
			<!--/down-->
							<div class="down">	
									  <a href="./"><img src="images/admin.jpg"></a>
									  <a href="./"><span class=" name-caret">Gueu Pacôme</span></a>
									 <p>Développeur Web</p>
									<ul>
                                    <li><a class="tooltips" href="?/infoCommentUtiliser/"><span>Info</span><i class="fa fa-info"></i></a></li>
                                    <li><a class="tooltips" href="?/ChangerAnnSco/"><span>Année</span><i class="fa fa-calendar-o"></i></a></li>
									<li><a class="tooltips" href="#"><span>Profil</span><i class="fa fa-user"></i></a></li>
										<li><a class="tooltips" href="?/Configuration/"><span>Config</span><i class="fa fa-gears"></i></a></li>
										<li><a class="tooltips" href="deconnexion.php"><span>Déco</span><i class="fa fa-power-off"></i></a></li>
										</ul>
                                        <hr>
                                        <strong style="color:#F00">Année Sco:</strong> <?php echo $ann_sco; ?><br>
                                        <strong style="color:#F00">Module:</strong>  <?php echo $module; ?>
									</div>
							   <!--//down-->
								<div class="menu">
									<ul id="menu" >
										<li><a href="./"><i class="fa fa-tachometer"></i> <span>Tableau de Bord</span></a></li>
										 <li id="menu-academico" ><a href="#"><i class="fa fa-users"></i> <span> Professeurs</span> <span class="fa fa-angle-right" style="float: right"></span></a>
										   <ul id="menu-academico-sub" >
											<li id="menu-academico-avaliacoes" ><a href="?/NouveauProf/"> Nouveau Prof</a></li>
											<li id="menu-academico-avaliacoes" ><a href="?/ListeProf/">Détails des Prof.</a></li>
                                            <li id="menu-academico-avaliacoes" ><a href="?/EtatDesEmargements/">L'état des émargements.</a></li>
											
										  </ul>
										</li>
										 <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i> <span>Matières</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
												<li id="menu-academico-boletim" ><a href="?/AttributionMatiereProf/">Attribution de Mati.</a></li>
											  </ul>
										 </li>
									<li><a href="#"><i class="fa fa-pencil"></i> <span>Emargements</span><span class="fa fa-angle-right" style="float: right"></span></a>
                                    <ul id="menu-academico-sub" >
										    <li id="menu-academico-avaliacoes" ><a href="?/NouveauEmargement/">Emargement</a></li>
										    <li id="menu-academico-boletim" ><a href="?/DetailsEmargement/">Détails Emargements</a></li>
										  </ul>
                                    </li>
									<li id="menu-academico" ><a href="#"><i class="fa fa-gears"></i> <span>Configuration</span> <span class="fa fa-angle-right" style="float: right"></span></a>
										  <ul id="menu-academico-sub" >
										    <li id="menu-academico-avaliacoes" ><a href="?/AjoutMatieres/">Ajout de Matieres</a></li>
										    <li id="menu-academico-boletim" ><a href="?/AjoutFiliere/">Ajout de Filières</a></li>
											<li id="menu-academico-boletim" ><a href="?/AjoutModule/">Ajout de Module</a></li>
											<li id="menu-academico-boletim" ><a href="?/AnneeScolaire/">Année Scolaire</a></li>
										  </ul>
									 </li>
									 
									
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
	<!--<script src="js/jquery.nicescroll.js"></script>-->
	<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>