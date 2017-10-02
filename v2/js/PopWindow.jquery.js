(function(){

	$.fn.extend({
		PopWindow:function(args){
			'use_strict'; var _init;
		    defaults = 
		    {
		    	Width: "100", 
		    	Height: "50",
		    	Url : "",
		    	Data : "",
		    	Post: ""

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
				domwindow.className = "frontpage2";
				$(this).append(domwindow);
				ht = (options.Height * 50) / 100;
				wt = (options.Width  * 50) / 100;
		
				var domwindowdata  = "<div id=\"popWindow2\"  class=\"subcontent2\" style=\"height:" + ht +"%; width:" + wt + "% \" >";
			    domwindowdata += "<div style=\"height:20px;  width:99%; z-index:502; padding-top:5px; padding-right:5px;\"><img onclick=\"_destroy()\" id=\"close-tooltip\" style=\"float:right; cursor:pointer;\" src=\"../images/close-tooltip.svg\" width=\"20\" height=\"20\"/></div>";
			    domwindowdata += "<div style=\"padding-left:20px; padding-right:20px; height: calc(93% - 20px); padding-bottom:20px; overflow:auto;\" id=\"popWindow2-body\"></div>";
			    domwindowdata += "</div>";
  
			    $("#frontpage2").append(domwindowdata);
			  // _ajax();
			//}	

			


			//var _ajax = function(){
				var send = '&' + options.Post +  '=' + options.Data;
				$.ajax({ type: "POST",  url: options.Url, data: send, cache: false, async: true,
					success: function(sResponse){
						setTimeout(function(){
	                		_show(sResponse);
	      				 }, 100);
					}, 

					error: function(x, y, z){
							console.log('Error: ' + x + ' ' + y +' '+z);
					}
		        });
			//}
			
			
			 var _show = function(sResponse) {
			 		//marginTop = (100 - options.Height) / 2;		 		
			 	    $("#frontpage2").animate({opacity:1}, 300, function(){
			 	    	//$("#popWindow2").animate({opacity: 1, marginTop: ( marginTop * 6)+"px"},150 ); 
			 	    	$("#popWindow2").animate({
			 	    		height: options.Height + "%",
			 	    		width: options.Width + "%",
			 	    		opacity:1
			 	    	  }, 230, function(){
			 	    	  	$("#popWindow2-body" ).append(sResponse);
			 	    	  	  _chargeElements();
			 	    	  });
			 	    });
			 	    $('body').addClass('position');
			 	   
			 	} 
			
			
			_destroy = function(){
					  
				$("#popWindow2-body" ).html("");
				$("#popWindow2").animate({opacity: 0, height: ht + "%", width: wt + "%"},230, function(){
										$("#frontpage2").animate({opacity:0}, 300, function(){
						$('body').removeClass('position');
						$('#frontpage2').remove();
					});
				} ); 
			} 	
				
		}

	})

})()