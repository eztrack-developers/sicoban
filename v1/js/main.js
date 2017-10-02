

function closeSession(url){
	
	location.href = url;
}


function loadScrips(url, data){

	
	$('#content').fadeOut(500, function(){
		$('#loading').css('display', 'block');
		load(url, data); 
		return false;	 
	});
	
	
}



function load(url, data){
	
	$.ajax({type: 'POST', url: url, data: data, cache: false, async: false,
			success: function(data){
				
				$('#content').html(data);
				$('#loading').css('display', 'none');
				$('#content').fadeIn(500, loadFunction());
				

			},

			error: function(x, y, z){
				console.log(y);
			}


		});


	
}


function loadFunction(){
	
		if($('#table_clients').length > 0 ){
			dataTableClients();
		}
	}


function showfronPage(){

	
	if($("#frontpage").css("display", "none")){

 		$("#frontpage").css("display", "block");
		 $("#containerWindow").animate({opacity: 1,},300 );
		$('#popWindow').css('display', 'block');
	}
	
}



function closeFrontPage(){

	
	if($("#frontpage").css("display", "block")){

		$("#containerWindow").animate({opacity: 0,},300 );
		$('#popWindow').css('display', 'none');   
		$("#frontpage").css("display", "none");
		
	}	


	
}

function uploadPhoto(obj){

	if(typeof(obj) != "undefined" || obj != null){

		var fileName = obj.files[0].name;
		var image  = fileName.substring(fileName.length -3, fileName.length);
	 	var id   = '#' + obj.id;
	 
		if(fileName != "" && image != 'jpg' && image != 'jpeg'){

			$('#uploadFile_photo').val("Extension no valida");
			
		}
		 else {
		 	
		 	$('#uploadFile_photo').val(fileName);
			


		 }
	
	}
}

function uploadPhotoToServer(){


	var fileData = $('#upload-imagen').prop('files')[0];
	var formData = new FormData();
	formData.append('image', fileData); 

	$.ajax({ type: "POST",  contentType: false, processData: false,  url: "../_source_ajax/files/upload_image_file.php", data: formData, cache: false, async: true,
		beforeSend: function(){
			
			
			$('#popWindow').append('<table width="35%" border="0" cellpadding="0" cellspacing="0" class="pop-window-table" id="containerWindow"> <tr> <td  height="80px" style="padding: 0 15px" align="center"> <img src="../images/ajax-loader.gif" height="35px" width="35px" alt=""></td></tr> <tr> <td height="60px"  align="center" style="padding: 0 15px"><span style="color:#607D8B; font-size:16px;">Subiendo imagen...</span></td> </tr> </table>');	
			showfronPage();
		},
		success : function(response){
			
			
			   $('#containerWindow').remove();
			   closeFrontPage()
			    loadScrips('../_source_show/files/home_page.php');		
			
			
			

		},
		error:function(x, y, z){
			console.log('Error: ' + x + ' ' + y +' '+z);

		}
	 })

}


function pickAColor(obj){

	if(typeof(obj) != "undefined" || obj != null){

		var iColor = '&color=' + $('#' + obj.id).data('color');
		$.ajax({ type: "POST",   url: "../_source_ajax/utilities.ajax.php", data: iColor, cache: false, async: true,
		
		success : function(response){
			
					alert('Guardado');
			
			
			

		},
		error:function(x, y, z){
			console.log('Error: ' + x + ' ' + y +' '+z);

		}
	 })



	}

}









