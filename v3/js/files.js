
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
			$(id + '_btn').removeClass('btn--red');
			$(id + '_btn').addClass('btn--gray');
			$(id + '_btn').addClass('not-active');
		}
		 else {
		 	//$('#5importFilePointExcel').append(obj.files[0]);
		 	$(id + '_Name').html(fileName);
			$(id + '_btn').removeClass('btn--gray');
			$(id + '_btn').addClass('btn--red');
			$(id + '_btn').removeClass('not-active');


		 }
	
	}
	
} //selectItemFile(obj)

function importFileExcelPoints(obj, option)
{
	var text = '#' + obj.id;
	var id   = text.substr(0, text.length - 4);
	var fileData = $(id).prop('files')[0];
	var formData = new FormData();
	formData.append('file', fileData); 
	var url_type = "";
switch (option) 
{
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
		 $('body').PopWindow({ Width: '350', Height: '120', Url:'../_source_show/myaccount/form.window-convert.php'})
	},
	success : function(nameFile){
		console.log(nameFile);
		_destroy();
		/*if(nameFile){
			location.href = 'http://www.sicoban.mx/_source_ajax/files/' + nameFile;	
		}else {
				alert('No se pudo generar el archivo excel.');
			} */

	},
	error:function(x, y, z){
		console.log('Error: ' + x + ' ' + y +' '+z);
	}
 })

}































