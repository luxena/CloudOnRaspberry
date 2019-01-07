<?php



class Db{
    
    private static $dsn = "mysql:host=localhost;dbname=Cloud";
    private static $userDb = "root";
    private static $passwordDb = "root";
    
   
    public function connect(){
        
       
        
        try{
            
           
            $con = new PDO( self::$dsn, self::$userDb, self::$passwordDb );

            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $con;
            
           
            
            
            
        }catch(PDOException $e){
            
            return "Connessione fallita: ".$e->getMessage();
            
        }
        
    }
    
    
    
    
}


?>
