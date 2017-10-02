function changePassword(id_user){
	
	$('input').each(function(index, element){
	
		if($('#' + element.id).val() == ""){
			$('#error_msg' + index).html('*Campo requerido');
		}
	});

	if($('#old_pass').val() != "" || $('#new_pass').val() != "" || $('#repeat_pass').val() != ""){

		if($('#new_pass').val() == $('#repeat_pass').val()){

				var data = '&option=2' + '&oldpass=' + $('#old_pass').val() + '&newpass=' + $('#new_pass').val()  + '&user=' + id_user;
			    $.ajax({ type: "POST",  url: '../_source_ajax/clients/clients.ajax.php', data: data, cache: false, async: true,
					beforeSend: function(){

					},

					success: function(response){

						alert(response);
						loadScrips('../_source_show/clients/myaccount.form.php')

					}, 

					error: function(x, y, z){
							console.log('Error: ' + x + ' ' + y +' '+z);
					}
			    });


		}else {
			$('#error_msg2').html('*Las contraseñas no coinciden');
		}
	}
}

function editUser(){
		
    //alert($('#hidden_id_user').data('id'));
    var formElement = document.getElementById("form_edit_user");
    var formData = new FormData(formElement);
    formData.append("id_user", $('#hidden_id_user').data('id'));

     $.ajax({ type: "POST",  url: '../_source_ajax/users/users.ajax.php?prefix=2', data: formData, async: true, contentType: false, cache: false, processData: false, 
		beforeSend: function(){

		},

		success: function(response){

			if(response == 'DONE')
			{
				loadScrips('../_source_show/clients/myaccount.form.php')
			}
			

		}, 

		error: function(x, y, z){
				console.log('Error: ' + x + ' ' + y +' '+z);
		}
    });

}