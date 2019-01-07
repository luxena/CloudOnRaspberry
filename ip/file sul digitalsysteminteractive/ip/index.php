<?php
    
    require_once('db.php');
    
    
    
    $getindirizzo = "SELECT * FROM ipAddress ORDER BY addressId DESC";
    $estrazione = mysqli_query($con,$getindirizzo);
    
    if(mysqli_num_rows($estrazione) > 0){
        
        while ($row=mysqli_fetch_array($estrazione)){
        
        $indirizzoIp = $row['address'];
            
            echo "<a href='http://$indirizzoIp'>val al MyCloud</a>";
        }
    }
    
    
    ?>
