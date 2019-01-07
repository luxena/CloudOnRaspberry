<?php
 require_once "creaCartelle.php";
 require_once "creaDb.php";
 require_once "database.php";
 

$db = new Db;
$con = $db->connect();

$sql = "CREATE TABLE IF NOT EXISTS Customers (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255) NOT NULL,password VARCHAR(255) NOT NULL,email VARCHAR(255) NOT NULL,foto VARCHAR(255) NOT NULL)";

    // use exec() because no results are returned
    

    if($con->query($sql)){
       echo "Installazione effettuata con successo";
       header('Location:../login.php'); 
    }

    //echo "Table MyGuests created successfully";
    $con = null;    
        



?>
