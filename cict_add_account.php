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


if(isset($_GET['newusername']) and isset($_GET['newpassword']) and isset($_GET['employeeid'])
        and isset($_GET['newname']) and isset($_GET['newphone']) and isset($_GET['datecreate']) and isset($_GET['dateexpire']) and 
        isset($_GET['role'])){

        $checkuser = "select users.user_id, accounts.user_id from users INNER JOIN accounts ON users.user_id = accounts.user_id WHERE users.user_id =".$_GET["employeeid"]." and accounts.user_id = ".$_GET["employeeid"];
	
        $result1 = mysqli_query($conn, $checkuser);

        if (mysqli_num_rows($result1) === 0) {
    
         
        $user = $_GET['newusername'];
	$pwd = $_GET['newpassword'];
        $id = $_GET['employeeid'];
        $newname = $_GET['newname'];
        $newphone = $_GET['newphone'];
        $datecreate = $_GET['datecreate'];
        $dateexpire = $_GET['dateexpire'];
        $newrole = $_GET['role'];
        
        $sql = "INSERT INTO `accounts`(`user_id`, `username`, `password`, `signature`, `date_created`, `date_expire`, `acc_status`) VALUES ('$id','$user','$pwd','','$datecreate','$dateexpire','Active')";
	$sql1 = "INSERT INTO `users`(`user_id`, `name`, `phone`, `role`) VALUES ('$id','$newname','$newphone','$newrole')";
        if (mysqli_query($conn, $sql) == true) {
            if (mysqli_query($conn, $sql1) == true) {
               echo "New record created successfully";
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        }else{
            echo "Existing employee. Account not created.";
        }
	
}