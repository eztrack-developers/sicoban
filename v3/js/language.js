$(document).ready(function() {
		
		var url = (navigator.language == "es") ? 'language/espanol.xml' : 'language/ingles.xml'; 
		$('#leng_hidden').val((navigator.language == "es") ? 'espanol' : 'ingles');
		$.ajax({
			url: url,
			type: 'GET',
			//data: {lenguaje: 'español'},
			success: function (dataxml) {
				xmlLoad(dataxml);						
			}
		});

		$('#ingles, #espanol').click(function(event) {
			$.ajax({
				url: 'language/' + this.id + '.xml',
				type: 'GET',
				success: function (dataxml) {
					xmlLoad(dataxml);	
				}
			}); 
			$('#leng_hidden').val(this.id);
		});

	
	function xmlLoad(dataxml){
			var tagUsuario     = dataxml.getElementsByTagName("usuario")[0].textContent;
			var tagContraseña  = dataxml.getElementsByTagName("contrase")[0].textContent;
			var tagIdioma      = dataxml.getElementsByTagName("idioma")[0].textContent;
			var tagBoton       = dataxml.getElementsByTagName("boton")[0].textContent;

			usuario.innerHTML  = tagUsuario;
			contrase.innerHTML = tagContraseña;
			idioma.innerHTML   = tagIdioma;
			btn.innerHTML      = tagBoton;
	}
});