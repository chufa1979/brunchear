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
$query_rs_banner_1 = "SELECT * FROM brunchear_banner WHERE ubicacion = 1";
$rs_banner_1 = mysql_query($query_rs_banner_1, $cone) or die(mysql_error());
$row_rs_banner_1 = mysql_fetch_assoc($rs_banner_1);
$totalRows_rs_banner_1 = mysql_num_rows($rs_banner_1);

mysql_select_db($database_cone, $cone);
$query_rs_banner_2 = "SELECT * FROM brunchear_banner WHERE ubicacion = 2";
$rs_banner_2 = mysql_query($query_rs_banner_2, $cone) or die(mysql_error());
$row_rs_banner_2 = mysql_fetch_assoc($rs_banner_2);
$totalRows_rs_banner_2 = mysql_num_rows($rs_banner_2);

mysql_select_db($database_cone, $cone);
$query_rs_banner_3 = "SELECT * FROM brunchear_banner WHERE ubicacion = 3";
$rs_banner_3 = mysql_query($query_rs_banner_3, $cone) or die(mysql_error());
$row_rs_banner_3 = mysql_fetch_assoc($rs_banner_3);
$totalRows_rs_banner_3 = mysql_num_rows($rs_banner_3);

mysql_select_db($database_cone, $cone);
$query_rs_banner_4 = "SELECT * FROM brunchear_banner WHERE ubicacion = 4";
$rs_banner_4 = mysql_query($query_rs_banner_4, $cone) or die(mysql_error());
$row_rs_banner_4 = mysql_fetch_assoc($rs_banner_4);
$totalRows_rs_banner_4 = mysql_num_rows($rs_banner_4);

mysql_select_db($database_cone, $cone);
$query_rsnot = "SELECT * FROM brunchear_nota ORDER BY id DESC";
$rsnot = mysql_query($query_rsnot, $cone) or die(mysql_error());
$row_rsnot = mysql_fetch_assoc($rsnot);
$totalRows_rsnot = mysql_num_rows($rsnot);

mysql_select_db($database_cone, $cone);
$query_rs_thumb_home = "SELECT * FROM brunchear_resto";
$rs_thumb_home = mysql_query($query_rs_thumb_home, $cone) or die(mysql_error());
$row_rs_thumb_home = mysql_fetch_assoc($rs_thumb_home);
$totalRows_rs_thumb_home = mysql_num_rows($rs_thumb_home);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<title>BRUNCHEAR</title>
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
  <div class="banner_1100 separa_bottom"><a href="<?php echo $row_rs_banner_1['link']; ?>" target="_blank"><img src="<?php echo $row_rs_banner_1['banner']; ?>" alt="<?php echo $row_rs_banner_1['alt']; ?>" /></a></div>
  <div class="columna_50 separa_der">
    <div class="post separa_bottom">
    <?php for($i=1;$i<=3;$i++) { ?>
      <div class="listado" onclick="window.location = 'post.php?vid=<?php echo $row_rsnot['id']; ?>';">
        <div class="num">1</div>
        <div class="foto"><img src="<?php echo $row_rsnot['imagen']; ?>" width="110" height="70" alt="<?php echo $row_rsnot['titulo']; ?>" /></div>
        <div class="txt"><?php echo $row_rsnot['titulo']; ?></div>
      </div>
      <?php $row_rsnot = mysql_fetch_assoc($rsnot); ?>
      <?php } ?>
      
      
      
      
    </div>
<div class="banner_540">
<a href="<?php echo $row_rs_banner_2['link']; ?>" target="_blank"><img src="<?php echo $row_rs_banner_2['banner']; ?>" alt="<?php echo $row_rs_banner_2['alt']; ?>" /></a></div>
  </div>
  <div class="columna_50 separa_bottom">
    <div id="mapa"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9289.89631531982!2d-58.43583105705647!3d-34.592165104766615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb58a45f59d85%3A0x51f3ad320d4ec47a!2sSarkis!5e0!3m2!1ses!2sar!4v1539462795110" width="100%" height="465" frameborder="0" style="border:0" allowfullscreen></iframe></div>
  </div>
  <div class="home_destacados">
<?php for($i=1; $i<=6; $i++) { ?>
    <div class="resto_thumb" style="background-image:url(<?php echo $row_rs_thumb_home['imagen02']; ?>);" onclick="window.location = 'guia.php';">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe"><?php echo $row_rs_thumb_home['restaurante']; ?></a>
        </div>
    </div>  
<?php $row_rs_thumb_home = mysql_fetch_assoc($rs_thumb_home);?>    
<?php } ?>

  </div>
  <div class="banner_1100 separa_bottom"><a href="<?php echo $row_rs_banner_3['link']; ?>" target="_blank"><img src="<?php echo $row_rs_banner_3['banner']; ?>" alt="<?php echo $row_rs_banner_3['alt']; ?>" /></a></div>
  <div class="columna_50 separa_der">
    <div class="destaca_redes separa_der">
    <iframe src="https://open.spotify.com/embed/track/3jPp0oUSbkvB34xMZ74R0h" width="100%" height="220" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
    </div>
    <div class="destaca_redes">
    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBrunchear%2F&tabs=timeline&width=190&height=220&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="220" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>
  </div>
  <div class="columna_50">
    <div class="banner_540"><a href="<?php echo $row_rs_banner_4['link']; ?>" target="_blank"><img src="<?php echo $row_rs_banner_4['banner']; ?>" alt="<?php echo $row_rs_banner_4['alt']; ?>" /></a></div>
  </div>
 
<!-- Foot -->
<?php include("foot.php"); ?>
<!-- FIN foot -->

</div>
</body>
</html>
<?php
mysql_free_result($rs_banner_1);

mysql_free_result($rsnot);

mysql_free_result($rs_thumb_home);
?>
