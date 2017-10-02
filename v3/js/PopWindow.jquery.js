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
				$(this).css('overflow', 'hidden');
				var domwindow = document.createElement("div");
				domwindow.id  = "frontpage2";
				domwindow.className = "frontpage2";
				$(this).append(domwindow);
				var hpx = $(document).height();
				$('#frontpage2').css('height', hpx + 'px');
				var height = options.Height/4;
				var width  = options.Width/4;

				var margin_top  = height/2;
				var margin_left = width/2;
				var domwindowdata  = "<div id=\"popWindow2\"  class=\"subcontent2\" style=\"height:" + height+"px; width:" + width + "px; margin-top:-" + margin_top + "px; margin-left: -" + margin_left + "px; \" >";
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
						_show(sResponse);
					
					}, 

					error: function(x, y, z){
							console.log('Error: ' + x + ' ' + y +' '+z);
					}
		        });
			//}
			
			
			 var _show = function(sResponse) {	 		
			 	    $("#frontpage2").animate({opacity:1}, 300, function(){
			 	    	//$("#popWindow2").animate({opacity: 1, marginTop: ( marginTop * 6)+"px"},150 ); 
			 	    	$("#popWindow2").animate({
			 	    		opacity:1,
			 	    		height: options.Height + "px",
			 	    		width: options.Width + "px",
			 	    		marginTop: '-' + options.Height/2 + 'px',
			 	    		marginLeft: '-' + options.Width/2 + 'px'
			 	    		
			 	    	  }, 230, function(){
			 	    	  	$("#popWindow2-body" ).append(sResponse);
			 	    	  	 
			 	    	  });
			 	    	
			 	    });
			 	    $('body').addClass('position');

			 	   
			 	} 
			
			
			_destroy = function(){
					  
				$("#popWindow2-body" ).html("");
				$("#popWindow2").animate({
								opacity: 0, 
								height: height + "px", 
								width: width + "px",
								marginTop: '-' + margin_top + 'px',
			 	    		     marginLeft: '-' + margin_left + 'px'
							},300, function(){
							     $("#frontpage2").animate({opacity:0}, 300, function(){
						             $('body').removeClass('position');
						             $('#frontpage2').remove();
						             $('body').css('overflow', 'auto');

					              });
				            } ); 
			} 	
				
		}

	})

})()