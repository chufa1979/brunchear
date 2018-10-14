<?php require_once('../Connections/cone.php'); ?>
<?php require_once('../Connections/cone.php'); ?>
<?php 
require_once('../Connections/cone.php'); 
include ("seguridad.php");

if ((isset($_GET["eliminalinea"])) || (isset($_GET["eliminalinea_x"]))){
	$v = $_GET['vid'];

	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM brunchear_nota WHERE id = '$v'";
	$rs = mysql_query($query_rs, $cone) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	
	$m2 = $row_rs['imagen'];

	if ($m2<>'') { unlink($m2);}
	
	$deleteSQL = "UPDATE brunchear_nota SET imagen='' WHERE id='$v'";
	mysql_select_db($database_cone, $cone);
	$Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'nota_editar.php?vid='.$v;
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
	
  $updateSQL = sprintf("UPDATE brunchear_nota SET titulo=%s, nota=%s, autor=%s, categoria=%s, imagen='$fichero1' WHERE id=%s",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['nota'], "text"),
                       GetSQLValueString($_POST['autor'], "text"),
                       GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cone, $cone);
  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());

  $updateGoTo = "nota_publicados.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsn = "-1";
if (isset($_GET['vid'])) {
  $colname_rsn = $_GET['vid'];
}
mysql_select_db($database_cone, $cone);
$query_rsn = sprintf("SELECT * FROM brunchear_nota WHERE id = %s", GetSQLValueString($colname_rsn, "int"));
$rsn = mysql_query($query_rsn, $cone) or die(mysql_error());
$row_rsn = mysql_fetch_assoc($rsn);
$totalRows_rsn = mysql_num_rows($rsn);

mysql_select_db($database_cone, $cone);
$query_rsautor = "SELECT * FROM brunchear_autor ORDER BY autor ASC";
$rsautor = mysql_query($query_rsautor, $cone) or die(mysql_error());
$row_rsautor = mysql_fetch_assoc($rsautor);
$totalRows_rsautor = mysql_num_rows($rsautor);
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
    <li class='has-sub active'><a href='#' class="nav_productos">Notas</a>
      <ul>
         <li><a href='nota_alta.php'>Cargar nuevo</a></li>
         <li><a href='nota_publicados.php'>Publicados</a></li>
      </ul>
   </li>
   <li class='has-sub '><a href='#' class="nav_pedidos">Restaurantes</a>
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
  <div class="ruta">NOTAS&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;MODIFICAR</div>
</div>
<div class="main">
  <div id="contenido">
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content"><label for="titulo">Titulo</label>
            <input name="titulo" type="text" class="form-control" id="titulo" value="<?php echo $row_rsn['titulo']; ?>" maxlength="255" />
            <label for="direccion">Autor</label>
            <select name="autor" id="autor" class="form-control" style="height: 35px;">
              <?php
do {  
?>
              <option value="<?php echo $row_rsautor['id']?>"<?php if (!(strcmp($row_rsautor['id'], $row_rsn['autor']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsautor['autor']?></option>
              <?php
} while ($row_rsautor = mysql_fetch_assoc($rsautor));
  $rows = mysql_num_rows($rsautor);
  if($rows > 0) {
      mysql_data_seek($rsautor, 0);
	  $row_rsautor = mysql_fetch_assoc($rsautor);
  }
?>
            </select>
            <label for="precio11">Categor&iacute;a</label>
            <select name="categoria" id="categoria" class="form-control" style="height: 35px;">
              <option value="0" selected="selected" <?php if (!(strcmp(0, $row_rsn['categoria']))) {echo "selected=\"selected\"";} ?>>Seleccionar</option>
              <option value="1" <?php if (!(strcmp(1, $row_rsn['categoria']))) {echo "selected=\"selected\"";} ?>>Brunch Tips</option>
              <option value="2" <?php if (!(strcmp(2, $row_rsn['categoria']))) {echo "selected=\"selected\"";} ?>>Brunch-In</option>
              <option value="3" <?php if (!(strcmp(3, $row_rsn['categoria']))) {echo "selected=\"selected\"";} ?>>Tendencias</option>
              <option value="4" <?php if (!(strcmp(4, $row_rsn['categoria']))) {echo "selected=\"selected\"";} ?>>Circuito</option>
              <option value="5" <?php if (!(strcmp(5, $row_rsn['categoria']))) {echo "selected=\"selected\"";} ?>>Brunch951</option>
            </select>
            <label for="menues">Nota</label>
            <textarea name="nota" cols="40" rows="5" class="form-txtarea" id="nota"><?php echo $row_rsn['nota']; ?></textarea>
            <br /></td>
        </tr>
      </table>
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content"><strong>Im&aacute;genes</strong> <span class="txt_italic">(Formato JPG)</span><br />
            <br />
            <?php if ($row_rsn['imagen']<>'') { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="320" align="left" class="separador"><img src="<?php echo $row_rsn['imagen']; ?>" width="310" height="310" alt="Imagen" /></td>
                <td align="left" class="separador"><div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
                <div id="ajax_dialog1">Dialog.alert({url: "nota_eliminar_img.php?vid=<?php echo $row_rsn['id']; ?>", options: {method: 'get'}},  
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
                  110x70 px</td>
                <td align="left" class="separador"><input type="file" name="fc01" id="fc01" /></td>
              </tr>

          </table>
          <?php } ?>
          <input name="id" type="hidden" id="id" value="<?php echo $row_rs['id']; ?>" />
          <input name="a1" type="hidden" id="a1" value="<?php echo $row_rs['imagen01']; ?>" />
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

mysql_free_result($rsn);
?>
