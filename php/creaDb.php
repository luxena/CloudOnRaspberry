<?php

$host="localhost"; 

$root="root"; 
$root_password="root"; 

$user='root';
$pass='root';
$db="Cloud"; 

    try {
        $con = new PDO("mysql:host=$host", $root, $root_password);

        $con->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;") 
        or die(print_r(/*$con->errorInfo()*/"", true));
        
    
        
        
    } catch (PDOException $e) {
        //die("DB ERROR: ". $e->getMessage());
    }

?>
