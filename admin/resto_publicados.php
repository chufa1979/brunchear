<?php include ("seguridad.php"); ?>
<?php require_once('../Connections/cone.php');  



$_SESSION['pagina'] = 'resto_publicados.php';

if ((isset($_GET["eliminalinea"])) || (isset($_GET["eliminalinea_x"]))){
  $v = $_GET['vid'];
	/***/
	mysql_select_db($database_cone, $cone);
	$query_rsc = "SELECT * FROM brunchear_resto WHERE id = '$v'";
	$rsc = mysql_query($query_rsc, $cone) or die(mysql_error());
	$row_rsc = mysql_fetch_assoc($rsc);
	$ihm = $row_rsc['imagen01'];	
	if ($ihm<>'') {	
		unlink($ihm);
	}
	$ihm = $row_rsc['imagen02'];	
	if ($ihm<>'') {	
		unlink($ihm);
	}
	$ihm = $row_rsc['imagen03'];	
	if ($ihm<>'') {	
		unlink($ihm);
	}
  
  $deleteSQL = "DELETE FROM brunchear_resto WHERE id='$v'";
  mysql_select_db($database_cone, $cone);
  $Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
}	


	mysql_select_db($database_cone, $cone);
	$query_rs1 = "SELECT * FROM brunchear_resto ORDER BY id DESC";
	$rs1 = mysql_query($query_rs1, $cone) or die(mysql_error());
	$row_rs1 = mysql_fetch_assoc($rs1);
	$totalRows_rs1 = mysql_num_rows($rs1);

   include 'buildNav.php';
   $conn = mysql_connect($hostname_cone,$username_cone,$password_cone);
   mysql_select_db($database_cone);
   $db = new buildNav;
   $db->offset = 'offset';
   $db->number_type = 'number';
   $db->limit = 15;
   $db->pag = $db->limit*$mostrar;
   $totalpag =ceil($totalRows_rstotalpag/$db->limit);
   $db->execute($query_rs1);
   $totalp=ceil($totalRows_rs1/$mostrar);
   
   if (isset($_GET["categoria"])) {
	   $pasa .= "categoria=".$_GET["categoria"].'&buscar.x=0&buscar.y=0';   
   }
   if ((isset($_GET["texto"])) && ($_GET["texto"]<>'')) {
	   $pasa .= 'texto='.$_GET["texto"].'&buscar.x=0&buscar.y=0';   
   }
   
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BRUNCHEAR | Panel de Administraci&oacute;n Web</title>
<link href="js/style_admin.css" rel="stylesheet" type="text/css" />
<link href="js/menu/menu.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="js/jquery-ui.js"></script>
  <script type="text/javascript" src="js/chosen.jquery.js"></script>
  <script type="text/javascript" src="js/menu/script.js"></script>

  <!-- popup -->
  <link href="js/popup/themes_default.css" rel="stylesheet" type="text/css" />
  <link href="js/popup/themes_alphacube.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/popup/js_popup/prototype.js"> </script> 
  <script type="text/javascript" src="js/popup/js_popup/effects.js"> </script>
  <script type="text/javascript" src="js/popup/js_popup/window.js"> </script>
  <script type="text/javascript" src="js/popup/js_popup/debug.js"> </script>
  <script type="text/javascript" src="js/popup/js_popup/application.js"> </script>
  <script>
  function changeFunc() {
	     document.getElementById("buscar").click(); // Click on the checkbox
  }
  </script>
</head>

<body>
<div class="main">
  <div id="top">
    <div id="logo"><a href="home.php"><img src="img/logo.png" width="217" height="28" alt="VOLVO" /></a></div>
    <div id="title_page">ADMINISTRADOR WEB BRUNCHEAR</div>
    <div id="user"><?php echo $_SESSION['nombreapellido'];?>&nbsp;&raquo;&nbsp;&nbsp;<a href="salir.php">Logout</a></div>
  </div>
</div>
<div id="menu">
<div id="cssmenu">
<ul>
   <li class='has-sub'><a href='#' class="nav_cate">Autores</a>
		<ul>
<li><a href='autores_alta.php'>Cargar Nuevo</a></li>
         <li><a href='autores.php'>Publicados</a></li>
         
      </ul>
	</li>
<li class='has-sub'><a href='#' class="nav_productos">Notas</a>
      <ul>
         <li><a href='nota_alta.php'>Cargar nuevo</a></li>
         <li><a href='nota_publicados.php'>Publicados</a></li>
      </ul>
   </li>    
   <li class='has-sub active'><a href='#' class="nav_pedidos">Restaurantes</a>
     <ul>
       <li><a href='resto_alta.php'>Cargar nuevo</a></li>
       <li><a href='resto_publicados.php'>Publicados</a></li>
     </ul></li>
   
    
   
   
   <li class='has-sub'><a href='#' class="nav_banner">Banners</a>
      <ul>
         <li><a href='banner_inferior.php'>Banners</a></li>
      </ul>
   </li>

   
   <li class='has-sub'><a href='#' class="nav_sist">Usuarios del sistema</a>
      <ul>
         <li><a href='usuarios_alta.php'>Crear nuevo</a></li>
         <li><a href='usuarios_sistema.php'>Usuarios</a></li>
      </ul>
   </li>
   <li><a href='http://www.brunchear.com.ar' target="_blank" class="nav_web">Ver Sitio Web</a>
   </li>
</ul>
</div>
</div>
<div id="rutas">
  <div class="ruta">restaurantes&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;publicados</div>
</div>
<div class="main">
  <div id="contenido">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><form id="form1" name="form1" method="get" action="resto_publicados.php">
          <div class="listado-filtros"></div>
        </form>
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
          <tr>
        <td class="content"><div class="listado-top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="10" align="left">&nbsp;</td>
              <td width="250" align="left">Restaurante</td>
              <td width="250" align="left">Direcci&oacute;n</td>
              <td width="200" align="left">Barrio</td>
              <td width="70" align="left">&nbsp;</td>
              <td width="60" align="left">&nbsp;</td>
            </tr>
          </table>
        </div>
        <?php while($myrow = mysql_fetch_array($db->sql_result))   { ?>
          <div class="listado">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="10" align="left">&nbsp;</td>
              <td width="250" align="left"><?php echo $myrow['restaurante']; ?></td>
              <td width="250" align="left"><?php echo $myrow['direccion']; ?></td>
              <td width="200" align="left"><?php echo $myrow['barrio']; ?></td>
              <td width="70" align="left"><a class="tooltips" href="resto_editar.php?vid=<?php echo $myrow['id']; ?><?php if (isset($_GET['offset'])) { echo "&offset=".$_GET['offset'];}?>"><img src="img/icono_editar.gif" alt="MODIFICAR" width="60" height="30" border="0" /><span>Modificar</span></a></td>
              <td width="60" align="right"><div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
                  <div id="ajax_dialog<?php echo $myrow['id']; ?>">Dialog.alert({url: "resto_eliminar.php?vid=<?php echo $myrow['id']; ?>", options: {method: 'get'}},  
                  {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
                  <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
                </div>
                <a href="#" class="tooltips" onclick="Application.evalCode('ajax_dialog<?php echo $myrow['id']; ?>', true)"><img src="img/icono_eliminar.gif" alt="ELIMINAR" width="60" height="30" border="0" /><span>Eliminar</span></a></td>
            </tr>
          </table>
        </div>
        <?php } ?>  
          
          </td>
      </tr>
  </table>
  <div class="paginado">
  <?php 
   // CREATE A VAR WITH THE NAV LINKS
   $pages = $db->show_num_pages('&larr; Anterior','&larr; Anterior','Siguiente  &rarr;','Siguiente  &rarr;','','class=advertencias2',$pasa);   // show pages 
   print $pages;
?>
   </div>
   
          </td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
