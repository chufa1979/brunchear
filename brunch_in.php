<?php require_once('Connections/cone.php'); ?>
<?php
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

mysql_select_db($database_cone, $cone);
$query_banner_sup = "SELECT * FROM brunchear_banner WHERE ubicacion = 5";
$banner_sup = mysql_query($query_banner_sup, $cone) or die(mysql_error());
$row_banner_sup = mysql_fetch_assoc($banner_sup);
$totalRows_banner_sup = mysql_num_rows($banner_sup);

mysql_select_db($database_cone, $cone);
$query_banner_sup2 = "SELECT * FROM brunchear_banner WHERE ubicacion = 6";
$banner_sup2 = mysql_query($query_banner_sup2, $cone) or die(mysql_error());
$row_banner_sup2 = mysql_fetch_assoc($banner_sup2);
$totalRows_banner_sup2 = mysql_num_rows($banner_sup2);

$page = 3; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<title>BRUNCHEAR - Brunch-In</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href="styles-media.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<!-- Accordion -->
<script type="text/javascript" src="js/accordion/jquery.accordion.source.js" charset="utf-8"></script>  
<script type='text/javascript' src='js/accordion/jquery.velocity.min.js'></script>
<script type="text/javascript" src="js/accordion/jquery.easing.1.3.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('ul.accordion').accordion();
		});
	
	function mm01() {
	    $("ul#acord ul").css("display", "none");
		}
	function MM_callJS(jsStr) { //v2.0
	  return eval(jsStr)
	  }
</script>

</head>

<body>
<div id="contenedor">
  <div class="header">
    <div class="logo"><a href="index.php"><img src="img/brunchear.png" width="200" height="26" alt="BRUNCHEAR" /></a></div>
    
<!-- Menu -->
<?php include("nav.php"); ?>
<!-- FIN menu -->

  </div>
  <div class="banner_1100 separa_bottom"><a href="<?php echo $row_banner_sup['link']; ?>" target="_blank"><img src="<?php echo $row_banner_sup['banner']; ?>" alt="<?php echo $row_banner_sup['alt']; ?>" /></a></div>
  <div class="main">
    <h1>BRUNCH-IN</h1>
<div class="post_recuadro">
			<?php $idcat = 2;?>
            <?php include("notas.php"); ?>
</div>
    <div class="banner_1100"><a href="<?php echo $row_banner_sup2['link']; ?>" target="_blank"><img src="<?php echo $row_banner_sup2['banner']; ?>" alt="<?php echo $row_banner_sup2['alt']; ?>" /></a></div>
</div>
  

  <!-- Foot -->
<?php include("foot.php"); ?>
<!-- FIN foot -->

</div>
</body>
</html>