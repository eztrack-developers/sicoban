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
	<title>Sicoban | <?php echo($_SESSION['user']); ?></title>

  <link rel="stylesheet" type="text/css" href="../css/styles.css" />
  <link rel="icon"       type="text/css" href="../images/logo-sicoban-icon.ico">
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css"  />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
  <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:300'>
  <link rel="stylesheet" type='text/css' href="../css/PopWindow.jquery.css">
  
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript" src="../js/files.js"></script>
  <script type="text/javascript" src="../js/clients.js"></script>
  <script type="text/javascript" src="../js/users.js"></script>
  <script type="text/javascript" src="../js/PopWindow.jquery.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  
</head>
<body onLoad="setInterval('_onload_()', 600000);">
<div class="menu">  
    <div style="position:absolute; width:250px; height: 60px; margin-top:10px; text-align:center;">
      <img src="../images/logo-sicoban.svg" height="30px" width="190px" alt="">
    </div>   
    <div style="width:250px; height: 50px; margin-top:15px; text-align:center; float:right; margin-right:130px;">
          <span style="color:#7B7C7B; font-size:13px;text-decoration: underline;">

<?php 
  
  if($sta_user['Us_Status'] == 'trial')
  {
    $DAYS_FREE_TRIAL = 30;
    $seconds  =  strtotime('now') - strtotime($_SESSION['creationDate']);
    $dif      = intval($seconds/60/60/24);
    $dif_days = $DAYS_FREE_TRIAL - $dif;
    if($dif_days <= 0)
    {
       echo( 'Prueba gratis vencida' );
    
    ?>
       <script>
        $(document).ready(function(){
          
           $('body').PopWindow({ Width: '80', Height: '90', Url:'https://localhost/sicoban/_source_show/method-paid/method-paid.php'})
             
        }) 
        </script>
    <?php 
    } else{
      echo( 'Prueba gratis restan ' . $dif_days . ' dias');
    }
  }
?>
              </span>
        </div>       
        <div style="" class="navfooter" onclick="displayMenu()">
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
                    if( $dif_days > 0 )
                    {
                        foreach ($menu as $key ) {                   
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
	
 <!-- display menu -->
     	 <div class="contentdisplaymenu" id="config">
           <div class="displaymenu" onclick="loadScrips('../_source_show/clients/myaccount.form.php')">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" width="40px" height="40px"> <img src="../images/myAcount.svg" alt="" width="17" height="17" /></td>
                        <td style="padding-left: 10px;"><h3 style="color: #607D8B; font-size: 11px;"><?php echo($xml->section[1]->myaccount); ?></h3></td>
                    </tr>
                </table>
           </div>
             <div class="displaymenu"  id="paypalPaid"> 
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" valign="center" width="40px" height="40px"><img src="../images/credit-card.svg" alt="" width="17" height="22" /></td>
                        <td style="padding-left: 10px;"><h3 style="color: #607D8B; font-size: 11px"><?php echo('Suscribirse'); ?></h3></td>
                    </tr>
                </table>
                <script>
                (function(){
                    $('#paypalPaid').on('click', function(){
                        $('body').PopWindow({ Width: '80', Height: '90', Url:'../_source_show/method-paid/method-paid.php'})
                    })
                })()

                </script>
               
           </div> 
           <div class="displaymenu"  onclick="closeSession('../_source_classes/users/sessionout.php')"> 
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" width="40px" height="40px"><img src="../images/logout.svg" alt="" width="17" height="22" /></td>
                        <td style="padding-left: 10px;"><h3 style="color: #607D8B; font-size: 11px"><?php echo($xml->section[1]->logout); ?></h3></td>
                    </tr>
                </table>
               
           </div> 
        </div>

 <div id="frontpage" style="width: 100%; height: 100%;  z-index: 500; background-color: #000000; opacity: .7; position: absolute; top: 0; display: none"> </div>
</body>
</html>
<script>
	

  $(document).ready(function(){
      
        loadScrips('../_source_show/files/home_page.php');
        $( '.dropdown' ).hover(
        function(){
            var id = $(this).data('type');
            $('#' + id + '_Sub').slideDown(200);
            //$(this).('.sub-menu').slideDown(200);
        },
        function(){
            var idd = $(this).data('type');
             $('#' + idd + '_Sub').slideUp(200);
        }
    );
  })

 function displayMenu(){
    if($('#config').css('marginTop') == "110px"){

         $("#config").css("display", "block");
         openMenu(); 
    }
    else{        
        closeMenu();   
    }
}

function openMenu(){

     $("#config").animate({opacity: 1,marginTop: "51px",},300 );      
         setTimeout(function(){
                    closeMenu();
           }, 10000);
}

function closeMenu(){
     $("#config").animate({opacity: 0,marginTop: "110px",},300 );
      $("#config").css("display", "none");
            
}	

</script>

<?php 

}

 ?>
