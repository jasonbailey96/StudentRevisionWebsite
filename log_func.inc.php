<?php
//CODE RETRIEVED FROM LEVEL 5 WEB DESIGN MODULE
include "cconfig.php";
$dbconn = mysqli_connect 
("$server", "$server_un", "$server_pw", "$schema");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error(); //failed to connect to database
}

function processlogin($username, $password, $dbconn) 
{
    //by using prepared statements means that SQL injection is not possible
    if (!$stmt = $dbconn->prepare
	//("SELECT id, email, pw FROM login WHERE email = ? LIMIT 1"))
	("SELECT id, username, password, salt FROM login WHERE email = ? LIMIT 1")) 
			{
		die ('Error: '  . $dbconn->error); 
			}
		else 
		
		{
        $stmt->bind_param('s', $email);  //bind "$email" to parameter.
        //$stmt->execute();    //execute the prepared query.
		if (!$stmt->execute()) {
                echo ("Statement failed: ". $stmt->error);
            }
        else
		{
        $stmt->store_result();
 
        //get variables from result
        $stmt->bind_result($user_id, $username, $userpw, $salt);
        $stmt->fetch();
 
        //hash the password with the unique salt, makes it almost impossible to hack
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) 
		{
         
                 //check to see if the password in the database matches
                //users password is submitted
                if ($userpw == $password) 
				
				{
				
                    //login is successful
                    return true;
                } 
				
				else 
				
				{
                    exit ("no user found"); //user not found
                }
        }
    }} 
	
		
		
}
mysqli_close($dbconn); //closes database


?>