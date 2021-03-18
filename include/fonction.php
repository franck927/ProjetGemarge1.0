<?php
$jour=date('Y-m-d');
$annee=date('Y');
$month=date('m');
function aucun($v){
	if(empty($v)){
		return true;
	} else {
		return false;
	}
}
// Si vide
function vide($v){
	if(empty($v)){return 'null';}else{return $v;}
}
// Format argent
function argent($v){
	return number_format($v,0,'','.');
}
// expirer
function expirer($v){
	if($v < date('Y-m-d')){
		return '<b style="color:red;">'.$v.'</b>';
	} else {
		return '<b style="color:green;">'.$v.'</b>';
	}
}
// Ajout jour
function ajoutJour($jour,$ajout){
$dd=date('Y-m-d');	
$j = date_create($jour);
date_add($j, date_interval_create_from_date_string($ajout.' days'));
if(date_format($j,'Y-m-d') < $dd){
	return '<b style="color:red;">'.$jour.'</b>';
} else {
		return '<b style="color:green;">'.$jour.'</b>';
	}
}
//
function get_file_extension( $file )  {
	if( empty( $file ) )
		return;
	// if goes here then good so all clear and good to go
	$ext = end(explode( ".", $file ));
	// return file extension
	return $ext;
}
function siExiste($tbl,$champ,$champ1,$champ2,$champ3,$ref,$ref1,$ref2,$ref3,$jour,$mysqli){
	$query=$mysqli->prepare("SELECT $champ FROM $tbl WHERE $champ=? AND $champ1=? AND $champ2=? AND $champ3=? AND date_emar=?")or die(mysqli_error($mysqli));
		$query->bind_param('siiis',$ref,$ref1,$ref2,$ref3,$jour);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return $db_id;
}
// VERIF
function siUnExi($tbl,$champ,$ref,$mysqli){
	$query=$mysqli->prepare("SELECT $champ FROM $tbl WHERE $champ=?") or die(mysqli_error($mysqli));
		$query->bind_param('s',$ref);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return $db_id;
}
function siYaTrois($tbl,$select,$champ1,$champ2,$champ3,$ref1,$ref2,$ref3,$mysqli){
	$query=$mysqli->prepare("SELECT $select FROM $tbl WHERE $champ1=? AND $champ2=? AND $champ3=?") or die(mysqli_error($mysqli));
		$query->bind_param('iii',$ref1,$ref2,$ref3);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return $db_id;
}
// Statistiques
function state($tbl,$champ,$mysqli){
	$query=$mysqli->prepare("SELECT COUNT($champ) AS tt FROM $tbl"); // or die(mysqli_error($mysqli));
		//$query->bind_param('s',$ref);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return $db_id;
}
function stateDeux($tbl,$champ,$ref,$idan,$idmo,$mysqli){
	$query=$mysqli->prepare("SELECT COUNT($champ) AS tt FROM $tbl WHERE EXTRACT(MONTH FROM date_emar)=? AND idann_sco=? AND idmodule=?"); // or die(mysqli_error($mysqli));
		$query->bind_param('sii',$ref,$idan,$idmo);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return $db_id;
}
function CoutHeure($tbl,$select,$champs1,$champs2,$champs3,$champs4,$ref1,$ref2,$ref3,$ref4,$mysqli){
	$query=$mysqli->prepare("SELECT $select AS tt FROM $tbl WHERE $champs1=? AND $champs2=? AND $champs3=? AND $champs4=?"); // or die(mysqli_error($mysqli));
		$query->bind_param('iiii',$ref1,$ref2,$ref3,$ref4);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return $db_id;
}

function infoBull($tbl,$select,$champs1,$ref1,$mysqli){
	$query=$mysqli->prepare("SELECT $select AS tt FROM $tbl WHERE $champs1=?"); // or die(mysqli_error($mysqli));
		$query->bind_param('i',$ref1);
		$query->execute();
		$query->bind_result($db_id);
		$query->store_result();
		$query->fetch();
		return htmlentities($db_id);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function randomString($length = 4) {
    $characters = '0123456789AZCFKMG';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function allFetch($eta,$mysqli){
$dool=$mysqli->prepare("SELECT filieres FROM contenu_rapport NATURAL JOIN filieres WHERE idetablissement=?");
$dool->bind_param('i',$eta);
$dool->execute();
$dool->bind_result($tt);
$dool->store_result();
while($data=$dool->fetch()) {
  return $results[] = $data;
	}
}
////////
function encode($v){
	return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($v))))));
}
function decode($v){
	return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($v))))));
}

///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function inactivite(){
// store the current time
$now = time();
// get the time the session should have expired
$limit = $now - 60 * 60 ;// 1e heure
// check the time of the last activity
if (isset($_SESSION['last_activity']) && $_SESSION['last_activity'] < $limit) {
  // if too old, clear the session array and redirect
  $_SESSION = array();
  header('Location: '.HOME_LINK.'login.php');
  exit;
} else {
  // otherwise, set the value to the current time
  $_SESSION['last_activity'] = $now;
	}
}


///////////////////////////////////////////////////////////
//include_once 'config/config.php';
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header('Location: '.HOME_LINK.'login.php?err=Could not initiate a safe session (ini_set)');
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}
////////////////////////////////////////////////////////////////////////////////////////// LOGIN FUNCTION
function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT idcompte,idrole, username, password, salt 
        FROM compte
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        // get variables from result.
        $stmt->bind_result($user_id, $idrole, $username, $db_password, $salt);
        $stmt->fetch();
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
					$_SESSION['idcompte']=$user_id;
					$_SESSION['idrole'] = $idrole;

					// JETON 
					$_SESSION['token'] = $token;
					$_SESSION['token_time'] = time(); // Fin jeton
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}



/////////////////////////////////////////////////////////////////////////////// FONCTION BRUTAL
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

///////////////////////////////////////////////////////// VERIFICATION DU LOGIN
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'],$_SESSION['username'],$_SESSION['login_string'],$_SESSION['idrole'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $contact = $_SESSION['username'];
		$idrole = $_SESSION['idrole'];
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM compte 
                                      WHERE idcompte = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

///////////////////////////////////////////////////////////////////////////// SAINTENISER LES LIEN
function esc_url($url) {
    if ('' == $url) {
        return $url;
    }
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
//////////////////// FUNCTION MOIS
function leMois($i){
	if($i==1){ return 'Janvier';}
	if($i==2){ return 'Février';}
	if($i==3){ return 'Mars';}
	if($i==4){ return 'Avril';}
	if($i==5){ return 'Mai';}
	if($i==6){ return 'Juin';}
	if($i==7){ return 'Juillet';}
	if($i==8){ return 'Août';}
	if($i==9){ return 'Septembre';}
	if($i==10){ return 'Octobre';}
	if($i==11){ return 'Novembre';}
	if($i==12){ return 'Décembre';}
}	
?>