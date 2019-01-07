<?php
require_once "database.php";

class User{
    
    
    private $id;
    private $username;
    private $password;
    private $email;
    private $img;
    
    public function __construct(){
	}
    
	public function __destruct(){
	}
	
	

	
	public function getId(){
       return $this->id; 
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getUsername(){
       return $this->username; 
    }
    
    public function setUsername($username){
        $this->username = $username;
    }
    
    public function getPassword(){
        return $this->password; 
    }
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function getEmail(){
        return $this->email; 
    }
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getImg(){
        return $this->img; 
    }
    public function setImg($img){
        $this->img = $img;
    }
    
    
    public function controlUser(User $user){
        
        $db = new Db;
        $con = $db->connect();
        
        $username = $user->getUsername();
        
        $sql = "SELECT username FROM Customers WHERE username = '$username'";
        
        $query = $con->prepare($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
        
        
        
    }
    
    public function insertUser(User $user){
        
        $db = new Db;
        $con = $db->connect();
        
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();
        
        $n = $this->controlUser($user);
        
        if($n > 0){
            
            return "Username già registrato";
            
        }else{
            
        $sql = "INSERT INTO Customers (username,password,email) values (:username,:password,:email)";
        
        $query = $con->prepare($sql); 
              
        $query->bindValue(':username',$username,PDO::PARAM_STR);
        $query->bindValue(':password',$password,PDO::PARAM_STR);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        
           if($query->execute()){

               Mkdir("../Customers/$username",0777);
               Mkdir("../Img_Customers/$username",0777);
               return "Registrazione effettuata con successo";
           }
         
            
        }
        
        
        $con = null;
    }
    
    
     public function updateUser(User $user){
        
        $db = new Db;
        $con = $db->connect();
        
        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $img = $user->getImg();
       
            
        $sql = "UPDATE Customers SET username =:username,password =:password,email =:email,foto =:img WHERE id ='$id'";
        
        $query = $con->prepare($sql); 
              
        $query->bindValue(':username',$username,PDO::PARAM_STR);
        $query->bindValue(':password',$password,PDO::PARAM_STR);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->bindValue(':img',$img,PDO::PARAM_STR);
        
           if($query->execute()){

               return "Dati salvati con successo";
           }
         
        
        $con = null;
    }
    
    
   public function login(User $user){
       
        $db = new Db;
        $con = $db->connect();
        
        $username = $user->getUsername();
        $password = $user->getPassword(); 
       
        $sql = "SELECT * FROM Customers WHERE username = '$username' AND password = '$password'";
        
        $query = $con->prepare($sql);
        $query->execute();
        $count = $query->rowCount();
       
        if($count > 0){
           return "Accesso consentito"; 
        }else{
            return "Accesso negato";
        }
        
   }
   
   public function getEmailAddress(User $user){
	   
		$db = new Db;
        $con = $db->connect();
        
        $username = $user->getUsername();
        
        $sql = "SELECT * FROM Customers WHERE username = '$username'";
        
        $rows = $con->query($sql);
        
        foreach($rows as $row){
			
			$emailAddress = $row['email'];
			
		}
		
		return $emailAddress;   
	   
   }
   
   
   public function getDatiUtente(User $user){
	   
		$db = new Db;
        $con = $db->connect();
        
        $username = $user->getUsername();
        
        $sql = "SELECT * FROM Customers WHERE username = '$username'";
        
        $rows = $con->query($sql);
        
        foreach($rows as $row){
			
			$id = $row['id'];
			$username = $row['username'];
			$email = $row['email'];
			$password = $row['password'];
			$foto = $row['foto'];
			
		}
		
		$datiUtente = array("id" => $id,"username" => $username,"email" => $email, "password" => $password,"foto" => $foto);
				
		return $datiUtente;   
	   
   }

    public function eliminaAccount(User $user){
		
		$db = new Db;
        $con = $db->connect();
        
        $id = $user->getId();
        $username = $user->getUsername();
        
        $n = $this->controlUser($user);
        
        if($n > 0){
            
            $sql = "DELETE FROM Customers WHERE id = '$id'";
        
			$delete = $con->query($sql);
			
			if($delete){
				
				
				
			
				return "Account eliminato con successo";
				
			}
            
            
        }else{
			
			return "Username non registrato";
			
		}
		
	}
	
	
		
    
}





?>
