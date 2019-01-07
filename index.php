<?php
require_once "php/User.php";
$sessione = session_start();


$utente = $_SESSION['utente'];
$user = $_SESSION['username'];
$userEmail = $_SESSION['email'];
$userPassword = $_SESSION['password'];




$u = new User;
$u->setUsername($user);

$u = new User;
$u->setUsername($user);

$datiUser = $u->getDatiUtente($u);

$id = $datiUser['id'];
$username = $datiUser['username'];
$email = $datiUser['email'];
$password = $datiUser['password'];
$foto = $datiUser['foto'];

if($foto != ""){
	
	$imgProfilo = "Img_Customers/$username/$foto";
}else{
	
	$imgProfilo = "ico/user.png";
	
}


$utente = $_SESSION['utente'];

if(isset($_GET['logout'])){
	
	$_SESSION = array();
	
	session_destroy();
	
	header("Location:login.php");
}

if(!$utente){
	

header("Location:login.php");	
	
}else{

	


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cloud</title>
    <link rel="icon" href="ico/bigdata.png" type="image/png" />
    
    <!-- librerie -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- fine librerie -->
    
    <!-- inizio style css -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet" href="css/index.css">
    
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
		
		 $('#inputGroupFile04').change(function(e){
		
		var theFiles = e.target.files;
		var relativePath = theFiles[0].webkitRelativePath;
		var folder = relativePath.split("/");
		var cartella = folder[0];
		
		$('#nomeCartella').val(cartella);
		
	});
		
	})
    
    </script>
  
    
</head>

<body>
   
 <nav class="navbar navbar-expand-md navbar-light bg-grey">
  <a class="navbar-brand back-home cursor-pointer"><img id="logo" src="ico/Database.png"></a>
  <button class="navbar-toggler border-info mr-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link back-home cursor-pointer"><i class="fas fa-home iconNav"></i> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown cursor-pointer">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-plus iconNav"></i> Nuovo 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a id="btnFolder" class="dropdown-item"><i class="fas fa-folder-open iconNav"></i> Cartella</a>
          <div class="dropdown-divider"></div>
          <a id="btnFile" class="dropdown-item"><i class="fas fa-file-signature iconNav"></i> File</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-upload iconNav"></i> Carica 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item cursor-pointer">
			 <form method="post" action="" enctype="multipart/form-data">
				<div class="input-group mb-3 d-none">
				  <div class="input-group-prepend">
					<span class="input-group-text">Nome Cartella</span>
				  </div>
				  <input type="text" class="form-control" id="nomeCartella" name="nomeCartella" aria-label="Dollar amount (with dot and two decimal places)">
				</div>
				 <div class="input-group">
				  <div class="custom-file">
					<input type="text" class="pathFolder" name="pathFolder">
					<input type="file" name="files[]" multiple directory webkitdirectory mozdirectory msdirectory odirectory  class="cursor-pointer" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
					<label class="custom-file-label" for="inputGroupFile04">Sfoglia Cartella</label>
				  </div>
				  <div class="input-group-append bg-mute">
					<button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04" name="uploadFolder">
						<i class="fas fa-folder-open iconNav cursor-pointer"></i>
						</button>
				  </div>
				</div>
			 </form>
			 </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item cursor-pointer">
			  <form method="post" action="" enctype="multipart/form-data">
				 <div class="input-group">
				  <div class="custom-file">
					<input type="text" class="pathFolder" name="pathFolder">
					<input type="file" name="files[]" multiple class="cursor-pointer" id="inputGroupFile05" aria-describedby="inputGroupFileAddon04">
					<label class="custom-file-label" for="inputGroupFile05">Sfoglia File</label>
				  </div>
				  <div class="input-group-append bg-mute">
					<button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon05" name="uploadFile">
						<i class="fas fa-file-import iconNav cursor-pointer" style="width:42.5px"></i>
						</button>
				  </div>
				</div>
			 </form>
		  </a>
        </div>
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
    

    
  <main id="main">
      
      <div id="info" class=""></div>
      
      <div id="containerFile" class="m-auto" style='height:800px;'>
      
      
      
      
      </div>

  </main>
  
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
			<a href="Account/" class="btn btn-water">Gestisci Account</a>
			<a href="index.php?logout" class="btn btn-water float-right">Esci</a>
		</div>
        
 </form>
  
  <!-- fine form gestione utente -->
    
    
<form id="form_rinomina" class="d-none" method="post" action="" enctype="multipart/form-data">
        <button id="close_form">X</button>
        <span id="titolo_form">Rinomina</span>
        <input type="text" name="titoloFileFolder" id="titoloFileFolder" placeholder="Inserisci il nome del file/cartella">
        <input type="button" name="btn_rinomina" id="btn_rinomina" value="Salva">
</form>
    
 <form id="form_crea_file" class="d-none" method="post">
        <button id="close_form">X</button>
        <span id="titolo_form">File</span>
        <input type="text" name="nome_file" id="nome_file" placeholder="Inserisci il nome del file">
        <input type="submit" name="btn_crea_file" id="btn_crea_file" value="Crea">
 </form>
    
  <form id="form_crea_cartella" class="d-none" action="" method="post">
        <button class="outline-none" id="close_form">X</button>
        <span id="titolo_form">Cartella</span>
        <input type="text" class="outline-none" name="nome_cartella" id="nome_cartella" placeholder="Inserisci il nome della cartella">
        <input type="submit" name="btn_crea_cartella" id="btn_crea_cartella" value="Crea">
 </form>
    

    

    
    <div id="folderListTree">
      
       <ul id='tree'></ul>
      
   </div>
   <!--<div class="splitter"></div>-->
         

    
    <!--inizio script js-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/js.cookie.js"></script>
    <script src="js/index.js"></script>
    <script src="js/jquery-resizable.js"></script>
    
    <script>
    $(".panel-left").resizable({
        handleSelector: ".splitter",
        resizeHeight: false
    });

   
</script>
    <!--fine script -->
</body>

</html>



<?php } ?>



<?php

if(isset($_POST['uploadFolder'])){
	
	$path = $_POST['pathFolder'];
	$nomeCartella = $_POST['nomeCartella'];
	
	if($path == ""){
		$cartellaDaCreare = "Customers/$username/$nomeCartella";
	}else{
		$cartellaDaCreare = "Customers/$username/$path/$nomeCartella";
	}
	
	if (!file_exists($cartellaDaCreare)) {
		Mkdir($cartellaDaCreare);
	}
	
	if(isset($_FILES['files'])){
		$n = 0;
		
		foreach($_FILES['files']['name'] as $file){
			
			$tmp = $_FILES['files']['tmp_name'][$n];
			
			move_uploaded_file($tmp,$cartellaDaCreare.'/'.$file);
			
			$n++;
			
		}
		
		echo "<script>window.location.href='index.php';</script>";
		
	}
	
}


if(isset($_POST['uploadFile'])){
	
	$path = $_POST['pathFolder'];
	
	if(!$path == ""){
		
		$cartellaUtente = "Customers/$username/$path/";
		
	}else{
		
		$cartellaUtente = "Customers/$username/";
	}
	
	if(isset($_FILES['files'])){
		$n = 0;
		
		foreach($_FILES['files']['name'] as $file){
			
			$tmp = $_FILES['files']['tmp_name'][$n];
			
			move_uploaded_file($tmp,$cartellaUtente.$file);
			
			$n++;
		}
		echo "<script>window.location.href='index.php';</script>";
	}
	
}

?>

