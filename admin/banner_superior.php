<?php include ("seguridad.php"); ?>
<?php require_once('../Connections/cone.php');  

$_SESSION['pagina'] = 'banner_superior.php';

if ((isset($_GET["eliminalinea"])) || (isset($_GET["eliminalinea_x"]))){
	/***/
 	$v = $_GET['vid'];
 	
	mysql_select_db($database_cone, $cone);
	$query_rsc = "SELECT * FROM volvo_slider WHERE id = '$v'";
	$rsc = mysql_query($query_rsc, $cone) or die(mysql_error());
	$row_rsc = mysql_fetch_assoc($rsc);
	$ihm = $row_rsc['imagen'];	
	if ($ihm<>'') {	
		unlink($ihm);
	}
  
  $deleteSQL = "DELETE FROM volvo_slider WHERE id='$v'";
  mysql_select_db($database_cone, $cone);
  $Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'banner_superior.php';
    header("Location:".$insertGoTo);
}	

if ((isset($_POST["editar"])) || (isset($_POST["editar_x"]))){

	$id = $_POST['id_e'];
	$altimg = $_POST['alt_e'];
	$link	 = $_POST['link_e'];
	$youtube = $_POST['youtube_e'];
	$orden_e = $_POST['orden_e'];
      $updateSQL = "UPDATE volvo_slider SET orden='$orden_e',alt='$altimg',link='$link',youtube='$youtube' WHERE id='$id'";
	  mysql_select_db($database_cone, $cone);
	  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());
}

if ((isset($_POST["agregar"])) || (isset($_POST["agregar_x"]))){
	
	$altimg = $_POST['altimg'];
	$link	 = $_POST['link'];
	$youtube = $_POST['youtube'];
	$orden = $_POST['orden'];


	if ($_FILES['fc01']['name']<>"") {
 	/** CREACION DE CARPETAS **/
		$path2 = "../upload/banner/";
		$imh = rand().'.jpg';
		$fichero1 = $path2.$imh;
		@copy($_FILES['fc01']['tmp_name'], $fichero1);
	}	
	  $link = $_POST['link'];
      $updateSQL = "INSERT INTO volvo_slider (imagen,alt,link,youtube,orden) VALUES
	  ('$fichero1','$altimg','$link','$youtube','$orden')";
	  mysql_select_db($database_cone, $cone);
	  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());
}

	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM volvo_slider";
	$rs = mysql_query($query_rs, $cone) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BRUNCHEAR | Panel de Administraci&oacute;n Web</title>
<link href="js/style_admin.css" rel="stylesheet" type="text/css" />
<link href="js/menu/menu.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="js/chosen.css" rel="stylesheet" type="text/css" />

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
         <li><a href='resto_alta.php'>Cargar nuevo</a></li>
         <li><a href='resto_publicados.php'>Publicados</a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#' class="nav_pedidos">Restaurantes</a>
      <ul>
         <li><a href='resto_alta.php'>Cargar nuevo</a></li>
         <li><a href='resto_publicados.php'>Publicados</a></li>
      </ul></li>
   
    
   
   
   <li class='has-sub active'><a href='#' class="nav_banner">Banners</a>
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
  <div class="ruta">SLIDER HOME</div>
</div>
<div class="main">
  <div id="contenido">
  <?php if ($totalRows_rs<>0) { ?>
    <?php do { ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
            <tr>
              <td colspan="2" align="left" class="content">
              <?php if ($row_rs['youtube']<>'') {?>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $row_rs['youtube'];?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
              <?php } else { ?>
              <img src="<?php echo $row_rs['imagen']; ?>" alt="Imagen" width="500" height="165" />
              <?php } ?>
                <input name="id_e" type="hidden" id="id_e" value="<?php echo $row_rs['id'];?>" /></td>
              </tr>
            <tr>
              <td width="170" height="45" align="left" valign="middle">&nbsp;&nbsp;<strong>ALT Imagen</strong></td>
              <td height="45" align="left" valign="middle"><input name="alt_e" type="text" class="form-control" id="alt_e"  value="<?php echo $row_rs['alt'];?>" /></td>
            </tr>
            <tr>
              <td height="45" align="left" valign="middle">&nbsp;&nbsp;<strong>Link</strong></td>
              <td height="45" align="left" valign="middle">
                <input name="link_e" type="text" class="form-control" id="link_e" value="<?php echo $row_rs['link'];?>" /></td>
            </tr>
            <tr>
              <td height="45" align="left" valign="middle">&nbsp;&nbsp;<strong>C&oacute;digo Youtube</strong></td>
              <td height="45" align="left" valign="middle"><input name="youtube_e" type="text" class="form-control" id="youtube_e" value="<?php echo $row_rs['youtube'];?>" /></td>
            </tr>
            <tr>
              <td height="45" align="left" valign="middle">&nbsp;&nbsp;<strong>Orden de visualizaci&oacute;n</strong></td>
              <td height="45" align="left" valign="middle"><input name="orden_e" type="text" class="form-control" id="orden_e" value="<?php echo $row_rs['orden'];?>" /></td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td height="60" align="left" valign="middle"><input name="editar" type="submit" class="btn_publicar" id="editar" value="Guardar cambios" />
&nbsp;&nbsp;&nbsp;&nbsp;
<div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
              <div id="ajax_dialog<?php echo $row_rs['id'];?>">Dialog.alert({url: "banner_eliminar.php?vid=<?php echo $row_rs['id'];?>", options: {method: 'get'}},  
              {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
              <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
              </div>
<input name="buttonp2" type="button" class="btn_borrador" id="buttonp2" value="Eliminar banner" onclick="Application.evalCode('ajax_dialog<?php echo $row_rs['id'];?>', true)"/></td>
              </tr>
          </table>
        </form></td>
      </tr>
    </table>
    <br />
    <? } while ($row_rs = mysql_fetch_assoc($rs)); ?>
    <?php } ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><form action="banner_superior.php" method="post" enctype="multipart/form-data" name="form1" id="form2">
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
            <tr>
              <td class="content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30" align="left" valign="top"><span class="txt_bold">Imagen </span><span class="txt_italic">(Medida: 970 x 320 px / Formato JPG)</span></td>
                </tr>
              </table>
                <input name="fc01" type="file" id="fc01" />
                <br />
                <br />
                <label for="altimg">ALT Imagen</label>
                <input name="altimg" type="text" class="form-control" id="altimg" placeholder="Titulo de la imagen" />
                <label for="youtube">Link</label>
                <input name="link" type="text" class="form-control" id="link" placeholder="Ej: http://www.ejemplo.com" />
                <label for="youtube">C&oacute;digo Youtube<br /></label><br />
                <span class="txt_azul">* Insertar SOLO lo que est&aacute; en rojo! Ej: https://www.youtube.com/watch?v=</span><strong class="ui-state-error-text">zyziue-pins</strong>
                <input name="youtube" type="text" class="form-control" id="youtube" placeholder="Ej: zyziue-pins" />  
                <label for="orden">Orden de visualizaci&oacute;n</label>
                <input name="orden" type="text" class="form-control" id="orden" placeholder="Ej: 1" />              
                
                </td>
 
            </tr>
          </table>
          <br />
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro_guardar">
            <tr>
              <td align="right" valign="middle" class="content"><input name="agregar" type="submit" class="btn_publicar" id="button" value="Agregar" /></td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
