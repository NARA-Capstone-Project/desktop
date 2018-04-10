<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cict_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "cict_database", 3306);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




if(isset($_GET['username']) and isset($_GET['password'])){
	$user = $_GET['username'];
	$pwd = $_GET['password'];
        $sql = "select `user_id`, `username`, aes_decrypt(password, 'cictpassword') as 'pass' from `accounts`";
	$result = mysqli_query($conn, $sql);
	global $pass, $userid, $role, $name;
        
	while($row = mysqli_fetch_array($result)){
	 if($user == $row['username'] and $pwd == $row['pass']){
		    $pass = 1;
                    $userid = $row["user_id"];
                    
                    $anothersql = "select * from `users` where `user_id` =$userid";
		    $anotherresult = mysqli_query($conn, $anothersql);
         while($row1 = mysqli_fetch_array($anotherresult)){
                        $name = $row1["name"];
			$role = $row1["role"];
	    }
	 }else{
             $pass = 0;
         }
 }
	
}


echo $pass."\n"; //0
echo $name."\n"; //1
echo $role."\n"; //2




