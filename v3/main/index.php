<?php 

session_start();

$xml = simplexml_load_file('../language/espanol.xml');
if(!isset($_SESSION['id'])){
    header("Location: ../_source_classes/users/sessionout.php");

} else {
    require_once('../_source_classes/menu/menu.class.php');
    require_once('../_db_conecction/dbconecction.php');
    require_once('../_source_classes/images/utilities.class.php');

    $utilities = new utilities();
    $status    = $utilities->getStatusUser($_SESSION['id']);

    if(!is_null($status))
    {
      $sta_user = $status->fetch_assoc();
    }

    if(isset($_SESSION['access'])){
      $now = date('Y-m-d H:i:s');
      $tiempo_transcurrido = (strtotime($now)-strtotime($_SESSION["access"])); 
   
      if($tiempo_transcurrido >= 600){
        echo('<script>alert("Su sesión ha expirado");</script>');
        echo('<script>location.href="../_source_classes/users/sessionout.php"</script>');
        
      }
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="description" content="Realiza la conversion de archivos xml o exp de bancos a excel en documentos legibles">
  <meta name="keywords" content="exp, bancomer, bancos, conversión, excel, méxico, xml, Estados de cuenta Cash Windows, Exportación cuaderno 43, Estado de cuenta CIE diario, Consulta CIE movimientos del día por cuenta, Movimientos del día C43 (sólo registro 22), Saldos">
  <meta name="author" content="Jaime Ortiz">
	<title>Sicoban | <?php echo($_SESSION['user']); ?></title>

  <link rel="stylesheet" type="text/css" href="../css/styles.css" />
  <link rel="icon"       type="text/css" href="../images/logo-sicoban-icon.ico">
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css"  />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../css/PopWindow.jquery.css" />
   <link rel="stylesheet" type="text/css" href="../css/icons.css" />
  

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript" src="../js/files.js"></script>
  <script type="text/javascript" src="../js/clients.js"></script>
  <script type="text/javascript" src="../js/users.js"></script>
  <script type="text/javascript" src="../js/PopWindow.jquery.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-96648834-1', 'auto');
      ga('send', 'pageview');
</script>
</head>
<body onLoad="setInterval('_onload_()', 600000);">
<div class="menu">  
        <div style="position:absolute; width:250px; height: 60px; margin-top:10px; text-align:center;">
         <!--   <span style="color:#FFFFFF; font-size:25px;">SICOBAN</span> -->
          <img src="../images/logo-sicoban.svg" height="30px" width="190px" alt="">
        </div>   
        <div style="width:250px; height: 50px; margin-top:15px; text-align:center; float:right; margin-right:130px;">
<?php 
  
  if($sta_user['Us_Status'] == 'trial')
  {
    $DAYS_FREE_TRIAL = 30;
    $seconds  =  strtotime('now') - strtotime($_SESSION['creationDate']);
    $dif      = intval($seconds/60/60/24);
    $dif_days = $DAYS_FREE_TRIAL - $dif;
    if($dif_days <= 0)
    {
       //echo( '<span class="msg_error" style="font-size:11px;">Prueba gratis vencida</span>' ); 
    ?>
       <script>
        $(document).ready(function(){
          
           //$('body').PopWindow({ Width: '800', Height: '400', Url:'../_source_show/method-paid/method-paid.php'})
             
        }) 
        </script>
    <?php 
    } else{
      echo( '<span style="color:#7B7C7B; font-size:11px;text-decoration: underline;">Prueba gratis restan ' . $dif_days . ' dias</span>');
    }
  }
?>
        </div>       
        <div style="" class="navfooter" onclick="javascript:$('body').PopWindow({ Width: '500', Height: '140', Url:'../_source_show/myaccount/form.window.php'})">
     			  <table border="0a" style="margin: 0 auto; text-align: left;" cellspacing="0" cellpadding="0">
    	             <tr >
    	                 <td height="45px" width="40px" align="center" valign="center"><img src="../images/icon_user.svg" alt="" height="18" width="18" style="margin-top:10px;"/></td>
    	                 <td align="center" width="40px" height="40px" valign="center"><span style="font-size:13px;  color:#7B7C7B"><?php echo($_SESSION['user']); ?></span></td>
    	                 <td width="30px"  width="40px" align="center" valign="center"><img style="cursor:pointer; margin-top:7px"  src="../images/arrow_menu_Hkjgg45fFD66.svg" alt=""  height="14" width="12"  /></td>
    	             </tr>
             </table>  
     		</div>	
   
</div>      
<div class="contentmain" >
       <div class="tableft">  
          <table width="100%" border="0" cellspacing="0" cellpadding="0" border="0" class="link">
          <?php 

            if($_SESSION['user'] == 'admin'){
  ?>
           <tr>
             <td width="15%" align="right">   
                                <img src="../images/icon_user.svg"  height="15px" width="15px" alt="">
                           </td>
            <td align="left" height="40px" style="padding-left:15px;"onclick="loadScrips('../_source_show/clients/clients.list.php')">
                <span class="span-link" >Clientes</span>  
            </td>
          </tr>

  <?php
            }
           ?>
          <tr>
            <td width="15%" align="right">   
                  <img src="../images/icon_main.svg"  style="margin-top:7px;" height="15px" width="15px" alt="">
             </td>
            <td align="left" height="40px" style="padding-left:15px;"onclick="loadScrips('../_source_show/files/home_page.php')">
                <span class="span-link" >Principal</span>  
            </td>
          </tr>
<?php 
          $men  = new menu();
          $menu = $men->getMenu();
          if(!is_null($menu))
          {
             $cx = $menu->num_rows;
             if($cx > 0)
             {

                if($sta_user['Us_Status'] == 'trial')
                {
                    //$dif_days > 0
                    if( $dif_days != 0 )
                    {
                        foreach ($menu as $key ) 
                        {                   
?>    
                           <tr>
                           <td width="15%" align="right">   
                                <img src="../images/icon_document.svg"  style="margin-top:7px;"  height="15px" width="15px" alt="">
                           </td>
                            <td align="left" height="40px" style="padding-left:15px;"onclick="<?php echo($key['Men_URL']) ?>"> 
                              <span class="span-link" ><?php echo(utf8_encode($key['Men_Descrip']))  ?></span>  
                            </td>
                          </tr>
<?php   
                        }
                    }  
                     
                 } else {
                    foreach ($menu as $key) 
                    {
  ?>    
                         <tr>
                          <td  width="15%" align="right">   
                                <img src="../images/icon_document.svg"  style="margin-top:7px;"  height="15px" width="15px" alt="">
                           </td>
                          <td align="left" height="40px" style="padding-left:15px;"onclick="<?php echo($key['Men_URL']) ?>"> 
                            <span class="span-link" ><?php echo(utf8_encode($key['Men_Descrip']))  ?></span>  
                          </td>
                        </tr>
  <?php   
                    }
                }
             }
          }      
?>     
          </table>
       </div>
       <div class="main" id="content">
            <!-- contenido principal -->
       </div> 
</div>
</body>
</html>
<script>
  $(document).ready(function(){      
        loadScrips('../_source_show/files/home_page.php');
  })
</script>

<?php 

}

 ?>
