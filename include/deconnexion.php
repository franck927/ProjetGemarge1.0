<?php //defined('exit') or die('<h3 align="center" style="color:red;">VOUS N\'AVEZ PAS LE DROIT D\'ACCEDER A CETTE PAGE</h3>'); ?>
<?php
require('../config/config.php');
include_once '../fonction/fonc_login.php';
include_once '../fonction/fonction.php';
sec_session_start();
// Unset all session values 
$_SESSION = array();
// get session parameters 
$params = session_get_cookie_params();
// Delete the actual cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
// Destroy session 
session_destroy();
header('Location: '.HOME_LINK.'login.php');
//// On appelle la session
//session_start();
//
//// On écrase le tableau de session
//$_SESSION = array();
//
//// On détruit la session
//session_destroy();
//header('Location:../index.php');

?>