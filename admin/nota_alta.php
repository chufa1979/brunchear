<?php require_once('../Connections/cone.php'); ?>
<?php include ("seguridad.php"); 
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

if ((isset($_POST["buttonp"])) || (isset($_POST["buttonp_x"]))){

	/***/
  	if ($_FILES['fc01']['name']<>"") {
		$path = "../upload/resto/";
		$fichero1 = $path .'_img01_'.$_FILES['fc01']['name'];
		@copy($_FILES['fc01']['tmp_name'], $fichero1);
	}	
		
$titulo = $_POST['titulo'];
$nota = $_POST['nota'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria'];


  $insertSQL = "INSERT INTO brunchear_nota (titulo, nota, autor, imagen, categoria) VALUES ('$titulo','$nota', '$autor','$fichero1' , '$categoria')";

 mysql_select_db($database_cone, $cone);
 $Result1 = mysql_query($insertSQL, $cone) or die(mysql_error());

  header("Location: nota_publicados.php");
}
?>
<?php
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
	function pasa() {
	  document.form1.submitButton.click()
	}
	
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
  <div class="ruta">NOTAS&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;&nbsp;Crear nuevo</div>
</div>
<div class="main">
  <div id="contenido">
    <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content">
          <label for="titulo">Titulo</label>
          <input name="titulo" type="text" class="form-control" id="titulo" maxlength="255" />
          <label for="direccion">Autor</label>
          <select name="autor" id="autor" class="form-control" style="height: 35px;">
            <?php
do {  
?>
            <option value="<?php echo $row_rsautor['id']?>"><?php echo $row_rsautor['autor']?></option>
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
            <option value="0" selected="selected">Seleccionar</option>
            <option value="1">Brunch Tips</option>
            <option value="2">Brunch-In</option>
            <option value="3">Tendencias</option>
            <option value="4">Circuito</option>
            <option value="5">Brunch951</option>
          </select>
          <label for="menues">Nota</label>
          <textarea name="nota" cols="40" rows="10" class="form-txtarea" id="nota">
</textarea>          <br /></td>
        </tr>
      </table>
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro">
        <tr>
          <td align="left" valign="top" class="content"><strong>Im&aacute;genes</strong> <span class="txt_italic">(Formato JPG)</span><br />
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150" align="left" class="separador">Imagen 1 (Principal)<br />
                110x70 px</td>
                <td align="left" class="separador"><input type="file" name="fc01" id="fc01" /></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <br />
      <table border="0" cellpadding="0" cellspacing="0" class="recuadro_guardar">
        <tr>
          <td align="center" valign="middle" class="content">
          <input name="buttonp" type="submit" class="btn_publicar" id="buttonp" value="Publicar" />
          <input name="submitButton" type="submit" id="submitButton" value=" " style="width:1px; height:1px"/>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rsautor);
?>
