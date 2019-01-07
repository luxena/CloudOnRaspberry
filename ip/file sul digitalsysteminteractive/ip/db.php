<?php

    $host="localhost";
    $username="digitalsysteminteractive";
    $password="tegdaperge77";
    $database_name="my_digitalsysteminteractive";
    
    $con=mysqli_connect("$host","$username","$password","$database_name");
    
    if(mysqli_connect_errno()){
        echo 'Impossibile connettersi al Database:' .mysqli_connect_error();
    }else{
        
        //echo "connessione ok";
    }
    
?>
