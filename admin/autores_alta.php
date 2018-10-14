<?php 
error_reporting(0);
include ("seguridad.php"); 
require_once('../Connections/cone.php'); 	
	

		
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
$autor = $_POST['autor'];
$instagram = $_POST['instagram'];

	if ($_FILES['fc01']['name']<>"") {
 	/** CREACION DE CARPETAS **/
		$path = "../upload/autor/";
		$szd = getimagesize($_FILES['fc01']['tmp_name']);
		$tipo = $szd[2];
			$imh = rand().'.png';
			$imagen01 = $path.$imh;				
			$banderook = 1 ;
			@copy($_FILES['fc01']['tmp_name'], $imagen01);
	}
	
$insertSQL = "INSERT INTO brunchear_autor
 (autor,imagen,instagram) VALUES ('$autor','$imagen01','$instagram')";
  mysql_select_db($database_cone, $cone);
  $Result1 = mysql_query($insertSQL, $cone) or die(mysql_error());

  header("Location:autores.php");
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
  <div class="ruta">Autores&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;Crear nuevo</div>
</div>
<div class="main">
  <div id="contenido">
    <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content">
          <label for="autor">Autor</label><input name="autor" type="text" required class="form-control" id="autor" />
          <label for="instagram">Instagram</label>
          <input name="instagram" type="text" required class="form-control" id="instagram" maxlength="255" /></td>
        </tr>
      </table><table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content"><strong>Foto</strong> <span class="txt_italic">(Medida: 300 x 300 px / Formato JPG)</span><br />
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150" align="left" class="separador">Imagen 1 (Principal)</td>
                <td align="left" class="separador"><input type="file" name="fc01" id="fc01" /></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <br />
      <input name="MM_insert" type="hidden" id="MM_insert" value="form1" />
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro_guardar">
        <tr>
          <td align="center" valign="middle" class="content"><input name="buttonp" type="submit" class="btn_publicar" id="buttonp" value="Publicar" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>
