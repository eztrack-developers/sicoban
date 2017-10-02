<?php 


/**
* 
*/
class email
{
	
	
	public function _sendEmailToVerifyUser($to, $subject, $body){

		    $msg  = "";
		    $from = 'noresponder-email@sicoban.mx';
			$url  = 'https://api.sendgrid.com/';
			$user = 'jaimeor';
			$pass = 'qwerty86';
			

			if($to != "") {
				$json_string = array('to' => array($to), 'category' => array('register_sicoban'));	
				$params = array('api_user'  => $user, 'api_key'   => $pass, 'x-smtpapi' => json_encode($json_string), 'to' => $to,  'subject'  => $subject, 'html'  => $body, 'text' => '', 'from' => $from);						
				
				$request =  $url.'api/mail.send.json';
				
				// Generate curl request
				$session = curl_init($request);
				// Tell curl to use HTTP POST
				curl_setopt ($session, CURLOPT_POST, true);
				// Tell curl that this is the body of the POST
				curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
				// Tell curl not to return headers, but do return the response
				curl_setopt($session, CURLOPT_HEADER, false);
				// Tell PHP not to use SSLv3 (instead opting for TLS)
				curl_setopt($session, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				// obtain response
				$response = curl_exec($session);
				curl_close($session);
				
				$response = json_decode($response,true);
				if($response['message'] == "success") {
					$msg = "Un correo ha sido enviado al email que dio de alta para su confirmación.";
				}
				else {
					echo("Problemas al enviar correo electronico, favor de notificarlo a Sicoban (".$response['errors'][0].")." . $subject);
				}		
			}
			else {
				$msg = "Agrega un correo.";
			}
			return $msg;
		
	}


	public function _bodyEmailVerifyUser($name, $token){

		$body = "";
		if($name != "")
		{

			$body .= "<html lang=\"en\">
					<head>
					    <meta charset=\"UTF-8\">
					    <title></title>
					    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto' >
					    <style type=\"text/css\">
					        body { margin-top:0px; 
					               margin-bottom: 0px;
					                margin-left: 0px; 
					                margin-right: 0px; 
					                font-family: 'Corbel', Arial, sans-serif; 
					             }
					    </style>
					</head>
					<body>
					    
					<div style=\"background-color:#FFFFFF; width:100%\">
					    <table width=\"100%\" style=\"min-width:680px;\" cellpadding=\"0\" cellspacing=\"0\">
					        <tr>
					             <td align=\"center\">
					                <table bgcolor=\"#FFFFFF\" width=\"680\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:#CCC solid 1px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;\">
					                    <tr>
					                        <td align=\"center\"><br /><br />
					                            <table width=\"640\" >
					                                <tr>
					                                    <td><span style=\"font-size:22px; color:#E86860; font-family: 'Roboto', Arial, sans-serif;\">Confirme su correo electrónico</span> </td>
					                                </tr>
					                                <tr>
					                                    <td height=\"40px\">
					                                        <span style=\"color:#5B757F; font-size:13px; font-family: 'Roboto', Arial, sans-serif;\">Estimado/a " . $name . ":</span>
					                                    </td>
					                                </tr>
					                                 <tr>
					                                    <td align=\"left\">
					                                        <div id=\"imgContainer\"> <span style=\"color:#5B757F; font-size:13px; font-family: 'Roboto', Arial, sans-serif;\">Gracias por abrir una cuenta en Sicoban. Para utilizar su cuenta, primero deberá confirmar su correo electrónico haciendo clic en el vínculo a continuación.</span></div>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td align=\"center\" height=\"70px\">
					                                          <div style=\"padding-left:30px; padding-right:30px; padding-top:20px; padding-bottom:20px; font-size:12px; font-family: 'Roboto', Arial, sans-serif;\">
					                                            <a style=\"padding:8px; background-color:#E86860; -moz-border-radius:2px; -webkit-border-radius:2px; border-radius:2px; text-decoration:none; color:#FFFFFF;\" href=\"http://www.sicoban.mx/?token=".$token."\">Confirme su correo electrónico</a>
					                                        </div>
					                                    </td>
					                                </tr>
					                            </table>
					                        </td>
					                    </tr>
					                
					                    <tr>
					                        <td height=\"105\" align=\"center\" valign=\"top\" >                        
					                            <table width=\"640\" style=\"border-top:#CCC solid 1px;\">
					                                <tr>
					                                    <td width=\"100\">
					                                          <img src=\"http://www.sicoban.mx/images/logo-sicoban.svg\" height=\"80px\" width=\"130px\">
					                                    </td>
					                                    <td valign=\"bottom\">&nbsp;
					                                      
					                                    </td>
					                                    <td style=\"font-size:11px; color:#666;\" align=\"right\">
					                                        <span style=\"font-family: 'Roboto', Arial, sans-serif; color:#5B757F;\">¿Necesita Ayuda?</span><br /> <span style=\"font-family: 'Roboto', Arial, sans-serif;color:#5B757F;\">Local Mexicali (686 ) 509 8051</span> <br /> <span style=\"font-family: 'Roboto', Arial, sans-serif; color:#5B757F;\">soporte@sicoban.mx</span>
					                                    </td>
					                                </tr>
					                            </table>
					                            <br>
					                        </td>
					                    </tr>
					                </table>
					                <table bgcolor=\"#FFFFFF\" width=\"680\" height=\"100%\" cellpadding=\"0\" cellspacing=\"10\">
					                    <tr>
					                        <td>
					                            <span style=\"color:#5B757F; font-size:11px; font-family: 'Roboto', Arial, sans-serif;\">No responda a este mensaje. Este correo electrónico ha sido enviado a través de un sistema automatizado que no permite dar respuesta a las preguntas enviadas a esta dirección. Para ponerse en contacto con nosotros, marque el numero o envie un correo en los datos descritos en la parte superior.</span>
					                        </td>
					                    </tr>
					                </table>
					                
					           </td>
					        </tr>
					    </table>
					</div>
					</body>
					</html>";
		}
		return $body;
	}



}



 ?>