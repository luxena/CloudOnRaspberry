<?php



if (!file_exists("../Customers/")) {
    Mkdir("../Customers/",0777,true);
    Mkdir("../Img_Customers/",0777,true);
    
    echo "<script>alert('Installazione terminata,registrare il proprio Account');</script>";
   
    header('Location:../login.php');
}


?>
