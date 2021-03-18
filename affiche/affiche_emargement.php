<?php
require('../config/config.php'); 
include('../include/fonction.php');

extract($_GET);
$id=explode('|',$q);
?>
<hr />
<form action="traitement/trai_emargement.php" method="post">
<div class="col-lg-3"> 
Heure effectuée <em>(Ex: 3.30)</em>:
<input type="text" class="control-label form-control" name="heure_eff" value="" required="required" />
</div>
<div class="col-lg-3"> 
Titre du Cours effectué :
<input type="text" class="control-label form-control" name="cours_eff" value="" required="required" />
</div>
<div class="col-lg-3">
Date d'émargement: 
<input type="date" class="control-label form-control" name="date_emar" value="" required="required" />
</div>
<div class="col-lg-3">
<input type="hidden" value="<?php echo $id[0]; ?>" name="idprof" />
<input type="hidden" value="<?php echo $id[1]; ?>" name="idfil" />
<input type="hidden" value="<?php echo $id[2]; ?>" name="idmat" />
<input type="hidden" value="<?php echo $id[3]; ?>" name="cout_heure" />
<input type="submit" class="control-label form-control" name="Valider" value="VALIDER"/>
</div>
</form> 