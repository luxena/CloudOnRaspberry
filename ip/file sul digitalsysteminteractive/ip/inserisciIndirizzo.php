<?php
    
    require_once('db.php');
    
    header('Access-Control-Allow-Origin: *'); //Abilita l'ccesso dall'esterno
    header('Content-type: text/html;charset=utf-8');
    
    $address = $_POST['address'];
   
    
    $getindirizzo = "SELECT * FROM ipAddress";
    $estrazione = mysqli_query($con,$getindirizzo);
    
    if(mysqli_num_rows($estrazione) > 0){

        $aggiorna = "UPDATE ipAddress SET address = '$address' WHERE addressId = '1'";
        $aggiornando = mysqli_query($con,$aggiorna);
        
        if($aggiornando){
            echo "indirizzo aggiornato";
        }
        
    }else{
        
        $inserimento = "INSERT INTO ipAddress (address) VALUES ('$address')";
        $inserendo = mysqli_query($con,$inserimento);
        
        if($inserendo){
            echo "indirizzo inserito";
        }
        
    }
    
    
    ?>
