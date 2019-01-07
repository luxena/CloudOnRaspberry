$(function(){
	
	var user = Cookies.get('username');
	var pass = Cookies.get('password');
	
	if(user && pass != ""){
		$('#username').val(user);
		$('#password').val(pass);
	}
	
	$('#btnLogin').click(function(){
		
		var username = $('#username').val();
		var password = $('#password').val();
		
		Cookies.set('username', username, { expires: 3 });
		Cookies.set('password', password, { expires: 3 });
		
		//alert(Cookies.get('username'));
	});
	
	
	
	
	
	
});
	
	
	
