var nomeIp = window.location.hostname;

var username = Cookies.get('username');
var percorso =  Cookies.get('percorso');


var fileCheck = "";

$(function(){
	
	$('.pathFolder').val(percorso);
    
   
    $("#folderListTree").resizable();
   
        
      alberoCartelleUtente();  
    
      $('#rinominaFile').hide();
      $('#eliminaFile').hide();
    
     
      $('#deselezionaTutto').hide();
      $('#selezionaTutto').hide();
     
      $('#btn_crea_cartella').attr("disabled", "disabled");
      $('#btn_crea_file').attr("disabled", "disabled");
      $('#btn_rinomina').attr("disabled", "disabled");
      

        $('.back-home').click(function(){
            Cookies.set('percorso', "", { expires: 3 });
            location.reload(true);
        });
       
        if(username == ""){
              window.location = 'login.php';
        }else{
            //$('#utente').html(username);
        }
    
        getFiles();
        
    
       $('#rinominaFile').click(function(){
            $('#form_rinomina').toggleClass('d-none');
       });
       $('#eliminaFile').click(eliminaFileChecked);
        
       $('#info').click(function(){
           location.reload(true);
       }); 
        
        
      $('#selezionaTutto').click(toggleChecked);
      $('#deselezionaTutto').click(toggleChecked2);
   
      
      $('#btnFolder').click(function(){
          $('#form_crea_cartella').toggleClass('d-none');
      });
    
      $('#btnFile').click(function(){
          $('#form_crea_file').toggleClass('d-none');
      });
      
      $('#handleUser').click(function(){
		  
		  $('#form_utente').toggleClass('d-none');
	  });
    
      $('#nome_cartella').keyup(function(){
          
          var nomeCartella = $('#nome_cartella').val();
          if(nomeCartella.length > 0){
              $('#btn_crea_cartella').addClass('bg-darkwater');
              $('#btn_crea_cartella').prop('disabled', false);
          }else{
              $('#btn_crea_cartella').removeClass('bg-darkwater');
              $('#btn_crea_cartella').attr("disabled", "disabled");
          }
          
      });
    
    
      $('#btn_crea_cartella').click(creaCartella);
          
    
    
      $('#nome_file').keyup(function(){
         var nomeFile = $('#nome_file').val();
          if(nomeFile.length > 0){
              $('#btn_crea_file').addClass('bg-darkwater');
              $('#btn_crea_file').prop('disabled', false);
          }else{
              $('#btn_crea_file').removeClass('bg-darkwater');
              $('#btn_crea_file').attr("disabled", "disabled");
          }
     });
    
     $('#btn_crea_file').click(creaFile);
    
    $('#titoloFileFolder').keyup(function(){
        var titoloFileFolder = $('#titoloFileFolder').val();
        
          if(titoloFileFolder.length > 0){
              $('#btn_rinomina').addClass('bg-darkwater');
              $('#btn_rinomina').prop('disabled', false);
          }else{
              $('#btn_rinomina').removeClass('bg-darkwater');
              $('#btn_rinomina').attr("disabled", "disabled");
          }
    });
    
    $('#btn_rinomina').click(rinominaFileFolder);
    

     $('#c2').css('color','red');
});



function getFolderNode(path,id){
    
    
    
   path = path.replace('../Customers/','');
   path = path.replace(username +'/','');
  
   Cookies.set('percorso', path, { expires: 3 });
   percorso = path;
    
    var lista = $("#containerFile");
   
    lista.html("");
    getFiles();
    
    $('.treeLi').css('color','black');
    $('#'+ id).css('color','red');
}



function getFiles(){
    

 
 var dataString = "azione=lista" + "&username=" + username + "&percorso=" + percorso;
       
   
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
          
            var risultato = $.trim(result);
             
             if (risultato != "") {

                var files = risultato.split(",");
                 
                var nFiles = files.length;
                 
               
                 if(nFiles > 0){
                   $('#selezionaTutto').show();
                 }
                
                for (var i = 0; i < nFiles; i++) {
                    var file = files[i];
                    
                    var extPosizione = file.lastIndexOf(".");
                    
                    var lista = $("#containerFile");
                    
                    if(extPosizione > 0){
                        
                        if(percorso == ""){
                           
                           var icon = $('<i class="fas fa-file-alt cursor-pointer iconCheck"></i>');
                           var link = $('<a id="' +  file +'" class="cursor-pointer"> '+ file +' </a>'); 
                        }else{
                           var icon = $('<i class="fas fa-file-alt cursor-pointer iconCheck"></i>');
                           var link = $('<a id="'+ percorso + "/" +  file +'" class="cursor-pointer"> '+ file +' </a>');
                        }
                        
                         //se clicchi su un file
                        
                        link.click(function(){
                           percorso = $(this).attr("id");
							
                           window.location.href='documento.php?documento=' + file + '&username='+ username + '&percorso=' + percorso;
                        
                        });
                        
                    }else{
                        if(percorso == ""){
                            var icon = $('<i class="fas fa-folder cursor-pointer iconCheck"></i>');
                            var link = $('<a id="' +  file +'" class="folderLink cursor-pointer"> '+ file +' </a>');
                        }else{
                           var icon = $('<i class="fas fa-folder cursor-pointer iconCheck"></i>');
                           var link = $('<a id="'+ percorso + "/" +  file +'" class="folderLink cursor-pointer"> '+ file +' </a>'); 
                        }
                        
                        
                         //se clicchi su una cartella
                        
                         link.click(function(){
                           percorso = $(this).attr("id");
                           
                           Cookies.set('percorso', percorso, { expires: 3 });
                           
                           location.reload(true);
                        });
                    }
                    
                    var container = $('<div class="containerFile"></div><br>');
                    var check = $('<input type="checkbox" id="'+ file +'" class="fileCheckbox" name="file" value="'+ file +'">');
                 
                    
                    check.change(function(){
                        
                        
                        var listaFileCheck = [];
                      
                        
                        $("input:checked").each(function(){

                           fileCheck = $(this).val();
                          $('#titoloFileFolder').val(fileCheck);

                          listaFileCheck.push(fileCheck);
                          var nListaFileCheck = listaFileCheck.length;

                         });
                        
                      
                        
                        if(listaFileCheck.length > 0){
                            $('#rinominaFile').show(); 
                            $('#eliminaFile').show(); 
                            
                                 if(listaFileCheck.length > 1){
                                    $('#rinominaFile').hide();
                                 }    
                            
                        }else{
                             $('#rinominaFile').hide();
                             $('#eliminaFile').hide();
                             
                        }
                        
                        
                       
                    });
                
                    container.append(check,"  ",icon,"  ",link);
                    lista.append(container);
                   
                }

            }
               
            
           

        }

    });
    
    
    
}



 function toggleChecked(status) {
      $('.fileCheckbox').each( function() {
        $(this).prop('checked', true);
       
        $('#eliminaFile').show();
      }) ;
      
          $('#deselezionaTutto').show();
          $('#selezionaTutto').hide();
          
        
    } ;
    
    
    
    function toggleChecked2(status) {
      $('.fileCheckbox').each( function() {
        $(this).prop('checked', false);
        $('#eliminaFile').hide();
        
      }) ;
      
    $('#selezionaTutto').show();
    $('#deselezionaTutto').hide();
        
    };



 function eliminaFileChecked(){
        
        var listaFileCheck = [];
                        
        $("input:checked").each(function(){
                            
          var fileCheck = $(this).val();
                            
          listaFileCheck.push(fileCheck);
                         
         });
                        
       var tabella = Cookies.get('tabella');
     
       var dataString = "azione=eliminaFile" + "&username=" + username + "&listaFile=" + listaFileCheck + "&percorso=" + percorso;
       
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
          
            var risultato = $.trim(result);
             
            location.reload(true);
           
        }

    });
        
}


function creaCartella(){
    
   var nomeCartella = $('#nome_cartella').val();
    
   var dataString = "azione=creaCartella" + "&username=" + username + "&percorso=" + percorso + "&nomeCartella=" + nomeCartella;
       
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
            
             var risultato = $.trim(result);
             
             if (risultato == "Cartella creata correttamente") {
                 location.reload(true);
             }
            
        }
           
       });
}

function creaFile(){
    
   
    
   var nomeFile = $('#nome_file').val();
    
   var dataString = "azione=creaFile" + "&username=" + username + "&percorso=" + percorso + "&nomeFile=" + nomeFile;
       
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
            
             var risultato = $.trim(result);
             
             if (risultato == "il file è stato creato") {
                 location.reload(true);
             }
            
        }
           
       });
    
}


function rinominaFileFolder(){
    
   var titoloFileFolder = $('#titoloFileFolder').val(); 
    
    var dataString = "azione=rinomina" + "&username=" + username + "&percorso=" + percorso + "&oldName=" + fileCheck + "&newName=" + titoloFileFolder;
       
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
            
             var risultato = $.trim(result);
             
             if (risultato == "Elemento rinominato con successo") {
                location.reload(true);
             }
            
        }
           
       });
    

}

function alberoCartelleUtente(){
    

    
   var dataString = "azione=albero" + "&username=" + username;
       
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
            
             var risultato = $.trim(result);
             
             if(risultato != ""){
                 
                 $('#tree').html(risultato);
             }
            
        }
           
       });
    
}

