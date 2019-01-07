<!DOCTYPE html>
<html>

<head>
  <title>Registrazione</title>
  <link rel="icon" href="ico/bigdata.png" type="image/png" />
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css">
  <link rel="stylesheet" href="css/login.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
  <script>
  
  $(function(){
	  
	  $('#username').keyup(verificaUsername);
	  
  });
  

function verificaUsername(){
    
var nomeIp = window.location.hostname;

var username = $('#username').val();  
  
    
var dataString = "azione=verificaUsername" + "&username=" + username;
    
   
    
 $.ajax({
        type: "POST",
        url: "http://"+ nomeIp +"/php/UserHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
         
           
            var risultato = $.trim(result);
            
           
            
             if (risultato != "") {

                if(risultato > 0){
                     
                    $('#avvisi').html("Username esistente");
                    $('#avvisi').css('color','orange');
                    
                }else{
                    $('#avvisi').html("Username libero");
                    $('#avvisi').css('color','green');
                } 
                
                
            }
           

        }

    });
    
    
}
  
  
  
  </script>

</head>

<body class="bg-dark" >
  <div class="py-3 mt-4">
    <div class="container">
      <div class="row">
       <div class="col-md-3"> </div>
        <div class="col-md-6">
          
                
            <section>
                <article></article>
                <article>

                 <form action="" method="post" autocomplete="off">
                    <i class="fas fa-envelope ico"></i>
                    <input type="email" class="txtLog" id="email" name="email" placeholder="email" required>
                    <i class="fas fa-user ico"></i>
                    <input type="text" class="txtLog" id="username" name="username" placeholder="username" required>
                    <i class="fas fa-unlock-alt ico"></i>
                    <input type="password" class="txtLog" id="password" name="password" placeholder="password" required>
                    <small id="avvisi" class="avvisi" style="color:transparent;">Disponibilità</small>
                    <a href="login.php"><button type="button" class="btnLog"><i class="fas fa-key"></i></button></a>
                    <input type="submit" class="btnRegister" id="btnRegister" name="register" value="Registrati">
                </form>

                </article>
            </section>    

           
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/js.cookie.js"></script>
</body>

</html>

<?php

require_once('php/User.php');


if(isset($_POST['register'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	
	$u = new User;
	$u->setUsername($username);
	$u->setPassword($password);
	$u->setEmail($email);
	

	$responso = $u->insertUser($u);
	
	if($responso == "Registrazione effettuata con successo"){
	
	$dati_utente = array("username" => $username,"password" => $password, "email" => $email);
	$sessione = session_start();
	
	$_SESSION['utente'] = $dati_utente;
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	$_SESSION['email'] = $email;
	
	Mkdir("Customers/$username",0777);
    Mkdir("Img_Customers/$username",0777);
	
	header("Location:index.php");
	
	
	}else{
		echo "<script>alert('$responso');</script>";
	}
	
	
}

?>

