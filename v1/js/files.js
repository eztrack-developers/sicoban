
function dragenter(e) {
  e.stopPropagation();
  e.preventDefault();
 
}

function dragover(e) {
  e.stopPropagation();
  e.preventDefault();
   
}
function drop(e) {
  e.stopPropagation();
  e.preventDefault();

  var dt = e.dataTransfer;
  selectItemFile(dt);
 
}



function selectItemFile(obj){

	if(typeof(obj) != "undefined" || obj != null){

		var fileName = obj.files[0].name;
		var txt  = fileName.substring(fileName.length -3, fileName.length);
	 	var id   = '#' + obj.id;
	 
		if(fileName != "" && txt != 'exp' && txt != 'txt'){

			$(id + '_Name').html("Extension no valida");
			$(id + '_btn').removeClass('red2');
			$(id + '_btn').addClass('gray2');
			$(id + '_btn').prop('disabled', 'disabled');
		}
		 else {
		 	//$('#5importFilePointExcel').append(obj.files[0]);
		 	$(id + '_Name').html(fileName);
			$(id + '_btn').removeClass('gray2');
			$(id + '_btn').addClass('red2');
			$(id + '_btn').removeAttr('disabled');


		 }
	
	}
	
} //selectItemFile(obj)

/*
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


	
} */







function importFileExcelPoints(obj, option){

	var text = '#' + obj.id;
	var id   = text.substr(0, text.length - 4);

	var fileData = $(id).prop('files')[0];
	var formData = new FormData();
	formData.append('file', fileData); 

	var url_type = "";
switch (option) {
	case 1:
		url_type = "../_source_ajax/files/upload_files.ajax_balances.php";
		break;
	
	case 2:
		url_type = "../_source_ajax/files/upload_files.ajax_movementsc43.php";
		break;
	case 3:
		url_type = "../_source_ajax/files/upload_files.ajax_consultationsCIE.php";
		break;
	case 4:
		url_type = "../_source_ajax/files/upload_files.ajax_stateCIE.php";
		break;
	case 5:
		url_type = "../_source_ajax/files/upload_files.ajax_book43.php";
		
		break;
	case 6:
		url_type = "../_source_ajax/files/upload_files.ajax_accountBalance.php";
		break;				
}
				

	$.ajax({ type: "POST",  contentType: false, processData: false,  url: url_type, data: formData, cache: false, async: true,
		beforeSend: function(){
			
			
			$('#popWindow').append('<table width="35%" border="0" cellpadding="0" cellspacing="0" class="pop-window-table" id="containerWindow"> <tr> <td  height="80px" style="padding: 0 15px" align="center"> <img src="../images/ajax-loader.gif" height="35px" width="35px" alt=""></td></tr> <tr> <td height="60px"  align="center" style="padding: 0 15px"><span style="color:#607D8B; font-size:16px;">Convirtiendo Archivo...</span></td> </tr> </table>');	
			showfronPage();
		},
		success : function(nameFile){
			console.log(nameFile);

			$('#containerWindow').remove();
			closeFrontPage()
			
			
			if(nameFile){
				location.href = 'http://www.sicoban.mx/_source_ajax/files/' + nameFile;	
			}else {
					alert('No se pudo generar el archivo excel.');
				} 

		},
		error:function(x, y, z){
			console.log('Error: ' + x + ' ' + y +' '+z);

		}
	 })

}































