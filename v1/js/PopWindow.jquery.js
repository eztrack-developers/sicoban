(function(){

	$.fn.extend({
		PopWindow:function(args){
			'use_strict'; var _init;
		    defaults = 
		    {
		    	Width: "100", 
		    	Height: "50",
		    	Url : "",

		    }

			var options   = $.extend({}, defaults, args); 
			var plugin = this;
			if(options != null && typeof(options) != "undefined")
			{
				//_init();
			}

			//_init = function(){
				var domwindow = document.createElement("div");
				domwindow.id  = "frontpage2";
				domwindow.className = "frontpage";
				$(this).append(domwindow);
				var marginTop =  ((100 - options.Height) / 2) + 5;
				var domwindowdata  = "<div id=\"popWindow2\"  class=\"subcontent\" style=\"position:relative; margin-top: calc(" +  marginTop +"vh); height:calc(" + options.Height + "vh); width:calc(" + options.Width + "vh) \" >";
			    domwindowdata += "<div style=\"height:20px;  z-index:502; padding-top:5px; padding-right:5px;\"><img onclick=\"_destroy()\" id=\"close-tooltip\" style=\"float:right; cursor:pointer;\" src=\"../images/close-tooltip.svg\" width=\"20\" height=\"20\"/></div>";
			    domwindowdata += "<div style=\"padding-left:20px; padding-right:20px; padding-bottom:20px; position:relative;\" id=\"popWindow2-body\"></div>";
			    domwindowdata += "</div>";
  
			    $("#frontpage2").append(domwindowdata);
			  // _ajax();
			//}	

			


			//var _ajax = function(){
				$.ajax({ type: "POST",  url: options.Url, data: "", cache: false, async: true,
					success: function(sResponse){
						$("#popWindow2-body" ).append(sResponse);
						setTimeout(function(){
	                		_show();
	      				 }, 100);
					}, 

					error: function(x, y, z){
							console.log('Error: ' + x + ' ' + y +' '+z);
					}
		        });
			//}
			
			
			 var _show = function() {
			 		marginTop = (100 - options.Height) / 2;
			 	    $("#frontpage2").animate({opacity:1}, 150, function(){
			 	    	$("#popWindow2").animate({opacity: 1, marginTop: ( marginTop * 6)+"px"},150 ); 
			 	    });
			 	     
			 	} 
			
			
			_destroy = function(){
				 marginTop =  ((100 - options.Height) / 2) + 5;				  
				
				$("#popWindow2").animate({opacity: 0, marginTop: ( marginTop * 6)+"px"},150, function(){
					$("#frontpage2").animate({opacity:0}, 350, function(){
						$('#frontpage2').remove();
					});
				} ); 
			} 	
				
		}

	})

})()