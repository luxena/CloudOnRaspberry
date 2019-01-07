var nomeIp = window.location.hostname;

var username = Cookies.get('username');
var percorso =  Cookies.get('percorso');

$(function(){

	
	controllaTesto();
	
	$('#testo').keyup(function(){
		var l = $('#testo').val().length;
		
		if(l < 1){
			$('#salva').hide();
		}else{
			$('#salva').show();
		}
		
	});
	
	
	$('#rinomina').click(function(){
            $('#form_rinomina').toggleClass('d-none');
    });
    
    
    $('#btnRinomina').click(rinominaFile);
    
    $('#titoloFile').keyup(function(){
        var titoloFile = $('#titoloFile').val();
        
          if(titoloFile.length > 0){
              $('#btnRinomina').addClass('bg-darkwater');
              $('#btnRinomina').prop('disabled', false);
          }else{
              $('#btnRinomina').removeClass('bg-darkwater');
              $('#btnRinomina').attr("disabled", "disabled");
          }
    });
    
    $('#salva').click(salvaFile);
    
	
});

function controllaTesto(){
	
	var l =  $('#testo').val().length;
	
	if(l > 0){
		
		$('#salva').removeClass('d-none');
	}
	
}


function rinominaFile(){
	
	
   var titoloFile = $('#titoloFile').val(); 
   
   var oldNomeFile = $('#oldNomeFile').val(); 
    
   
    var dataString = "azione=rinomina" + "&username=" + username + "&percorso=" + percorso + "&oldName=" + oldNomeFile + "&newName=" + titoloFile;
       
       $.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
            
             var risultato = $.trim(result);
             
             if (risultato == "Elemento rinominato con successo") {
                
                window.location.href='documento.php?documento=' + titoloFile + '&username='+ username + '&percorso=' + percorso + "/" + titoloFile;
                
                
             }
            
        }
           
       });
    

}


function salvaFile(){
	
	var nomeFile = $('#oldNomeFile').val(); 
	var testoFile = $('#testo').val();
    
    var dataString = "azione=salvaFile" + "&username=" + username + "&percorso=" + percorso + "&nomeFile=" + nomeFile + "&testoFile=" + testoFile;
       
	$.ajax({
        type: "POST",
        url: "http://" + nomeIp + "/php/fileHandle.php",
        data: dataString,
        cache: false,
        success: function (result) {
			
			
            
             var risultato = $.trim(result);
             
             if (risultato == "Elemento salvato con successo") {
                
                window.location.href='documento.php?documento=' + nomeFile + '&username='+ username + '&percorso=' + percorso + "/" + nomeFile;
                
                
             }
            
        }
           
       });
	
}
