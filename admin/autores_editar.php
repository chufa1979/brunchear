<?php 
require_once('../Connections/cone.php'); 
include ("seguridad.php");


if ((isset($_GET["eliminalinea"])) || (isset($_GET["eliminalinea_x"]))){
	$v = $_GET['vid'];
	
	mysql_select_db($database_cone, $cone);
	$query_rs = "SELECT * FROM brunchear_autor WHERE id = '$v'";
	$rs = mysql_query($query_rs, $cone) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
	
	$m2 = $row_rs['imagen'];
	if ($m2<>'') { unlink($m2);}
	
	$deleteSQL = "UPDATE brunchear_autor SET imagen='' WHERE id='$v'";
	mysql_select_db($database_cone, $cone);
	$Result1 = mysql_query($deleteSQL, $cone) or die(mysql_error());
	
    $insertGoTo = 'autores_editar.php?vid='.$v;
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
/*********************/
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

	$id = $_POST['id'];
	$autor = $_POST['autor'];
	$instagram = $_POST['instagram'];
	
	if ($_FILES['fc01']['name']<>"") {
 	/** CREACION DE CARPETAS **/
		$path = "../upload/autor/";
		$szd = getimagesize($_FILES['fc01']['tmp_name']);
		$tipo = $szd[2];
		if ($tipo==3) { 
			$imh = rand().'.png';
			$imagen01 = $path.$imh;				
			$banderook = 1 ;
			$foto0 = redimensionar($_FILES['fc01']['tmp_name'], $imagen01,$max_width=300,$max_height=300,$calidad=100,$clase=3);
		} 	
		if ($tipo==2) { 
			$imh = rand().'.jpg';
			$imagen01 = $path.$imh;				
			$banderook = 1 ;
			$foto0 = redimensionar($_FILES['fc01']['tmp_name'], $imagen01,$max_width=300,$max_height=300,$calidad=100,$clase=2);
		} 	
		if ($tipo==1) { 	
			$imh = rand().'.gif';
			$imagen01 = $path.$imh;				
			$banderook = 1 ;	
			$foto0 = redimensionar($_FILES['fc01']['tmp_name'], $imagen01,$max_width=300,$max_height=300,$calidad=100,$clase=1);
		} 
	} else {
		$imagen01 = $_POST['a1'];
	}
	/***/	
					 		
    $updateSQL = "UPDATE brunchear_autor SET autor = '$autor',imagen = '$imagen01', instagram = '$instagram' WHERE id='$id'";
    mysql_select_db($database_cone, $cone);
	$Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());

	if (isset($_GET['offset'])) {
		$offset = $_GET['offset'];
		$insertGoTo = "autores.php?offset=".$offset;
		header("Location: ".$insertGoTo);		
	} else {
		$insertGoTo = "autores.php";
		header("Location: ".$insertGoTo);		
	}

}

$colname_rs = "-1";
if (isset($_GET['vid'])) {
  $colname_rs = $_GET['vid'];
}
mysql_select_db($database_cone, $cone);
$query_rs = sprintf("SELECT * FROM brunchear_autor WHERE id = %s", GetSQLValueString($colname_rs, "int"));
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
   <li class='has-sub active'><a href='#' class="nav_cate">Autores</a>
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
   <li class='has-sub'><a href='#' class="nav_pedidos">Restaurantes</a>
      <ul>
         <li><a href='resto_alta.php'>Cargar nuevo</a></li>
         <li><a href='resto_publicados.php'>Publicados</a></li>
      </ul></li>
   
   <li class='has-sub'><a href='#' class="nav_banner">Banners</a>
     <ul>
       <li><a href='banner_superior.php'>Slider Home</a></li>
       <li><a href='banner_inferior.php'>Banners inferior</a></li>
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
  <div class="ruta">Autores&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;MODIFICAR</div>
</div>
<div class="main">
  <div id="contenido">
  <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content">
          <label for="autor">Autor</label>
          <input name="autor" type="text" required class="form-control" id="autor" value="<?php echo $row_rs['autor']; ?>" />
          <label for="instagram">Instagram</label>
          <input name="instagram" type="text" required class="form-control" id="instagram" value="<?php echo $row_rs['instagram']; ?>" maxlength="255" /></td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content"><strong>Im&aacute;genes</strong> <span class="txt_italic">(Medida: 1000 x 1000 px / Formato JPG)</span><br />
            <br />
            <?php if ($row_rs['imagen']<>'') { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="320" align="left" class="separador"><img src="<?php echo $row_rs['imagen']; ?>" width="300" height="300" alt="Imagen" /></td>
                <td align="left" class="separador"><div class="listing" style="display:none" id="open_ajax_dialog_codediv1">
                <div id="ajax_dialog1">Dialog.alert({url: "autor_eliminar_img.php?vid=<?php echo $row_rs['id']; ?>", options: {method: 'get'}},  
                  {className: "alphacube", width:440, height:280, zIndex:999, okLabel: "Close"});</div>
                <script type="text/javascript"> Application.addEditButton('open_ajax_dialog')</script>
                </div>
                <a href="javascript:void();" class="tooltips" onclick="Application.evalCode('ajax_dialog1', true)"><img src="img/icono_eliminar.gif" alt="ELIMINAR" width="60" height="30" border="0" /><span>Eliminar</span></a></td>
              </tr>

          </table>
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150" align="left" class="separador">Imagen 1 (Principal)</td>
                <td align="left" class="separador"><input type="file" name="fc01" id="fc01" /></td>
              </tr>

          </table>
          <?php } ?>
          <input name="id" type="hidden" id="id" value="<?php echo $row_rs['id']; ?>" />
          <input name="a1" type="hidden" id="a1" value="<?php echo $row_rs['imagen']; ?>" />
          <input name="e" type="hidden" id="e" value="2" />
          
          <input type="hidden" name="MM_update" value="form1" />
          <input name="offset" type="hidden" id="offset" value="<?php echo $_GET['offset']; ?>" /></td>
        </tr>
      </table>
      <br />
      <?php if (isset($_GET['offset'])) { ?>
      <input name="offset" type="hidden" id="offset" value="<?php echo $_GET['offset']; ?>" />
      <? } ?>
      <input name="MM_update" type="hidden" id="MM_update" value="form1" />
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro_guardar">
        <tr>
          <td align="center" valign="middle" class="content"><input name="button2" type="submit" class="btn_borrador" id="button" onclick="MM_goToURL('parent','puntos_ventas.php');return document.MM_returnValue" value="Volver" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="buttonp" type="submit" class="btn_publicar" id="buttonp" value="Guardar cambios" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>
