<?php 
require_once('../Connections/cone.php'); 
include ("seguridad.php");

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

$nombreapellido=$_POST["nombreapellido"];
$email=$_POST["email"];
$usuario=$_POST["usuario"];
$pass=$_POST["pass"];
$nivel=$_POST["nivel"];
$vid=$_POST["id"];	
					 		
  $updateSQL = "UPDATE brunchear_usuarios SET nombreapellido='$nombreapellido',email='$email', usuario='$usuario', pass='$pass', nivel='$nivel'  WHERE id='$vid'";
					   
		//echo $updateSQL;
	  mysql_select_db($database_cone, $cone);
	  $Result1 = mysql_query($updateSQL, $cone) or die(mysql_error());

	/** REDIRECCIONAMIENTO**/
	$insertGoTo = "usuarios_sistema.php";
  	header("Location: ".$insertGoTo);
}

$colname_rs = "-1";
if (isset($_GET['vid'])) {
  $colname_rs = $_GET['vid'];
}
mysql_select_db($database_cone, $cone);
$query_rs = sprintf("SELECT * FROM brunchear_usuarios WHERE id = %s", GetSQLValueString($colname_rs, "int"));
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
   
    
   
   
   <li class='has-sub'><a href='#' class="nav_banner">Banners</a>
      <ul>
         <li><a href='banner_inferior.php'>Banners</a></li>
      </ul>
   </li>

   
   <li class='has-sub active'><a href='#' class="nav_sist">Usuarios del sistema</a>
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
  <div class="ruta">Usuarios&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;modificar</div>
</div>
<div class="main">
  <div id="contenido">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top">
        <form id="form1" name="form1" method="post" action="">
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
            <tr>
              <td class="content">
              <label for="nombreapellido">Nombre y apellido</label>
                <input name="nombreapellido" type="text" class="form-control" id="nombreapellido" value="<?php echo $row_rs['nombreapellido']; ?>" />
                <label for="usuario">E-mail</label>
                <input name="email" type="text" class="form-control" id="email" value="<?php echo $row_rs['email']; ?>" />
                <label for="usuario">Usuario</label>
                <input name="usuario" type="text" class="form-control" id="usuario" value="<?php echo $row_rs['usuario']; ?>" />
                <label for="pass">Contrase&ntilde;a</label>
                <input name="pass" type="text" class="form-control" id="pass" value="<?php echo $row_rs['pass']; ?>" />
                </td>
            </tr>
          </table>
          <br />
          <table border="0" cellpadding="0" cellspacing="0" class="recuadro_guardar">
            <tr>
              <td align="center" valign="middle" class="content"><input type="hidden" name="MM_update" value="form1" />
                <input name="id" type="hidden" id="id" value="<?php echo $row_rs['id']; ?>" />
                <input name="button2" type="submit" class="btn_borrador" id="button" onclick="MM_goToURL('parent','usuarios_sistema.php');return document.MM_returnValue" value="Volver" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button" type="submit" class="btn_publicar" id="button3" value="Guardar cambios" /></td>
            </tr>
          </table>
        </form>
        </td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
