
function sessionStart(){

	 $('input[name=session]').each(function(index, element){

 		if( $('#' + element.id).val() == ""){

 			$('#' + element.id).addClass('input-error');
 		} else {
 			$('#' + element.id).removeClass('input-error');
 		}
 	});

	if(!$('input[name=session]').hasClass('input-error'))
	{
		var data = '&user=' + $('#session_users').val() + '&password=' + $('#session_passwords').val() + '&token_user=' + $('#new_user_token').val();
		$.ajax({url: '_source_ajax/login/login.ajax.php', type: 'POST', data: data, cache: false, async: false, 
				success: function(data)
				{
	    
		   			if(data == "SUCESS"){
		   				
		   				location.href = "main/"; 

		   			} else {

		   				$('#msg').html(data);
		   			}	
		
				},
				error: function(x, y, z){
					console.log(x);

				}	
		
		});
	}	
}


     function enter_pwd(e) {
       var key;
       if(window.event)
          key = window.event.keyCode;     //IE
       else
          key = e.which;     //firefox
       if(key == 13)  {
        $('#session_passwords').focus();    
          return false;
       }
       else
          return true;      
    }
    
    function disableEnterKey(e)
    {
       var key;
       if(window.event)
          key = window.event.keyCode;     //IE
       else
          key = e.which;     //firefox
       if(key == 13)  {
          sessionStart();   
          return false;
       }
       else
          return true;
    }  