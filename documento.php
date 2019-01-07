<?php

require_once "php/User.php";


if($_GET['documento']){
	
	 $nomeDocumento = $_GET['documento'];
	 $nomeUtente = $_GET['username'];
	 $percorso = $_GET['percorso'];
	
	
	
}


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
      
      <li id="salva" class="nav-item">
        <a class="nav-link cursor-pointer" ><i class="fas fa-save iconNav"></i> Salva <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item">
        <a download href="<?php echo "Customers/".$username."/".$percorso; ?>" class="nav-link cursor-pointer" ><i class="fas fa-cloud-download-alt iconNav"></i> Scarica <span class="sr-only">(current)</span></a>
      </li>
      <li id="rinomina" class="nav-item">
        <a class="nav-link cursor-pointer"><i class="fas fa-pencil-alt iconNav"></i> Rinomina <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link cursor-pointer"><i class="fas fa-trash-alt iconNav"></i> Elimina <span class="sr-only">(current)</span></a>
      </li>
     
    </ul>
    
    <form class="form-inline my-2 my-lg-0 mr-4">
      <label id="utente" class="ml-3 mr-2"><?php echo $username; ?></label>
      <img id="handleUser" class="img-ico rounded-circle" src="<?php echo $imgProfilo;?>">
    </form>
  </div>
</nav>
    

    
 
  
  
    
    <?php 
    
    
	//header('Content-Type:text/plain');
    
    $file = "Customers/".$username."/".$percorso;
	
	$document = file_get_contents($file);
    
     ?>

  <div style="width:90%;" class="text-center m-auto ">
  
	<textarea id="testo" name="testo" style="resize:none;" class="outline-none mt-4 w-100 hg-800 border-0"><?php echo $document; ?></textarea>
  
  </div>

	
	
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
  
  
  <!-- form rinomina -->
  
  <form id="form_rinomina" class="d-none" method="post" action="" enctype="multipart/form-data">
        <button id="close_form">X</button>
        <span id="titolo_form">Rinomina</span>
        <input type="text" id="oldNomeFile" value="<?php echo $nomeDocumento; ?>" hidden>
        <input type="text" name="titoloFile" id="titoloFile" placeholder="Inserisci il nome del file/cartella" value="<?php echo $nomeDocumento;?>">
        <input type="button" name="btnRinomina" id="btnRinomina" value="Salva">
</form>
  
  <!--fine form rinomina -->


    
    <!--inizio script js-->
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/js.cookie.js"></script>
    <script src="../js/documento.js"></script>
    <script src="../js/index.js"></script>
    
    <script src="../js/jquery-resizable.js"></script>
    
 
    <!--fine script -->
</body>

</html>



<?php } ?>

