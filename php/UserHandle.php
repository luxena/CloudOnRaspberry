<?php

require_once "User.php";

header('Access-Control-Allow-Origin: *'); //Abilita l'ccesso dall'esterno
header('Content-type: text/html;charset=utf-8');




$azione = $_POST['azione'];

if($azione == "verificaUsername"){
    
    

    $username = $_POST['username'];
  
    
    $u = new User;
    $u->setUsername($username);

    echo $u->controlUser($u);
    
   
    
}

if($azione == "registrazione"){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    $u = new User;
    $u->setUsername($username);
    $u->setPassword($password);
    $u->setEmail($email);

    echo $u->insertUser($u);
    
    
}

if($azione == "login"){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $u = new User;
    $u->setUsername($username);
    $u->setPassword($password);
    
    echo $u->login($u);
    
}


?>