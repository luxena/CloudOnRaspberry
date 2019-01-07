<?php

require_once "../php/User.php";

$sessione = session_start();

$utente = $_SESSION['utente'];
$user = $_SESSION['username'];

$u = new User;
$u->setUsername($user);

$datiUser = $u->getDatiUtente($u);

$id = $datiUser['id'];
$username = $datiUser['username'];
$email = $datiUser['email'];
$password = $datiUser['password'];
$foto = $datiUser['foto'];

if($foto != ""){
	
	$imgProfilo = "../Img_Customers/$username/$foto";
	
}else{
	
	$imgProfilo = "../ico/user.png";
}

if(isset($_GET['logout'])){
	
	$_SESSION = array();
	
	session_destroy();
	
	header("Location:../login.php");
}

if(!$utente){
	
header("Location:../login.php");	
	
}else{

	


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cloud</title>
    <link rel="icon" href="../ico/bigdata.png" type="image/png" />
    
    <!-- librerie -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- fine librerie -->
    
    <!-- inizio style css -->
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mystyle.css">
    <link rel="stylesheet" href="../css/index.css">
    
    <!-- fine style css -->
   
    
    <style>
       /* .panel-left {
            flex: 0 0 auto;   only manually resize 
            padding: 10px;
            width: 300px;
            min-height: 200px;
            min-width: 150px;
            white-space: nowrap;
            
            background: #838383;
            color: white;
        }*/
        .splitter  {
            flex: 0 0 auto;
            width: 18px;
            background: url(img/vsizegrip.png) center center no-repeat #535353;
            min-height: 200px;
            cursor: col-resize;
        }
       

    
    </style>
    
  <script>
  
  $(function(){
	  
	  $('#showPassword').click(function(){
		 
		  $('#password').attr('type','text');
		   
		  $('#hidePassword').removeClass('d-none');
		  $('#showPassword').addClass('d-none');
		  
	  })
	  
	  $('#hidePassword').click(function(){
		  
		  $('#password').attr('type','password');
		   
		  $('#showPassword').removeClass('d-none');
		  $('#hidePassword').addClass('d-none');
		  
	  })
	  
	  
	  
})
  
  
  
  </script>
    
</head>

<body>
   
 <nav class="navbar navbar-expand-md navbar-light bg-grey">
  <a class="navbar-brand back-home cursor-pointer"><img id="logo" src="../ico/Database.png"></a>
  <button class="navbar-toggler border-info mr-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a href="../" class="nav-link back-home cursor-pointer"><i class="fas fa-home iconNav"></i> Home <span class="sr-only">(current)</span></a>
      </li>
     
    
      <li class="nav-item">
        <a class="nav-link cursor-pointer" href="index.php"><i class="fas fa-sync-alt iconNav"></i> Aggiorna <span class="sr-only">(current)</span></a>
      </li>
      <li id="selezionaTutto" class="nav-item">
        <a class="nav-link cursor-pointer" ><i class="far fa-check-circle iconNav"></i> Seleziona tutto <span class="sr-only">(current)</span></a>
      </li>
       <li id="deselezionaTutto" class="nav-item">
        <a class="nav-link cursor-pointer" ><i class="far fa-circle iconNav"></i> Deseleziona tutto <span class="sr-only">(current)</span></a>
      </li>
      <li id="rinominaFile" class="nav-item">
        <a class="nav-link cursor-pointer"><i class="fas fa-pencil-alt iconNav"></i> Rinomina <span class="sr-only">(current)</span></a>
      </li>
      <li id="eliminaFile" class="nav-item">
        <a class="nav-link cursor-pointer"><i class="fas fa-trash-alt iconNav"></i> Elimina <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0 mr-4">
      <label id="utente" class="ml-3 mr-2"><?php echo $username; ?></label>
      <img id="handleUser" class="img-ico rounded-circle" src="<?php echo $imgProfilo;?>">
    </form>
  </div>
</nav>
    

    
 
  
   <!-- form gestione utente -->
  
  <form id="form_utente" method="post" class="d-none">
	  <div style="width:100%;height:70%;">
		<div class="text-center" style="float:left;width:49%;">
			<img class="img-profile rounded-circle" src="<?php echo $imgProfilo;?>">
		</div>
		<div class="text-center" style="float:left;width:49%;">
			<span id="titolo_form"><?php echo $username; ?></span><br>
			<span><?php echo $email;?></span>
		</div>
	 </div>
	    <hr>
        <div style="width:100%;height:30%;">
			<a href="index.php" class="btn btn-water">Gestisci Account</a>
			<a href="../index.php?logout" class="btn btn-water float-right">Esci</a>
		</div>
        
 </form>
  
  <!-- fine form gestione utente -->
    
    

    <div class="container mt-4">
    <h1 class="text-center">Account</h1>
	<form action="" method="post" enctype="multipart/form-data">
	  <div class="form-row">
		
		
		<div class="col-md-12 mb-3">
		  <label for="username">Username</label>
		  <div class="input-group">
			<div class="input-group-prepend">
			  <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-user-alt"></i></span>
			</div>
			<input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>" placeholder="Username" aria-describedby="inputGroupPrepend2" required>
		  </div>
		</div>
		
		<div class="col-md-12 mb-3">
		  <label for="email">Email</label>
		  <div class="input-group">
			<div class="input-group-prepend">
			  <span class="input-group-text" id="email"><i class="fas fa-envelope"></i></span>
			</div>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
		  </div>
		</div>
		
		<div class="col-md-12 mb-3">
		  <label for="password">Password</label>
		  <div class="input-group">
			<div class="input-group-prepend">
			  <span class="input-group-text" id="key"><i class="fas fa-key"></i></span>
			</div>
			<input type="password" class="form-control" id="password" name="password" value="<?php echo $password;?>" placeholder="Password" aria-describedby="inputGroupPrepend2" required>
			<div class="input-group-append">
			  <span class="input-group-text cursor-pointer"><i id="showPassword" class="fas fa-eye cursor-pointer"></i><i id="hidePassword" class="d-none fas fa-eye-slash cursor-pointer"></i></span>
			</div>
		  </div>
	    </div>
	
	
		<div class="col-md-2 mb-3">
		  <a href="<?php echo $imgProfilo;?>"><img class="img-profile rounded-circle" src="<?php echo $imgProfilo;?>"></a>
	    </div>
	    <div class="col-md-7 mb-3 ">
			<label for="file">Carica la tua foto</label>
			<div class="input-group mb-3">
				<input type="file" class="custom-file-input mt-4" id="file" name="file" aria-describedby="inputGroupFileAddon04">
				<label class="custom-file-label cursor-pointer" for="file">Sfoglia file</label>
			</div>
	    </div>
		<div class="col-md-3 mt-4 text-right">
			
				<button class="btn btn-water mt-2 w-100" type="submit" id="salva" name="update">Salva</button>
				
			
		</div>
		<div class="col-md-12 mt-4 text-right">
			
				
				<button class="btn btn-water mt-2 w-100" type="submit" id="elimina" name="elimina">Elimina Account</button>
			
			
		</div>
		
		
	  </div>
	  
		
	
	  
	  
	 </form>
    
    
    </div>



    
    <!--inizio script js-->
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/js.cookie.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/jquery-resizable.js"></script>
    
 
    <!--fine script -->
</body>

</html>



<?php } ?>


<?php

if(isset($_POST['update'])){
	
	
	
	$usernamePost = $_POST['username'];
	$emailPost = $_POST['email'];
	$passwordPost = $_POST['password'];
	
	$user = $_SESSION['username'];

	$folder = "../Img_Customers/$user/";
	
	if(isset($_FILES['file'])){
		
		$file = $_FILES['file']['name'];
		
		$pos = strrpos($file,".");
		$ext = substr($file,$pos + 1);
		
		$tmp_file = $_FILES['file']['tmp_name'];
		
		$estensioni = array("jpg","jpeg","png","PNG","JPG","ico","gif","GIF");
		
		if(in_array($ext,$estensioni)){
			
			move_uploaded_file($tmp_file,$folder.$file);
			
		}
		
	}
	
	if($file == ""){
		$file = $foto;
		}
	
	
	
		//update dati utente
		

		$u = new User;
		$u->setId($id);
		$u->setUsername($usernamePost);
		$u->setEmail($emailPost);
		$u->setPassword($passwordPost);
		$u->setImg($file);

		$responso = $u->updateUser($u);

		if($responso == "Dati salvati con successo"){
			
			if($user != $usernamePost){
				
				$oldname1 = "../Customers/$user";
				$newname1 = "../Customers/$usernamePost";
				
				$oldname2 = "../Img_Customers/$user";
				$newname2 = "../Img_Customers/$usernamePost";
				
				rename($oldname1,$newname1);
				rename($oldname2,$newname2);
				
				echo "<script>alert('Rieffettuare il login');</script>";
				
				echo "<script>window.location.href='../login.php';</script>";
				
			}else{
				
				echo "<script>window.location.href='index.php';</script>";
				
			}
		
			
			
		}

}


if(isset($_POST['elimina'])){
	
	$u = new User;
	$u->setId($id);
	$u->setUsername($username);
	$responso = $u->eliminaAccount($u);
	
	if($responso == "Account eliminato con successo"){
		
		rmdir_recursive('../Customers/'.$username);
		rmdir_recursive('../Img_Customers/'.$username);
		
		echo "<script>alert('$responso');</script>";
				
		echo "<script>window.location.href='../login.php';</script>";
				
		
	}
	
}

function rmdir_recursive($dir) {
		  foreach(scandir($dir) as $file) {
			if ('.' === $file || '..' === $file) continue;
			if (is_dir($dir.'/'.$file)) rmdir_recursive($dir.'/'.$file);
			else unlink($dir.'/'.$file);
		  }
		  rmdir($dir);
		}

?>
