<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
  <link rel="icon" href="ico/bigdata.png" type="image/png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css">
  <link rel="stylesheet" href="css/login.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
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
                    <i class="fas fa-user ico"></i>
                    <input type="text" class="txtLog" id="username" name="username" placeholder="username" required>
                    <i class="fas fa-unlock-alt ico"></i>
                    <input type="password" class="txtLog" id="password" name="password" placeholder="password" required>
                    <small id="avvisi" class="avvisi" style="color:transparent;">Disponibilità</small>
                    <button type="submit" class="btnLog" id="btnLogin" name="login"><i class="fas fa-key"></i></button>
                    <a href="registrati.php"><input type="button" class="btnRegister" id="btnRegister" name="register" value="Registrati"></a>
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
  <script src="js/login.js"></script>
</body>

</html>


<?php

require_once('php/User.php');

if(isset($_POST['login'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	
	$u = new User;
	$u->setUsername($username);
	$u->setPassword($password);
	

	$responso = $u->login($u);
	
	if($responso == "Accesso consentito"){
		
	$u = new User;
	$u->setUsername($username);

	$email = $u->getEmailAddress($u);
		
	$dati_utente = array("username" => $username,"password" => $password,"email" => $email);
	$sessione = session_start();
	
	$_SESSION['utente'] = $dati_utente;
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	$_SESSION['email'] = $email;
	$_SESSION['percorso'] = "";

	
	header("Location:index.php");
	
	}else{
		echo "<script>alert('$responso');</script>";
	}
	
  
	
}

?>
