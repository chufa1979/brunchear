<?php include ("seguridad.php"); ?>
<?php require_once('../Connections/cone.php');  

$_SESSION['pagina'] = 'banner_inferior.php';

if ((isset($_GET["eliminalinea"])) || (isset($_GET["eliminalinea_x"]))){
	/***/
 	$v = $_GET['vid'];
 	
	mysql_select_db($database_cone, $cone);
	$query_rsc = "SELECT * FROM brunchear_banner WHERE id = '$v'";
	$rsc = mysql_query($query_rsc, $cone) or die(mysql_error());
	$row_rsc = mysql_fetch_assoc($rsc);
	$ihm = $row_rsc['imagen'];	
	if ($ihm<>'') {	
		unlink($ihm);
	}
  
  $deleteSQL = "DELETE FROM brunchear_banner WHERE id='$v'";
  mysql_select_db($database_cone, $cone);
  $Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'banner_inferior.php';
    header("Location:".$insertGoTo);
}	

if ((isset($_POST["editar"])) || (isset($_POST["editar_x"]))){

	$id = $_POST['id_e'];
	$altimg = $_POST['alt_e'];
	$link	 = $_POST['link_e'];
	$ubicacion_e = $_POST['ubicacion_e'];
      $updateSQL = "UPDATE brunchear_banner SET link='$link',ubicacion='$ubicacion_e',alt='$altimg' WHERE id='$id'";
	  mysql_select_db($database_cone, $cone);
	  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());
}

if ((isset($_POST["agregar"])) || (isset($_POST["agregar_x"]))){
	
	$altimg = $_POST['altimg'];
	$link	 = $_POST['link'];
	$ubicacion = $_POST['ubicacion'];


	if ($_FILES['fc01']['name']<>"") {
 	/** CREACION DE CARPETAS **/
		$path2 = "../upload/banner/";
		$imh = rand().'.jpg';
		$fichero1 = $path2.$imh;
		@copy($_FILES['fc01']['tmp_name'], $fichero1);
	}	
	  $link = $_POST['link'];
      $updateSQL = "INSERT INTO brunchear_banner (banner,link,ubicacion,alt) VALUES
	  ('$fichero1','$link','$ubicacion','$altimg')";
	  mysql_select_db($database_cone, $cone);
	  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());
}

	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM brunchear_banner";
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
  <div class="ruta">Banner</div>
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
              <td colspan="2" align="left" class="content"><img src="<?php echo $row_rs['banner']; ?>" alt="Imagen" height="165" style="max-width: 980px;"/>
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
              <td height="45" align="left" valign="middle">&nbsp;&nbsp;<strong>Ubicaci&oacute;n</strong></td>
              <td height="45" align="left" valign="middle"><label for="ubicacion_e"></label>
                <select name="ubicacion_e" id="ubicacion_e" class="form-control" style="height:35px">
                  <option value="0" <?php if (!(strcmp(0, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
                  <option value="1" <?php if (!(strcmp(1, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Home Sup</option>
                  <option value="2" <?php if (!(strcmp(2, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Home Med Notas</option>
                  <option value="3" <?php if (!(strcmp(3, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Home Med Grande</option>
                  <option value="4" <?php if (!(strcmp(4, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Home Footer</option>
                  <option value="5" <?php if (!(strcmp(5, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Notas Superior</option>
                  <option value="6" <?php if (!(strcmp(6, $row_rs['ubicacion']))) {echo "selected=\"selected\"";} ?>>Notas Inferios</option>                
                </select></td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td height="60" align="left" valign="middle"><input name="editar" type="submit" class="btn_publicar" id="editar" value="Guardar cambios" />
&nbsp;&nbsp;&nbsp;&nbsp;
<div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
              <div id="ajax_dialogt<?php echo $row_rs['id'];?>">Dialog.alert({url: "banner_eliminar2.php?vid=<?php echo $row_rs['id'];?>", options: {method: 'get'}},  
              {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
              <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
              </div>
<input name="buttonp2" type="button" class="btn_borrador" id="buttonp2" value="Eliminar banner" onclick="Application.evalCode('ajax_dialogt<?php echo $row_rs['id'];?>', true)"/></td>
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
        <td align="left" valign="top"><form action="banner_inferior.php" method="post" enctype="multipart/form-data" name="form1" id="form2">
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
            <tr>
              <td class="content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30" align="left" valign="top"><span class="txt_bold">Imagen </span><span class="txt_italic">(Formato JPG)</span></td>
                </tr>
              </table>
                <input name="fc01" type="file" id="fc01" />
                <br />
                <br />
                <label for="altimg">ALT Imagen</label>
                <input name="altimg" type="text" class="form-control" id="altimg" placeholder="Titulo de la imagen" />
                <label for="youtube">Link</label>
                <input name="link" type="text" class="form-control" id="link" placeholder="Ej: http://www.ejemplo.com" />
                <label for="orden">Ubicaci&oacute;n</label>
                <select name="ubicacion" id="ubicacion" class="form-control" style="height:35px">
                  <option value="0">Seleccionar</option>
                  <option value="1">Home Sup</option>
                  <option value="2">Home Med Notas</option>
                  <option value="3">Home Med Grande</option>
                  <option value="4">Home Footer</option>
                  <option value="5">Notas Superior</option>
                  <option value="6">Notas Inferios</option>
                </select></td>
 
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
