(function(){

	$.fn.extend({
		validate:function(){

			this.each(function(evt){
				var $this = $(this);

				var typ = $this.attr("type");
				 
				switch(typ){
					case "email":
 
					//$this.focus(function(){
					 
						//$this.keypress(function(){
						 
							var expresion = /^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
							 
							var valor = $this.val();
							 
							if(!expresion.test(valor)){
							 
								$this.addClass('input-error');
							 
							}else{
							 	
								$this.removeClass('input-error');
							 
							}
						 
						//});
					 
					//});
					 
					break;

					case "tel":
						 evt = (evt) ? evt : window.event;
					    var charCode = (evt.which) ? evt.which : evt.keyCode;
					    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					        return false;
					    }
					    return true;
					break

				}

			})
		}	
	});
})();

