<?php

$address = file_get_contents("http://www.digitalsysteminteractive.altervista.org/ip/getIp.php");

echo "<input id='indirizzo' type='text' value='$address'>";

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Address</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
    <script>
        
    
    var address = $('#indirizzo').val();
    
        
var dataString = "address=" + address;
    
   
    
 $.ajax({
        type: "POST",
        url: "http://digitalsysteminteractive.altervista.org/ip/inserisciIndirizzo.php",
        data: dataString,
        cache: false,
        success: function (result) {

        }

    });
    
    
    </script>
</head>

<body>
    
</body>

</html>
