<?php 
require_once('../Connections/cone.php'); 
include ("seguridad.php");

if ((isset($_GET["eliminalinea"])) || (isset($_GET["eliminalinea_x"]))){
	$v = $_GET['vid'];
	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM brunchear_resto WHERE id = '$v'";
	$rs = mysql_query($query_rs, $cone) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	
	$m2 = $row_rs['imagen01'];

	if ($m2<>'') { unlink($m2);}
	
	$deleteSQL = "UPDATE brunchear_resto SET imagen01='' WHERE id='$v'";
	mysql_select_db($database_cone, $cone);
	$Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'resto_editar.php?vid='.$v;
    header("Location:".$insertGoTo);	
}
if ((isset($_GET["eliminalinea02"])) || (isset($_GET["eliminalinea02_x"]))){
	$v = $_GET['vid'];
	
	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM brunchear_resto WHERE id = '$v'";
	$rs = mysql_query($query_rs, $cone) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	
	$m2 = $row_rs['imagen02'];
	if ($m2<>'') { unlink($m2);}
	
	$deleteSQL = "UPDATE brunchear_resto SET imagen02='' WHERE id='$v'";
	mysql_select_db($database_cone, $cone);
	$Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'resto_editar.php?vid='.$v;
    header("Location:".$insertGoTo);	
}
if ((isset($_GET["eliminalinea03"])) || (isset($_GET["eliminalinea03_x"]))){
	$v = $_GET['vid'];
	
	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM brunchear_resto WHERE id = '$v'";
	$rs = mysql_query($query_rs, $cone) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	
	$m2 = $row_rs['imagen03'];
	if ($m2<>'') { unlink($m2);}
	
	$deleteSQL = "UPDATE brunchear_resto SET imagen03='' WHERE id='$v'";
	mysql_select_db($database_cone, $cone);
	$Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'resto_editar.php?vid='.$v;
    header("Location:".$insertGoTo);	
}

/********* funciones ****************/
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



$colname_rs = "-1";
if (isset($_GET['vid'])) {
  $colname_rs = $_GET['vid'];
}
mysql_select_db($database_cone, $cone);
$query_rs = sprintf("SELECT * FROM brunchear_resto WHERE id = %s", GetSQLValueString($colname_rs, "int"));
$rs = mysql_query($query_rs, $cone) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
    /*********************/
	/***/
	if ($_FILES['fc01']['name']<>"") {
		$path = "../upload/resto/";
		$fichero1 = $path .'_img01_'.$_FILES['fc01']['name'];
		@copy($_FILES['fc01']['tmp_name'], $fichero1);
	} else {
		$fichero1 = $_POST['a1'];
	}
	/***/
	if ($_FILES['fc02']['name']<>"") {
		$path = "../upload/resto/";
		$fichero2 = $path .'_img02_'.$_FILES['fc02']['name'];
		@copy($_FILES['fc02']['tmp_name'], $fichero2);
	} else {
		$fichero2 = $_POST['a2'];
	}
	/***/
	if ($_FILES['fc03']['name']<>"") {
		$path = "../upload/resto/";
		$fichero3 = $path .'_img03_'.$_FILES['fc03']['name'];
		@copy($_FILES['fc03']['tmp_name'], $fichero3);
	} else {
		$fichero3 = $_POST['a3'];
	}
	/***/	
	
  $updateSQL = sprintf("UPDATE brunchear_resto SET restaurante=%s, direccion=%s, barrio=%s, telefono=%s, latitud=%s, longitud=%s, descripcion=%s, menu=%s, imagen01='$fichero1', imagen02='$fichero2', imagen03='$fichero3' WHERE id=%s",
                       GetSQLValueString($_POST['restaurante'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['barrio'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['latitud'], "text"),
                       GetSQLValueString($_POST['longitud'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['menues'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cone, $cone);
  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());

  $updateGoTo = "resto_publicados.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
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

    <!-- editor -->  
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "table contextmenu paste"
        ],
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
    });

	function pasa() {
	  document.form1.submitButton.click()
	}	
    </script>

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
  <div class="ruta">productos&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;MODIFICAR</div>
</div>
<div class="main">
  <div id="contenido">
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content">
          <label for="restaurante">Restaurante</label>
          <input name="restaurante" type="text" class="form-control" id="restaurante" value="<?php echo $row_rs['restaurante']; ?>" maxlength="255" />
          <label for="direccion">Direcci&oacute;n</label>
          <input name="direccion" type="text" required class="form-control" id="direccion" value="<?php echo $row_rs['direccion']; ?>" />
          <label for="precio11">Barrio</label><input name="barrio" type="text" class="form-control" id="precio11" value="<?php echo $row_rs['barrio']; ?>" />
          <label for="telefono">Telefono</label><input name="telefono" type="text"  class="form-control" id="telefono" placeholder="0.00" value="<?php echo $row_rs['telefono']; ?>" />
          <label for="telefono">Latitud</label>
          <input name="latitud" type="text"  class="form-control" id="latitud" placeholder="0.00" value="<?php echo $row_rs['latitud']; ?>" />
          <label for="telefono">Longitud</label>
          <input name="longitud" type="text"  class="form-control" id="longitud" placeholder="0.00" value="<?php echo $row_rs['longitud']; ?>" />
          Para determinar la Lat y Long puede ingresar aqui: <a href="https://www.coordenadas-gps.com/" target="_blank">https://www.coordenadas-gps.com/</a><br />
          <label for="menues">Descripci&oacute;n</label>
          <textarea name="descripcion" cols="40" rows="5" class="form-txtarea" id="descripcion"><?php echo $row_rs['descripcion']; ?></textarea>
                    <label for="menues">Menu</label>
          <textarea name="menues" cols="40" rows="5" class="form-txtarea" id="menues"><?php echo $row_rs['menu']; ?></textarea>                    
          <br /></td>
        </tr>
      </table>
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content"><strong>Im&aacute;genes</strong> <span class="txt_italic">(Formato JPG)</span><br />
            <br />
            <?php if ($row_rs['imagen01']<>'') { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="320" align="left" class="separador"><img src="<?php echo $row_rs['imagen01']; ?>" style="
    max-width: 600px; alt="Imagen" /></td>
                <td align="left" class="separador"><div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
                <div id="ajax_dialog1">Dialog.alert({url: "resto_eliminar_img.php?vid=<?php echo $row_rs['id']; ?>", options: {method: 'get'}},  
                  {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
                <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
                </div>
                <a href="javascript:void();" class="tooltips" onclick="Application.evalCode('ajax_dialog1', true)"><img src="img/icono_eliminar.gif" alt="ELIMINAR" width="60" height="30" border="0" /><span>Eliminar</span></a></td>
              </tr>

          </table>
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150" align="left" class="separador">Imagen 1 (Principal)<br />
                <span class="subtitulo_azul">Header (895x149px)</span></td>
                <td align="left" class="separador"><input type="file" name="fc01" id="fc01" /></td>
              </tr>

          </table>
          <?php } ?>
            
          <?php if ($row_rs['imagen02']<>'') { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="320" align="left" class="separador"><img src="<?php echo $row_rs['imagen02']; ?>" style="
    max-width: 600px; alt="Imagen" /></td>
                <td align="left" class="separador"><div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
                <div id="ajax_dialog2">Dialog.alert({url: "resto_eliminar_img2.php?vid=<?php echo $row_rs['id']; ?>", options: {method: 'get'}},  
                  {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
                <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
                </div>
                <a href="javascript:void();" class="tooltips" onclick="Application.evalCode('ajax_dialog2', true)"><img src="img/icono_eliminar.gif" alt="ELIMINAR" width="60" height="30" border="0" /><span>Eliminar</span></a></td>
              </tr>

          </table>
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150" align="left" class="separador">Imagen 2<br />
                <span class="subtitulo_azul">Listado (160x160px)</span></td>
                <td align="left" class="separador"><input type="file" name="fc02" id="fc02" /></td>
              </tr>

          </table>
          <?php } ?>
          
          <?php if ($row_rs['imagen03']<>'') { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="320" align="left" class="separador"><img src="<?php echo $row_rs['imagen03']; ?>" style="
    max-width: 600px; alt="Imagen" /></td>
                <td align="left" class="separador"><div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
                <div id="ajax_dialog3">Dialog.alert({url: "resto_eliminar_img3.php?vid=<?php echo $row_rs['id']; ?>", options: {method: 'get'}},  
                  {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
                <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
                </div>
                <a href="javascript:void();" class="tooltips" onclick="Application.evalCode('ajax_dialog3', true)"><img src="img/icono_eliminar.gif" alt="ELIMINAR" width="60" height="30" border="0" /><span>Eliminar</span></a></td>
              </tr>

          </table>
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150" align="left" class="separador">Imagen 3<br />
                <span class="subtitulo_azul">Home (200x110px)</span></td>
                <td align="left" class="separador"><input type="file" name="fc03" id="fc03" /></td>
              </tr>

          </table>
          <?php } ?>
          <input name="id" type="hidden" id="id" value="<?php echo $row_rs['id']; ?>" />
          <input name="a1" type="hidden" id="a1" value="<?php echo $row_rs['imagen01']; ?>" />
          <input name="a2" type="hidden" id="a2" value="<?php echo $row_rs['imagen02']; ?>" />
          <input name="a3" type="hidden" id="a3" value="<?php echo $row_rs['imagen03']; ?>" />
          <input name="e" type="hidden" id="e" value="2" />
          
          <input type="hidden" name="MM_update" value="form1" />
          <input name="offset" type="hidden" id="offset" value="<?php echo $_GET['offset']; ?>" /></td>
        </tr>
      </table>
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro_guardar">
        <tr>
          <td align="center" valign="middle" class="content"><input name="button2" type="submit" class="btn_borrador" id="button" onclick="MM_goToURL('parent','resto_publicados.php');return document.MM_returnValue" value="Volver" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="buttonp" type="submit" class="btn_publicar" id="button3" value="Guardar cambios" /></td>
        </tr>
      </table><input name="submitButton" type="submit" id="submitButton" value=" " style="width:1px; height:1px"/>
    </form>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
