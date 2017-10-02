<?php 

$xml = simplexml_load_file('language/espanol.xml');
$token = null;
if(isset($_GET)){

  if(isset($_GET['token'])){
    $token = $_GET['token'];
  }

}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sicoban | Login</title>

  <link rel="stylesheet" href="css/session-style.css">
  <link rel="icon" href="images/logo-sicoban-icon.ico">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="js/session.js"></script> 
</head>
<body>

  <div class="content-main">
      <input type="hidden" value="<?php echo( $token ); ?>" id="new_user_token" >
      <div class="subcontent-main">
          <br>
          <br>
            <img src="images/logo-sicoban.svg" height="30px" width="190px" alt="">
          <!--<span style="color:#607D8B; font-size:25px;">SICOBAN</span>-->
          <br>
         
           <table cellspacing="0" cellspacing="0" border="0" width="100%" style="margin: 0 auto; text-align: left;" class="table-form">
             <tr>
               <td>
                   <p class="background-line"><span>Inicia Sesión</span></p>
               </td>
             </tr>
              <tr>
                <td colspan="3" height="90px">
                    <input type="text" id="session_users" class="input" name="session" onKeyPress="return enter_pwd(event)" placeholder="Usuario">
                </td>
              </tr>
              <tr>
                <td colspan="3" height="90px">
                    <input type="password" id="session_passwords" class="input" name="session" onkeypress="return disableEnterKey(event)" placeholder="Contraseña">
                </td>
              </tr>
               <tr>
                  <td height="30px" colspan="3" align="center" valign="top">
                    <label class="msg_error" id="msg"></label>
                  </td>
                </tr>
                <tr>
                
                  <td height="7px" colspan="3">
                    <input type="button" class="button-session" onclick="sessionStart()" value="<?php echo($xml->section[0]->boton); ?>">
                  </td>
                </tr>
               
                <tr>
                  <td align="center" height="100px">
                          <p class="background-line"><span>O crea una cuenta</span></p>
                  </td>
                </tr>
                <tr>
                    <td>
                       <input type="button" class="button-session-account" onclick="window.location.href='http://www.sicoban.mx/register-clients/'" value="<?php echo("Registrate"); ?>">
                    </td>
                    
                </tr>
             
           </table>
      </div>

  </div>
     
  
</body>
<script>
  $(document).ready(
    function() {
      $('#session_users').focus();    
    }
  );
  
</script>
</html>













