
function saveClient(id){

	var data;
		if(data == null){
			data  += '&option=1';
		} else {
			data  += '&option=5';
			data  += '&clientID=' + id;
		}

	    data += '&user=' + $('#user_id').val();
	    data += '&name=' + $('#user_name').val();
	    data += '&rfc=' + $('#user_rfc').val();
	    data += '&address=' + $('#user_address').val();
	    data += '&address2=' + $('#user_address2').val();
	    data += '&phone=' + $('#user_phone').val();
	    data += '&state=' + $('#user_state option:selected').val();
	    data += '&city=' + $('#user_city').val();
	    data += '&zip=' + $('#user_zip').val();
	    data += '&email=' + $('#user_email').val();
	    data += '&comments=' + $('#user_comments').val();

	    if($('#user_active').is(':checked')){
	    	data += '&active=1';
	    }

	    if($('#user_inactive').is(':checked')){
	    	data += '&active=2';
	    }

	    $.ajax({ type: "POST",  url: '../_source_ajax/clients/clients.ajax.php', data: data, cache: false, async: true,
			beforeSend: function(){

			},

			success: function(response){

				alert(response);
				loadScrips('../_source_show/clients/clients.list.php')

			}, 

			error: function(x, y, z){
					console.log('Error: ' + x + ' ' + y +' '+z);
			}
	    });



}



function dataTableClients(){

	$('#table_clients').dataTable({
		"bProcessing": true, "bServerSide": true, "bFilter": true, "bAutoWidth": false, "sPaginationType": "full_numbers", 
		"aoColumns": [	{"bSortable": true, "bSearchable": true, "visible":false}, 
						{ "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center"}, 
						{ "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center"}, 
						{ "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center"},
						{ "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center"},
						{ "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center"},
						{ "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center"},
					    { "bSortable": false, "class": 'details-control',  "bSearchable": true, "sClass": "center",
					    mRender : function(data, type, full){
								var ret = '';
								ret += '<label onclick="javascript:resetPassword(\'' + full[0] + '\');" title="Restaurar contraseña"><input type="button"  width="25" height="25" class="restore" /></label>';
								ret += '<label onclick="javascript:loadScrips(\'../_source_show/clients/clients.form.php\', \'CliID=' + full[0] + '\');" title="Editar"><input type="button"  width="25" height="25" class="edit" /></label>';
								ret += '<label onclick="javascript:deleteClient(\'' + full[0] + '\');" title="Eliminar"><input type="button"   width="25" height="25" class="delete" /></label>';
								return ret;
							}

						},
					],
		"iDisplayLength": 25,
		"aaSorting": [ [1, 'asc'] ],
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {	},	
		"fnDrawCallback": function (oSettings) {
		
		},
		"oLanguage": { "sUrl": "../language/es.txt" },
		"sAjaxSource": "../_source_ajax/clients/clients_list_processing.php"  				


	});

}



function resetPassword(id){

	if(typeof(id) != "undefined" || id != null)
	{

		var data = '&option=3' + '&clientID=' + id;
		$.ajax({ type: "POST",  url: '../_source_ajax/clients/clients.ajax.php', data: data, cache: false, async: true,
			beforeSend: function(){

			},

			success: function(response){

				if(response.trim() == 'Done'){
					alert('La contraseña por default ha sido restablecida');
				} else {
					alert('Se produjo un error durante el restablecimiento de la contraseña');
					
				}
				

			}, 

			error: function(x, y, z){
					console.log('Error: ' + x + ' ' + y +' '+z);
			}
		});
	}
	

}


function deleteClient(id){
	if(typeof(id) != "undefined" || id != null)
	{

		var data = '&option=4' + '&clientID=' + id;
		$.ajax({ type: "POST",  url: '../_source_ajax/clients/clients.ajax.php', data: data, cache: false, async: true,
			beforeSend: function(){

			},

			success: function(response){

				if(response.trim() == 'Done')
				{
					alert('El cliente ha sido eliminado correctamente.');
					loadScrips('../_source_show/clients/clients.list.php')
				} else {
					alert('Se produjo un error durante la eliminacion del cliente.');
					
				}
				

			}, 

			error: function(x, y, z){
					console.log('Error: ' + x + ' ' + y +' '+z);
			}
		});
	}

}












