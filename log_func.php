<?php
//CODE RETRIEVED FROM LEVEL 5 WEB DESIGN ASSIGNMENT
session_start();
include "cconfig.php";
include "log_func.inc.php";
$dbconn = mysqli_connect //connects to database
("$server", "$server_un", "$server_pw", "$schema"); //retrieves database information from cconfig file
if (mysqli_connect_errno()) 
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error(); //failed to connect to database
}
//starts session
 
//creates the session variables
if (isset($_POST['username'], $_POST['password'])) //checks to see if data has been entered
 {
	$username= $_POST['usernamel']; //is field correct
    $password = $_POST['password']; //is password correct
    if (processlogin($username, $password, $dbconn) == true) {
        //login is successful 
        //$_SESSION['sess_print'] = hash ('sha512', $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
		$_SESSION['AUTH']= "OK";
		header('Location: ../admin/index.php'); //takes you to this file location if loginis successful
    } else {
	        //login failed 
        header('Location: ../admin/index.php?error=1'); 
    }
} else {
    //correct POST variables were not sent to this page 
    echo 'Sorry we have been unable to process your requested, please contact the administrator';
}
mysqli_close($dbconn); //closes database
?>