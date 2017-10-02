'use strict'; var cx; var response; var b;
//$(document).ready(function(){  $('#button-register').bind('click', function(){  ( cx() == "DO") ? window.location.href='http://localhost/sicoban' : "Fail" })    });
cx = function (){
  	response = null;
    $('input[name=register]').each(function(index, element){

 		if( $('#' + element.id).val() == ""){

 			$('#' + element.id).addClass('input-error');
 		} else {
 			$('#' + element.id).removeClass('input-error');
 			$('#msg-error-user').html("");
 		}
 	});

    if(!$('input[name=register]').hasClass('input-error'))
    {
    	var data_session  = '&client_name=' + $('#client_name').val();
    	    data_session += '&client_lastname=' + $('#client_lastname').val();
    	    data_session += '&client_user=' + $('#client_user').val();
    	    data_session += '&client_password=' + $('#client_password').val();
    	    data_session += '&client_email=' + $('#client_email').val();
    	    data_session += '&client_phone=' + $('#client_phone').val();
    	    data_session += '&client_city=' + $('#client_city').val();




            data_session += '&client_IP=' + myip;
    	    response      =  $.ajax({ type: "POST",  url: '../_source_ajax/users/users.ajax.php?prefix=1', data: data_session, cache: false, async: false,
					success: function(sResponse){
					     $('input[name=register]').each(function(index, element){

                                if( $('#' + element.id).val() != "")
                                {
                                      $('#' + element.id).val("");
                                } 
                        });   
						return sResponse;
					}, 

					error: function(x, y, z){
							console.log('Error: ' + x + ' ' + y +' '+z);
					}
			    }).responseText;  
    } 
    return  response;
 }

 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}