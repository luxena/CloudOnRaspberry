<?php

header('Access-Control-Allow-Origin: *'); //Abilita l'ccesso dall'esterno
header('Content-type: text/html;charset=utf-8');


function rmdir_recursive($dir) {
  foreach(scandir($dir) as $file) {
    if ('.' === $file || '..' === $file) continue;
    if (is_dir($dir.'/'.$file)) rmdir_recursive($dir.'/'.$file);
    else unlink($dir.'/'.$file);
  }
  rmdir($dir);
}


// tree folder of dir user
function dir_recursive($dir,$username) {
    
    echo "<ul id='tree'>";
    $n =0;
  foreach(scandir($dir) as $file) {
      
      $n++;
    if ('.' === $file || '..' === $file || '.DS_Store' === $file) continue;
      
        if (is_dir($dir.'/'.$file)) {


            //echo $dir.'/'.$file.'<br>';
            
            echo "<li id='".$file."' class='treeLi' title='".$dir.'/'.$file."' onclick='getFolderNode(this.title,this.id)'><i class='fas fa-folder mr-2 iconNav'></i>$file</li>";

                 dir_recursive($dir.'/'.$file,$username);

        } else {
            //echo $file.'<br>';
        }

  }
     echo "</ul>"; 
}



$azione = $_POST['azione'];


if($azione == "albero"){
    
     $username = $_POST['username']; 
     dir_recursive('../Customers/'.$username,$username);
}

if($azione == "lista"){
    
   $username = $_POST['username']; 
   $percorso = $_POST['percorso']; 

   $directory = "../Customers/".$username."/".$percorso."/";
   $directory = str_replace(' ', '', $directory);
			
        $local = glob($directory . "*"); 
			//print each file name
			
        $files = [];
    
			foreach($local as $item)
			{
                
               $item = str_replace($directory,"",$item);
               array_push($files,$item);
    
            }
    
        echo implode(",",$files);

}





if($azione == "eliminaFile"){
    
    $username = $_POST['username']; 
    $listaFile = $_POST['listaFile'];
    $percorso = $_POST['percorso'];
     
    
    $directory = "../Customers/".$username."/".$percorso."/";
			
    $listaFile = explode(",",$listaFile);
    
    foreach($listaFile as $file){

        if (is_dir($directory.$file)) {
            
           rmdir_recursive($directory.$file);
           
        }else{
            
            unlink($directory.$file);
            unset($listaFile[array_search($file,$listaFile)]); 
            
        }
         
    }
    
    if(count($listaFile) == 0){
        echo "eliminazione completata con successo";
    }
}


if($azione == "creaCartella"){
    
    $username = $_POST['username']; 
    $percorso = $_POST['percorso']; 
    $nomeCartella = $_POST['nomeCartella']; 
    
    $folderName = "../Customers/$username/$percorso/$nomeCartella";
    

    if (!file_exists($folderName)) { 
        Mkdir($folderName,0777);
        
        if (file_exists($folderName)) { 
            echo "Cartella creata correttamente"; 
        } 
    } 
    
    
}

if($azione == "creaFile"){
    
    $username = $_POST['username']; 
    $percorso = $_POST['percorso']; 
    $nomeFile = $_POST['nomeFile']; 
    
    $filename = "../Customers/$username/$percorso/$nomeFile.txt"; 
    
    $handle = fopen($filename, "w");
    fwrite($handle, "");
    fclose($handle);
    
   
 
    if (file_exists($filename)) { 
        echo "il file è stato creato"; 
    } else { 
        echo "Errore"; 
    } 
    
}

if($azione == "rinomina"){
   
    $username = $_POST['username']; 
    $percorso = $_POST['percorso']; 
    $oldFile = $_POST['oldName']; 
    $newFile = $_POST['newName']; 
    
     $directory = "../Customers/".$username."/".$percorso."/";
    
    if(rename($directory.$oldFile,$directory.$newFile)){
         echo "Elemento rinominato con successo";
    }
    
   
    
}

if($azione == "salvaFile"){
    
    $username = $_POST['username']; 
    $percorso = $_POST['percorso']; 
    $nomeFile = $_POST['nomeFile'];
    $testoFile = $_POST['testoFile'];
    
    $filename = "../Customers/$username/$percorso/$nomeFile"; 
    
    $handle = fopen($filename, "w");
    fwrite($handle, $testoFile);
    fclose($handle);
    
    echo "Elemento salvato con successo";
    
}


?>
