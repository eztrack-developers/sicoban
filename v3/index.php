<?php 

$xml = simplexml_load_file('language/espanol.xml');
$token = null;
if(isset($_GET)){

  if(isset($_GET['token'])){
    $token = $_GET['token'];
  }

}
  if(!isset($_SESSION))     
  { 
    session_start(); 
    session_cache_limiter('nocache, private');
    //revisar que este loggeado   
      if(isset($_SESSION['id'])) {
        header("Location: http://www.sicoban.mx/main/");  
        die();
      }  else 

      { 
    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
  <meta name="description" content="Realiza la conversion de archivos xml o exp de bancos a excel en documentos legibles">
  <meta name="keywords" content="exp, bancomer, bancos, conversión, excel, méxico, xml, Estados de cuenta Cash Windows, Exportación cuaderno 43, Estado de cuenta CIE diario, Consulta CIE movimientos del día por cuenta, Movimientos del día C43 (sólo registro 22), Saldos">
  <meta name="author" content="Jaime Ortiz">
  <title>Sicoban | Login</title>

  <link rel="stylesheet" href="css/session-style.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
  <link rel="icon" href="images/logo-sicoban-icon.ico">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="js/session.js"></script> 
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-96648834-1', 'auto');
    ga('send', 'pageview');
</script>
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
                    <a class="red white" onclick="sessionStart()">ENTRAR</a>
                  </td>
                </tr>
               
                <tr>
                  <td align="center" height="100px">
                          <p class="background-line"><span>O crea una cuenta</span></p>
                  </td>
                </tr>
                <tr>
                    <td>
                       <a class="silver" onclick="window.location.href='http://www.sicoban.mx/register-clients/'">REGISTRATE</a>
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

<?php 
      }
  }
 ?>











