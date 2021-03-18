<?php
include_once('config/config.php');
include('include/fonction.php');
?>
<?php
/////////////////////////////////////////////////////////////////////::
sec_session_start(); // Our custom secure way of starting a PHP session.
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // The hashed password.
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: '.HOME_LINK.'./?bienvenue');
    }
	//elseif(checkbrute($user_id, $mysqli) == false){
//		// Login Locked 
//        header('Location: '.HOME_LINK.'login.php?error=2');	// Session Blocker
//	}
	else {
        // Login failed 
        header('Location: '.HOME_LINK.'login.php?error=1'); // Information incorrect
    }
} else {
    // The correct POST variables were not sent to this page. 
    header('Location: '.HOME_LINK.'login.php?error=3'); // Reket Invalide
}

?>